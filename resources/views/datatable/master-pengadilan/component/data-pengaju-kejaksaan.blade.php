<div class="card productdesc">
    <div class="card-header">
        <b>Data Jaksa Penuntut Umum</b>
    </div>
    <div class="card-body">
        <?php
        $jaksa = jaksaById($data->user_id);
        ?>
        <ul class="list-unstyled mb-0">
            <li class="p-b-20 row">
                <div class="col-sm-4 text-muted">NIP Jaksa</div>
                <div class="col">{{ $jaksa ? $jaksa->nip : "-" }}</div>
            </li>
            <li class="p-b-20 row">
                <div class="col-sm-4 text-muted">Nama Jaksa</div>
                <div class="col">{{ $jaksa->name ? $jaksa->name : "-" }}</div>
            </li>
        </ul>
    </div>
</div>