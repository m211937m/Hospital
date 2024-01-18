@extends('Dashboard.layouts.master')
@section('css')

@endsection
@section('title')
     {{ trans('Dashboard/Patient_trans.Patient_information') }}
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">{{ trans('Dashboard/Patient_trans.Patient') }}</h4><span
                    class="text-muted mt-1 tx-13 mr-2 mb-0">/ {{ trans('Dashboard/Patient_trans.Patient_information') }}</span>
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
                                            <li class="nav-item"><a href="#tab1" class="nav-link active" data-toggle="tab">{{ trans('Dashboard/Patient_trans.Patient_information') }}</a></li>
                                            <li class="nav-item"><a href="#tab2" class="nav-link" data-toggle="tab">{{ trans('Dashboard/main-sidebar-trans.invoice') }}</a>
                                            </li>
                                            <li class="nav-item"><a href="#tab3" class="nav-link" data-toggle="tab">{{ trans('Dashboard/Patient_trans.payment') }}</a>
                                            </li>
                                            <li class="nav-item"><a href="#tab4" class="nav-link" data-toggle="tab">{{ trans('Dashboard/Patient_trans.Statement') }}</a></li>
                                            <li class="nav-item"><a href="#tab5" class="nav-link" data-toggle="tab">{{ trans('Dashboard/Patient_trans.ٌRadiology') }}</a></li>
                                            <li class="nav-item"><a href="#tab6" class="nav-link" data-toggle="tab">{{ trans('Dashboard/Patient_trans.Laboratory') }}</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="panel-body tabs-menu-body main-content-body-right border-top-0 border">
                                    <div class="tab-content">


                                        {{-- Strat Show Information Patient --}}

                                        <div class="tab-pane active" id="tab1">
                                            <br>
                                            <div class="table-responsive">
                                                <table class="table table-hover text-md-nowrap text-center">
                                                    <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>{{ trans('Dashboard/single_invoice.patient_name') }}</th>
                                                        <th>{{ trans('Dashboard/doctor_trans.phone') }}</th>
                                                        <th>{{ trans('Dashboard/validation.attributes.email') }}</th>
                                                        <th>{{ trans('Dashboard/Patient_trans.Date_Birth') }}</th>
                                                        <th>{{ trans('Dashboard/Patient_trans.Gender') }}</th>
                                                        <th>فصيلة الدم</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <tr>
                                                        <td>1</td>
                                                        <td>{{$Patient->name}}</td>
                                                        <td>{{$Patient->Phone}}</td>
                                                        <td>{{$Patient->email}}</td>
                                                        <td>{{$Patient->Date_Birth}}</td>
                                                        <td>{{$Patient->Gender == 1 ? trans('Dashboard/Patient_trans.male') : trans('Dashboard/Patient_trans.female') }}</td>
                                                        <td>{{$Patient->Blood_Group}}</td>
                                                    </tr>
                                                    </tbody>
                                                </table>
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
                                                        <th>{{ trans('Dashboard/group_service_trans.name_service') }}</th>
                                                        <th>{{ trans('Dashboard/service_trans.created_at') }}</th>
                                                        <th>{{ trans('Dashboard/group_service_trans.total_with_tax') }}</th>
                                                        <th>{{ trans('Dashboard/single_invoice.invoice_type') }} </th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach($invoices as $invoice)
                                                        <tr>
                                                            <td>{{$loop->iteration}}</td>
                                                            <td>{{$invoice->Service->name ?? $invoice->Group->name}}</td>
                                                            <td>{{$invoice->date}}</td>
                                                            <td>{{$invoice->total_with_tax}}</td>
                                                            <td>{{$invoice->type == 1 ? trans('Dashboard/single_invoice.cash') : 'اجل'}}</td>
                                                        </tr>
                                                        <br>
                                                    @endforeach
                                                    <tr>
                                                        <th colspan="4" scope="row" class="alert alert-success">
                                                             {{  trans('Dashboard/group_service_trans.total') }}
                                                        </th>
                                                        <td class="alert alert-primary">{{ number_format( $invoices->sum('total_with_tax') , 2)}}</td>
                                                    </tr>
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
                                                        <th>{{ trans('Dashboard/sections_trans.created_add') }} </th>
                                                        <th>{{ trans('Dashboard/receipt.Amount') }}</th>
                                                        <th>{{ trans('Dashboard/print.note') }}</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach($receipt_accounts as $receipt_account)
                                                        <tr>
                                                            <td>{{$loop->iteration}}</td>
                                                            <td>{{$receipt_account->date}}</td>
                                                            <td>{{$receipt_account->Debit}}</td>
                                                            <td>{{$receipt_account->description}}</td>
                                                        </tr>
                                                        <br>
                                                    @endforeach
                                                    <tr>
                                                        <th scope="row" class="alert alert-success">{{ trans('Dashboard/group_service_trans.total') }}</th>
                                                        <td colspan="4"
                                                            class="alert alert-primary">{{ number_format( $receipt_accounts->sum('Debit') , 2)}}</td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>

                                        {{-- End Receipt Patient  --}}


                                        {{-- Start payment accounts Patient --}}
                                        <div class="tab-pane" id="tab4">
                                            <div class="table-responsive">
                                                <table class="table table-hover text-md-nowrap text-center" id="example1">
                                                    <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>{{ trans('Dashboard/sections_trans.created_add') }}</th>
                                                        <th>{{ trans('Dashboard/service_trans.description') }}</th>
                                                        <th>{{ trans('Dashboard/Patient_trans.owes') }}</th>
                                                        <th>{{ trans('Dashboard/Patient_trans.creditos') }}</th>
                                                        <th>{{ trans('Dashboard/Patient_trans.final_balance') }}</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach($Patient_accounts as $Patient_account)
                                                        <tr>
                                                            <td>{{$loop->iteration}}</td>
                                                            <td>{{$Patient_account->date}}</td>
                                                            <td>
                                                                @if($Patient_account->single_invoice_id == true)
                                                                    {{$Patient_account->invoice->Service->name ?? $Patient_account->invoice->Group->name }}

                                                                @elseif($Patient_account->receip_id == true)
                                                                    {{$Patient_account->ReceiptAccount->description}}

                                                                @elseif($Patient_account->payment_id == true)
                                                                    {{$Patient_account->PaymentAccount->description}}
                                                                @endif

                                                            </td>
                                                            <td>{{ $Patient_account->Dabit}}</td>
                                                            <td>{{ $Patient_account->credit}}</td>
                                                            <td></td>
                                                        </tr>
                                                        <br>
                                                    @endforeach
                                                    <tr>
                                                        <th colspan="3" scope="row" class="alert alert-success">
                                                            {{ trans('Dashboard/group_service_trans.total') }}
                                                        </th>
                                                        <td class="alert alert-primary">{{ number_format( $Dabit = $Patient_accounts->sum('Dabit'), 2) }}</td>
                                                        <td class="alert alert-primary">{{ number_format( $credit = $Patient_accounts->sum('credit'), 2) }}</td>
                                                        <td class="alert alert-danger">
                                                            <span class="text-danger">
                                                                {{$Dabit - $credit}}
                                                                {{ if($Dabit-$credit > 0 ){
                                                                        trans('Dashboard/Patient_trans.owes');}
                                                                    elseif ($Dabit-$credit < 0) {
                                                                        trans('Dashboard/Patient_trans.creditos');
                                                                    }
                                                                    else {
                                                                        
                                                                    }
                                                                }}
                                                             </span>
                                                        </td>
                                                    </tr>
                                                    </tbody>
                                                </table>

                                            </div>

                                            <br>

                                        </div>

                                        {{-- End payment accounts Patient --}}


                                        <div class="tab-pane" id="tab5">
                                            <p>praesentium voluptatum deleniti atque corrquas molestias excepturi sint
                                                occaecati cupiditate non provident,</p>
                                            <p class="mb-0">similique sunt in culpa qui officia deserunt mollitia animi,
                                                id est laborum et dolorum fuga. Et harum quidem rerum facilis est et
                                                expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi
                                                optio cumque nihil impedit quo minus id quod maxime placeat facere
                                                possimus, omnis voluptas assumenda est, omnis dolor repellendus.</p>
                                        </div>
                                        <div class="tab-pane" id="tab6">
                                            <p>praesentium et quas molestias excepturi sint occaecati cupiditate non
                                                provident,</p>
                                            <p class="mb-0">similique sunt in culpa qui officia deserunt mollitia animi,
                                                id est laborum et dolorum fuga. Et harum quidem rerum facilis est et
                                                expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi
                                                optio cumque nihil impedit quo minus id quod maxime placeat facere
                                                possimus, omnis voluptas assumenda est, omnis dolor repellendus.</p>
                                        </div>
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
@endsection
