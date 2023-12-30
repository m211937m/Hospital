@extends('Dashboard.layouts.master')
@section('title',trans('Dashboard/sections_trans.sections'))
@section('css')
<link href="{{URL::asset('Dashboard/plugins/datatable/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" />
<link href="{{URL::asset('Dashboard/plugins/datatable/css/buttons.bootstrap4.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('Dashboard/plugins/datatable/css/responsive.bootstrap4.min.css')}}" rel="stylesheet" />
<link href="{{URL::asset('Dashboard/plugins/datatable/css/jquery.dataTables.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('Dashboard/plugins/datatable/css/responsive.dataTables.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('Dashboard/plugins/datatable/css/responsive.dataTables.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('Dashboard/plugins/notify/css/notifIt.css')}}" rel="stylesheet">

@endsection
@section('page-header')
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex">
							<h4 class="content-title mb-0 my-auto">{{ trans('Dashboard/sections_trans.sections') }}</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ {{ trans('Dashboard/sections_trans.view_all') }}</span>
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
                <div class="d-flex justify-content-between">
                  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">{{ trans('Dashboard/sections_trans.add') }}</button>
                  @include('Dashboard.Sections.add')
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table text-md-nowrap" id="example2">
                            <thead>
                                <tr>
                                    <th class="wd-5 border-bottom-0">#</th>
                                    <th class="w-25 border-bottom-0">{{ trans("Dashboard/sections_trans.name_section")  }}</th>
                                    <th class="w-25 border-bottom-0">{{ trans("Dashboard/sections_trans.description")  }}</th>
                                    <th class="w-25 border-bottom-0">{{ trans("Dashboard/sections_trans.created_add") }}</th>
                                    <th class="w-25 border-bottom-0">{{ trans("Dashboard/sections_trans.operations") }}</th>
                                    {{-- <th class="wd-0p  border-bottom-0"></th> --}}
                                </tr>
                            </thead>
                            <tbody>
                            @forelse ($sections as $section)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $section->name }}</td>
                                    <td>{{ \Str::limit($section->description ,50) }}</td>
                                    <td>{{ $section->created_at->diffForHumans() }}</td>
                                    <td>
                                        <a class="btn btn-sm btn-info" data-effect="effect-scale" data-toggle="modal" href="#edit{{ $section->id }}"><i class="las la-pen"></i></a>
                                        @include('Dashboard.Sections.edit')
                                        <a class="btn btn-sm btn-danger"data-effect="effect-scale"data-toggle="modal" href="#delete{{ $section->id }}"><i class="las la-trash"></i></a>
                                        @include('Dashboard.Sections.delete')
                                    </td>
                                    {{-- <td></td> --}}
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
<script src="{{URL::asset('Dashboard/plugins/notify/js/notifit-custom.js')}}"></script>
<script src="{{URL::asset('Dashboard/plugins/notify/js/notifIt.js')}}"></script>
<script src="{{URL::asset('Dashboard/js/table-data.js')}}"></script>
@endsection
