<div>
    <!-- PAGE-HEADER -->
    <div class="page-header">
        <div>
            <h1 class="page-title">Edit Profile</h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Profile</a></li>
                <li class="breadcrumb-item active" aria-current="page">Edit Profile</li>
            </ol>
        </div>
    </div>
    <!-- PAGE-HEADER END -->

    <!-- ROW-1 OPEN -->
    <div class="row">
        <div class="col-lg-4 col-xl-4 col-md-12 col-sm-12">
            <div class="card panel-theme">
                <div class="card-header">
                    <div class="float-start">
                        <h3 class="card-title">Contact</h3>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="card-body no-padding">
                    <ul class="list-group no-margin">
                        <li class="list-group-item"><i class="fa fa-envelope list-contact-icons border text-center br-100"></i> <span class="contact-icons">cjs-sumsel@gmail.com</span></li>
                        <li class="list-group-item"><i class="fa fa-phone list-contact-icons border text-center br-100"></i> <span class="contact-icons">085846132417 </span></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-lg-8 col-xl-8 col-md-12 col-sm-12">
          <form action="#" method="post" wire:submit.prevent="updateUser">
            @csrf
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Edit Profile</h3>
                </div>
               
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12 col-md-12">
                            <div class="form-group">
                                <label class="form-label form-label-required">Username</label>
                                <input type="text" class="form-control" wire:model='name' placeholder="Name">
                            </div>
                            @error('name')
                                <div class="mt-2 text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1">Email</label>
                        <input type="email" class="form-control" wire:model='email' placeholder="email address" readonly>
                    </div>

                    <div class="form-group">
                        <label class="form-label form-label-required">Contact Number</label>
                        <input type="number" class="form-control" wire:model='phone' placeholder="phone number">
                        @error('phone')
                            <div class="mt-2 text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    @hasanyrole('kepolisian')
                        <div class="form-group">
                            <label class="form-label form-label-required">NRP</label>
                            <input type="text" class="form-control" wire:model='nrp' placeholder="Masukan NRP">
                            @error('nrp')
                                <div class="mt-2 text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    @endhasanyrole

                    @hasanyrole('kejaksaan')
                        <div class="form-group">
                            <label class="form-label form-label-required">NIP</label>
                            <input type="text" class="form-control" wire:model='nip' placeholder="Masukan NIP">
                            @error('nip')
                                <div class="mt-2 text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    @endhasanyrole

                    <div class="form-group">
                        <label class="form-label form-label-required">Nama Lengkap</label>
                        <input type="text" class="form-control" wire:model='nama_lengkap' placeholder="Masukan Nama Lengkap">
                        @error('nama_lengkap')
                            <div class="mt-2 text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group" wire:ignore>
                        <label class="form-label form-label-required">Pangkat</label>
                        <select class="form-control select2-show-search" wire:model='pangkat_id' id="pangkat_id">
                            <option value=""> Pilih Pangkat</option>
                            @foreach ($pangkats as $pk)
                            <option value="{{ $pk->id }}">{{ $pk->name }}</option>
                            @endforeach
                        </select>
                        @error('pangkat_id')
                            <div class="mt-2 text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="card-footer text-end">
                        <button type="submit" class="btn btn-success mt-1">Save</button>
                        <a href="/profiles" class="btn btn-danger mt-1">Cancel</a>
                    </div>

                </div>
            </div>
          </form>
        </div>
    </div>
  <!-- ROW-1 CLOSED -->
</div>
@section('js')
<script type="text/javascript">
    document.addEventListener('DOMContentLoaded', function () {
        // data select2 jenis_pidana
        $('#pangkat_id').on('change', function(e) {
            @this.set('pangkat_id', e.target.value);
        });
    });
</script>
@endsection