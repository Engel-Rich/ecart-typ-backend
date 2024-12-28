<?php

namespace App\Http\Controllers;

use App\Utils\Helpers;
use App\Traits\ActivationClass;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Validator;
use function App\Utils\translate;

class InstallController extends Controller
{
    use ActivationClass;

    public function purchaseShow()
    {
        return view('installation.purchase_code');
    }

    public function step1()
    {
        Artisan::call('storage:link');

        return view('installation.step1');
    }

    public function step2(Request $request)
    {
        if (Hash::check('step_2', $request['token'])) {
            //extensions
            $permission['curl'] = function_exists('curl_version');
            $permission['bcmath'] = extension_loaded('bcmath');
            $permission['ctype'] = extension_loaded('ctype');
            $permission['json'] = extension_loaded('json');
            $permission['mbstring'] = extension_loaded('mbstring');
            $permission['openssl'] = extension_loaded('openssl');
            $permission['pdo'] = defined('PDO::ATTR_DRIVER_NAME');
            $permission['tokenizer'] = extension_loaded('tokenizer');
            $permission['xml'] = extension_loaded('xml');
            $permission['zip'] = extension_loaded('zip');
            $permission['fileinfo'] = extension_loaded('fileinfo');
            $permission['gd'] = extension_loaded('gd');
            $permission['sodium'] = extension_loaded('sodium');

            //file permissions
            $permission['db_file_write_perm'] = is_writable(base_path('.env'));
            $permission['routes_file_write_perm'] = is_writable(base_path('app/Providers/RouteServiceProvider.php'));

            return view('installation.step2', compact('permission'));
        }
        session()->flash('error', 'Access denied!');
        return redirect()->route('step0');
    }

    public function step3(Request $request)
    {
        if (Hash::check('step_3', $request['token'])) {
            return view('installation.step3');
        }
        session()->flash('error', 'Access denied!');
        return redirect()->route('step1');
    }

    public function step4(Request $request)
    {
        if (Hash::check('step_4', $request['token'])) {
            return view('installation.step4');
        }
        session()->flash('error', 'Access denied!');
        return redirect()->route('step1');
    }

    public function step5(Request $request)
    {
        if (Hash::check('step_5', $request['token'])) {
            return view('installation.step5');
        }
        session()->flash('error', 'Access denied!');
        return redirect()->route('step1');
    }

    public function step6(Request $request)
    {
        if (Hash::check('step_6', $request['token'])) {
            return view('installation.step6');
        }
        session()->flash('error', 'Access denied!');
        return redirect()->route('step0');
    }

