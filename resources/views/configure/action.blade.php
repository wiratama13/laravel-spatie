<div class="modal-content">
  <form id="formAction" action="{{ $role->id ? route('roles.update', $role->id) : route('roles.store') }}">
    @csrf
    @if($role->id)
      @method('put')
    @endif
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="roleName" class="form-label">Name</label>
                    <input for="text" value="{{ $role->name }}" placeholder="Role Name" name="name" class="form-control" id="roleName">
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="guardName" class="form-label">Guard</label>
                    <input for="text" value="{{ $role->guard_name }}" placeholder="Guard" name="guard_name" class="form-control" id="guardName">
                </div>
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save changes</button>
      </div>  
  </form>    
</div>