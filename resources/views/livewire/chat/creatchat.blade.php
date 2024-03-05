<div wire:ignore>
    <div class="row row-sm">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header pb-0">
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table style="text-align: center" class="table text-md-nowrap" id="example2">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th >{{ trans('Dashboard/single_invoice.doctor_name') }}</th>
                            </thead>
                            <tbody>
                           @foreach($users as $user)
                               <tr>
                                   <td>{{$loop->iteration}}</td>
                                   <td><a wire:click='createconversations("{{$user->email}}")'>{{$user->name}}</a></td>
                               </tr>

                           @endforeach
                            </tbody>
                        </table>
                    </div>
                </div><!-- bd -->
            </div><!-- bd -->
        </div>
        </div>

    {{-- @include('Dashboard.Sections.add') --}}

