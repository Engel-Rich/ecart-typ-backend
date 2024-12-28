@extends('layouts.admin.app')

@section('title',\App\Utils\translate('add_new_brand'))

@push('css_or_js')
    <link rel="stylesheet" href="{{asset('assets/admin')}}/css/custom.css"/>
    <link rel="stylesheet" href="{{ asset('assets/filepond/css/filepond-plugin-image-preview.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/filepond/css/filepond.min.css') }}">
    <link href="{{ asset('assets/filepond/css/filepond-plugin-image-edit.css') }}" rel="stylesheet" />
@endpush

@section('content')
<div class="content container-fluid">
        <div class="">
            <div class="row align-items-center mb-3 ">
                <div class="col-sm mb-2 mb-sm-0">
                    <h1 class="page-header-title d-flex align-items-center g-2px text-capitalize">
                        <i class="tio-add-circle-outlined"></i>
                        <span>{{\App\Utils\translate('add_new_brand')}}</span>
                    </h1>
                </div>
            </div>
        </div>
        <div class="row gx-2 gx-lg-3">
            <div class="col-sm-12 col-lg-12 mb-3 mb-lg-2">
                <div class="card">
                    <div class="card-body">
                        <form action="{{route('admin.brand.store')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-12 col-sm-12">
                                    <div class="form-group">
                                        <label for="">{{\App\Utils\translate('brand_name')}}</label>
                                        <input type="text" name="name" class="form-control" placeholder="{{\App\Utils\translate('brand_name')}}">
                                        <input name="position" value="0" class="d-none">
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6">
                                    <div class="form-group">
                                        <label>{{\App\Utils\translate('image')}}</label><small class="text-danger">* ( {{\App\Utils\translate('ratio_1:1')}}  )</small>
                                        <input
                                            type="file"
                                            class="filepond"
                                            name="brand"
                                            data-max-file-size="55MB"
                                            data-max-files="100"
                                            data-allow-reorder="true"
                                            data-allow-multiple="true"
                                            class="custom-file-input"
                                        />
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">{{\App\Utils\translate('submit')}}</button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-sm-12 col-lg-12 mb-3 mb-lg-2">
                <div class="card">
                    <div class="card-header">
                        <div>
                            <h5>{{ \App\Utils\translate('brand_table')}}<span class="badge badge-soft-dark ml-2">{{$brands->total()}}</span></h5>
                        </div>
                    </div>
                    <!-- Table -->
                    <div class="table-responsive ">
                        <table class="table table-borderless table-thead-bordered table-nowrap table-align-middle card-table">
                            <thead class="thead-light">
                            <tr>
                                <th >{{\App\Utils\translate('#')}}</th>
                                <th >{{\App\Utils\translate('image')}}</th>
                                <th >{{\App\Utils\translate('name')}}</th>
                                <th class="w-one-bri">{{\App\Utils\translate('action')}}</th>
                            </tr>

                            </thead>
                            <tbody>
                            @foreach($brands as $key=>$brand)
                                <tr>
                                    <td>{{ $brands->firstItem()+$key }}</td>
                                    <td>
                                        <img class="img-two-bri"
                                        src="{{ $brand['image_fullpath'] }}" alt="">
                                    </td>
                                    <td>
                                    <span class="d-block font-size-sm text-body">
                                        {{$brand['name']}}
                                    </span>
                                    </td>
                                    <td>
                                        <a class="btn btn-white mr-1"
                                           href="{{route('admin.brand.edit',[$brand['id']])}}"><span class="tio-edit"></span></a>
                                        <a class="btn btn-white mr-1 form-alert" href="javascript:"
                                           data-id="brand-{{$brand['id']}}"
                                           data-message="{{ \App\Utils\translate('Want to delete this brand') }}?">
                                            <span class="tio-delete"></span>
                                        </a>
                                        <form action="{{route('admin.brand.delete',[$brand['id']])}}"
                                              method="post" id="brand-{{$brand['id']}}">
                                            @csrf @method('delete')
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>

                        <hr>
                        <table>
                            <tfoot>
                            {!! $brands->links() !!}
                            </tfoot>
                        </table>
                        @if(count($brands)==0)
                            <div class="text-center p-4">
                                <img class="mb-3 w-two-bri" src="{{ asset('assets/admin/img/no-data.jpg') }}" alt="{{\App\Utils\translate('image_description')}}">
                                <p class="mb-0">{{ \App\Utils\translate('No_data_to_show')}}</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            <!-- End Table -->
        </div>
    </div>
@endsection

@push('script_2')
    <script src="{{asset("assets/admin/js/global.js")}}"></script>
    <script src="{{ asset('assets/filepond/js/filepond-plugin-file-encode.min.js') }}"></script>
    <script src="{{ asset("assets/filepond/js/filepond-plugin-file-validate-size.min.js") }}"></script>
    <script src="{{ asset('assets/filepond/js/filepond-plugin-image-preview.min.js') }}"></script>
    <script src="{{ asset('assets/filepond/js/filepond-plugin-image-exif-orientation.min.js') }}"></script>
    <script src="{{ asset('assets/filepond/js/filepond-plugin-image-edit.js') }}"></script>
    <script src="{{ asset('assets/filepond/js/filepond.min.js') }}"></script>

    <script>
        initializeFilePond('brand',null,"{!! env('APP_URL') !!}","{!! csrf_token() !!}")
    </script>
@endpush
