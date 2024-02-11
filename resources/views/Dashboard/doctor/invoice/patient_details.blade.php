@extends('Dashboard.layouts.master')
@section('css')
    <link href="{{URL::asset('dashboard/plugins/notify/css/notifIt.css')}}" rel="stylesheet"/>
@endsection
@section('title')
    {{ trans('Dashboard/Statements_trans.Patient_Record') }}
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">{{ trans('Dashboard/Statements_trans.Patient_Record') }}</h4><span
                    class="text-muted mt-1 tx-13 mr-2 mb-0">/ {{ $Patient->name }}</span>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
@endsection
@section('content')
    @include('Dashboard.messages_alert')
    <!-- row opened -->
    <div class="row row-sm">
        <div class="col-lg-12 col-md-12">
            <div class="card" id="basic-alert">
                <div class="card-body">
                    <div class="text-wrap">
                        <div class="example">
                            <div class="panel panel-primary tabs-style-1">
                                <div class=" tab-menu-heading">
                                    <div class="tabs-menu1">
                                        <!-- Tabs -->
                                        <ul class="nav panel-tabs main-nav-line">
                                            <li class="nav-item"><a href="#tab1" class="nav-link active" data-toggle="tab">{{ trans('Dashboard/Statements_trans.Patient_Record') }}</a></li>
                                            <li class="nav-item"><a href="#tab2" class="nav-link" data-toggle="tab">{{ trans('Dashboard/Patient_trans.ٌRadiology') }}</a></li>
                                            <li class="nav-item"><a href="#tab3" class="nav-link" data-toggle="tab">{{ trans('Dashboard/Patient_trans.Laboratory') }}</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="panel-body tabs-menu-body main-content-body-right border-top-0 border">
                                    <div class="tab-content">


                                        {{-- Strat Show Information Patient --}}

                                        <div class="tab-pane active" id="tab1">
                                            <br>
                                            <div class="vtimeline">
                                                @foreach($patient_records as $patient_record)
                                                    <div class="timeline-wrapper {{ $loop->iteration % 2 == 0 ? 'timeline-inverted' : '' }} timeline-wrapper-primary">
                                                        <div class="timeline-badge"><i class="las la-check-circle"></i></div>
                                                        <div class="timeline-panel">
                                                            {{-- <div class="timeline-heading">
                                                                <h6 class="timeline-title"></h6>
                                                            </div> --}}
                                                            <div class="timeline-body">
                                                                <p>{{$patient_record->diagnosis}}</p>
                                                            </div>
                                                            <div class="timeline-footer d-flex align-items-center flex-wrap">
                                                                <i class="fas fa-user-md"></i>&nbsp;
                                                                <span>{{$patient_record->Doctor->name}}</span>
                                                                <span class="mr-auto"><i class="fe fe-calendar text-muted mr-1"></i>{{$patient_record->date}}</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>

                                        {{-- End Show Information Patient --}}



                                        {{-- Start Invices Patient --}}

                                        <div class="tab-pane" id="tab2">

                                            <div class="table-responsive">
                                                <table class="table table-hover text-md-nowrap text-center">
                                                    <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>{{ trans('Dashboard/group_service_trans.name_service') }} </th>
                                                        <th>{{ trans('Dashboard/single_invoice.doctor_name') }}</th>
                                                        <th>{{ trans('Dashboard/dashboard_trans.name_employee') }}</th>
                                                        <th>{{ trans('Dashboard/service_trans.Status') }}</th>
                                                        <th>{{ trans('Dashboard/doctor_trans.operations') }}</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach($patient_rays as $patient_ray)
                                                        <tr>
                                                            <td>{{$loop->iteration}}</td>
                                                            <td>{{$patient_ray->descriptio}}</td>
                                                            <td>{{$patient_ray->doctor->name}}</td>
                                                            {{-- <td>{{$patient_ray->employee_id !==null ? $patient_ray->employee->name:'NOEmployee'}}</td> --}}
                                                            {{-- <td>{{$patient_ray->employee->name ?? 'noEmployee'}}</td> --}}
                                                            <td>{{$patient_ray->employee->name}}</td>


                                                            @if($patient_ray->case == 0)
                                                                <td class="text-danger">{{ trans('Dashboard/invoice_doctor_trans.incompleted') }}</td>
                                                            @else
                                                                <td class="text-success">{{ trans('Dashboard/Statements_trans.Completed') }}</td>
                                                            @endif


                                                            @if($patient_ray->doctor_id == auth()->user()->id)
                                                                @if($patient_ray->case == 0)
                                                                <td>
                                                                    <a class="modal-effect btn btn-sm btn-primary" data-effect="effect-scale"  data-toggle="modal" href="#edit_xray_conversion{{$patient_ray->id}}"><i class="fas fa-edit"></i></a>
                                                                    <a class="modal-effect btn btn-sm btn-danger" data-effect="effect-scale"  data-toggle="modal" href="#delete{{$patient_ray->id}}"><i class="las la-trash"></i></a>
                                                                </td>

                                                                @else
                                                                    <td>
                                                                        <a class="modal-effect btn btn-sm btn-primary"  href="{{route('invoice.show',$patient_ray->id)}}"><i class="fas fa-binoculars"></i></a>
                                                                    </td>

                                                                @endif
                                                            @endif
                                                        </tr>
                                                        @include('Dashboard.doctor.invoice.edit_xray_conversion')
                                                        @include('Dashboard.doctor.invoice.deleted')
                                                    @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>

                                        {{-- End Invices Patient --}}



                                        {{-- Start Receipt Patient  --}}

                                        <div class="tab-pane" id="tab3">
                                            <div class="table-responsive">
                                                <table class="table table-hover text-md-nowrap text-center">
                                                    <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>{{ trans('Dashboard/group_service_trans.name_service') }}</th>
                                                        <th>{{ trans('Dashboard/single_invoice.doctor_name') }}</th>
                                                        <th>{{ trans('Dashboard/dashboard_trans.name_employee') }}</th>
                                                        <th>{{ trans('Dashboard/doctor_trans.operations') }}</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach($patient_Laboratories as $patient_Laboratorie)
                                                        <tr>
                                                            <td>{{$loop->iteration}}</td>
                                                            <td>{{$patient_Laboratorie->description}}</td>
                                                            <td>{{$patient_Laboratorie->doctor->name}}</td>
                                                            <td>{{$patient_Laboratorie->lab_emp->name}}</td>

                                                            @if($patient_Laboratorie->doctor_id == auth()->user()->id)
                                                                @if($patient_Laboratorie->case == 0)
                                                                    <td>
                                                                        <a class="modal-effect btn btn-sm btn-primary" data-effect="effect-scale"  data-toggle="modal" href="#edit_xray_conversion{{$patient_Laboratorie->id}}"><i class="fas fa-edit"></i></a>
                                                                        <a class="modal-effect btn btn-sm btn-danger" data-effect="effect-scale"  data-toggle="modal" href="#delete{{$patient_Laboratorie->id}}"><i class="las la-trash"></i></a>
                                                                    </td>
                                                                @else
                                                                    <td>
                                                                        <a class="modal-effect btn btn-sm btn-warning"  href="{{route('show.laboratorie',$patient_Laboratorie->id)}}"><i class="fas fa-binoculars"></i></a>
                                                                    </td>

                                                                @endif
                                                            @endif

                                                        </tr>
                                                        @include('Dashboard.doctor.invoice.edit_laboratorie_conversion')
                                                        @include('Dashboard.doctor.invoice.deleted_laboratorie')
                                                    @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>

                                        {{-- End Receipt Patient  --}}

                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End Prism Precode -->
                    </div>
                </div>
            </div>
        </div>


    </div>
    </div>
    <!-- /row -->
    </div>
    <!-- Container closed -->
    </div>
@endsection
@section('js')
    <script src="{{URL::asset('dashboard/plugins/notify/js/notifIt.js')}}"></script>
    <script src="{{URL::asset('/plugins/notify/js/notifit-custom.js')}}"></script>
@endsection
