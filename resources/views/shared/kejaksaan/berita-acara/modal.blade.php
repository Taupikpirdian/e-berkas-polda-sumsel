<style>
    .card-body-content {
        height: 400px !important;
        overflow-y: auto;
    }

    #resp-table {
        width: 100%;
        display: table;
    }

    #resp-table-body {
        display: table-row-group;
    }

    .resp-table-row {
        display: table-row;
    }

    .table-body-cell {
        display: table-cell;
        border: 1px solid #dddddd;
        padding: 8px;
        line-height: 1.42857143;
        vertical-align: top;
    }
</style>
<!-- Tambah Formil  -->
<div wire:ignore.self class="modal fade" id="modalFormil" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Formil</h5>
                <button class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="card-body" style="bottom: 15px">
                    <div class="form-group">
                        <label class="form-label">Deskipsi</label>
                        <textarea type="text" class="form-control" wire:model='name_formil' placeholder="Masukan Formil"></textarea>
                        @error('name_formil')
                        <div class="mt-2 text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button class="btn btn-primary" wire:click.prevent="addFormils()">Save changes</button>
            </div>
        </div>
    </div>
</div>

<!-- Tambah Materil  -->
<div wire:ignore.self class="modal fade" id="modalMateril" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Materil</h5>
                <button class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="card-body" style="bottom: 15px">
                    <div class="form-group">
                        <label class="form-label">Deskripsi</label>
                        <textarea type="text" class="form-control" wire:model='name_materil' placeholder="Masukan Materil"></textarea>
                        @error('name_materil')
                        <div class="mt-2 text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button class="btn btn-primary" wire:click.prevent="addMaterils()">Save changes</button>
            </div>
        </div>
    </div>
</div>