<button class="btn btn-primary pull-right" wire:click="show_form_add" type="button">اضافة فاتورة جديدة </button><br><br>
<div class="table-responsive">
    <table class="table text-md-nowrap" id="example1" data-page-length="50"style="text-align: center">
        <thead>
        <tr>
            <th>#</th>
            <th>{{ trans('Dashboard/group_service_trans.name_service') }}</th>
            <th>{{ trans('Dashboard/single_invoice.patient_name') }}</th>
            <th> {{ trans('Dashboard/single_invoice.date') }}</th>
            <th>{{ trans('Dashboard/single_invoice.doctor_name') }}</th>
            <th>{{ trans('Dashboard/doctor_trans.section_name') }} </th>
            <th>{{ trans('Dashboard/doctor_trans.price') }}</th>
            <th>{{ trans('Dashboard/group_service_trans.discount_value') }}</th>
            <th>{{ trans('Dashboard/group_service_trans.tax_ratoi') }}</th>
            <th>{{ trans('Dashboard/single_invoice.tax_value') }}</th>
            <th>{{ trans('Dashboard/group_service_trans.total_with_tax') }}</th>
            <th>{{ trans('Dashboard/single_invoice.invoice_type') }}</th>
            <th>{{ trans('Dashboard/doctor_trans.operations') }}</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($group_invoices as $group_invoice)
            <tr>
                <td>{{ $loop->iteration}}</td>
                <td>{{ $group_invoice->Group->name }}</td>
                <td>{{ $group_invoice->Patient->name }}</td>
                <td>{{ $group_invoice->date }}</td>
                <td>{{ $group_invoice->Doctor->name }}</td>
                <td>{{ $group_invoice->Section->name }}</td>
                <td>{{ number_format($group_invoice->price, 2) }}</td>
                <td>{{ number_format($group_invoice->discount_value, 2) }}</td>
                <td>{{ $group_invoice->tax_rate }}%</td>
                <td>{{ number_format($group_invoice->tax_value, 2) }}</td>
                <td>{{ number_format($group_invoice->total_with_tax, 2) }}</td>
                <td>{{ $group_invoice->type == 1 ? trans('Dashboard/single_invoice.cash') :'اجل' }}</td>
                <td>
                    <button wire:click="edit({{ $group_invoice->id }})" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></button>
                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#delete_invoice" wire:click="delete({{ $group_invoice->id }})" ><i class="fa fa-trash"></i></button>
                    <a wire:click="print({{ $group_invoice->id }})" class="btn btn-primary btn-sm" target="_blank" title="طباعه سند صرف"><i class="fas fa-print"></i></a>
                </td>
            </tr>

        @endforeach
    </table>
    @include('livewire.group_invoices.delete')
</div>
