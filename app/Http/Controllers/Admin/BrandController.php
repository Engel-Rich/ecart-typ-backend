<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Utils\Helpers;
use App\Models\Brand;
use App\Models\TemporaryFile;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Session;

use function App\Utils\translate;

class BrandController extends Controller
{
    public function __construct(
        private Brand $brand
    ){}

    /**
     * @return Application|Factory|View
     */
    public function index(): View|Factory|Application
    {
        $brands = $this->brand->latest()->paginate(Helpers::pagination_limit());
        return view('admin-views.brand.index', compact('brands'));
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required|unique:brands,name'
        ], [
            'name.required' => translate('Name is required'),
        ]);
        $session_images = Session::get("images.brand");
        /* if (!empty($request->file('image'))) {
            $imageName =  Helpers::upload('brand/', 'png', $request->file('image'));
        } else {
            $imageName = 'def.png';
        } */
        if($session_images) {
            $last_image = end($session_images);
            $imageName =  $last_image . '/' . TemporaryFile::where('folder', $last_image)->first()->filename;
        } else {
            $imageName = null;
        }
        $brand = $this->brand;
        $brand->name = $request->name;
        $brand->image = $imageName;
        $brand->save();

        Toastr::success(translate('Brand stored successfully'),'' , ["positionClass" => "toast-top-right"]);
        return back();
    }

    /**
     * @param $id
     * @return Application|Factory|View
     */
    public function edit($id): Factory|View|Application
    {
        $brand = $this->brand->find($id);
        $image = null;
        if($brand->image != 'def.png' && !empty($brand->image)) {
            $image = collect([
                "source" => "storage/brand/".$brand->image,
                "options" =>  [
                    'type' => 'limbo'
                ]
            ]);
        }

        return view('admin-views.brand.edit',compact('brand','image'));
    }

    /**
     * @param Request $request
     * @param $id
     * @return RedirectResponse
     */
    public function update(Request $request, $id): RedirectResponse
    {
        $request->validate([
            'name' => 'required|unique:brands,name,'. $id,
        ], [
            'name.required' => translate('Name is required'),
        ]);

        $brand = $this->brand->find($id);

        $session_images = Session::get("images.brand");
        if($session_images) {
            $last_image = end($session_images);
            $imageName =  $last_image . '/' . TemporaryFile::where('folder', $last_image)->first()->filename;
        } else {
            $imageName = $brand->image;
        }

        $brand->name = $request->name;
        $brand->image = $imageName;
        $brand->save();

        Session::forget("images.brand");

        Toastr::success(translate('Brand updated successfully'), '' , ["positionClass" => "toast-top-right"]);
        return back();
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function delete(Request $request): RedirectResponse
    {
        $brand = $this->brand->find($request->id);
        Helpers::delete('brand/' . $brand['image']);
        $brand->delete();

        Toastr::success(translate('Brand deleted successfully'), '' , ["positionClass" => "toast-top-right"]);
        return back();
    }
}
