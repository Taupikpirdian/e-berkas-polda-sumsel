<!-- modal aprrove -->
<div class="modal fade" id="uploadModal{{$files->file_id}}">
    <div class="modal-dialog">
        <form action="" method="post">
        {{ csrf_field() }}
        {{ method_field('DELETE') }}
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Upload File</h5>
                </div>
                <div class="modal-body">
                    <div class="row container-field">
                        <div class="col-lg-12 col-sm-12 mb-lg-0">
                            <input type="file" class="dropify" name="resume_lapju" value="" data-bs-height="180"/>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" onclick="formSubmit()">Submit</button>
                </div>
            </div>
        </form>
    </div>
</div>


<!-- modal aprrove -->
<div class="modal fade" id="modalApprove{{$files->file_id}}">
    <div class="modal-dialog">
        <form action='' id="deleteForm" method="post" style="margin-top: 30%;">
        {{ csrf_field() }}
        {{ method_field('DELETE') }}
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Approve File</h5>
                </div>
                <div class="modal-body text-center">
                    <p>Apakah Anda akan approve file ini ?</p>
                    <div class="row">
                        <div class="col-lg">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tidak</button>
                            <button type="submit" class="btn btn-primary" onclick="formSubmit()">Iya</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>