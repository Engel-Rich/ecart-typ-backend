@extends('layouts.admin.app')

@section('title', \App\Utils\translate('add_new_category'))

@push('css_or_js')
    <link rel="stylesheet" href="{{ asset('assets/admin') }}/css/custom.css" />
    <link rel="stylesheet" href="{{ asset('assets/filepond/css/filepond-plugin-image-preview.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/filepond/css/filepond.min.css') }}">
    <link href="{{ asset('assets/filepond/css/filepond-plugin-image-edit.css') }}" rel="stylesheet" />
@endpush

@section('content')
    <div class="content container-fluid">
        <div class="">
            <div class="row align-items-center mb-3">
                <div class="col-sm mb-2 mb-sm-0">
                    <h1 class="page-header-title d-flex align-items-center g-2px text-capitalize">
                        <i class="tio-add-circle-outlined"></i>
                        <span>{{ \App\Utils\translate('add_new_category') }}</span>
                    </h1>
                </div>
            </div>
        </div>
        <div class="row gx-2 gx-lg-3">
            <div class="col-sm-12 col-lg-12 mb-3 mb-lg-2">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('admin.category.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                                    <div class="form-group">
                                        <label for="">{{ \App\Utils\translate('category_name') }}</label>
                                        <input type="text" name="name" class="form-control"
                                            placeholder="{{ \App\Utils\translate('add_category_name') }}">
                                        <input name="position" value="0" class="d-none">
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6">
                                    <div class="form-group">
                                        <label>{{\App\Utils\translate('image')}}</label><small class="text-danger">* ( {{\App\Utils\translate('ratio_1:1')}}  )</small>
                                        <input
                                            type="file"
                                            class="filepond"
                                            name="category"
                                            data-max-file-size="55MB"
                                            data-max-files="100"
                                            data-allow-reorder="true"
                                            data-allow-multiple="true"
                                            class="custom-file-input"
                                        />
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">{{ \App\Utils\translate('submit') }}</button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-sm-12 col-lg-12 mb-3 mb-lg-2">
                <div class="card">
                    <div class="card-header">
                        <div class="w-100">
                            <div class="row">
                                <div class="col-12 col-sm-4 col-md-6 col-lg-7 col-xl-8">
                                    <h5>{{ \App\Utils\translate('category_table') }}
                                        <span class="badge badge-soft-dark">{{$categories->total()}}</span>
                                    </h5>


                                </div>
                                <div class=" col-12 col-sm-8 col-md-6 col-lg-5 col-xl-4">
                                    <form action="{{ url()->current() }}" method="GET">
                                        <div class="input-group input-group-merge input-group-flush">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <i class="tio-search"></i>
                                                </div>
                                            </div>
                                            <input id="datatableSearch_" type="search" name="search" class="form-control"
                                                   placeholder="{{ \App\Utils\translate('search_by_category') }}"
                                                   aria-label="Search orders" value="{{ $search }}" required>
                                            <button type="submit"
                                                    class="btn btn-primary">{{ \App\Utils\translate('search') }}</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive ">
                        <table
                            class="table table-borderless table-thead-bordered table-nowrap table-align-middle card-table">
                            <thead class="thead-light">
                                <tr>
                                    <th>{{ \App\Utils\translate('#') }}</th>
                                    <th>{{ \App\Utils\translate('image') }}</th>
                                    <th>{{ \App\Utils\translate('name') }}</th>
                                    <th>{{ \App\Utils\translate('status') }}</th>
                                    <th>{{ \App\Utils\translate('action') }}</th>
                                </tr>

                            </thead>

                            <tbody>
                                @foreach ($categories as $key => $category)
                                    <tr>
                                        <td>{{ $categories->firstitem() + $key }}</td>
                                        <td>
                                            <img src="{{ $category['image_fullpath'] }}"
                                                class="img-two-cati">
                                        </td>
                                        <td>
                                            <span class="d-block font-size-sm text-body">
                                                {{ $category['name'] }}
                                            </span>
                                        </td>
                                        <td>
                                            <label class="toggle-switch toggle-switch-sm">
                                                <input type="checkbox" class="toggle-switch-input change-status"
                                                       data-route="{{ route('admin.category.status', [$category['id'], $category->status ? 0 : 1]) }}"
                                                    class="toggle-switch-input" {{ $category->status ? 'checked' : '' }}>
                                                <span class="toggle-switch-label">
                                                    <span class="toggle-switch-indicator"></span>
                                                </span>
                                            </label>
                                        </td>
                                        <td>
                                            <a class="btn btn-white mr-1"
                                                href="{{ route('admin.category.edit', [$category['id']]) }}">
                                                <span class="tio-edit"></span>
                                            </a>
                                            <a class="btn btn-white mr-1 form-alert" href="javascript:"
                                               data-id="category-{{$category['id']}}"
                                               data-message="{{ \App\Utils\translate('Want to delete this category') }}?">
                                                <span class="tio-delete"></span>
                                            </a>
                                            <form action="{{ route('admin.category.delete', [$category['id']]) }}"
                                                method="post" id="category-{{ $category['id'] }}">
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
                                {!! $categories->links() !!}
                            </tfoot>
                        </table>
                        @if (count($categories) == 0)
                            <div class="text-center p-4">
                                <img class="mb-3 w-one-cati"
                                    src="{{ asset('assets/admin/img/no-data.jpg') }}"
                                    alt="Image Description">
                                <p class="mb-0">{{ \App\Utils\translate('No_data_to_show') }}</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script_2')
    <script src={{ asset('assets/admin/js/global.js') }}></script>
    <script src="{{asset("assets/admin/js/global.js")}}"></script>
    <script src="{{ asset('assets/filepond/js/filepond-plugin-file-encode.min.js') }}"></script>
    <script src="{{ asset("assets/filepond/js/filepond-plugin-file-validate-size.min.js") }}"></script>
    <script src="{{ asset('assets/filepond/js/filepond-plugin-image-preview.min.js') }}"></script>
    <script src="{{ asset('assets/filepond/js/filepond-plugin-image-exif-orientation.min.js') }}"></script>
    <script src="{{ asset('assets/filepond/js/filepond-plugin-image-edit.js') }}"></script>
    <script src="{{ asset('assets/filepond/js/filepond.min.js') }}"></script>

    <script>
        initializeFilePond('category',null,"{!! env('APP_URL') !!}","{!! csrf_token() !!}")
    </script>
@endpush
