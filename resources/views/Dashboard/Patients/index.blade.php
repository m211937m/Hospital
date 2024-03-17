@extends('Dashboard.layouts.master')
@section('title')
{{ trans('Dashboard/main-sidebar-trans.Patient') }}
@endsection
@section('css')
    <link href="{{URL::asset('dashboard/plugins/notify/css/notifIt.css')}}" rel="stylesheet"/>
@endsection
@section('page-header')
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex">
							<h4 class="content-title mb-0 my-auto">{{ trans('Dashboard/main-sidebar-trans.Patient') }}</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ {{ trans('Dashboard/main-sidebar-trans.Patient_list') }}</span>
						</div>
					</div>
				</div>
				<!-- breadcrumb -->
@endsection
@section('content')
    @include('Dashboard.messages_alert')
				<!-- row opened -->
				<div class="row row-sm">
					<!--div-->
					<div class="col-xl-12">
						<div class="card">
							<div class="card-header pb-0">
								<div class="d-flex justify-content-between">
                                    <a href="{{route('Patients.create')}}" class="btn btn-primary">{{ trans('Dashboard/Patient_trans.Patient_new_add') }}</a>
								</div>
							</div>
							<div class="card-body">
								<div class="table-responsive">
									<table class="table text-md-nowrap">
										<thead>
											<tr>
												<th>#</th>
												<th>{{ trans('Dashboard/doctor_trans.name') }}</th>
												<th >{{ trans('Dashboard/doctor_trans.email') }}</th>
												<th>{{ trans('Dashboard/Patient_trans.Date_Birth') }}</th>
												<th>{{ trans('Dashboard/doctor_trans.phone') }}</th>
												<th>{{ trans('Dashboard/Patient_trans.Gender') }}</th>
                                                <th > {{ trans('Dashboard/Patient_trans.Blood_Group') }}</th>
                                                <th >{{ trans('Dashboard/Patient_trans.Address') }}</th>
                                                <th>{{ trans('Dashboard/doctor_trans.operations') }}</th>
											</tr>
										</thead>
										<tbody>
                                        @foreach($Patients as $Patient)
											<tr>
                                                <td>{{$loop->iteration}}</td>
                                                <td><a href="{{route('Patients.show',$Patient->id)}}">{{$Patient->name}}</a></td>
                                                <td>{{$Patient->email}}</td>
                                                <td>{{$Patient->Date_Birth}}</td>
                                                <td>{{$Patient->phone}}</td>
                                                <td>{{$Patient->Gender == 1 ? trans('Dashboard/Patient_trans.male') :trans('Dashboard/Patient_trans.female') }}</td>
                                                <td>{{$Patient->Blood_Group}}</td>
                                                <td>{{$Patient->Address}}</td>
                                                <td>
                                                    <a href="{{route('Patients.edit',$Patient->id)}}" class="btn btn-sm btn-success"><i class="fas fa-edit"></i></a>
                                                    <button class="btn btn-sm btn-danger" data-toggle="modal" data-target="#Deleted{{$Patient->id}}"><i class="fas fa-trash"></i></button>
                                                    <a href="{{route('Patients.show',$Patient->id)}}" class="btn btn-primary btn-sm"><i class="fas fa-eye"></i></a>

                                                </td>
											</tr>
                                           @include('Dashboard.Patients.Deleted')
                                        @endforeach
										</tbody>
									</table>
								</div>
                                {{$Patients->links()}}
							</div><!-- bd -->
						</div><!-- bd -->
					</div>
					<!--/div-->
				</div>
				<!-- /row -->
			</div>
			<!-- Container closed -->
		</div>
		<!-- main-content closed -->
@endsection
@section('js')>
    <!--Internal  Notify js -->
    <script src="{{URL::asset('dashboard/plugins/notify/js/notifIt.js')}}"></script>
    <script src="{{URL::asset('/plugins/notify/js/notifit-custom.js')}}"></script>
@endsection
