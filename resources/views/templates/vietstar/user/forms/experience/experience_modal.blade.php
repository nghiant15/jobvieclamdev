<div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
        <form class="form" id="add_edit_profile_experience" method="POST" action="{{ route('store.front.profile.experience', [$user->id]) }}">{{ csrf_field() }}
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">{{__('Add Experience')}}</h4>
            </div>
            @include(config('app.THEME_PATH').'.user.forms.experience.experience_form')
            <div class="modal-footer">
                <button type="button" class="btn btn-large btn-primary" onClick="submitProfileExperienceForm();">{{__('Add Experience')}} </button>
            </div>
        </form>
    </div>
    <!-- /.modal-content --> 
</div>
<!-- /.modal-dialog -->