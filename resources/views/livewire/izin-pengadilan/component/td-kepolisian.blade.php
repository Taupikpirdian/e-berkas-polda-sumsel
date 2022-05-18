<td class="text-nowrap align-middle text-center">
    @if(isset($data->filePengajuan))
        <a type="button" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#modalPengajuanIzinSita_{{$data->id}}">
            <i class="fa fa-check-circle-o color-green" aria-hidden="true" data-bs-placement="top" data-bs-toggle="tooltip" title="" data-bs-original-title="Lihat"></i> 
        </a>
    @else
        <i class="fa fa-minus-circle" data-bs-placement="top" data-bs-toggle="tooltip" title="" data-bs-original-title="Dikunci"></i>
    @endif
</td>

<td class="text-nowrap align-middle text-center">
    @if(isset($data->fileBalasan))
        <a type="button" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#modalBalasanIzinSitaView_{{$data->id}}">
            <i class="fa fa-check-circle-o color-green" aria-hidden="true" data-bs-placement="top" data-bs-toggle="tooltip" title="" data-bs-original-title="Lihat"></i> 
        </a>
    @else
    <i class="fa fa-spinner" data-bs-placement="top" data-bs-toggle="tooltip" title="" data-bs-original-title="Menunggu Balasan"></i>
    @endif
</td>