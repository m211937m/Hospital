@extends('Dashboard.layouts.master')
@section('title',$section->name)
@section('css')
<link href="{{URL::asset('Dashboard/plugins/datatable/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" />
<link href="{{URL::asset('Dashboard/plugins/datatable/css/buttons.bootstrap4.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('Dashboard/plugins/datatable/css/responsive.bootstrap4.min.css')}}" rel="stylesheet" />
<link href="{{URL::asset('Dashboard/plugins/datatable/css/jquery.dataTables.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('Dashboard/plugins/datatable/css/responsive.dataTables.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('Dashboard/plugins/select2/css/select2.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('Dashboard/plugins/notify/css/notifIt.css')}}" rel="stylesheet">
@endsection
@section('page-header')
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex">
							<h4 class="content-title mb-0 my-auto">{{ $section->name }}</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ {{ trans('Dashboard/doctor_trans.doctor ') }}</span>
						</div>
					</div>
				</div>
				<!-- breadcrumb -->
@endsection
@section('content')
@include('Dashboard.messages_alert')
<div class="row row-sm">

    <!--div-->
    <div class="col-xl-12">
        <div class="card">
            <div class="card-header pb-0">
                <div class="card-body">
                        <a class="btn btn-info w-25 m-1" href="{{ route('Sections.index') }}"><b>{{ trans('Dashboard/doctor_trans.back') }}</b></a><br>
                        <div class="alert alert-info w-100 text-center font-bold ">
                            <b>{{ trans('Dashboard/doctor_trans.count') }} {{ $doctors->count() }}</b>
                        </div>
                    <div class="table-responsive">
                        <table class="table text-md-nowrap" id="example2">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>{{ trans("Dashboard/doctor_trans.name")  }}</th>
                                    <th>{{ trans("Dashboard/doctor_trans.email")  }}</th>
                                    <th>{{ trans("Dashboard/doctor_trans.section_name") }}</th>
                                    <th>{{ trans("Dashboard/doctor_trans.phone") }}</th>
                                    <th>{{ trans("Dashboard/doctor_trans.appointments") }}</th>
                                    <th>{{ trans("Dashboard/doctor_trans.status") }}</th>
                                    <th>{{ trans("Dashboard/doctor_trans.created_at") }}</th>
                                    <th>{{ trans("Dashboard/doctor_trans.operations") }}</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                            @forelse ($doctors as $doctor)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $doctor->name }}</td>
                                    <td>{{ $doctor->email }}</td>
                                    <td>{{ $doctor->section->name }}</td>
                                    <td>{{ $doctor->phone }}</td>
                                    <td>
                                        @foreach ($doctor->doctorappointments as $appointments)
                                            {{ $appointments->name }}
                                        @endforeach
                                    </td>
                                    <td>
                                        <div class="dot-label bg-{{ $doctor->status == 1 ? 'success' : 'danger'}} ml-1"></div>
                                        {{ $doctor->status == 1 ? trans('Dashboard/doctor_trans.enable') : trans('Dashboard/doctor_trans.notenable')}}
                                    </td>
                                    <td>{{ $doctor->created_at->diffForHumans() }}</td>
                                    <td>
                                        <div class="dropdown">
                                            <button aria-expanded="false" aria-haspopup="true" class="btn btn-outline-primary btn-sm" data-toggle="dropdown" type="button">{{trans('Dashboard/doctor_trans.operations')}}<i class="fas fa-caret-down mr-1"></i></button>
                                            <div class="dropdown-menu tx-13">
                                                <a class="dropdown-item" href="{{route('Doctors.edit',$doctor->id)}}"><i style="color: #0ba360" class="text-success ti-user"></i>&nbsp;&nbsp;{{ trans('Dashboard/doctor_trans.update') }}</a>
                                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#update_password{{$doctor->id}}"><i   class="text-primary ti-key"></i>&nbsp;&nbsp; {{ trans('Dashboard/doctor_trans.passwoerd_change') }}</a>
                                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#update_status{{$doctor->id}}"><i   class="text-warning ti-back-right"></i>&nbsp;&nbsp; {{ trans('Dashboard/doctor_trans.status_change') }}</a>
                                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#delete{{$doctor->id}}"><i   class="text-danger  ti-trash"></i>&nbsp;&nbsp;{{ trans('Dashboard/doctor_trans.delete_doctor') }}</a>
                                            </div>
                                        @include('Dashboard.Doctors.delete')
                                        @include('Dashboard.Doctors.update_password')
                                        @include('Dashboard.Doctors.status_doctor')
                                    </td>
                                    <td></td>
                                </tr>

                            @empty

                            @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div><!-- bd -->
    </div>

@endsection
@section('js')
<script src="{{URL::asset('Dashboard/plugins/datatable/js/jquery.dataTables.min.js')}}"></script>
<script src="{{URL::asset('Dashboard/plugins/datatable/js/dataTables.dataTables.min.js')}}"></script>
<script src="{{URL::asset('Dashboard/plugins/datatable/js/dataTables.responsive.min.js')}}"></script>
<script src="{{URL::asset('Dashboard/plugins/datatable/js/responsive.dataTables.min.js')}}"></script>
<script src="{{URL::asset('Dashboard/plugins/datatable/js/jquery.dataTables.js')}}"></script>
<script src="{{URL::asset('Dashboard/plugins/datatable/js/dataTables.bootstrap4.js')}}"></script>
<script src="{{URL::asset('Dashboard/plugins/datatable/js/dataTables.buttons.min.js')}}"></script>
<script src="{{URL::asset('Dashboard/plugins/datatable/js/buttons.bootstrap4.min.js')}}"></script>
<script src="{{URL::asset('Dashboard/plugins/datatable/js/jszip.min.js')}}"></script>
<script src="{{URL::asset('Dashboard/plugins/datatable/js/pdfmake.min.js')}}"></script>
<script src="{{URL::asset('Dashboard/plugins/datatable/js/vfs_fonts.js')}}"></script>
<script src="{{URL::asset('Dashboard/plugins/datatable/js/buttons.html5.min.js')}}"></script>
<script src="{{URL::asset('Dashboard/plugins/datatable/js/buttons.print.min.js')}}"></script>
<script src="{{URL::asset('Dashboard/plugins/datatable/js/buttons.colVis.min.js')}}"></script>
<script src="{{URL::asset('Dashboard/plugins/datatable/js/dataTables.responsive.min.js')}}"></script>
<script src="{{URL::asset('Dashboard/plugins/datatable/js/responsive.bootstrap4.min.js')}}"></script>
<script src="{{URL::asset('Dashboard/js/table-data.js')}}"></script>
<script src="{{ URL::asset('Dashboard/plugins/notify/js/notifit-custom.js')}}"></script>
<script src="{{ URL::asset('Dashboard/plugins/notify/js/notifIt.js')}}"></script>

@endsection
