{{-- Tahap II --}}
<td class="text-nowrap align-middle text-center">
    @if(isset($dp->fileTahapII))
        <a type="button" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#modalUploadTahap2View_{{$dp->id}}">
            <i class="fa fa-check-circle-o color-green" aria-hidden="true" data-bs-placement="top" data-bs-toggle="tooltip" title="" data-bs-original-title="Sudah ada Berkas"></i> 
        </a>
    @else
        <a type="button" class="dropdown-item">
            <i class="fa fa-spinner" data-bs-placement="top" data-bs-toggle="tooltip" title="" data-bs-original-title="Menunggu Penyidik"></i>
        </a>
    @endif
</td>