<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Utils\Helpers;
use Brian2694\Toastr\Facades\Toastr;
use function App\Utils\translate;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{

    public function __construct(
        private Department $department
    ){}

    public function index(Request $request)
    {
        $queryParam = [];
        $search = $request['search'];
        if ($request->has('search')) {
            $key = explode(' ', $request['search']);
            $departements = $this->department->where(function ($q) use ($key) {
                foreach ($key as $value) {
                    $q->orWhere('name', 'like', "%{$value}%");
                }
            });
            $queryParam = ['search' => $request['search']];
        } else {
            $departements = $this->department;
        }

        $departements = $departements->latest()->paginate(Helpers::pagination_limit())->appends($queryParam);
        return view('admin-views.department.index',compact('departements','search'));
    }

    public function create()
    {
        return view('admin-views.department.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
        ]);

        $this->department->create($request->all());

        Toastr::success(translate('Department created successfully'));

        return redirect()->route('admin.departement.index');
    }

    public function edit($id)
    {
        $departement = $this->department->find($id);
        return view('admin-views.department.edit', compact('departement'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
        ]);

        $this->department->find($id)->update($request->all());

        Toastr::success(translate('Department updated successfully'));

        return redirect()->route('admin.departement.index');
    }

    public function destroy($id)
    {
        $this->department->find($id)->delete();

        Toastr::success(translate('Department deleted successfully'));

        return redirect()->route('admin.departement.index');
    }
}
