@extends('Dashboard.layouts.master')
@section('title')
   {{ trans('Bond_print') }}
@stop
@section('css')
    <style>
        @media print {
            #print_Button {
                display: none;
            }
        }
    </style>
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">{{ trans('Dashboard/main-sidebar-trans.Bond_Catch') }} </h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ {{ trans('Bond_print') }}</span>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
@endsection
@section('content')
@include('Dashboard.messages_alert')
    <!-- row -->
    <div class="row row-sm">
        <div class="col-md-12 col-xl-12">
            <div class=" main-content-body-invoice" id="print">
                <div class="card card-invoice">
                    <div class="card-body">
                        <div class="invoice-header">
                            <h1 class="invoice-title">{{ trans('Dashboard/main-sidebar-trans.Bond_Catch') }}</h1>
                            <div class="billed-from">
                                <h6>{{ trans('Dashboard/main-sidebar-trans.Main') }}</h6>
                                <p>
                                    {{ trans('Dashboard/doctor_trans.phone') }} : 011111111<br>
                                    {{ trans('Dashboard/validation.attributes.email') }}: Hospital@gmail.com
                                </p>
                            </div><!-- billed-from -->
                        </div><!-- invoice-header -->
                        <div class="row mg-t-20">
                            <div class="col-md">
                                <label class="tx-gray-600">{{ trans('Dashboard/print.Bond_information') }}</label>
                                <p class="invoice-info-row"><span>{{ trans('Dashboard/service_trans.created_at') }}</span> <span>{{$receipt->date}}</span>
                                </p>
                                <p class="invoice-info-row "><span>{{ trans('Dashboard/single_invoice.patient_name') }}</span>
                                    <span>{{$receipt->patients->name}}</span></p>
                            </div>
                        </div>
                        <div class="table-responsive mg-t-40">
                            <table class="table table-invoice border text-md-nowrap mb-0">
                                <thead>
                                <tr>
                                    <th class="wd-20p">#</th>
                                    <th class="wd-40p">{{ trans('Dashboard/print.note') }}</th>
                                    <th class="tx-center">{{ trans('Dashboard/receipt.Amount') }}</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>1</td>
                                    <td class="tx-12">{{ $receipt->description}}</td>
                                    <td class="tx-center">{{ number_format($receipt->Debit,2)}}</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <hr class="mg-b-40">
                        <a href="#" class="btn btn-danger float-left mt-3 mr-2" id="print_Button" onclick="printDiv()">
                            <i class="mdi mdi-printer ml-1"></i>{{ trans('Dashboard/print.print') }}
                        </a>
                    </div>
                </div>
            </div>
        </div><!-- COL-END -->
    </div>
    <!-- row closed -->
    </div>
    <!-- Container closed -->
    </div>
    <!-- main-content closed -->
@endsection
@section('js')
    <!--Internal  Chart.bundle js -->
    <script src="{{URL::asset('Admin/assets/plugins/chart.js/Chart.bundle.min.js')}}"></script>


    <script type="text/javascript">
        function printDiv() {
            var printContents = document.getElementById('print').innerHTML;
            var originalContents = document.body.innerHTML;
            document.body.innerHTML = printContents;
            window.print();
            document.body.innerHTML = originalContents;
            location.reload();
        }
    </script>
@endsection
