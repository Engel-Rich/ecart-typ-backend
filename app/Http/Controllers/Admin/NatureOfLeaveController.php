<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\NatureOfLeave;
use App\Utils\Helpers;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use function App\Utils\translate;

class NatureOfLeaveController extends Controller
{
    public function __construct(
        private NatureOfLeave $natureOfLeave
    ){}

    public function index(Request $request)
    {
        $queryParam = [];
        $search = $request['search'];
        if ($request->has('search')) {
            $key = explode(' ', $request['search']);
            $natureOfLeaves = $this->natureOfLeave->where(function ($q) use ($key) {
                foreach ($key as $value) {
                    $q->orWhere('name', 'like', "%{$value}%");
                }
            });
            $queryParam = ['search' => $request['search']];
        } else {
            $natureOfLeaves = $this->natureOfLeave;
        }

        $natureOfLeaves = $natureOfLeaves->latest()->paginate(Helpers::pagination_limit())->appends($queryParam);
        return view('admin-views.natureOfLeaves.index',compact('natureOfLeaves','search'));
    }

    public function create()
    {
        return view('admin-views.natureOfLeaves.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
        ]);

        $this->natureOfLeave->create($request->all());

        Toastr::success(translate('nature_of_leave created successfully'));

        return redirect()->route('admin.natureofleave.index');
    }

    public function edit($id)
    {
        $natureOfLeave = $this->natureOfLeave->find($id);
        return view('admin-views.natureOfLeaves.edit', compact('natureOfLeave'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
        ]);

        $this->natureOfLeave->find($id)->update($request->all());

        Toastr::success(translate('nature_of_leave updated successfully'));

        return redirect()->route('admin.natureofleave.index');
    }

    public function destroy($id)
    {
        $this->natureOfLeave->find($id)->delete();

        Toastr::success(translate('nature_of_leave deleted successfully'));

        return redirect()->route('admin.natureofleave.index');
    }
}
