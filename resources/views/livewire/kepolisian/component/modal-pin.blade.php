<!-- modal create perkara -->
<div class="modal fade" id="exampleModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <div class="row mt-3">
                    <div class="col text-center">
                        <h1>PIN <span style="color: #6259CA;">CJS</span><span style="color: #F63131">+</span></h1>
                        <p>masukan 6 digit pin anda</p>
                    </div>
                </div>
                <div class="row mt-4 m-auto" style="width: 50%; margin-top: 20px !important;">
                    <div class="col text-center">
                        <p>Pin CJS</p>
                        <input class="form-control" type="password" maxlength="6" wire:model='pin' oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" autocomplete="new-password"/>
                    </div>
                </div>
                <div class="row mt-5 mb-3">
                    <div class="col text-center">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button class="btn btn-primary" wire:click.prevent="validasiPin()">Kirim</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
