<div class="modal fade" id="wpsiteupdate" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Update Wordpress Site</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form onsubmit="return confirm('Do you want to update this data?');" method="POST" action="{{ route('post.user.update-wp-site', auth()->user()->id) }}">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="wp_site">WP SITE</label>
                        <input id="wp_site" type="text" class="form-control" name="wp_site" value="{{ auth()->user()->wp_site }}" required>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-success form-control">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
