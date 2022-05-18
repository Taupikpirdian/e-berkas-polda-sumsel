<td class="text-nowrap align-middle text-center">
    @if(isset($data->filePengajuan))
        <a type="button" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#modalPengajuanIzinSitaView_{{$data->id}}">
            <i class="fa fa-check-circle-o color-green" aria-hidden="true" data-bs-placement="top" data-bs-toggle="tooltip" title="" data-bs-original-title="Lihat"></i> 
        </a>
    @else
        <i class="fa fa-minus-circle" data-bs-placement="top" data-bs-toggle="tooltip" title="" data-bs-original-title="Dikunci"></i>
    @endif
</td>

<td class="text-nowrap align-middle text-center">
    @if(isset($data->fileBalasan))
        <a type="button" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#modalBalasanIzinSita_{{$data->id}}">
            <i class="fa fa-check-circle-o color-green" aria-hidden="true" data-bs-placement="top" data-bs-toggle="tooltip" title="" data-bs-original-title="Lihat"></i> 
        </a>
    @else
        <a type="button" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#modalBalasanIzinSita_{{$data->id}}">
            <i class="fa fa-plus-circle color-yellow" aria-hidden="true" data-bs-placement="top" data-bs-toggle="tooltip" title="" data-bs-original-title="Upload Balasan"></i> 
        </a>
    @endif
</td>