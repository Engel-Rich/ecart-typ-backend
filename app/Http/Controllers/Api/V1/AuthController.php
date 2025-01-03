<?php

namespace App\Http\Controllers\Api\V1;

use App\Utils\Helpers;
use App\Models\Admin;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use function App\Utils\translate;

class AuthController extends Controller
{
    public function __construct(
        private Admin $admin
    )
    {
    }

    /**
     * @param Request $request
     * @return Application|ResponseFactory|JsonResponse|Response
     */
    public function adminLogin(Request $request): Response|JsonResponse|Application|ResponseFactory
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required',
            'password' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => Helpers::error_processor($validator)], 403);
        }

        $admin = $this->admin->where('email', $request->email)->first();

        if ($admin) {
            if (Hash::check($request->password, $admin->password)) {
                $token = $admin->createToken('LaravelPassportClient')->accessToken;
                return response()->json(
                    ['message' => translate('You are logged in'), 'token' => $token],
                    200
                );
            } else {
                $response = ["message" => translate('Password mismatch')];
                return response($response, 422);
            }
        } else {
            $response = ["message" => translate('Wrong credentials! please input correct email and password')];
            return response($response, 422);
        }
    }

    /**
     * @param Request $request
     * @return JsonResponse|void
     */
    public function passwordChange(Request $request)
    {
        $adminId = Auth::guard('admin-api')->user()->id;
        $validator = Validator::make($request->all(), [
            'password' => 'required|same:confirm_password|min:8',
            'confirm_password' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => Helpers::error_processor($validator)], 403);
        }
        if (isset($adminId)) {
            DB::table('admins')->where(['id' => $adminId])->update([
                'password' => bcrypt($request['confirm_password'])
            ]);
            return response()->json(['message' => translate('Password changed successfully.')], 200);
        }
    }

    /**
     * @return JsonResponse
     */
    public function profile(Request $request): JsonResponse
    {
        $profile = Admin::where('id', $request->user()->id)->with('role')->first();
        if ($profile?->role) {
            $profile->role->modules = json_decode($profile->role->modules);
        }

        return response()->json($profile, 200);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function logOut(Request $request): JsonResponse
    {
        try {
            $request->admin()->token()->revoke();
            return response()->json([
                'message' => translate('Successfully logged out'),
                "success" => true
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => translate('Something wrong'),
                "success" => false
            ], 403);
        }
    }
}
