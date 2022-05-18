<div>
    @if ($createProfile === false)
    <!-- PAGE-HEADER -->
    <div class="page-header">
        <div>
            <h1 class="page-title">Profile</h1>
        </div>
    </div>
    <!-- PAGE-HEADER END -->

    <!-- ROW-1 OPEN -->
    <div class="row" id="user-profile">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="wideget-user">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-xl-6">
                                <div class="wideget-user-desc d-sm-flex">
                                    <div class="wideget-user-img">
                                        <img class="" src="../../assets/images/users/8.jpg" alt="img">
                                    </div>
                                    <div class="user-wrap">
                                        <h4>{{ $user->name }}</h4>
                                        <h6 class="text-muted mb-3">Member Since: {{ date('d M Y', strtotime($user->created_at)) }}</h6>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-12 col-xl-6">
                                <div class="text-xl-right mt-4 mt-xl-0">
                                  @hasanyrole('kejaksaan|kepolisian')
                                    <a href="profiles/{{ helperEncrypt($uid) }}/edit" class="btn btn-primary btn-icon text-white me-2"> Edit Akun + Lengkapi Data</a>
                                  @endhasanyrole
                                    <a href="profiles/ubah-pin/{{ helperEncrypt($uid) }}" class="btn btn-primary btn-icon text-white me-2"> Ubah Pin</a>
                                    <a href="profiles/ubah-password/{{ helperEncrypt($uid) }}" class="btn btn-primary btn-icon text-white me-2"> Ubah Password</a>
                                </div>
                                <div class="mt-5">
                                    <div class="main-profile-contact-list float-md-end d-lg-flex">
                                        <div class="me-5">
                                            <div class="media">
                                                <div class="media-icon bg-primary  me-3 mt-1">
                                                    <i class="fe fe-file-plus fs-20 text-white"></i>
                                                </div>
                                                <div class="media-body">
                                                    <span class="text-muted">Perkara</span>
                                                    <div class="fw-semibold fs-25">
                                                        {{ $countDataPranut }}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="border-top">
                    <div class="wideget-user-tab">
                        <div class="tab-menu-heading">
                            <div class="tabs-menu1">
                                <ul class="nav">
                                    <li class=""><a href="#tab-51" class="active show" data-bs-toggle="tab">Profile</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-content">
              <div class="tab-pane active show" id="tab-51">
                  <div id="profile-log-switch">
                      <div class="card">
                          <div class="card-body">
                              <div class="media-heading">
                                  <h5><strong>Personal Information</strong></h5>
                              </div>
                              <div class="table-responsive ">
                                  <table class="table row table-borderless">
                                      <tbody class="col-lg-12 col-xl-6 p-0">
                                          <tr>
                                            <td><strong>Username :</strong> {{ $user->name }}</td>
                                          </tr>
                                          <tr>
                                            <td><strong>Email :</strong> {{ $user->email }}</td>
                                          </tr>
                                          @hasanyrole('kepolisian')
                                          <tr>
                                            <td><strong>No Hp :</strong> {{ $user->phone }}</td>
                                          </tr>
                                          @endhasanyrole
                                          @hasanyrole('kejaksaan')
                                          <tr>
                                            <td><strong>No Hp :</strong> {{ $jaksa ? $jaksa->no_tlp : '-' }}</td>
                                          </tr>
                                          @endhasanyrole
                                      </tbody>
                                      <tbody class="col-lg-12 col-xl-6 p-0">
                                          @foreach ($user->akses as $item)
                                          <tr>
                                              <td><strong>Satker :</strong> {{ $item->satker ? $item->satker->name : '' }} </td>
                                          </tr>
                                          @endforeach
                                      </tbody>
                                  </table>
                              </div>

                              <hr>
                              <div class="media-heading">
                                <h5><strong>Kelengkapan Data</strong></h5>
                              </div>
                              @hasanyrole('kepolisian')
                                <div class="table-responsive ">
                                    <table class="table row table-borderless">
                                        <tbody class="col-lg-12 col-xl-6 p-0">
                                            <tr>
                                              <td><strong>NRP :</strong> {{ $penyidik ? $penyidik->nrp : '' }}</td>
                                            </tr>
                                            <tr>
                                              <td><strong>Nama Lengkap :</strong> {{ $penyidik ? $penyidik->name : '' }}</td>
                                            </tr>
                                            <tr>
                                              <td><strong>Pangkat :</strong> @if($penyidik) {{ $penyidik->pangkat ? $penyidik->pangkat->name : '' }} @endif</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                              @endhasanyrole
                              @hasanyrole('kejaksaan')
                              <div class="table-responsive ">
                                <table class="table row table-borderless">
                                    <tbody class="col-lg-12 col-xl-6 p-0">
                                        <tr>
                                          <td><strong>NIP :</strong> {{ $jaksa ? $jaksa->nip : '' }}</td>
                                        </tr>
                                        <tr>
                                          <td><strong>Nama Lengkap :</strong> {{ $jaksa ? $jaksa->name : '' }}</td>
                                        </tr>
                                        <tr>
                                          <td><strong>Pangkat :</strong> @if($jaksa) {{ $jaksa->pangkat ? $jaksa->pangkat->name : '' }} @endif</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                              @endhasanyrole
                          </div>
                      </div>
                  </div>
              </div>
            </div>
        </div><!-- COL-END -->
    </div>
    <!-- ROW-1 CLOSED -->
    @else
        @livewire('profile.profile-update', compact('selectedProfileId'))
    @endif
</div>

@section('js')
<script>
  document.addEventListener('DOMContentLoaded', function () {
    window.livewire.on('deleteModalRole', (params) => {
      setTimeout(function(){
        Swal.fire({
          title: 'Apakah Anda yakin akan menghapus data ini?',
          text: "Anda tidak akan dapat mengembalikan data yang telah dihapus!",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Ya Hapus!',
          confirmButtonClass: 'btn btn-primary',
          cancelButtonClass: 'btn btn-danger ml-1',
          cancelButtonText: 'Batal',
          buttonsStyling: false,
        }).then(function (result) {
          if (result.value) {
            window.livewire.emit('deleteRole', params);
            Swal.fire(
              {
                icon: "success",
                title: 'Deleted!',
                text: 'Your file has been deleted.',
                confirmButtonClass: 'btn btn-success',
              }
            )
          }
        });

      }, 1000);
    });

    window.livewire.on('createSweetAlert', () => {
      setTimeout(function(){
        Swal.fire({
          icon: 'success',
          title: 'Berhasil!',
          text: 'Anda berhasil input data!',
          confirmButtonClass: 'btn btn-primary',
          buttonsStyling: false,
        })
      }, 1000);
    });

    window.livewire.on('updateSweetAlert', () => {
      setTimeout(function(){
        Swal.fire({
          icon: 'success',
          title: 'Berhasil!',
          text: 'Anda berhasil update data!',
          confirmButtonClass: 'btn btn-primary',
          buttonsStyling: false,
        })
      }, 1000);
    });

    window.livewire.on('errorSweetAlert', () => {
      setTimeout(function(){
        Swal.fire({
          icon: 'error',
          title: 'Error!',
          text: 'Harap pilih permission terlebih dahulu',
          // footer: '<a href>Why do I have this issue?</a>',
          confirmButtonClass: 'btn btn-primary',
          buttonsStyling: false,
        })
      }, 1000);
    });

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

    window.livewire.on('showFormCreateProfile', (params) => {
      // select2 prodi
      $('#pangkat_id').select2();
      $('#pangkat_id').on('change', function (e) {
        @this.set('pangkat_id', e.target.value);
      });
    });

  });
</script>
@endsection