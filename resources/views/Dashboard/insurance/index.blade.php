@extends('Dashboard.layouts.master')
@section('css')
<!--Internal   Notify -->
<link href="{{URL::asset('dashboard/plugins/notify/css/notifIt.css')}}" rel="stylesheet"/>
@endsection
@section('title')
    {{trans('Dashboard/main-sidebar-trans.insurance_companies')}}
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">{{trans('Dashboard/main-sidebar-trans.service')}}</h4>
                <span class="text-muted mt-1 tx-13 mr-2 mb-0">/ {{trans('Dashboard/main-sidebar-trans.insurance_companies')}}</span>
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
                <div class="card-header">
                    <a href="{{route('insurance.create')}}" class="btn btn-primary">{{trans('Dashboard/insurance_trans.Add_Insurance')}}</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table text-md-nowrap text-center" id="example1">
                            <thead>
                            <tr class="table-secondary">
                                <th>#</th>
                                <th >{{trans('Dashboard/insurance_trans.Company_code')}}</th>
                                <th >{{trans('Dashboard/insurance_trans.Company_name')}}</th>
                                <th >{{trans('Dashboard/insurance_trans.discount_percentage')}}</th>
                                <th >{{trans('Dashboard/insurance_trans.Insurance_bearing_percentage')}}</th>
                                <th >{{trans('Dashboard/service_trans.description')}}</th>
                                <th >{{trans('Dashboard/doctor_trans.status')}}</th>
                                <th >{{trans('Dashboard/service_trans.Processes')}}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($insurances as $insurance)
                                <tr>
                                    <td>{{$loop->iteration }}</td>
                                    <td>{{$insurance->insurance_code}}</td>
                                    <td>{{$insurance->name}}</td>
                                    <td>{{$insurance->discount_percentage}}</td>
                                    <td>{{$insurance->Company_rate}}</td>
                                    <td>{{$insurance->note}}</td>
                                    <td class="alert-{{ $insurance->status == 1 ? 'success' : 'danger'}}">
                                        {{$insurance->status == 1 ? trans('Dashboard/doctor_trans.enable') : trans('Dashboard/doctor_trans.notenable')}}
                                    </td>
                                    <td>
                                        <a href="{{route('insurance.edit',$insurance->id)}}" class="btn btn-sm btn-success"><i class="fas fa-edit"></i></a>
                                        <button class="btn btn-sm btn-danger" data-toggle="modal" data-target="#Deleted{{$insurance->id}}"><i class="fas fa-trash"></i>
                                        </button>

                                    </td>
                                 @include('Dashboard.insurance.Deleted')
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- row closed -->
@endsection
@section('js')
    <!--Internal  Notify js -->
    <script src="{{URL::asset('dashboard/plugins/notify/js/notifIt.js')}}"></script>
    <script src="{{URL::asset('/plugins/notify/js/notifit-custom.js')}}"></script>

@endsection
