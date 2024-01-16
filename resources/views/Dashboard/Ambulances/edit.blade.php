@extends('Dashboard.layouts.master')
@section('css')
    <!--Internal   Notify -->
    <link href="{{URL::asset('dashboard/plugins/notify/css/notifIt.css')}}" rel="stylesheet"/>
@endsection
@section('title')
    {{ trans('Dashboard/ambulance_trans.update_car') }}
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="breadcrumb-header justify-content-between">
    <div class="my-auto">
        <div class="d-flex">
            <h4 class="content-title mb-0 my-auto">{{ trans('Dashboard/ambulance_trans.ambulance') }}</h4>
            <span class="text-muted mt-1 tx-13 mr-2 mb-0">/ {{ trans('Dashboard/ambulance_trans.update_car') }}</span>
        </div>
    </div>
</div>
<!-- breadcrumb -->
@endsection
@section('content')
@include('Dashboard.messages_alert')
<!-- row -->
<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-body">
                <form action="{{route('Ambulance.update','test')}}" method="post">
                    @method('PUT')
                    @csrf
                    <div class="col">
                        <div class="row m-1">
                            <label>{{ trans('Dashboard/ambulance_trans.Vehicle_Number') }}</label>
                            <input type="text" name="car_numper"  value="{{$ambulance->car_numper}}" class="form-control @error('car_number') is-invalid @enderror">
                            <input type="hidden" name="id" value="{{$ambulance->id}}">
                        </div>

                        <div class="row m-1">
                            <label>{{ trans('Dashboard/ambulance_trans.Car_Model') }} </label>
                            <input type="text" name="car_model"  value="{{$ambulance->car_model}}" class="form-control @error('car_model') is-invalid @enderror">
                        </div>

                        <div class="row m-1">
                            <label>{{ trans('Dashboard/ambulance_trans.Year_of_manufacture') }}</label>
                            <input type="number" name="car_year_model"  value="{{$ambulance->car_year_model}}" class="form-control @error('car_year_made') is-invalid @enderror">
                        </div>

                        <div class="row m-1">
                            <label>نوع السيارة</label>
                            <select class="form-control" name="car_type">
                                <option value="1" {{$ambulance->car_type == 1 ? 'selected':''}}>{{ trans('Dashboard/ambulance_trans.Kingdom') }}</option>
                                <option value="2" {{$ambulance->car_type == 2 ? 'selected':''}}>{{ trans('Dashboard/ambulance_trans.Rent') }}</option>
                            </select>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col">
                            <label>{{ trans('Dashboard/doctor_trans.status') }} {{ trans('Dashboard/doctor_trans.enable') }}</label>
                            &nbsp;
                            <input name="is_available" {{$ambulance->is_available == 1 ? 'checked' : ''}} value="1" type="checkbox" class="form-check-input" id="exampleCheck1">
                        </div>
                    </div>

                    <br>

                    <div class="row">
                        <div class="col">
                            <button class="btn btn-success lg">{{ trans('Dashboard/doctor_trans.update') }}</button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
<!-- row closed -->
@endsection
@section('js')
    <script src="{{URL::asset('dashboard/plugins/notify/js/notifIt.js')}}"></script>
    <script src="{{URL::asset('/plugins/notify/js/notifit-custom.js')}}"></script>
@endsection
