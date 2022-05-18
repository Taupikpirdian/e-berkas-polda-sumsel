{{-- P31 --}}
<td class="text-nowrap align-middle text-center">
    @if ($dp->status == \App\Constant::LENGKAP && !isset($dp->fileP31)) 
        <a type="button" class="dropdown-item" wire:click="$emit('selectDua', {{ $dp->id }})" data-bs-toggle="modal" data-bs-target="#modalAssignPengadilan_{{$dp->id}}">
            <i class="fa fa-plus-circle color-yellow" aria-hidden="true" data-bs-placement="top" data-bs-toggle="tooltip" title="" data-bs-original-title="Assign Pengadilan"></i> 
        </a>
    @elseif (isset($dp->fileP31))
        @if ($dp->status == \App\Constant::LENGKAP)
        <a type="button" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#modalUploadFileP31_{{$dp->id}}">
            <i class="fa fa-check-circle-o color-green" aria-hidden="true" data-bs-placement="top" data-bs-toggle="tooltip" title="" data-bs-original-title="Upload File P34"></i> 
        </a>
        @else
        <a type="button" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#modalPreviewFileP31_{{$dp->id}}">
            <i class="fa fa-check-circle-o color-green" aria-hidden="true" data-bs-placement="top" data-bs-toggle="tooltip" title="" data-bs-original-title="Lihat"></i> 
        </a>
        @endif
    @else
        <i class="fa fa-minus-circle" data-bs-placement="top" data-bs-toggle="tooltip" title="" data-bs-original-title="Dikunci"></i>
    @endif
</td>

{{-- P33 --}}
<td class="text-nowrap align-middle text-center">
    @if (isset($dp->fileP31) && !isset($dp->fileP33))
        <i class="fa fa-spinner" data-bs-placement="top" data-bs-toggle="tooltip" title="" data-bs-original-title="Menunggu Pengadilan"></i>
    @elseif (isset($dp->fileP33))
        <a type="button" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#modalPreviewFileP33_{{$dp->id}}">
            <i class="fa fa-check-circle-o color-green" aria-hidden="true" data-bs-placement="top" data-bs-toggle="tooltip" title="" data-bs-original-title="Lihat"></i> 
        </a>
    @else
        <i class="fa fa-minus-circle" data-bs-placement="top" data-bs-toggle="tooltip" title="" data-bs-original-title="Dikunci"></i>
    @endif
</td>

{{-- P34 --}}
<td class="text-nowrap align-middle text-center">
    @if (isset($dp->fileP33) && !isset($dp->fileP34))
        <a type="button" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#modalUploadFileP34_{{$dp->id}}">
            <i class="fa fa-plus-circle color-yellow" aria-hidden="true" data-bs-placement="top" data-bs-toggle="tooltip" title="" data-bs-original-title="Upload File P34"></i> 
        </a>
    @elseif (isset($dp->fileP34))
        @if ($dp->status == \App\Constant::LENGKAP)
        <a type="button" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#modalUploadFileP34_{{$dp->id}}">
            <i class="fa fa-check-circle-o color-green" aria-hidden="true" data-bs-placement="top" data-bs-toggle="tooltip" title="" data-bs-original-title="Upload File P34"></i> 
        </a>
        @else
        <a type="button" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#modalPreviewFileP34_{{$dp->id}}">
            <i class="fa fa-check-circle-o color-green" aria-hidden="true" data-bs-placement="top" data-bs-toggle="tooltip" title="" data-bs-original-title="Lihat"></i> 
        </a>
        @endif
    @else
        <i class="fa fa-minus-circle" data-bs-placement="top" data-bs-toggle="tooltip" title="" data-bs-original-title="Dikunci"></i>
    @endif
</td>

{{-- RENDAK --}}
<td class="text-nowrap align-middle text-center">
    @if (isset($dp->fileP33) && !isset($dp->fileP34))
        <a type="button" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#modalUploadFileRendak_{{$dp->id}}">
            <i class="fa fa-plus-circle color-yellow" aria-hidden="true" data-bs-placement="top" data-bs-toggle="tooltip" title="" data-bs-original-title="Upload File Rendak"></i> 
        </a>
    @elseif (isset($dp->fileRendak))
        @if ($dp->status == \App\Constant::LENGKAP)
        <a type="button" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#modalUploadFileRendak_{{$dp->id}}">
            <i class="fa fa-check-circle-o color-green" aria-hidden="true" data-bs-placement="top" data-bs-toggle="tooltip" title="" data-bs-original-title="Upload File Rendak"></i> 
        </a>
        @else
        <a type="button" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#modalPreviewFileRendak_{{$dp->id}}">
            <i class="fa fa-check-circle-o color-green" aria-hidden="true" data-bs-placement="top" data-bs-toggle="tooltip" title="" data-bs-original-title="Lihat"></i> 
        </a>
        @endif
    @else
        <i class="fa fa-minus-circle" data-bs-placement="top" data-bs-toggle="tooltip" title="" data-bs-original-title="Dikunci"></i>
    @endif
</td>