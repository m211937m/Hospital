<!-- Modal -->
<div class="modal fade" id="edit{{ $ray_employee->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{ trans('Dashboard/employee.Edit_Employees_information') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('ray_employee.update', $ray_employee->id) }}" method="post">
                {{ method_field('patch') }}
                {{ csrf_field() }}
                @csrf
                <div class="modal-body">
                    <label for="exampleInputPassword1">{{ trans('Dashboard/doctor_trans.name')  }}</label>
                    <input type="text" value="{{$ray_employee->name}}" name="name" class="form-control"><br>

                    <label for="exampleInputPassword1">{{ trans('Dashboard/employee.salary') }}</label>
                    <input type="number" value="{{$ray_employee->price}}" name="price" class="form-control"><br>

                    <label for="exampleInputPassword1">{{ trans('Dashboard/validation.attributes.email') }}</label>
                    <input type="email" value="{{$ray_employee->email}}" name="email" class="form-control"><br>

                    <label for="exampleInputPassword1">{{ trans('Dashboard/validation.attributes.password') }}</label>
                    <input type="password" name="password" class="form-control" autocomplete="new-password">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{trans('Dashboard/doctor_trans.close')}}</button>
                    <button type="submit" class="btn btn-success">{{trans('Dashboard/doctor_trans.confirm')}}</button>
                </div>
            </form>
        </div>
    </div>
</div>
