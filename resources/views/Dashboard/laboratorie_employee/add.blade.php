<!-- Modal -->
<div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{ trans('Dashboard/employee.Add_Employees_New') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('laboratorie_employee.store') }}" method="post" autocomplete="off">
                @csrf
                <div class="modal-body">
                    <label for="exampleInputPassword1">{{ trans('Dashboard/doctor_trans.name') }}</label>
                    <input type="text" name="name" class="form-control"><br>

                    <label for="exampleInputPassword1">{{ trans('Dashboard/employee.salary') }}</label>
                    <input type="number" name="price" class="form-control"><br>

                    <label for="exampleInputPassword1">{{ trans('Dashboard/validation.attributes.email') }}</label>
                    <input type="email" name="email" class="form-control"><br>

                    <label for="exampleInputPassword1">{{ trans('Dashboard/login_trans.Password') }}</label>
                    <input type="password" name="password" class="form-control"><br>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{trans('Dashboard/sections_trans.exit')}}</button>
                    <button type="submit" class="btn btn-primary">{{trans('Dashboard/doctor_trans.confirm')}}</button>
                </div>
            </form>
        </div>
    </div>
</div>
