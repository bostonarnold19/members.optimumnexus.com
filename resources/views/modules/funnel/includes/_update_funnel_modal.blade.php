<div class="modal fade" id="createpost" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Update Funnel</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form onsubmit="return confirm('Do you want to save this data?');" method="POST" action="{{ route('funnel.update', $funnel->id) }}">
                    {{ csrf_field() }}
                    {{ method_field('PATCH') }}
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input id="title" type="text" class="form-control" name="title" value="{{ $funnel->title }}" required>
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea class="form-control" name="description">{{ $funnel->description }}</textarea>
                    </div>
                    <div class="form-group">
                        <label>Category</label>
                        <select required name="category_id" class="form-control">
                            <option {{ $funnel->category_id == null ? 'selected' : '' }} selected disabled>Select Category</option>
                            @foreach($categories as $category)
                            <option {{ $funnel->category_id == $category->id ? 'selected' : '' }}  value="{{ $category->id }}">{{$category->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-success form-control">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
