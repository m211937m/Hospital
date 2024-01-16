<div class="modal fade" id="edit{{ $section->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"> <div class="modal-dialog" role="document"> <div class="modal-content">
     <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">{{ trans('Dashboard/sections_trans.ubdate_section') }} {{ $section->name }}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
    </div>
     <div class="modal-body">
        <form action="{{ route('Sections.update','test') }}" method="post"autocomplete="off">
            {{ method_field('patch') }}
            {{ csrf_field() }}
        @csrf
            <input type="hidden" class="form-control" name="id" value="{{ $section->id }}" >
            <div class="col">
                <div class="row">
                    <label>{{ trans("Dashboard/sections_trans.name_section")}}</label><input type="text" class="form-control" name="name" value="{{ $section->name }}">
                </div>
                <div class="row">
                    <label>{{ trans("Dashboard/sections_trans.description")}}</label><input type="text" class="form-control" name="description" value="{{ $section->description }}">
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ trans("Dashboard/sections_trans.exit") }}</button>
            <button type="submit" class="btn btn-success">{{ trans("Dashboard/sections_trans.ubdate") }}</button>
        </div>
        </form>
    </div>
</div>
 </div>
