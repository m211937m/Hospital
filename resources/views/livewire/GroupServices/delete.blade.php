<!-- Modal -->
<div class="modal fade" id="deleteGroup{{ $group->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{trans('Dashboard/main-sidebar-trans.group_services')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h5>{{trans('Dashboard/sections_trans.text')}}</h5>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{trans('Dashboard/sections_trans.exit')}}</button>
                <button type="submit" wire:click="delete({{ $group->id }})" class="btn btn-danger">{{trans('Dashboard/service_trans.delete')}}</button>
            </div>
            </form>
        </div>
    </div>
</div>

