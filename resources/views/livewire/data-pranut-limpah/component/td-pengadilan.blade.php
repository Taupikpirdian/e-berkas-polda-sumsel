{{-- P31 --}}
<td class="text-nowrap align-middle text-center">
    @if (isset($dp->fileP31))
        <a type="button" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#modalPreviewFileP31_{{$dp->id}}">
            <i class="fa fa-check-circle-o color-green" aria-hidden="true" data-bs-placement="top" data-bs-toggle="tooltip" title="" data-bs-original-title="Lihat"></i> 
        </a>
    @else
        <i class="fa fa-minus-circle" data-bs-placement="top" data-bs-toggle="tooltip" title="" data-bs-original-title="Dikunci"></i>
    @endif
</td>

{{-- P33 --}}
<td class="text-nowrap align-middle text-center">
    @if (isset($dp->fileP31) && !isset($dp->fileP33))
        <a type="button" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#modalUploadFileP33_{{$dp->id}}">
            <i class="fa fa-plus-circle color-yellow" aria-hidden="true" data-bs-placement="top" data-bs-toggle="tooltip" title="" data-bs-original-title="Upload File P33"></i> 
        </a>
    @elseif (isset($dp->fileP33))
        @if ($dp->status == \App\Constant::LENGKAP)
        <a type="button" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#modalUploadFileP33_{{$dp->id}}">
            <i class="fa fa-check-circle-o color-green" aria-hidden="true" data-bs-placement="top" data-bs-toggle="tooltip" title="" data-bs-original-title="Upload File P33"></i> 
        </a>
        @else
        <a type="button" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#modalPreviewFileP33_{{$dp->id}}">
            <i class="fa fa-check-circle-o color-green" aria-hidden="true" data-bs-placement="top" data-bs-toggle="tooltip" title="" data-bs-original-title="Lihat"></i> 
        </a>
        @endif
    @else
        <i class="fa fa-minus-circle" data-bs-placement="top" data-bs-toggle="tooltip" title="" data-bs-original-title="Dikunci"></i>
    @endif
</td>

{{-- P34 --}}
<td class="text-nowrap align-middle text-center">
    @if (isset($dp->fileP31) && !isset($dp->fileP33))
        <i class="fa fa-spinner" data-bs-placement="top" data-bs-toggle="tooltip" title="" data-bs-original-title="Menunggu Kejaksaan"></i>
    @elseif (isset($dp->fileP34))
        <a type="button" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#modalPreviewFileP34_{{$dp->id}}">
            <i class="fa fa-check-circle-o color-green" aria-hidden="true" data-bs-placement="top" data-bs-toggle="tooltip" title="" data-bs-original-title="Lihat"></i> 
        </a>
    @else
        <i class="fa fa-minus-circle" data-bs-placement="top" data-bs-toggle="tooltip" title="" data-bs-original-title="Dikunci"></i>
    @endif
</td>

{{-- RENDAK --}}
<td class="text-nowrap align-middle text-center">
    @if (isset($dp->fileP34) && !isset($dp->fileRendak))
        <i class="fa fa-spinner" data-bs-placement="top" data-bs-toggle="tooltip" title="" data-bs-original-title="Menunggu Kejaksaan"></i>
    @elseif (isset($dp->fileRendak))
        <a type="button" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#modalPreviewFileRendak_{{$dp->id}}">
            <i class="fa fa-check-circle-o color-green" aria-hidden="true" data-bs-placement="top" data-bs-toggle="tooltip" title="" data-bs-original-title="Lihat"></i> 
        </a>
    @else
        <i class="fa fa-minus-circle" data-bs-placement="top" data-bs-toggle="tooltip" title="" data-bs-original-title="Dikunci"></i>
    @endif
</td>