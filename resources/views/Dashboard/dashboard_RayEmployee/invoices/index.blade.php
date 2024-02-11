@extends('Dashboard.layouts.master')
@section('title')
    {{ trans('Dashboard/main-sidebar-trans.Statements') }}
@stop
@section('css')


    <link href="{{URL::asset('dashboard/plugins/notify/css/notifIt.css')}}" rel="stylesheet"/>

@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">{{ trans('Dashboard/main-sidebar-trans.Statements') }}</h4>
                <span class="text-muted mt-1 tx-13 mr-2 mb-0">/ {{ trans('Dashboard/main-sidebar-trans.invoice') }}</span>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
@endsection
@section('content')
    @include('Dashboard.messages_alert')
    <!-- row -->
    <!-- row opened -->
    <div class="row row-sm">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table text-md-nowrap" id="example1">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>{{ trans('Dashboard/sections_trans.created_add') }}</th>
                                <th>{{ trans('Dashboard/single_invoice.patient_name') }}</th>
                                <th>{{ trans('Dashboard/single_invoice.doctor_name') }}</th>
                                <th>{{ trans('Dashboard/invoice_doctor_trans.required') }}</th>
                                <th>{{ trans('Dashboard/doctor_trans.status') }}</th>
                                <th>{{ trans('Dashboard/doctor_trans.operations') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($rays as $ray)
                                <tr>
                                    <td>{{ $loop->iteration}}</td>
                                    <td>{{ $ray->created_at }}</td>
                                    <td>{{ $ray->Patient->name }}</td>
                                    <td>{{ $ray->doctor->name }}</td>
                                    <td>{{ $ray->descriptio }}</td>
                                    <td>
                                        @if($ray->case == 0)
                                            <span class="badge badge-danger">{{ trans('Dashboard/Statements_trans.Under_procedure') }}</span>
                                        @else
                                            <span class="badge badge-success">{{ trans('Dashboard/Statements_trans.Completed') }}</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a class="btn ripple btn-outline-primary btn-sm" href="{{ route('invoices_ray_employee.edit',$ray->id) }}"><i class="text-primary fa fa-stethoscope"></i>&nbsp;&nbsp;{{ trans('Dashboard/Statements_trans.Add_Diagnosis') }} </a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div><!-- bd -->
            </div><!-- bd -->
        </div>
        <!--/div-->

        <!-- /row -->
    </div>
    <!-- row closed -->

    <!-- Container closed -->

    <!-- main-content closed -->
@endsection
@section('js')

    <!--Internal  Notify js -->
    <script src="{{URL::asset('dashboard/plugins/notify/js/notifIt.js')}}"></script>
    <script src="{{URL::asset('/plugins/notify/js/notifit-custom.js')}}"></script>

@endsection

