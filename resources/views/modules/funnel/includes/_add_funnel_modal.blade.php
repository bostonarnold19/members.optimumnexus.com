<div class="modal fade" id="createpost" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Create Funnel</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form onsubmit="return confirm('Do you want to save this data?');" method="POST" action="{{ route('funnel.store') }}">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input id="title" type="text" class="form-control" name="title" value="{{ old('title') }}" required autofocus>
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea class="form-control" name="description">{{ old('description') }}</textarea>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-success form-control">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
