@extends('Dashboard.layouts.master')
@section('css')
@endsection
@section('title')
{{ trans('Dashboard/main-sidebar-trans.group_services') }}
@stop
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">{{ trans('Dashboard/service_trans.Services')}}<h4>
                <span class="text-muted mt-1 tx-13 mr-2 mb-0">/{{ trans('Dashboard/main-sidebar-trans.group_services') }}</span>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
@endsection
@section('content')
@include('Dashboard.messages_alert')

    <div class="row row-sm">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    <livewire:create-group-services/>
                </div>
            </div>
        </div>

    </div>
    <!-- row closed -->
    </div>
    <!-- Container closed -->
    </div>
    <!-- main-content closed -->
@endsection
@section('js')

@endsection
