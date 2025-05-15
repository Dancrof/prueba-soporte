@extends('themes.default1.admin.layout.admin')
<link href="{{asset("lb-faveo/css/faveo-css.css")}}" rel="stylesheet" type="text/css" />
@section('Settings')
class="nav-link active"
@stop

@section('settings-menu-parent')
class="nav-item menu-open"
@stop

@section('settings-menu-open')
class="nav nav-treeview menu-open"
@stop

@section('company')
class="nav-link active"
@stop

@section('HeadInclude')
@stop
<!-- header -->
@section('PageHeader')
<h1>{{ Lang::get('lang.settings') }}</h1>
@stop
<!-- /header -->
<!-- breadcrumbs -->
@section('breadcrumbs')
<ol class="breadcrumb">
</ol>
@stop
<!-- /breadcrumbs -->
<!-- content -->
@section('content')
<!-- open a form -->
{!! Form::model($companys,['url' => 'postcompany/'.$companys->id, 'method' => 'PATCH','files'=>true]) !!}
<!-- check whether success or not -->
@if(Session::has('success'))
<div class="alert alert-success alert-dismissable">
    <i class="fas fa-check-circle"></i>
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    {!!Session::get('success')!!}
</div>
@endif
<!-- failure message -->
@if(Session::has('fails'))
<div class="alert alert-danger alert-dismissable">
    <i class="fas fa-ban"></i>
    <b>{!! Lang::get('lang.alert') !!}!</b>
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    {!!Session::get('fails')!!}
</div>
@endif

@if(Session::has('errors'))
<?php //dd($errors); ?>
<div class="alert alert-danger alert-dismissable">
    <i class="fas fa-ban"></i>
    <b>{!! Lang::get('lang.alert') !!}!</b>
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    <br/>
    @if($errors->first('company_name'))
    <li class="error-message-padding">{!! $errors->first('company_name', ':message') !!}</li>
    @endif
    @if($errors->first('website'))
    <li class="error-message-padding">{!! $errors->first('website', ':message') !!}</li>
    @endif
    @if($errors->first('phone'))
    <li class="error-message-padding">{!! $errors->first('phone', ':message') !!}</li>
    @endif
