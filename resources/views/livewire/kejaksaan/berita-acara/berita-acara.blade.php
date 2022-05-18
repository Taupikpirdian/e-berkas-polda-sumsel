<div>
    <!-- PAGE-HEADER -->
    <div class="page-header">
        <div>
            <h1 class="page-title">Berita Acara</h1>
        </div>

        <div class="ms-auto pageheader-btn">
            <a href="{{ route('berita-acara.create') }}" class="btn btn-primary btn-icon text-white me-2">
                <i class="fe fe-plus"></i>
                Create Berita Acara
            </a>
        </div>
    </div>
    <!-- PAGE-HEADER END -->

    <!-- ROW OPEN -->
    <div class="row row-cards">
        <div class="col-lg-12 col-xl-12">
            <div class="input-group mb-5">
                <input type="text" class="form-control" wire:model='query' placeholder="Cari Berdasarkan no lp, nama tersangka dab nama jaksa">
                <div class="input-group-text btn btn-primary">
                    <i class="fa fa-search" aria-hidden="true"></i>
                </div>
            </div>
            <div class="card">
                <div class="card-header border-bottom-0 p-4">
                </div>
                <div class="e-table px-5 pb-5">
                    <div class="table-responsive table-lg">
                        <table class="table border-top table-bordered mb-0">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>No LP</th>
                                    <th>Tanggal Lp</th>
                                    <th>Tersangka</th>
                                    <th>JPU</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i=1; ?>
                                @forelse ($beritaAcara as $beritaAcaras)
                                <tr>
                                    <td>{{ $i }}</td>
                                    <td>{{ $beritaAcaras->perkara->no_lp }}</td>
                                    <td>{{ dateIndo($beritaAcaras->perkara->date_no_lp) }}</td>
                                    <td>
                                        @foreach($beritaAcaras->perkara->perkaraTersangka as $key => $tersangka)
                                        <?php $no = $key + 1; ?>
                                        {{ "Tersangka " . $no .": " . $tersangka->name }} <br>
                                        @endforeach
                                    </td>
                                    <td>
                                        @foreach($beritaAcaras->perkara->listJaksa as $jaksa)
                                        {{ $jaksa->masterJaksa->name }}
                                        @endforeach
                                    </td>
                                    <td>
                                        <center>
                                            <button type="button" class="btn btn-sm btn-secondary badge" wire:click="$emit('exportBeritaAcara', '{{ Crypt::encrypt($beritaAcaras->id) }}')"><i class="fa fa-file-pdf-o"></i></button>
                                            <button type="button" class="btn btn-sm btn-primary badge" data-bs-toggle="modal" data-bs-target="#detailBeritaAcara{{$beritaAcaras->id}}"><i class="fa fa-eye"></i></button>
                                            <button class="btn btn-sm btn-danger badge" type="button" wire:click="$emit('deleteBeritaAcaraModal', '{{ Crypt::encrypt($beritaAcaras->id) }}')"><i class="fa fa-trash"></i></button>
                                        </center>
                                    </td>
                                </tr>
                                <?php $i++ ?>
                                @include('shared.kejaksaan.berita-acara.modal-detail')
                                @empty
                                <td colspan="6" class="text-nowrap align-middle">
                                    Data Kosong
                                </td>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-end mb-5">
                {{ $beritaAcara->links("livewire::bootstrap") }}
            </div>
        </div><!-- COL-END -->
    </div>
</div>

@section('js')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        window.livewire.on('deleteBeritaAcaraModal', (params) => {
            setTimeout(function() {
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
                }).then(function(result) {
                    if (result.value) {
                        window.livewire.emit('deleteBeritaAcara', params);
                        Swal.fire({
                            icon: "success",
                            title: 'Deleted!',
                            text: 'Your file has been deleted.',
                            confirmButtonClass: 'btn btn-success',
                        })
                    }
                });

            }, 1000);
        });

        window.livewire.on('exportBeritaAcara', (id) => {
            setTimeout(function() {
                Swal.fire({
                    title: 'Masukan PIN!',
                    text: "Masukan PIN Anda untuk bisa melakukan export berita acara !",
                    icon: 'warning',
                    input: 'password',
                    inputAttributes: {
                        required: true,
                        placeholder: 'Masukan PIN Anda',
                        autocapitalize: 'off',
                        maxlength: 6,
                        autocorrect: 'off'
                    },
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Submit',
                    confirmButtonClass: 'btn btn-primary',
                    cancelButtonClass: 'btn btn-danger ml-1',
                    cancelButtonText: 'Batal',
                    buttonsStyling: false,
                }).then(function(result) {
                    let pinUser = result.value;
                    console.log(pinUser);
                    if (pinUser) {
                        window.livewire.emit('exportPDFBeritaAcara', id, pinUser);
                    }
                });

            }, 1000);
        });

        window.livewire.on('createSweetAlert', () => {
            setTimeout(function() {
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
            setTimeout(function() {
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: 'Anda berhasil update data!',
                    confirmButtonClass: 'btn btn-primary',
                    buttonsStyling: false,
                })
            }, 1000);
        });

        window.livewire.on('sweetAlert', (param) => {
            setTimeout(function () {
                Swal.fire({
                    icon: param.icon,
                    title: param.title,
                    text: param.text,
                    confirmButtonClass: 'btn btn-primary',
                    buttonsStyling: false,
                })
            }, 1000);
        });

    });
</script>
@endsection