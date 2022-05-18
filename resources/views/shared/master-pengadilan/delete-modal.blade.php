<!-- modal delete -->
<div class="modal fade" id="myModal">
    <div class="modal-dialog">
        <form action='{{URL::action("PengadilanController@destroy",array($data->id))}}' id="deleteForm" method="post">
        {{ csrf_field() }}
        {{ method_field('DELETE') }}
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Hapus Data</h5>
                </div>
                <div class="modal-body">
                    <p>Apakah Anda akan menghapus data ini ?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-danger" onclick="formSubmit()">Delete</button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    function deleteData(id)
    {
        var id = id;
        var url = '{{ route("master-pengadilan.destroy", ":id") }}';
        url = url.replace(':id', id);
        $("#deleteForm").attr('action', url);
    }
</script>