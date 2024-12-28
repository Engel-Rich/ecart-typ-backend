<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AdminRole;
use App\Models\Department;
use App\Models\LeaveRequest;
use App\Models\NatureOfLeave;
use App\Utils\Helpers;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use function App\Utils\translate;

class LeaveRequestController extends Controller
{
    public function __construct(
        private LeaveRequest $leaveRequest,
        private AdminRole $role,
        private Department $department,
        private NatureOfLeave $natureOfLeave
    ){}

    public function index(Request $request)
    {
        $queryParam = [];
        $search = $request['search'];
        if ($request->has('search')) {
            $key = explode(' ', $request['search']);
            $leaveRequests = $this->leaveRequest
            ->with('natureOfLeave','department','adminRole')
            ->where(function ($q) use ($key) {
                foreach ($key as $value) {
                    $q->orWhere('name', 'like', "%{$value}%");
                }
            });
            $queryParam = ['search' => $request['search']];
        } else {
            $leaveRequests = $this->leaveRequest;
        }

        $demandes = $leaveRequests
                    ->with('natureOfLeave','department','adminRole')
                    ->latest()
                    ->paginate(Helpers::pagination_limit())->appends($queryParam);

        return view('admin-views.leave-requests.index',compact('demandes','search'));
    }

    public function create()
    {
        $firstname_lastname = Auth::guard('admin')->user()->f_name . ' ' . Auth::guard('admin')->user()->l_name;
        $services = $this->role->all();
        $departments = $this->department->all();
        $natureOfLeaves = $this->natureOfLeave->all();

        return view('admin-views.leave-requests.create', compact('firstname_lastname','services','departments','natureOfLeaves'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'admin_id' => 'required',
            'department_id' => 'required',
            'nature_of_leave_id' => 'required',
            'from' => 'required',
            'to' => 'required',
        ]);

        $this->leaveRequest->create([
            'user_id' => Auth::guard('admin')->user()->id,
            'name' => Auth::guard('admin')->user()->f_name . ' ' . Auth::guard('admin')->user()->l_name,
            'admin_id' => $request->admin_id,
            'department_id' => $request->department_id,
            'nature_of_leave_id' => $request->nature_of_leave_id,
            'number_days' => $request->number_days,
            'from' => $request->from,
            'to' => $request->to,
            'reason' => $request->reason,
        ]);
        Toastr::success(translate('Leave request created successfully'));

        return redirect()->route('admin.leave-request.index');

    }

    public function edit($id)
    {
        $demande = $this->leaveRequest
                        ->with('natureOfLeave','department','adminRole')
                        ->where('user_id',Auth::guard('admin')->user()->id)
                        ->find($id);
        if(!$demande) {
            Toastr::error(translate('Leave request not found'));
            return redirect()->route('admin.leave-request.index');
        }
        $services = $this->role->all();
        $departments = $this->department->all();
        $natureOfLeaves = $this->natureOfLeave->all();

        return view('admin-views.leave-requests.edit', compact('demande','services','departments','natureOfLeaves'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'admin_id' => 'required',
            'department_id' => 'required',
            'nature_of_leave_id' => 'required',
            'from' => 'required',
            'to' => 'required',
        ]);

        $this->leaveRequest->find($id)->update([
            'user_id' => Auth::guard('admin')->user()->id,
            'admin_id' => $request->admin_id,
            'department_id' => $request->department_id,
            'nature_of_leave_id' => $request->nature_of_leave_id,
            'number_days' => $request->number_days,
            'from' => $request->from,
            'to' => $request->to,
            'reason' => $request->reason,
        ]);
        Toastr::success(translate('Leave request updated successfully'));

        return redirect()->route('admin.leave-request.index');
    }

    public function destroy($id)
    {
        $this->leaveRequest
        ->where('user_id',Auth::guard('admin')->user()->id)
        ->find($id)->delete();

        Toastr::success(translate('Leave request deleted successfully'));

        return redirect()->route('admin.leave-request.index');
    }

    public function updateStatus(Request $request)
    {
        $this->leaveRequest->find($request->id)->update(['status' => $request->status]);

        Toastr::success(translate('Leave request status updated successfully'));

        return response()->json(['success' => 'success','message' => 'Leave request status updated successfully']);
    }
}
