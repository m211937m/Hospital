@extends('Dashboard.layouts.master')
@section('title')
    {{ trans('Dashboard/Statements_trans.Add_Diagnosis') }}
@stop
@section('css')

@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">{{ trans('Dashboard/Statements_trans.Add_Diagnosis') }}</h4>
                <span class="text-muted mt-1 tx-13 mr-2 mb-0">/ {{ $invoice->Patient->name }}</span>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
@endsection
@section('content')
@include('Dashboard.messages_alert')

    <div class="row">
        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{route('invoices_ray_employee.update',$invoice->id)}}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="exampleFormControlTextarea1">{{ trans('Dashboard/Statements_trans.diagnosis') }}</label>
                            <textarea class="form-control" id="exampleFormControlTextarea1" name="description_employee" rows="3"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlTextarea1">{{ trans('Dashboard/ray_emp.image') }}</label>
                            <input type="file" name="photos[]" accept="image/*" multiple>
                        </div>
                        <button type="submit" class="btn btn-primary">{{ trans('Dashboard/doctor_trans.confirm') }}</button>
                    </form>
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
