<div class="modal fade" id="delete{{ $section->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"> <div class="modal-dialog" role="document"> <div class="modal-content">
     <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">{{ trans('Dashboard/sections_trans.delete_section') }} {{ $section->name }}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
    </div>
     <div class="modal-body">
        <form action="{{ route('Sections.destroy','test') }}" method="post"autocomplete="off">
        {{ method_field('delete') }}
         {{ csrf_field() }}
        @csrf
            <input type="hidden" class="form-control" name="id" value="{{ $section->id }}" >
            <h5 class="modal-title"><label for="exampleInputpassword">{{ trans('Dashboard/sections_trans.text') }}</label></h5>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ trans("Dashboard/sections_trans.exit") }}</button>
            <button type="submit" class="btn btn-danger">{{ trans("Dashboard/sections_trans.confirm") }}</button>
        </div>
        </form>
    </div>
</div>
 </div>
