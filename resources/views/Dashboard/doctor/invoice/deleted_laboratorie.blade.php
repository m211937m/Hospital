<!-- Deleted insurance -->
<div class="modal fade" id="delete{{$patient_Laboratorie->id}}" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{ trans('Dashboard/invoice_doctor_trans.Delete_detective_detalis') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('Laboratories.destroy', $patient_Laboratorie->id) }}" method="post">
                    @method('DELETE')
                    @csrf
                    <div class="row">
                        <div class="col">
                            <p class="h5 text-danger">{{ trans('Dashboard/sections_trans.text') }}</p>
                            <input type="text" class="form-control" readonly value="{{ $patient_Laboratorie->description }}">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary"
                            data-dismiss="modal">{{ trans('Dashboard/sections_trans.exit') }}</button>
                        <button class="btn btn-danger">{{ trans('Dashboard/service_trans.delete') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
