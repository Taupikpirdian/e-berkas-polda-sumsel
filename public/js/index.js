$(document).ready(function() {
    var max_fields = 10;
    var wrapper = $(".form-tersangka");
    var add_button = $(".add-tersangka");

    var x = 1;
    $(add_button).click(function(e) {
        e.preventDefault();
        x++;
        $(wrapper).append(`
            <div class="form-tersangka">
            <div class="form-group">
                <label class="form-label">Nama Tersangka</label>
                <input type="text" name="tersangka[]" class="form-control mb-2" placeholder="Tersangka">
            </div>
            <div class="form-group">
                <label class="form-label">Tempat Tanggal Lahir</label>
                <input type="text" name="tersangka[]" class="form-control mb-2" placeholder="Tersangka">
            </div>
            <div class="form-group">
                <label class="form-label">Tanggal Lahir</label>
                <input class="form-control" id="datepicker-date" name="tanggallahir[]" value="{{old('date_no_lp')}}" placeholder="DD/MM/YYYY" type="text" required>
            </div>
            <div class="form-group">
                <label class="form-label">Jenis Kelamin</label>
                <input type="text" name="jenis-kelamin[]" class="form-control mb-2" placeholder="Tersangka">
            </div>
            <div class="form-group">
                <label class="form-label">Kebangsaan</label>
                <input type="text" name="kebangsaan[]" class="form-control mb-2" placeholder="Tersangka">
            </div>
            <div class="form-group">
                <label class="form-label">Alamat</label>
                <input type="text" name="alamat[]" class="form-control mb-2" placeholder="Tersangka">
            </div>
            <div class="form-group">
                <label class="form-label">Agama</label>
                <input type="text" name="agama[]" class="form-control mb-2" placeholder="Tersangka">
            </div>
            <div class="form-group">
                <label class="form-label">Pekerjaan</label>
                <input type="text" name="pekerjaan[]" class="form-control mb-2" placeholder="Tersangka">
            </div>
            <div class="form-group">
                <label class="form-label">Pendidikan</label>
                <input type="text" name="pendidikan[]" class="form-control mb-2" placeholder="Tersangka">
            </div>
            <div class="form-group">
                <label class="form-label">Pasal</label>
                <input type="text" name="pasal[]" class="form-control mb-2" placeholder="Tersangka">
            </div>
        </div>`);
    });

    $(wrapper).on("click", ".delete", function(e) {
        e.preventDefault();
        $(this).parent('div').remove();
        x--;
    })
});