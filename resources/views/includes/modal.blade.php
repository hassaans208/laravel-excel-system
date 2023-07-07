@if (Route::currentRouteName() == 'admin.users.index')

{{-- {{dd(Route::currentRouteName())}} --}}
<div class="modal" tabindex="-1" id="assignModal" aria-hidden="true" aria-labelledby="assignModalLabel">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Assign Customers to Users</h5>
                <button type="button" id="close" class="btn-close" aria-label="Close"><i class="fa-solid fa-xmark"></i></button>
            </div>
            <form action="{{route('admin.assign-cust-users')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    {{-- <div class="input-group mb-3"> --}}
                        <label class="input-group-text" for="inputGroupFile01">Upload</label>
                        <input type="file" class="form-control pb-2" name="import" id="inputGroupFile01">
                        <input type="hidden" id="users_id" name="users_id" id="inputGroupFile01">
                    {{-- </div> --}}
                </div>
                @error('import')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
                <div class="modal-footer">
                    <button type="button" id="close" class="btn btn-secondary">Close</button>
                    <input type="submit" class="btn btn-primary" value="Upload File"></button>
                </div>
            </form>
        </div>
    </div>
</div>
@else
<div class="modal" tabindex="-1" id="assignModal" aria-hidden="true" aria-labelledby="assignModalLabel">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Import Customers</h5>
                <button id="close" class="btn-close" aria-label="Close"><i class="fa-solid fa-circle-xmark"></i></button>
            </div>
            <form action="{{route('admin.import')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    {{-- <div class="input-group mb-3"> --}}
                        <label class="input-group-text" for="inputGroupFile01">Upload</label>
                        <input type="file" class="form-control pb-2" name="import" id="inputGroupFile01">
                        {{-- <input type="hidden" id="users_id" name="users_id" id="inputGroupFile01"> --}}
                    {{-- </div> --}}
                </div>
                @error('import')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
                <div class="modal-footer">
                    <button type="button" id="close" class="btn btn-secondary">Close</button>
                    <input type="submit" class="btn btn-primary" value="Upload File"></button>
                </div>
            </form>
        </div>
    </div>
</div>
@endif
