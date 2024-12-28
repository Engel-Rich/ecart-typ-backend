<?php

namespace App\Http\Controllers\Admin;

use App\Utils\Helpers;
use App\Models\Category;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use function App\Utils\translate;
use App\Http\Controllers\Controller;
use App\Models\TemporaryFile;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;


class CategoryController extends Controller
{
    public function __construct(
        private Category $category
    ){}

    /**
     * @param Request $request
     * @return Application|Factory|View
     */
    public function index(Request $request): View|Factory|Application
    {
        $categories = $this->category;
        $queryParam = [];
        $search = $request['search'];

        if($request->has('search')) {
            $key = explode(' ', $request['search']);
            $categories = $categories->where(function ($q) use ($key) {
                foreach ($key as $value) {
                    $q->orWhere('name', 'like', "%{$value}%");
                }
            });

            $queryParam = ['search' => $request['search']];
        }

        $categories = $categories->where(['position'=>0])->latest()->paginate(Helpers::pagination_limit())->appends($queryParam);
        return view('admin-views.category.index',compact('categories', 'search'));
    }

    /**
     * @param Request $request
     * @return Application|Factory|View
     */
    public function subIndex(Request $request): Factory|View|Application
    {
        $categories = $this->category;
        $queryParam = [];
        $search = $request['search'];

        if($request->has('search')) {
            $key = explode(' ', $request['search']);
            $categories = Category::where(function ($q) use ($key) {
                foreach ($key as $value) {
                    $q->orWhere('name', 'like', "%{$value}%");
                }
            });

            $queryParam = ['search' => $request['search']];
        }

        $categories = $categories->with(['parent'])->where(['position'=>1])->latest()->paginate(Helpers::pagination_limit())->appends($queryParam);
        return view('admin-views.category.sub-index',compact('categories', 'search'));
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required'
        ]);

        //uniqueness check
        $parentId = $request->parent_id ?? 0;
        $allCategory = $this->category->where(['parent_id' => $parentId])->pluck('name')->toArray();

        if (in_array($request->name, $allCategory)) {
            Toastr::error(translate(($request->parent_id == null ? 'Category' : 'Sub_category') . ' already exists!'));
            return back();
        }

        $session_images = Session::get("images.category");
        if($session_images) {
            $last_image = end($session_images);
            $image_name =  $last_image . '/' . TemporaryFile::where('folder', $last_image)->first()->filename;
        } else {
            $image_name = null;
        }

        $category = $this->category;
        $category->name = $request->name;
        $category->image = $image_name;
        $category->parent_id = $request->parent_id == null ? 0 : $request->parent_id;
        $category->position = $request->position;
        $category->save();

        Session::forget("images.category");

        Toastr::success(translate('Category stored successfully'),'' , ["positionClass" => "toast-top-right"]);
        return back();
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function status(Request $request): RedirectResponse
    {
        $category = $this->category->find($request->id);
        $category->status = $request->status;
        $category->save();

        Toastr::success(translate('Category status updated'),'' , ["positionClass" => "toast-top-right"]);
        return back();
    }

    /**
     * @param $id
     * @return Application|Factory|View
     */
    public function edit($id): View|Factory|Application
    {
        $category = $this->category->find($id);

        $image = null;
        if($category->image != 'def.png' && !empty($category->image)) {
            $image = collect([
                "source" => "storage/category/".$category->image,
                "options" =>  [
                    'type' => 'limbo'
                ]
            ]);
        }

        return view('admin-views.category.edit', compact('category', 'image'));
    }

    /**
     * @param $id
     * @return Application|Factory|View
     */
    public function editSub($id): Factory|View|Application
    {
        $category = $this->category->find($id);
        return view('admin-views.category.edit-sub-category', compact('category'));
    }

    /**
     * @param Request $request
     * @param $id
     * @return RedirectResponse
     */
    public function update(Request $request, $id): RedirectResponse
    {
        $request->validate([
            'name' =>'required|unique:categories,name,'.$request->id,
        ], [
            'name.required' => translate('Name is required'),
        ]);

        $category = $this->category->find($id);

        $session_images = Session::get("images.category");

        if($session_images) {
            $last_image = end($session_images);
            $imageName =  $last_image . '/' . TemporaryFile::where('folder', $last_image)->first()->filename;
        }else{
            $imageName = $category->image;
        }

        $category->name = $request->name;
        $category->image = $imageName;
        $category->save();

        Toastr::success(translate('Category updated successfully'),'' , ["positionClass" => "toast-top-right"]);
        return back();
    }

    /**
     * @param Request $request
     * @param $id
     * @return RedirectResponse
     */
    public function updateSub(Request $request, $id): RedirectResponse
    {
        $request->validate([
            'name' =>'required|unique:categories,name,'.$request->id
        ], [
            'name.required' => translate('Name is required'),
        ]);

        $category = $this->category->find($id);
        $category->name = $request->name;
        $category->save();

        Toastr::success(translate('Sub Category updated successfully'),'' , ["positionClass" => "toast-top-right"]);
        return back();
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function delete(Request $request): RedirectResponse
    {
        $category = $this->category->find($request->id);

        if ($category->childes->count()==0){
            Helpers::delete('category/' . $category['image']);
            $category->delete();
            Toastr::success(translate('Category removed'),'' , ["positionClass" => "toast-top-right"]);
        }else{
            Toastr::warning(translate('Remove subcategories first'),'' , ["positionClass" => "toast-top-right"]);
        }

        return back();
    }
}
