<div>
    <!-- PAGE-HEADER -->
    <div class="page-header">
        <div>
            <h1 class="page-title">Pejabat</h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{URL::to('/pejabat')}}">Pejabat</a></li>
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
                    <form action="#" method="post" wire:submit.prevent="addData">
                      @csrf
                      <div class="form-group">
                        <label class="form-label form-label-required">NIP</label>
                        <input class="form-control form-control-sm  mb-4" wire:model='nip' placeholder="Masukan NIP Pejabat" type="text">
                        @error('nip')
                          <div class="mt-2 text-danger">{{ $message }}</div>
                        @enderror
                      </div>

                      <div class="form-group">
                        <label class="form-label form-label-required">Name</label>
                        <input class="form-control form-control-sm  mb-4" wire:model='name' placeholder="Masukan Nama Pejabat" type="text">
                        @error('name')
                          <div class="mt-2 text-danger">{{ $message }}</div>
                        @enderror
                      </div>

                      <div class="form-group" wire:ignore>
                          <label class="form-label form-label-required">Pangkat</label>
                          <select wire:model='pangkat_id' name="pangkat_id" id="pangkat_id" class="form-control select2-show-search" required>
                              <option value=""> Pilih Pangkat</option>
                              @foreach ($pangkats as $pk)
                              <option value="{{ $pk->id }}">{{ $pk->name }}</option>
                              @endforeach
                          </select>
                          @error('pangkat_id')
                          <div class="mt-2 text-danger">{{ $message }}</div>
                          @enderror
                      </div>

                      <div class="form-group" wire:ignore>
                          <label class="form-label form-label-required">Jabatan</label>
                          <select wire:model='jabatan_id' name="jabatan_id" id="jabatan_id" class="form-control select2-show-search" required>
                              <option value=""> Pilih Jabatan</option>
                              @foreach ($jabatans as $jb)
                              <option value="{{ $jb->id }}">{{ $jb->name }}</option>
                              @endforeach
                          </select>
                          @error('jabatan_id')
                          <div class="mt-2 text-danger">{{ $message }}</div>
                          @enderror
                      </div>

                      <div class="form-group">
                          <button type="submit" class="btn btn-success btn-icon text-white me-2"><i class="fe fe-plus"></i> Submit</button>
                          <a href="{{ route('pejabat.index') }}" class="btn btn-warning btn-icon text-white">
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
@section('js')
  <script>
    document.addEventListener('DOMContentLoaded', function () {
      // data select2 status
      $('#pangkat_id').on('change', function(e) {
          @this.set('pangkat_id', e.target.value);
      });
      // data select2 jabatan_id
      $('#jabatan_id').on('change', function(e) {
          @this.set('jabatan_id', e.target.value);
      });

      window.livewire.on('sweetAlert', (param) => {
        setTimeout(function(){
          Swal.fire({
            icon: param.icon,
            title: param.title,
            text: param.text,
            confirmButtonClass: 'btn btn-primary',
            buttonsStyling: false,
          }).then(function() {
                window.location = param.url_redirect;
          });
        }, 1000);
      });
  
    });
  </script>
@endsection