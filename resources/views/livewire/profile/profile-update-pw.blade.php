<div>
    <!-- PAGE-HEADER -->
    <div class="page-header">
        <div>
            <h1 class="page-title">Edit Profile</h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/profiles">Profile</a></li>
                <li class="breadcrumb-item active" aria-current="page">Ubah Password</li>
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
            <div class="card">
                <div class="card-header">
                    <div class="card-title">Edit Password</div>
                </div>
                <form action="#" method="post" wire:submit.prevent="updatePassword">
                  @csrf
                  <div class="card-body">
                      {{-- <div class="d-flex mb-3">
                          <img alt="User Avatar" class="rounded-circle avatar-lg me-2" src="../../assets/images/users/8.jpg">
                      </div> --}}
                      <div class="form-group">
                          <label class="form-label form-label-required">PIN</label>
                          <input type="password" wire:model='pin' class="form-control" autocomplete="new-password">
                          @error('pin')
                            <div class="mt-2 text-danger">{{ $message }}</div>
                          @enderror
                      </div>
                      <div class="form-group">
                          <label class="form-label form-label-required">Kata Sandi Sebelumnya</label>
                          <input type="password" wire:model='old_password' class="form-control">
                          @error('old_password')
                            <div class="mt-2 text-danger">{{ $message }}</div>
                          @enderror
                      </div>
                      <div class="form-group">
                          <label class="form-label form-label-required">Kata Sandi Baru</label>
                          <input type="password" wire:model='password' class="form-control">
                          @error('password')
                            <div class="mt-2 text-danger">{{ $message }}</div>
                          @enderror
                      </div>
                      <div class="form-group">
                          <label class="form-label form-label-required">Konfirmasi Kata Sandi Baru</label>
                          <input type="password" wire:model='password_confirmation' class="form-control">
                          @error('password_confirmation')
                            <div class="mt-2 text-danger">{{ $message }}</div>
                          @enderror
                      </div>
                  </div>
                  <div class="card-footer text-end">
                      <button type="submit" class="btn btn-primary">Updated</button>
                      <a href="/profiles" class="btn btn-danger">Kembali</a>
                  </div>
                </form>
            </div>
        </div>
    </div>
  <!-- ROW-1 CLOSED -->
</div>
@section('js')
<script>
  document.addEventListener('DOMContentLoaded', function () {
    window.livewire.on('sweetAlert', ($params) => {
      setTimeout(function(){
        Swal.fire({
          icon: $params.icon,
          title: $params.title,
          text: $params.text,
          confirmButtonClass: 'btn btn-primary',
          buttonsStyling: false,
        })
      }, 1000);
    });

    window.livewire.on('sweetAlertRedirect', ($params) => {
      setTimeout(function(){
        Swal.fire({
          icon: $params.icon,
          title: $params.title,
          text: $params.text,
          confirmButtonClass: 'btn btn-primary',
          buttonsStyling: false,
        }).then(function() {
            window.location = $params.url;
        });
      }, 1000);
    });
  });
</script>
@endsection