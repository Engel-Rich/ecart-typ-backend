<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\CategoryImage;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\Shop;
use App\Models\TemporaryFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image as ResizeImage;

class UploadController extends Controller
{
    public function store(Request $request, $id_folder)
    {
        if($request->file($id_folder) != null) {
            $file = $request->file($id_folder);
            $folder = uniqid() . '-' . now()->timestamp;
            $params_size = $id_folder;
            if (!is_dir(storage_path("app/public/$id_folder/".$folder))){
                mkdir(storage_path("app/public/$id_folder/".$folder), 0777, true);
            }
            // you can change this value in config/image.php

            $img_width = config("image.$params_size.default.width");
            $img_height = config("image.$params_size.default.height");

            $img = ResizeImage::make($file)->fit($img_width, $img_height, function($constraint) {
                $constraint->aspectRatio();
            })->setDriver(new \Intervention\Image\Gd\Driver);

            // convert to webp
            $img->encode('webp', 100);

            $img_name = time() . '-'. pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME) . '.webp';

            $img_name = preg_replace('/[^A-Za-z0-9\-\.]/', '', $img_name);
            /* save in storage with folder */
            $img->save(storage_path("app/public/$id_folder/".$folder.'/'.$img_name));

            $temporaryFile = new TemporaryFile();
            $temporaryFile->folder = $folder;
            $temporaryFile->filename = $img_name;
            $temporaryFile->save();

            Session::push("images.$id_folder", $folder);
            return $folder;
        }
    }

    public function revert(Request $request,$id_folder)
    {
        $fileId = $request->getContent();

        Session::forget("images.$id_folder");

        $urlExtract = explode('/', $fileId);


        if(isset($urlExtract[2]) && isset($urlExtract[3])) {
            $newUrl = $urlExtract[2] . '/' . $urlExtract[3];
        }else{
            $newUrl = $urlExtract[2] ?? "";
        }

        $temporaryFile = TemporaryFile::whereFolder($newUrl)->first();
        if($temporaryFile) {
            $temporaryFile->delete();
            // delete folder and files in storage
            if(Storage::disk('public')->exists("$id_folder/".$fileId)) {
                Storage::disk('public')->deleteDirectory("$id_folder/".$fileId);
            }
        }

        $brand = Brand::where('image', $newUrl)->first();
        $category = Category::where('image', $newUrl)->first();
        $product = Product::where('image', $newUrl)->first();

        if($brand) {
            $brand->image = null;
            $brand->save();
        }

        if($category) {
            $category->image = null;
            $category->save();
        }

        if($product) {
            $product->image = null;
            $product->save();
        }
    }
}