</div>
@endif
<div class="card card-light">
    <div class="card-header">
        <h3 class="card-title">{{Lang::get('lang.company_settings')}}</h3>
    </div>
    <!-- Name text form Required -->
    <div class="card-body">
        <div class="row">
            <div class="col-md-4">
                <!-- comapny name -->
                <div class="form-group {{ $errors->has('company_name') ? 'has-error' : '' }}">
                    {!! Form::label('company_name',Lang::get('lang.name')) !!} <span class="text-red"> *</span>
                    {!! Form::text('company_name',$companys->company_name,['class' => 'form-control']) !!}
                </div>
            </div>
            <div class="col-md-4">
                <!-- website -->
                <div class="form-group {{ $errors->has('website') ? 'has-error' : '' }}">
                    {!! Form::label('website',Lang::get('lang.website')) !!}
                    {!! Form::url('website',$companys->website,['class' => 'form-control']) !!}
                </div>
            </div>
            <div class="col-md-4">
                <!-- phone -->
                <div class="form-group {{ $errors->has('phone') ? 'has-error' : '' }}">
                    {!! Form::label('phone',Lang::get('lang.phone')) !!}
                    {!! Form::text('phone',$companys->phone,['class' => 'form-control']) !!}
                </div>
            </div>
        </div>

         <div class="{{ $errors->has('address') ? 'has-error' : '' }}">
            {!! Form::label('address',Lang::get('lang.address')) !!}
            {!! Form::textarea('address',$companys->address,['class' => 'form-control','size' => '30x5']) !!}
        </div>

        <div class="row align-items-start mb-4" style="gap: 0;">
            <div class="col-md-6 d-flex flex-column align-items-center">
                <!-- logo -->
                <label class="font-weight-bold mb-2" for="logo">{!! Lang::get('lang.logo') !!}</label>
                <div class="custom-file mb-2 w-100" style="max-width:320px;">
                    {!! Form::file('logo', ['class' => 'custom-file-input', 'id' => 'logo']) !!}
                    <label class="custom-file-label" for="logo">{{ Lang::get('lang.upload_file') }}</label>
                </div>
                @if($companys->logo != null)
                <div class="mt-2 position-relative d-inline-block image" style="max-width:320px;">
                    <img src="{{asset('lb-faveo/media/company')}}/{{ $companys->logo }}" alt="User Image" id="company-logo" width="100%" class="img-thumbnail shadow-sm" style="border:1px solid #DCD1D1; background:#fff; max-width:320px;" />
                    <span class="badge badge-danger position-absolute" style="top:8px; right:8px; cursor:pointer; z-index:10; font-size:1.2em;">&times;</span>
                </div>
                @endif
            </div>
            <div class="col-md-6 d-flex flex-column align-items-center">
                <!-- Favicon -->
                <label class="font-weight-bold mb-2" for="favicon">{!! Lang::get('lang.favicon') !!}</label>
                <div class="custom-file mb-2 w-100" style="max-width:180px;">
                    {!! Form::file('favicon', ['class' => 'custom-file-input', 'id' => 'favicon']) !!}
                    <label class="custom-file-label" for="favicon">{{ Lang::get('lang.upload_favicon') }}</label>
                </div>
                @if($companys->favicon != null)
                <div class="mt-2 position-relative d-inline-block favicon-image" style="max-width:40px;">
                    <img src="{{asset('lb-faveo/media/company')}}/{{ $companys->favicon }}" alt="Favicon" id="company-favicon" width="32" height="32" class="img-thumbnail shadow-sm" style="border:1px solid #DCD1D1; background:#fff;" />
                    <span class="badge badge-danger position-absolute" style="top:2px; right:2px; cursor:pointer; z-index:10; font-size:0.9em; padding:2px 5px; line-height:1;">&times;</span>
                </div>
                @endif
            </div>
            <div class="w-100"></div>
            <div class="col-12 d-flex justify-content-center mt-3">
                <div class="form-check">
                    {!! Form::checkbox('use_logo', 1, $companys->use_logo == 1, ['class' => 'form-check-input', 'id' => 'use_logo']) !!}
                    <label class="form-check-label" for="use_logo">{!! Lang::get('lang.use_logo') !!} - {!! Lang::get('lang.use_favicon') !!}</label>
                </div>
            </div>
        </div>
    </div>
    <div class="card-footer">
        {!! Form::submit(Lang::get('lang.submit'),['class'=>'btn btn-primary'])!!}
    </div>
    <!-- Modal -->   
    <div class="modal fade" id="myModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel"></h4>
                    <button type="button" class="close closemodal" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                </div>
                <div class="modal-body" id="custom-alert-body" >
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-primary yes" data-dismiss="modal"></button>
                    <button type="button" class="btn btn-default no"></button>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        // Previsualización de logo
        $('#logo').on('change', function(e) {
            var input = this;
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    var img = $('#company-logo');
                    if (img.length === 0) {
                        var preview = $('<div class="mt-2 position-relative d-inline-block image" data-content="'+"{{Lang::get('lang.click-delete')}}"+'"><img id="company-logo" width="100" class="img-thumbnail shadow-sm" style="border:1px solid #DCD1D1; background:#fff;" /><span class="badge badge-danger position-absolute" style="top:0; right:0; cursor:pointer;">&times;</span></div>');
                        $(input).closest('.col-md-3').append(preview);
                        img = $('#company-logo');
                    }
                    img.attr('src', e.target.result);
                    img.parent().show();
                }
                reader.readAsDataURL(input.files[0]);
            }
        });
        // Previsualización de favicon
        $('#favicon').on('change', function(e) {
            var input = this;
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    var img = $('#company-favicon');
                    if (img.length === 0) {
                        var preview = $('<div class="mt-2 position-relative d-inline-block favicon-image" data-content="'+"{{ Lang::get('lang.click-delete-favicon') }}"+'"><img id="company-favicon" width="32" height="32" class="img-thumbnail shadow-sm" style="border:1px solid #DCD1D1; background:#fff;" /><span class="badge badge-danger position-absolute" style="top:0; right:0; cursor:pointer;">&times;</span></div>');
                        $(input).closest('.col-md-3').append(preview);
                        img = $('#company-favicon');
                    }
                    img.attr('src', e.target.result);
                    img.parent().show();
                }
                reader.readAsDataURL(input.files[0]);
            }
        });
        // Logo delete
        $(document).on("click", ".image .badge", function() {
            $('#myModal').modal('show');
            $("#myModalLabel").html("{!! Lang::get('lang.delete-logo') !!}");
            $(".yes").html("{!! Lang::get('lang.yes') !!}");
            $(".no").html("{{Lang::get('lang.cancel')}}");
            $("#custom-alert-body").html("{{Lang::get('lang.confirm')}}");
            $("#myModal").data('delete-type', 'logo');
        });
        // Favicon delete
        $(document).on("click", ".favicon-image .badge", function() {
            $('#myModal').modal('show');
            $("#myModalLabel").html("{!! Lang::get('lang.delete-favicon') !!}");
            $(".yes").html("{!! Lang::get('lang.yes') !!}");
            $(".no").html("{{Lang::get('lang.cancel')}}");
            $("#custom-alert-body").html("{{Lang::get('lang.confirm')}}");
            $("#myModal").data('delete-type', 'favicon');
        });
        $('.no,.closemodal').on("click", function() {
            $('#myModal').modal('hide');
        });
        $('.yes').on('click', function() {
            var deleteType = $('#myModal').data('delete-type');
            var path = '';
            if(deleteType === 'logo') {
                var src = $('#company-logo').attr('src').split('/');
                var file = src[src.length - 1];
                path = "lb-faveo/media/company/" + file;
            } else if(deleteType === 'favicon') {
                var src = $('#company-favicon').attr('src').split('/');
                var file = src[src.length - 1];
                path = "lb-faveo/media/company/" + file;
            }
            $.ajax({
                type: "GET",
                url: "{{route('delete.logo')}}",
                dataType: "html",
                data: {data1: path, type: deleteType},
                success: function(data) {
                    if (data == "true") {
                        if(deleteType === 'logo') {
                            $('.image').hide();
                            $('#logo').val('');
                        } else if(deleteType === 'favicon') {
                            $('.favicon-image').hide();
                            $('#favicon').val('');
                        }
                        $('#myModal').modal('hide');
                    } else {
                        $('#myModal').modal('hide');
                    }
                }
            });
        });
    });
</script>
@stop