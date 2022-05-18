<div>
    <!-- PAGE-HEADER -->
    <div class="page-header">
        <div>
            <h1 class="page-title">Role</h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{URL::to('/permissions')}}">Role</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ $breadcrumb }}</li>
            </ol>
        </div>
    </div>
    <!-- PAGE-HEADER END -->
    <!-- Row -->
    <div class="row">
        <div class="col-lg-12 col-md-12">
            <div  class="card">
                <div class="card-header">
                    <h3 class="card-title">{{ $breadcrumb }}</h3>
                </div>
                <div class="card-body pt-2">
                    <form action="#" method="post" wire:submit.prevent="addRole">
                      @csrf
                      <div class="form-group">
                          <label class="form-label form-label-required">Role</label>
                          <input class="form-control form-control-sm  mb-4" wire:model='name' placeholder="Masukan nama role" type="text">
                      </div>

                      <div class="table-responsive">
                        <table id="table-extended-transactions" class="table mb-0">
                          <thead>
                            <tr>
                              <th colspan="3">Pilih Permission</th>
                            </tr>
                          </thead>
                        </table>
                        <table id="table-extended-transactions" class="table mb-0">
                          <thead>
                            <tr>
                              <th>No</th>
                              <th>Permission</th>
                              <th>Ambil</th>
                            </tr>
                          </thead>
                          <tbody>
                          @foreach($permissions as $i=>$permission)
                            <tr>
                              <td>{{ $i + 1 }}</td>
                              <td>{{ $permission->name }}</td>
                              @if($permission->status == 0)
                              <td class="align-middle">
                                <div class="custom-control custom-control-inline custom-checkbox custom-control-nameless m-0 align-top">
                                    <input class="custom-control-input" wire:model="id_permission.{{ $permission->name }}" type="checkbox" id="{{ $permission->name }}">
                                    <label class="custom-control-label" for="{{ $permission->name }}"></label>
                                </div>
                              </td>
                              @else
                              <td class="align-middle">
                                <div class="custom-control custom-control-inline custom-checkbox custom-control-nameless m-0 align-top">
                                    <input class="custom-control-input" wire:model="id_permission.{{ $permission->name }}" type="checkbox" id="{{ $permission->name }}" selected>
                                    <label class="custom-control-label" for="{{ $permission->name }}"></label>
                                </div>
                              </td>
                              @endif
                            </tr>
                          @endforeach
                          </tbody>
                        </table>
                      </div>

                      <div class="form-group">
                          <button type="submit" class="btn btn-success btn-icon text-white me-2"><i class="fe fe-plus"></i> Submit</button>
                          <a href="#" class="btn btn-warning btn-icon text-white" wire:click="indexRole">
                              <span>
                                  <i class="fe fe-log-in"></i>
                              </span> Cancel
                          </a>
                      </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- End Row -->
</div>
