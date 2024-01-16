<!-- Deleted insurance -->
<div class="modal fade" id="Deleted{{$ambulance->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{ trans('Dashboard/ambulance_trans.delete_information_car') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('Ambulance.destroy','test')}}" method="post">
                    @method('DELETE')
                    @csrf
                    <input type="hidden" name="id" value="{{$ambulance->id}}">
                    <div class="row">
                        <div class="col">
                            <p class="h5"> {{ trans('Dashboard/ambulance_trans.text') }}</p>
                            <div class="alert alert-info">{{$ambulance->car_numper}}</div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{trans('Dashboard/doctor_trans.close')}}</button>
                        <button class="btn btn-danger">{{trans('Dashboard/service_trans.delete')}}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
