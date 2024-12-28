@extends('layouts.admin.app')

@section('title',\App\Utils\translate('demande_list'))

@push('css_or_js')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endpush

@section('content')
    <div class="content container-fluid">
        <div class="row align-items-center mb-3">
            <div class="col-sm mb-2 mb-sm-0">
                <h1 class="page-header-title d-flex align-items-center g-2px text-capitalize"><i
                        class="tio-filter-list"></i> {{\App\Utils\translate('demande_list')}}
                    <span class="badge badge-soft-dark ml-2">{{$demandes->total()}}</span>
                </h1>
            </div>
        </div>
        <div class="row gx-2 gx-lg-3">
            <div class="col-sm-12 col-lg-12 mb-3 mb-lg-2">
                <div class="card">
                    <div class="card-header">
                        <div class="row justify-content-between align-items-center flex-grow-1">
                            <div class="col-12 col-md-6 mb-3">
                                <form action="{{url()->current()}}" method="GET">
                                    <div class="input-group input-group-merge input-group-flush">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="tio-search"></i>
                                            </div>
                                        </div>
                                        <input id="datatableSearch_" type="search" name="search" class="form-control"
                                               placeholder="{{\App\Utils\translate('search_by_name')}}" aria-label="{{\App\Utils\translate('Search')}}" value="{{ $search }}" required>
                                        <button type="submit" class="btn btn-primary">{{\App\Utils\translate('search')}} </button>
                                    </div>
                                </form>
                            </div>
                            <div class="col-12 col-md-6">
                                <a href="{{route('admin.leave-request.create')}}" class="btn btn-primary float-right"><i
                                        class="tio-add-circle"></i> {{\App\Utils\translate('add_new_leave_request')}}
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive datatable-custom">
                        <table class="table table-borderless table-thead-bordered table-nowrap table-align-middle card-table">
                            <thead class="thead-light">
                            <tr>
                                <th>{{\App\Utils\translate('#')}}</th>
                                <th>{{\App\Utils\translate('name')}}</th>
                                <th>{{\App\Utils\translate('service')}}</th>
                                <th>{{\App\Utils\translate('department')}}</th>
                                <th>{{\App\Utils\translate('nature_of_leave')}}</th>
                                <th>{{\App\Utils\translate('start_date')}}</th>
                                <th>{{\App\Utils\translate('end_date')}}</th>
                                <th>{{\App\Utils\translate('status')}}</th>
                                <th>{{\App\Utils\translate('action')}}</th>
                            </tr>
                            </thead>

                            <tbody id="set-rows">
                            @foreach($demandes as $key=>$demande)
                                <tr>
                                    <td>{{ $demandes->firstItem()+$key }}</td>
                                    <td>
                                        <a class="text-primary" href="{{ route('admin.leave-request.edit',[$demande['id']]) }}">
                                            {{ $demande->name }}
                                        </a>
                                    </td>
                                    <td>
                                        <a class="text-primary" href="{{ route('admin.leave-request.edit',[$demande['id']]) }}">
                                            {{ $demande->adminRole->name }}
                                        </a>
                                    </td>
                                    <td>
                                        <a class="text-primary" href="{{ route('admin.leave-request.edit',[$demande['id']]) }}">
                                            {{ $demande->department->name }}
                                        </a>
                                    </td>
                                    <td>
                                        <a class="text-primary" href="{{ route('admin.leave-request.edit',[$demande['id']]) }}">
                                            {{ $demande->natureOfLeave->name }}
                                        </a>
                                    </td>
                                    <td>
                                        <a class="text-primary" href="{{ route('admin.leave-request.edit',[$demande['id']]) }}">
                                            {{ $demande->from }}
                                        </a>
                                    </td>
                                    <td>
                                        <a class="text-primary" href="{{ route('admin.leave-request.edit',[$demande['id']]) }}">
                                            {{ $demande->to }}
                                        </a>
                                    </td>
                                    <td id="status_td_{{$demande->id}}">
                                        @if (\App\Utils\Helpers::module_permission_check('can_change_status_leave_request'))
                                            <span class="badge badge-{{$demande->status == 'pending' ? 'warning' : ($demande->status == 'approved' ? 'success' : 'danger')}} status-badge" onclick="showStatusDropdown({{$demande->id}})" data-toggle="tooltip" title="Click to change status">{{ \App\Utils\translate(ucfirst($demande->status)) }}</span>
                                            <select class="form-control d-none" id="status_select_{{$demande->id}}">
                                                <option value="pending" {{ $demande->status == 'pending' ? 'selected' : '' }}>{{ \App\Utils\translate('Pending') }}</option>
                                                <option value="approved" {{ $demande->status == 'approved' ? 'selected' : '' }}>{{ \App\Utils\translate('Approved') }}</option>
                                                <option value="rejected" {{ $demande->status == 'rejected' ? 'selected' : '' }}>{{ \App\Utils\translate('Rejected') }}</option>
                                            </select>
                                            <button class="btn btn-danger btn-sm d-none mt-1" onclick="updateStatus({{$demande->id}})">{{ \App\Utils\translate('Update') }}</button>
                                        @else
                                            <span class="badge badge-{{$demande->status == 'pending' ? 'warning' : ($demande->status == 'approved' ? 'success' : 'danger')}} status-badge">{{ \App\Utils\translate(ucfirst($demande->status)) }}</span>
                                        @endif
                                    </td>

                                    <td>
                                        <a class="btn btn-white mr-1"
                                            href="{{route('admin.leave-request.edit',[$demande['id']])}}">
                                            <span class="tio-edit"></span>
                                        </a>
                                        <a class="btn btn-white mr-1 form-alert" href="javascript:"
                                           data-id="demande-{{$demande['id']}}"
                                           data-message="{{ \App\Utils\translate('Want to delete this demande') }}?"><span class="tio-delete"></span></a>
                                            <form action="{{route('admin.leave-request.delete',[$demande['id']])}}"
                                                    method="post" id="demande-{{$demande['id']}}">
                                                @csrf @method('delete')
                                            </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>

                        <div class="page-area">
                            <table>
                                <tfoot class="border-top">
                                {!! $demandes->links() !!}
                                </tfoot>
                            </table>
                        </div>
                        @if(count($demandes)==0)
                            <div class="text-center p-4">
                                <img class="mb-3 img-one-sl" src="{{ asset('assets/admin/img/no-data.jpg') }}" alt="{{\App\Utils\translate('Image Description')}}">
                                <p class="mb-0">{{ \App\Utils\translate('No_data_to_show')}}</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script_2')
    <script src={{asset("assets/admin/js/global.js")}}></script>
    <script>
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();
        });
        function showStatusDropdown(id) {
            $('#status_td_' + id + ' .status-badge').addClass('d-none');
            $('#status_select_' + id).removeClass('d-none');
            $('#status_select_' + id).siblings('button').removeClass('d-none');
        }

        function updateStatus(id) {
            let status = $('#status_select_'+id).val();
            $.ajax({
                url: '{{route('admin.leave-request.update-status')}}',
                type: 'POST',
                data: {
                    id: id,
                    status: status,
                    _token: '{{csrf_token()}}'
                },
                success: function (data) {
                   // console.log(data)
                    if (data.success == 'success') {
                        toastr.success(data.message);
                        // Update badge after saving
                        $('#status_td_' + id + ' .status-badge').removeClass('badge-warning badge-success badge-danger');
                        $('#status_td_' + id + ' .status-badge').addClass('badge-' + (status == 'pending' ? 'warning' : (status == 'approved' ? 'success' : 'danger')));
                        $('#status_td_' + id + ' .status-badge').text(status.charAt(0).toUpperCase() + status.slice(1));
                    } else {
                        toastr.error(data.message);
                    }
                    // Hide select dropdown and button after saving
                    $('#status_select_' + id).addClass('d-none');
                    $('#status_select_' + id).siblings('button').addClass('d-none');
                    // Show badge again after saving
                    $('#status_td_' + id + ' .status-badge').removeClass('d-none');
                }
            });
        }
    </script>
@endpush
