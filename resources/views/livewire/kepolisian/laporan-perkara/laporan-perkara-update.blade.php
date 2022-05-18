<div>
    <!-- PAGE-HEADER -->
    <div class="page-header">
        <div>
            <h1 class="page-title">Tambah Laporan Perkara</h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{URL::to('/laporan-perkara')}}">Laporan Perkara</a></li>
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
                    <form action="#" method="post" wire:submit.prevent="addLaporanPerkara">
                      @csrf
                      <div class="form-group">
                          <label class="form-label">User Pengirim : {{$user_pengirim->name}}</label>
                          <input class="form-control form-control-sm  mb-4" wire:model='user_id' type="text" value="{{$user_pengirim->id}}" readonly>
                          @error('user_id')
                            <div class="mt-2 text-danger">{{ $message }}</div>
                          @enderror
                      </div>

                      <div class="form-group">
                        <label class="form-label">No LP</label>
                        <input class="form-control form-control-sm  mb-4" wire:model='no_lp' placeholder="Masukan no lp" type="text">
                        @error('no_lp')
                          <div class="mt-2 text-danger">{{ $message }}</div>
                        @enderror
                      </div>

                      <div class="form-group">
                        <label class="form-label">Tanggal No LP</label>
                        <input class="form-control form-control-sm  mb-4" wire:model='date_no_lp' placeholder="Masukan tanggal no lp" type="date">
                        @error('date_no_lp')
                          <div class="mt-2 text-danger">{{ $message }}</div>
                        @enderror
                      </div>

                      <div class="form-group">
                          {{$list_kategori}}
                      </div>

                      <div class="form-group">
                        {{$list_kategori_bagian}}
                      </div>

                      <div class="form-group">
                        {{-- {{$list_kategori_bagian}} --}}
                        dropdown status
                      </div>
                      
                      <div class="form-group">
                        user pengirim id encrypt 
                        {{$user_pengirim_id}}
                      </div>
                      
                      <div class="form-group">
                        code file
                        {{$list_code_file}}
                        <br/>format :
                        <br/>dropdown code file | choose file | tambah file (tambah row ini kebawah untuk multifile)
                      </div>

                      <div class="form-group">
                          <button type="submit" class="btn btn-success btn-icon text-white me-2"><i class="fe fe-plus"></i> Submit</button>
                          <a href="#" class="btn btn-warning btn-icon text-white" wire:click="indexLaporanPerkara">
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
