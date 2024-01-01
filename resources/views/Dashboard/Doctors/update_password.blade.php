<!-- Modal -->
<div class="modal fade" id="update_password{{ $doctor->id }}" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">
                    {{ trans('Dashboard/doctor_trans.password_update') }} {{$doctor->name}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('doctor.update_password') }}" method="post" autocomplete="off">
                {{ csrf_field() }}
                <div class="modal-body">
                    <div class="form-group">
                        <label for="password">{{ trans('Dashboard/doctor_trans.password_new') }}</label>
                        <input type="password" class="form-control" id="password" name="password" >
                    </div>

                    <div class="form-group">
                        <label for="password_confirmation">{{ trans('Dashboard/doctor_trans.password_confirm') }}</label>
                        <input type="password" class="form-control" name="password_confirmation" id="password_confirm">
                    </div>

                    <input type="hidden" name="id" value="{{ $doctor->id }}">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{trans('Dashboard/doctor_trans.close')}}</button>
                    <button type="submit" class="btn btn-primary">{{trans('Dashboard/doctor_trans.confirm')}}</button>
                </div>
            </form>
        </div>
    </div>
</div>
