@extends('layouts.admin.app')

@section('title',\App\Utils\translate('update_leave_request'))

@push('css_or_js')
    <link rel="stylesheet" href="{{ asset('assets/admin/css/bootstrap-datepicker.min.css') }}">
@endpush

@section('content')
<div class="content container-fluid">
    <div class="row align-items-center mb-3">
        <div class="col-sm mb-2 mb-sm-0">
            <h1 class="page-header-title d-flex align-items-center g-2px text-capitalize"><i
                    class="tio-add-circle-outlined"></i> {{\App\Utils\translate('update_leave_request')}}
            </h1>
        </div>
    </div>
        <div class="row gx-2 gx-lg-3">
            <div class="col-sm-12 col-lg-12 mb-3 mb-lg-2">
                <div class="card">
                    <div class="card-body">
                        <form action="{{route('admin.leave-request.update',$demande->id)}}" method="post">
                            @csrf
                            @method('PUT')
                            <div class="col-12 col-md-12 pl-2 form-group">
                                <label class="input-label" >{{\App\Utils\translate('name')}} <span
                                        class="input-label-secondary text-danger">*</span></label>
                                <input type="text" name="name" readonly class="form-control readonly" value="{{ $demande->name }}"  placeholder="{{\App\Utils\translate('departement_name')}}" required>
                            </div>
                            <div class="col-12 col-md-12 pl-2 form-group">
                                <label class="input-label" >{{\App\Utils\translate('service')}}</label>
                                <select name="admin_id" class="form-control" required>
                                    <option value="">{{\App\Utils\translate('select_service')}}</option>
                                    @foreach($services as $service)
                                        <option value="{{$service->id}}" {{ $demande->admin_id == $service->id ? "selected" : "" }} >{{$service->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-12 col-md-12 pl-2 form-group">
                                <label class="input-label" >{{\App\Utils\translate('departement')}}</label>
                                <select name="department_id" class="form-control" required>
                                    <option value="">{{\App\Utils\translate('select_departement')}}</option>
                                    @foreach($departments as $department)
                                        <option value="{{$department->id}}" {{ $demande->department_id == $department->id ? "selected" : "" }}>{{$department->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="row ml-0 mr-0">
                                <div class="col-md-5">
                                    <label for="">{{\App\Utils\translate('Period: from (Start of leave)')}}</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" width="22" height="22" x="0" y="0" viewBox="0 0 24 24" style="enable-background:new 0 0 512 512" xml:space="preserve" class=""><g><g fill="#000"><path fill-rule="evenodd" d="M17 3H7v1h10zm3 1a1 1 0 0 1 1 1v14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V5a1 1 0 0 1 1-1V3a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V5a2 2 0 0 0-2-2z" clip-rule="evenodd" fill="#525252" opacity="1" data-original="#000000" class=""></path><path d="M18 2.5a.5.5 0 0 1 1 0v2a.5.5 0 0 1-1 0zM5 2.5a.5.5 0 0 1 1 0v2a.5.5 0 0 1-1 0z" fill="#525252" opacity="1" data-original="#000000" class=""></path><g fill-rule="evenodd" clip-rule="evenodd"><path d="M21 8H3V7h18zM7 11H5v1h2zm-2-1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1h2a1 1 0 0 0 1-1v-1a1 1 0 0 0-1-1zM13 11h-2v1h2zm-2-1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1h2a1 1 0 0 0 1-1v-1a1 1 0 0 0-1-1zM19 11h-2v1h2zm-2-1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1h2a1 1 0 0 0 1-1v-1a1 1 0 0 0-1-1zM7 16H5v1h2zm-2-1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1h2a1 1 0 0 0 1-1v-1a1 1 0 0 0-1-1zM13 16h-2v1h2zm-2-1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1h2a1 1 0 0 0 1-1v-1a1 1 0 0 0-1-1zM19 16h-2v1h2zm-2-1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1h2a1 1 0 0 0 1-1v-1a1 1 0 0 0-1-1z" fill="#525252" opacity="1" data-original="#000000" class=""></path></g></g></g></svg>
                                            </span>
                                        </div>
                                        <input name="from" id="periode_du" class="input-group date form-control" value="{{ $demande->from }}" data-provide="datepicker" data-date-language="fr" data-date-autoclose="true" autocomplete="off">
                                    </div>
                                </div>
                                <div class="form-group col-12 col-lg-2">
                                    <label for="nbre_jours">{{\App\Utils\translate('Number of days')}}</label>
                                    <select class="form-control" id="nbre_jours" name="number_days">
                                        <option value="">{{\App\Utils\translate('Number of days')}}</option>
                                        @for ($i = 1; $i <= 15; $i++)
                                        <option value="{{ $i }}" {{ $demande->number_days == $i ? "selected" : "" }}>{{ $i }}</option>
                                        @endfor
                                    </select>
                                </div>
                                <div class="col-md-5">
                                    <label for="">{{\App\Utils\translate('to (Included)')}}</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" width="22" height="22" x="0" y="0" viewBox="0 0 24 24" style="enable-background:new 0 0 512 512" xml:space="preserve" class=""><g><g fill="#000"><path fill-rule="evenodd" d="M17 3H7v1h10zm3 1a1 1 0 0 1 1 1v14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V5a1 1 0 0 1 1-1V3a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V5a2 2 0 0 0-2-2z" clip-rule="evenodd" fill="#525252" opacity="1" data-original="#000000" class=""></path><path d="M18 2.5a.5.5 0 0 1 1 0v2a.5.5 0 0 1-1 0zM5 2.5a.5.5 0 0 1 1 0v2a.5.5 0 0 1-1 0z" fill="#525252" opacity="1" data-original="#000000" class=""></path><g fill-rule="evenodd" clip-rule="evenodd"><path d="M21 8H3V7h18zM7 11H5v1h2zm-2-1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1h2a1 1 0 0 0 1-1v-1a1 1 0 0 0-1-1zM13 11h-2v1h2zm-2-1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1h2a1 1 0 0 0 1-1v-1a1 1 0 0 0-1-1zM19 11h-2v1h2zm-2-1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1h2a1 1 0 0 0 1-1v-1a1 1 0 0 0-1-1zM7 16H5v1h2zm-2-1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1h2a1 1 0 0 0 1-1v-1a1 1 0 0 0-1-1zM13 16h-2v1h2zm-2-1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1h2a1 1 0 0 0 1-1v-1a1 1 0 0 0-1-1zM19 16h-2v1h2zm-2-1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1h2a1 1 0 0 0 1-1v-1a1 1 0 0 0-1-1z" fill="#525252" opacity="1" data-original="#000000" class=""></path></g></g></g></svg>
                                            </span>
                                        </div>
                                        <input  name="to" id="periode_au" class="input-group date form-control" value="{{ $demande->to }}" data-provide="datepicker" data-date-language="fr" data-date-autoclose="true" autocomplete="off" placeholder="Période fin" readonly="readonly">
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-12 pl-2 form-group">
                                <label class="input-label" >{{\App\Utils\translate('nature_of_leave')}}</label>
                                <select name="nature_of_leave_id" class="form-control" required>
                                    <option value="">{{\App\Utils\translate('select_natureofleave')}}</option>
                                    @foreach($natureOfLeaves as $natureOfLeave)
                                        <option value="{{$natureOfLeave->id}}" {{ $demande->nature_of_leave_id == $natureOfLeave->id ? "selected" : "" }}>{{$natureOfLeave->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-12 col-md-12 pl-2 form-group">
                                <label class="input-label" >{{\App\Utils\translate('reason')}}</label>
                                <textarea name="reason" class="form-control" placeholder="{{\App\Utils\translate('reason')}}">{{ $demande->reason }}</textarea>
                            </div>

                            <button type="submit" class="btn btn-primary">{{\App\Utils\translate('submit')}}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('script_2')

    <script src={{asset("assets/admin/js/global.js")}}></script>
    <script src="{{ asset("assets/admin/js/bootstrap-datepicker.min.js") }}"></script>
    <script>
        // Extend the French datepicker settings
        $.fn.datepicker.dates['fr'] = {
            days: ['Dimanche','Lundi','Mardi','Mercredi','Jeudi','Vendredi','Samedi'],
            daysShort: [ "Dim","Lun", "Mar", "Mer", "Jeu", "Ven", "Sam"],
            daysMin: ["Di", "Lu", "Ma", "Me", "Je", "Ve", "Sa"],
            months: ["Janvier", "Février", "Mars", "Avril", "Mai", "Juin", "Juillet", "Août", "Septembre", "Octobre", "Novembre", "Decembre"],
            monthsShort: ["Jan", "Fev", "Mar", "Avr", "Mai", "Jun", "Jul", "Aou", "Sep", "Oct", "Nov", "Dec"],
            today: "Aujourd'hui",
            clear: "Effacer",
            format: "yyyy-mm-dd",
            titleFormat: "MM yyyy",
            weekStart: 1,
            language: 'fr'
        };

        document.addEventListener("DOMContentLoaded", function() {
            // Get today's date
            var date = new Date();
            var lastDate = new Date(date.getTime() - (date.getTimezoneOffset() * 60000 )).toISOString().split("T")[0];
            var defaultlast = lastDate.split('-').reverse().join('-');

            // Set default values for the date fields
            /* document.querySelector("#periode_du").value = defaultlast;
            document.querySelector("#periode_au").value = defaultlast; */

            // Initialize datepicker for the date fields
            $('#periode_du,#periode_au').datepicker({
                format: 'dd-mm-yyyy',
                language: 'fr',
            });

            // Event listener for changes in the number of days
            $("#nbre_jours").change(function () {
                let val = parseInt($(this).val());
                let dateD = $("#periode_du").val().split('-').reverse().join('-');
                let dateArrive = new Date(dateD);
                dateArrive.setDate(dateArrive.getDate() + (val - 1));
                let finalDate = dateArrive.toISOString().substring(0, 10).split('-').reverse().join('-');
                $("#periode_au").val(finalDate);
            });
        });




    </script>
@endpush
