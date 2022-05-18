<div>
    <!-- PAGE-HEADER -->
    <div class="page-header">
        <div>
            <h1 class="page-title">Lapas</h1>
        </div>

        <div class="ms-auto pageheader-btn">
            <a href="{{ route('lapas.create') }}" class="btn btn-primary btn-icon text-white me-2">
                <i class="fe fe-plus"></i>
                Create Lapas
            </a>
        </div>
    </div>
    <!-- PAGE-HEADER END -->

    <!-- ROW OPEN -->
    <div class="row row-cards">
        <div class="col-lg-12 col-xl-12">
            <div class="input-group mb-5">
                <input type="text" class="form-control" wire:model='query' placeholder="">
                <div class="input-group-text btn btn-primary">
                    <i class="fa fa-search" aria-hidden="true"></i>
                </div>
            </div>
            <div class="card">
                <div class="card-header border-bottom-0 p-4">
                    <h2 class="card-title">{{ $paginate_content }}</h2>
                </div>
                <div class="e-table px-5 pb-5">
                    <div class="table-responsive table-lg">
                        <table class="table border-top table-bordered mb-0">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($datas as $i=>$data)
                                <tr>
                                    <td class="text-nowrap align-middle">
                                        {{ ($datas->currentpage()-1) * $datas->perpage() + $i + 1 }}</td>
                                    <td class="text-nowrap align-middle">{{ $data->name }}</td>
                                    <td class="text-center align-middle">
                                        <div class="btn-group align-top">
                                            <a href="{{ route('lapas.edit', Crypt::encrypt($data->id)) }}"
                                                class="btn btn-sm btn-primary badge"><i class="fa fa-edit"></i></a>
                                            <button class="btn btn-sm btn-primary badge" type="button"
                                                wire:click="$emit('deleteLapasModal', '{{ Crypt::encrypt($data->id) }}')"><i
                                                    class="fa fa-trash"></i></button>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <td colspan="4" class="text-nowrap align-middle">
                                    Data Kosong
                                </td>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-end mb-5">
                {{ $datas->links("livewire::bootstrap") }}
            </div>
        </div><!-- COL-END -->
    </div>
</div>

@section('js')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        window.livewire.on('deleteLapasModal', (params) => {
            setTimeout(function () {
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
                        window.livewire.emit('deleteLapas', params);
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
    });
</script>
@endsection