    public function system_settings(Request $request)
    {
        if (!Hash::check('step_6', $request['token'])) {
            session()->flash('error', 'Access denied!');
            return redirect()->route('step0');
        }

        Validator::make($request->all(),[
            'password' => 'required|min:8',
            'confirm_password' => 'required|same:password',
        ])->validate();

        DB::table('admins')->insertOrIgnore([
            'f_name' => $request['admin_f_name'],
            'l_name' => $request['admin_l_name'],
            'email' => $request['admin_email'],
            'password' => bcrypt($request['password']),
            'phone' => $request['phone_code'] . $request['admin_phone'],
            'role_id' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('admin_roles')->insertOrIgnore([
            'id' => 1,
            'name' => 'Master Admin',
            'modules' => null,
            'status' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('business_settings')->updateOrInsert(['key' => 'shop_name'], [
            'value' => $request['business_name']
        ]);

        $previousRouteServiceProvier = base_path('app/Providers/RouteServiceProvider.php');
        $newRouteServiceProvier = base_path('installation/RouteServiceProvider.txt');
        copy($newRouteServiceProvier, $previousRouteServiceProvier);

        Helpers::remove_dir(base_path('installation'));

        Helpers::remove_dir(base_path('resources/views/installation'));

        $route = base_path('routes/install.php');

        if (file_exists($route)) {
            unlink($route);
        }

        $config = base_path('config/purchase.php');

        if (file_exists($config)) {
            unlink($config);
        }

        return view('welcome');
    }

    public function database_installation(Request $request)
    {
        if (self::check_database_connection($request->DB_HOST, $request->DB_DATABASE, $request->DB_USERNAME, $request->DB_PASSWORD)) {

            $key = base64_encode(random_bytes(32));
            $output = 'APP_NAME=ecartify-'.time().'
                    APP_ENV=live
                    APP_KEY=base64:' . $key . '
                    APP_DEBUG=false
                    APP_INSTALL=true
                    APP_LOG_LEVEL=debug
                    APP_MODE=live
                    APP_URL=' . URL::to('/') . '

                    DB_CONNECTION=mysql
                    DB_HOST=' . $request->DB_HOST . '
                    DB_PORT=3306
                    DB_DATABASE=' . $request->DB_DATABASE . '
                    DB_USERNAME=' . $request->DB_USERNAME . '
                    DB_PASSWORD="' . $request->DB_PASSWORD . '"

                    BROADCAST_DRIVER=log
                    CACHE_DRIVER=file
                    SESSION_DRIVER=file
                    SESSION_LIFETIME=60
                    QUEUE_DRIVER=sync

                    REDIS_HOST=127.0.0.1
                    REDIS_PASSWORD=null
                    REDIS_PORT=6379

                    PUSHER_APP_ID=
                    PUSHER_APP_KEY=
                    PUSHER_APP_SECRET=
                    PUSHER_APP_CLUSTER=mt1

                    SOFTWARE_VERSION=1.0
                    '; //to_be_set software_id_encrypted
            $file = fopen(base_path('.env'), 'w');
            fwrite($file, $output);
            fclose($file);

            $path = base_path('.env');
            if (file_exists($path)) {
                return redirect()->route('step4', ['token' => $request['token']]);
            } else {
                session()->flash('error', 'Database error!');
                return redirect()->route('step3', ['token' => bcrypt('step_3')]);
            }
        } else {
            session()->flash('error', translate('Database error'));
            return redirect()->route('step3', ['token' => bcrypt('step_3')]);
        }
    }

    public function import_sql()
    {
        try {
            $sql_path = base_path('installation/backup/database.sql');
            DB::unprepared(file_get_contents($sql_path));
            return redirect()->route('step5',['token' => bcrypt('step_5')]);
        } catch (\Exception $exception) {
            session()->flash('error', 'Your database is not clean, do you want to clean database then import?');
            return back();
        }
    }

    public function force_import_sql()
    {
        try {
            Artisan::call('db:wipe');
            $sql_path = base_path('installation/backup/database.sql');
            DB::unprepared(file_get_contents($sql_path));
            return  redirect()->route('step5',['token' => bcrypt('step_5')]);
        } catch (\Exception $exception) {
            session()->flash('error', 'Check your database permission!');
            return back();
        }
    }

    function check_database_connection($db_host = "", $db_name = "", $db_user = "", $db_pass = "")
    {
        try {
            $conn = new \PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_pass);
            // set the PDO error mode to exception
            $conn->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            return true;
        } catch (\PDOException $e) {
            return false;
        }
    }

    public function purchase_code(Request $request)
    {
        if(Hash::check('purchase', $request['token'])){
            $request->validate([
                'purchase_code' => 'required'
            ]);

            try {
                $purchase_code = $request->purchase_code;
                $personalToken = config('purchase.token');

                $code = trim($purchase_code);


                if (!preg_match("/^([a-f0-9]{8})-(([a-f0-9]{4})-){3}([a-f0-9]{12})$/i", $code)) {
                    // throw new Exception("Invalid purchase code");
                    session()->flash('error', 'Invalid purchase code');

                    return redirect()->route('purchase-code-show');
                }

                $response = Http::withHeaders([
                    "Authorization" => "Bearer {$personalToken}",
                    "User-Agent" => "Purchase code verification script"
                ])->get(config('purchase.base_url'), [
                    'code' => $code
                ]);

                $responseCode = $response->status();

                switch ($responseCode) {
                    case 404:
                        session()->flash('error', 'No sale belonging to the current user found with that code');
                        return redirect()->route('purchase-code-show');
                    case 403:
                        session()->flash('error', 'The personal token is not authorized to access the purchase code');
                        return redirect()->route('purchase-code-show');
                    case 401:
                        session()->flash('error', 'The personal token is invalid or has been deleted');
                        return redirect()->route('purchase-code-show');
                }

                if ($responseCode !== 200) {
                    // throw new Exception("Got status {$responseCode}, try again shortly");
                    session()->flash('error', "Got status {$responseCode}, try again shortly");
                    return redirect()->route('purchase-code-show');
                }else if($responseCode === 200){
                    session()->flash('success', 'Purchase code verified successfully');
                    return redirect()->route('step1', ['token' => bcrypt('purchase')]);
                }

                $body = $response->json();

                if ($body === null) {
                    // throw new Exception("Error parsing response, try again");
                    session()->flash('error', "Error parsing response, try again");
                    return redirect()->route('purchase-code-show');
                }

                return redirect()->route('step1', ['token' => bcrypt('purchase')]);
            } catch (\Exception $exception) {
                session()->flash('error', $exception->getMessage());

                return redirect()->route('purchase-code-show');
            }
        }

        session()->flash('error', 'Access denied!');

        return redirect()->route('purchase-code-show');
    }
}
