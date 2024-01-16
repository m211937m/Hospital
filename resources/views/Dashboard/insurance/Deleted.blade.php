<!-- Deleted insurance -->
<div class="modal fade" id="Deleted{{$insurance->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{trans('Dashboard/insurance_trans.Title_deleted')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('insurance.destroy','test')}}" method="post">
                    @method('DELETE')
                    @csrf

                    {{-- input hidden value => id   --}}
                    <input type="hidden" name="id" value="{{$insurance->id}}">

                    <div class="row">
                        <div class="col">
                            <h5 class="modal-title"><label for="exampleInputpassword">{{ trans('Dashboard/sections_trans.text') }} {{$insurance->name}}</label></h5>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ trans("Dashboard/sections_trans.exit") }}</button>
                        <button class="btn btn-danger">{{ trans("Dashboard/sections_trans.confirm") }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
