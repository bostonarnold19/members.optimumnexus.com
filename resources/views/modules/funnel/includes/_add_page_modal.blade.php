<div class="modal fade" id="addpage" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Page</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form onsubmit="return confirm('Do you want to save this data?');" method="POST" action="{{ route('page.store') }}">
                    {{ csrf_field() }}
                                <div class="form-group">
                        <label for="page_id">Page ID</label>
                        <input id="page_id" type="text" class="form-control" name="page_id" value="{{ old('page_id') }}" required>
                    </div>
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input id="title" type="text" class="form-control" name="title" value="{{ old('title') }}" required>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-success form-control">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
