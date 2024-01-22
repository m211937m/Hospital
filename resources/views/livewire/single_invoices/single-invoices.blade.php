<div>

    @if ($catchError)
        <div class="alert alert-danger" id="success-danger">
            <button type="button" class="close" data-dismiss="alert">x</button>
            {{ $catchError }}
        </div>
    @endif

    @if ($InvoiceSaved)
        <div class="alert alert-info">{{ trans('Dashboard/messages.add') }}</div>
    @endif

    @if ($InvoiceUpdated)
        <div class="alert alert-info">{{ trans('Dashboard/messages.edit') }}</div>
    @endif

    @if($show_table)

     @include('livewire.single_invoices.Table')

    @else

    <form wire:submit.prevent="store" autocomplete="off">
                @csrf
                <div class="row">
                    <div class="col">
                        <label>{{ trans('Dashboard/single_invoice.patient_name') }}</label>
                        <select wire:model="patient_id" class="form-control" required>
                            <option value=""  >-- {{ trans('Dashboard/single_invoice.select_from_the_list') }} --</option>
                            @foreach($Patients as $Patient)
                                <option value="{{$Patient->id}}">{{$Patient->name}}</option>
                            @endforeach
                        </select>
                    </div>


                    <div class="col">
                        <label>{{ trans('Dashboard/single_invoice.doctor_name') }}</label>
                        <select wire:model="doctor_id"  wire:change="get_section" class="form-control"  id="exampleFormControlSelect1" required>
                            <option value="" >-- {{ trans('Dashboard/single_invoice.select_from_the_list') }}  --</option>
                            @foreach($Doctors as $Doctor)
                                <option value="{{$Doctor->id}}">{{$Doctor->name}}</option>
                            @endforeach
                        </select>
                    </div>


                    <div class="col">
                        <label>{{ trans('Dashboard/doctor_trans.section_name') }} </label>
                        <input wire:model="section_id" type="text" class="form-control" readonly >
                    </div>

                    <div class="col">
                        <label>{{ trans('Dashboard/single_invoice.invoice_type') }}</label>
                        <select wire:model="type" class="form-control" {{$updateMode == true ? 'disabled':''}}>
                            <option value="" >-- {{ trans('Dashboard/single_invoice.select_from_the_list') }}  --</option>
                            <option value="1">{{ trans('Dashboard/single_invoice.cash') }} </option>
                            <option value="2">اجل</option>
                        </select>
                    </div>


                </div><br>

                <div class="row row-sm">
                    <div class="col-xl-12">
                        <div class="card">
                            <div class="card-header pb-0">
                                <div class="d-flex justify-content-between">
                                    <h4 class="card-title mg-b-0"></h4>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped mg-b-0 text-md-nowrap" style="text-align: center">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>{{ trans('Dashboard/group_service_trans.name_service') }} </th>
                                            <th>{{ trans('Dashboard/doctor_trans.price') }} </th>
                                            <th>{{ trans('Dashboard/group_service_trans.discount_value') }} </th>
                                            <th>{{ trans('Dashboard/group_service_trans.tax_ratoi') }}</th>
                                            <th>{{ trans('Dashboard/single_invoice.tax_value') }}</th>
                                            <th> {{ trans('Dashboard/group_service_trans.total_with_tax') }}</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <th scope="row">1</th>
                                            <td>
                                                <select wire:model="Service_id" class="form-control" wire:change="get_price" id="exampleFormControlSelect1">
                                                    <option value="">-- {{ trans('Dashboard/single_invoice.select_from_the_list') }}  --</option>
                                                    @foreach($Services as $Service)
                                                        <option value="{{$Service->id}}">{{$Service->name}}</option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td><input wire:model="price" type="text" class="form-control" readonly></td>
                                            <td><input wire:model="discount_value" type="text" class="form-control"></td>
                                            <th><input wire:model="tax_rate" type="text" class="form-control"></th>
                                            <td><input type="text" class="form-control" value="{{$tax_value}}" readonly ></td>
                                            <td><input type="text" class="form-control" readonly value="{{$subtotal + $tax_value }}"></td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div><!-- bd -->
                            </div><!-- bd -->
                        </div><!-- bd -->
                    </div>
                </div>

                <input class="btn btn-outline-primary lg" type="submit" value="{{ trans('Dashboard/doctor_trans.confirm') }}">
            </form>

    @endif


</div>

