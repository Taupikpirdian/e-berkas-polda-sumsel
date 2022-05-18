<div>
    <!-- PAGE-HEADER -->
    <div class="page-header">
        <div>
            <h1 class="page-title">User</h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{URL::to('/code-file')}}">Code File</a></li>
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
                    <form action="#" method="post" wire:submit.prevent="addCodeFile">
                      @csrf
                      <div class="form-group">
                          <label class="form-label form-label-required">Code</label>
                          <input class="form-control form-control-sm  mb-4" wire:model='code' placeholder="Masukan code file" type="text">
                          @error('code')
                            <div class="mt-2 text-danger">{{ $message }}</div>
                          @enderror
                      </div>

                      <div class="form-group">
                        <label class="form-label form-label-required">Name</label>
                        <input class="form-control form-control-sm  mb-4" wire:model='name' placeholder="Masukan code name" type="text">
                        @error('name')
                          <div class="mt-2 text-danger">{{ $message }}</div>
                        @enderror
                      </div>

                      <div class="form-group">
                          <button type="submit" class="btn btn-success btn-icon text-white me-2"><i class="fe fe-plus"></i> Submit</button>
                          <a href="#" class="btn btn-warning btn-icon text-white" wire:click="indexCodeFile">
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
