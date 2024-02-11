@extends('Dashboard.layouts.master')
@section('title',trans('Dashboard/doctor_trans.add') )
@section('css')
<!--- Internal Select2 css-->
<link href="{{URL::asset('Dashboard/plugins/select2/css/select2.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('Dashboard/plugins/notify/css/notifIt.css')}}" rel="stylesheet">
@endsection
@section('page-header')
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex">
							<h4 class="content-title mb-0 my-auto">{{ trans('Dashboard/doctor_trans.doctor ') }}</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/{{ trans('Dashboard/doctor_trans.add') }}</span>
						</div>
					</div>
				</div>
				<!-- breadcrumb -->
@endsection
@section('content')
@include('Dashboard.messages_alert')
				<!-- row -->
				<div class="row">
					<div class="col-lg-12 col-md-12">
						<div class="card">
							<div class="card-body">
								<div class="pd-30 pd-sm-40 bg-gray-200">
                                    <form action ="{{ route('Doctors.store') }}" method ="post" autocomplete="off" enctype="multipart/form-data">
                                    @csrf
									<div class="row row-xs align-items-center mg-b-20">
										<div class="col-md-4">
											<label class="form-label mg-b-0">{{ trans('Dashboard/doctor_trans.name') }}</label>
										</div>
										<div class="col-md-8 mg-t-5 mg-md-t-0">
											<input class="form-control" type="text"name="name" autofocus>
										</div>
									</div>
                                    <div class="row row-xs align-items-center mg-b-20">
                                        <div class="col-md-4">
                                            <label class="form-label mg-b-0">{{ trans('Dashboard/doctor_trans.email') }}</label>
                                        </div>
                                        <div class="col-md-8 mg-t-5 mg-md-t-0">
                                            <input class="form-control" type="email"name="email">
                                        </div>
                                    </div>
									<div class="row row-xs align-items-center mg-b-20">
										<div class="col-md-4">
											<label class="form-label mg-b-0">{{ trans('Dashboard/doctor_trans.password') }}</label>
										</div>
										<div class="col-md-8 mg-t-5 mg-md-t-0">
											<input class="form-control" type="text"name="password">
										</div>
									</div>
                                    <div class="row row-xs align-items-center mg-b-20">
										<div class="col-md-4">
											<label class="form-label mg-b-0">{{ trans('Dashboard/doctor_trans.phone') }}</label>
										</div>
										<div class="col-md-8 mg-t-5 mg-md-t-0">
											<input class="form-control" type="number"name="phone">
										</div>
									</div>
                                    <div class="row row-xs align-items-center mg-b-20">
										<div class="col-md-4">
											<label class="form-label mg-b-0">{{ trans('Dashboard/doctor_trans.section_name') }}</label>
										</div>
										<div class="col-md-8 mg-t-5 mg-md-t-0">
                                            <select name="section_id" class="form-control SelectBox">
                                                <option value="" selected disabled></option>
                                                @forelse ($sections as $section)
                                                    <option value="{{ $section->id }}">{{ $section->name }}</option>
                                                @empty
                                                @endforelse
                                            </select>
										</div>
									</div>
                                    <div class="row row-xs align-items-center mg-b-20">
										<div class="col-md-4">
											<label class="form-label mg-b-0">{{ trans('Dashboard/doctor_trans.appointments') }}</label>
										</div>
										<div class="col-md-8 mg-t-5 mg-md-t-0">
                                            <select multiple="multiple" name="appointments[]" class="form-control select2">
                                                {{-- <option value="" selected disabled></option> --}}
                                                @foreach ($appointments as $appointment)

                                                <option value="{{ $appointment->name }}">{{ $appointment->name }}</option>
                                                @endforeach
                                            </select>
										</div>
									</div>
                                    <div class="row row-xs align-items-center mg-b-20">
										<div class="col-md-4">
											<label class="form-label mg-b-0"><img width="150px" height="150px"id="output"/></label>
										</div>
										<div class="col-md-8 mg-t-5 mg-md-t-0">
											<input class="custom-file-input" accept="image/*" type="file"name="photo"onchange="loadFile(event)">
                                            <label class="custom-file-label" for="customFile">{{ trans('Dashboard/doctor_trans.image') }}</label>

										</div>
									</div>
									<input class="btn btn-main-primary pd-x-30 mg-r-5 mg-t-5"type="submit" value="{{ trans('Dashboard/doctor_trans.confirm') }}">
                                    </form>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!-- /row -->
			</div>
			<!-- Container closed -->
		</div>
		<!-- main-content closed -->
@endsection
@section('js')
        <script>
            var loadFile = function(event){
                var output = document.getElementById('output');
                output.src = URL.createObjectURL(event.target.files[0]);
                output.onload = function(){
                    URL.revokeObjectURL(output.src);
                }
            };
        </script>
<!--Internal  Select2 js -->
<script src="{{URL::asset('Dashboard/plugins/select2/js/select2.min.js')}}"></script>
<!-- Form-layouts js -->
<script src="{{URL::asset('Dashboard/js/form-layouts.js')}}"></script>
<script src="{{ URL::asset('Dashboard/plugins/notify/js/notifit-custom.js')}}"></script>
<script src="{{ URL::asset('Dashboard/plugins/notify/js/notifIt.js')}}"></script>
@endsection
