@extends('layouts.admin.app')

@section('title',\App\Utils\translate('nature_of_leave'))

@push('css_or_js')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endpush

@section('content')
    <div class="content container-fluid">
        <div class="row align-items-center mb-3">
            <div class="col-sm mb-2 mb-sm-0">
                <h1 class="page-header-title d-flex align-items-center g-2px text-capitalize"><i
                        class="tio-filter-list"></i> {{\App\Utils\translate('nature_of_leave')}}
                    <span class="badge badge-soft-dark ml-2">{{$natureOfLeaves->total()}}</span>
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
                                <a href="{{route('admin.natureofleave.create')}}" class="btn btn-primary float-right"><i
                                        class="tio-add-circle"></i> {{\App\Utils\translate('add_new_natureofleave')}}
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
                                <th class="hide-div-sl">{{\App\Utils\translate('description')}}</th>
                                <th>{{\App\Utils\translate('action')}}</th>
                            </tr>
                            </thead>

                            <tbody id="set-rows">
                            @foreach($natureOfLeaves as $key=>$natureOfLeave)
                                <tr>
                                    <td>{{ $natureOfLeaves->firstItem()+$key }}</td>
                                    <td>
                                        <a class="text-primary" href="{{ route('admin.natureofleave.edit',[$natureOfLeave['id']]) }}">
                                            {{ $natureOfLeave->name }}
                                        </a>
                                    </td>
                                    <td>
                                        <a class="text-primary" href="{{ route('admin.natureofleave.edit',[$natureOfLeave['id']]) }}">
                                            {{ $natureOfLeave->description }}
                                        </a>
                                    </td>
                                    <td>
                                        <a class="btn btn-white mr-1"
                                            href="{{route('admin.natureofleave.edit',[$natureOfLeave['id']])}}">
                                            <span class="tio-edit"></span>
                                        </a>
                                        <a class="btn btn-white mr-1 form-alert" href="javascript:"
                                           data-id="natureofleave-{{$natureOfLeave['id']}}"
                                           data-message="{{ \App\Utils\translate('Want to delete this natureOfLeave') }}?"><span class="tio-delete"></span></a>
                                            <form action="{{route('admin.natureofleave.delete',[$natureOfLeave['id']])}}"
                                                    method="post" id="natureofleave-{{$natureOfLeave['id']}}">
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
                                {!! $natureOfLeaves->links() !!}
                                </tfoot>
                            </table>
                        </div>
                        @if(count($natureOfLeaves)==0)
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
