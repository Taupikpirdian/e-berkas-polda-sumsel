<div class="card productdesc">
    <div class="card-header">
        <b>Data Penyidik</b>
    </div>
    <div class="card-body">
        <?php
        $penyidik = penyidikById($data->user_id);
        ?>
        <ul class="list-unstyled mb-0">
            <li class="p-b-20 row">
                <div class="col-sm-4 text-muted">NRP Penyidik</div>
                <div class="col">{{ $penyidik ? $penyidik->nrp : "-" }}</div>
            </li>
            <li class="p-b-20 row">
                <div class="col-sm-4 text-muted">Nama Penyidik</div>
                <div class="col">{{ $penyidik->name ? $penyidik->name : "-" }}</div>
            </li>
        </ul>
    </div>
</div>