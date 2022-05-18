{{-- P31 --}}
<td class="text-nowrap align-middle text-center">
    @if (isset($dp->fileP31))
        <a type="button" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#modalPreviewFileP31_{{$dp->id}}">
            <i class="fa fa-check-circle-o color-green" aria-hidden="true" data-bs-placement="top" data-bs-toggle="tooltip" title="" data-bs-original-title="Lihat"></i> 
        </a>
    @else
        <i class="fa fa-minus-circle" data-bs-placement="top" data-bs-toggle="tooltip" title="" data-bs-original-title="Menunggu Pengadilan"></i>
    @endif
</td>

{{-- P33 --}}
<td class="text-nowrap align-middle text-center">
    @if (isset($dp->fileP33))
        <a type="button" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#modalPreviewFileP33_{{$dp->id}}">
            <i class="fa fa-check-circle-o color-green" aria-hidden="true" data-bs-placement="top" data-bs-toggle="tooltip" title="" data-bs-original-title="Lihat"></i> 
        </a>
    @else
        <i class="fa fa-minus-circle" data-bs-placement="top" data-bs-toggle="tooltip" title="" data-bs-original-title="Menunggu Kejaksaan"></i>
    @endif
</td>

{{-- P34 --}}
<td class="text-nowrap align-middle text-center">
    @if (isset($dp->fileP34))
        <a type="button" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#modalPreviewFileP34_{{$dp->id}}">
            <i class="fa fa-check-circle-o color-green" aria-hidden="true" data-bs-placement="top" data-bs-toggle="tooltip" title="" data-bs-original-title="Lihat"></i> 
        </a>
    @else
        <i class="fa fa-minus-circle" data-bs-placement="top" data-bs-toggle="tooltip" title="" data-bs-original-title="Menunggu Kejaksaan"></i>
    @endif
</td>

{{-- RENDAK --}}
<td class="text-nowrap align-middle text-center">
    @if (isset($dp->fileRendak))
        <a type="button" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#modalPreviewFileRendak_{{$dp->id}}">
            <i class="fa fa-check-circle-o color-green" aria-hidden="true" data-bs-placement="top" data-bs-toggle="tooltip" title="" data-bs-original-title="Lihat"></i> 
        </a>
    @else
        <i class="fa fa-minus-circle" data-bs-placement="top" data-bs-toggle="tooltip" title="" data-bs-original-title="Menunggu Kejaksaan"></i>
    @endif
</td>