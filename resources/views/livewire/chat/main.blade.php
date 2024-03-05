@extends('Dashboard.layouts.master')
@section('css')
@endsection
@section('page-header')
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex"><h4 class="content-title mb-0 my-auto">المحادثات</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ المحادثات الاخيرة</span></div>
					</div>
				</div>
				<!-- breadcrumb -->
@endsection
@section('content')
				<!-- row -->
				<div class="row row-sm main-content-app mb-4">
					<div class="col-xl-4 col-lg-5">
						@livewire('chat.chatlist')
					</div>
					<div class="col-xl-8 col-lg-7">
						<div class="card">
							<a class="main-header-arrow" href="" id="ChatBodyHide"><i class="icon ion-md-arrow-back"></i></a>
                                @livewire('chat.chatbox')
                                @livewire('chat.sendmessage')
						</div>
					</div>
				</div>
				<!-- row -->
			</div>
			<!-- Container closed -->
		</div>
		<!-- main-content closed -->
@endsection
@section('js')
<!--Internal  lightslider js -->
<script src="{{URL::asset('Dashboard/plugins/lightslider/js/lightslider.min.js')}}"></script>
<!--Internal  Chat js -->
<script src="{{URL::asset('Dashboard/js/chat.js')}}"></script>
@endsection