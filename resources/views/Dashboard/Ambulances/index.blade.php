@extends('Dashboard.layouts.master')
@section('title')
 {{ trans('Dashboard/ambulance_trans.ambulance') }}
@endsection
@section('css')
    <link href="{{URL::asset('dashboard/plugins/notify/css/notifIt.css')}}" rel="stylesheet"/>
@endsection
@section('page-header')
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex">
							<h4 class="content-title mb-0 my-auto">{{ trans('Dashboard/ambulance_trans.ambulance') }}</h4>
                            <span class="text-muted mt-1 tx-13 mr-2 mb-0">/ {{ trans('Dashboard/ambulance_trans.ambulances') }} </span>
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
                                    <a href="{{route('Ambulance.create')}}" class="btn btn-primary">{{ trans('Dashboard/ambulance_trans.Add_a_new_car') }}</a>
								</div>
							</div>
							<div class="card-body">
								<div class="table-responsive">
									<table class="table text-md-nowrap" id="example1">
										<thead>
											<tr>
												<th>#</th>
												<th >{{ trans('Dashboard/ambulance_trans.Vehicle_Number') }}</th>
												<th >{{ trans('Dashboard/ambulance_trans.Car_Model') }}</th>
												<th>{{ trans('Dashboard/ambulance_trans.Year_of_manufacture') }}</th>
												<th>{{ trans('Dashboard/ambulance_trans.Car_Type') }} </th>
                                                <th >{{ trans('Dashboard/doctor_trans.status') }}</th>
                                                <th>{{ trans('Dashboard/doctor_trans.operations') }}</th>
											</tr>
										</thead>
										<tbody>
                                        @foreach($ambulances as $ambulance)
											<tr>
                                                <td>{{$loop->iteration}}</td>
                                                <td>{{$ambulance->car_numper}}</td>
                                                <td>{{$ambulance->car_model}}</td>
                                                <td>{{$ambulance->car_year_model}}</td>
                                                <td>{{$ambulance->car_type == 1 ? trans('Dashboard/ambulance_trans.Kingdom') : trans('Dashboard/ambulance_trans.Rent') }}</td>>
                                                <td class="{{$ambulance->is_available == 1 ? 'alert-success': 'alert-danger'}}">{{$ambulance->is_available == 1 ? trans('Dashboard/doctor_trans.enable') : trans('Dashboard/doctor_trans.notenable') }}</td>
                                                <td>
                                                    <a href="{{route('Ambulance.edit',$ambulance->id)}}" class="btn btn-sm btn-success"><i class="fas fa-edit"></i></a>
                                                    <button class="btn btn-sm btn-danger" data-toggle="modal" data-target="#Deleted{{$ambulance->id}}"><i class="fas fa-trash"></i></button>
                                                </td>
											</tr>
                                            @include('Dashboard.Ambulances.Deleted')
                                        @endforeach
										</tbody>
									</table>
								</div>
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
@section('js')
    <script src="{{URL::asset('Dashboard/js/table-data.js')}}"></script>
    <!--Internal  Notify js -->
    <script src="{{URL::asset('dashboard/plugins/notify/js/notifIt.js')}}"></script>
    <script src="{{URL::asset('/plugins/notify/js/notifit-custom.js')}}"></script>
@endsection
