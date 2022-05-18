{{-- P16 --}}
<td class="text-nowrap align-middle text-center v_p16">
    @if(isset($dp->fileSpdp) && !isset($dp->fileP16))
        <i class="fa fa-spinner" data-bs-placement="top" data-bs-toggle="tooltip" title="" data-bs-original-title="Menunggu Jaksa"></i>
    @elseif(isset($dp->fileP16))
        <a type="button" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#modalP16_{{$dp->id}}">
            <i class="fa fa-check-circle-o color-green" aria-hidden="true"></i> 
        </a>
    @else
        <i class="fa fa-minus-circle" data-bs-placement="top" data-bs-toggle="tooltip" title="" data-bs-original-title="Dikunci"></i>
    @endif
</td>

{{-- Berkas --}}
<td class="text-nowrap align-middle text-center v_berkas">
    @if(isset($dp->fileP16) && !isset($dp->fileResumeBerkasPerkara))
        <i class="fa fa-spinner" data-bs-placement="top" data-bs-toggle="tooltip" title="" data-bs-original-title="Menunggu Penyidik"></i>
    @elseif(isset($dp->fileP16) && isset($dp->fileResumeBerkasPerkara))
        <a type="button" class="dropdown-item" wire:click="$emit('detailModal', {{ $dp->id }}, 'modal-berkas', '#modalBerkasView_{{$dp->id}}')">
            <i class="fa fa-check-circle-o color-green" aria-hidden="true" data-bs-placement="top" data-bs-toggle="tooltip" title="" data-bs-original-title="Lihat"></i> 
        </a>
    @else
        <i class="fa fa-minus-circle" data-bs-placement="top" data-bs-toggle="tooltip" title="" data-bs-original-title="Dikunci"></i>
    @endif
</td>

{{-- P17 --}}
<td class="text-nowrap align-middle text-center v_p17">
    @if(!isset($dp->fileResumeBerkasPerkara) && !isset($dp->fileP17))
        <a type="button" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#modalUploadP17_{{$dp->id}}">
            <i class="fa fa-plus-circle color-yellow" aria-hidden="true" data-bs-placement="top" data-bs-toggle="tooltip" title="" data-bs-original-title="Upload P17"></i> 
        </a>
    @elseif(!isset($dp->fileResumeBerkasPerkara) && isset($dp->fileP17))
        <a type="button" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#modalUploadP17_{{$dp->id}}">
            <i class="fa fa-send-o color-yellow" aria-hidden="true" data-bs-placement="top" data-bs-toggle="tooltip" title="" data-bs-original-title="Lihat"></i> 
        </a>
    @elseif(isset($dp->fileResumeBerkasPerkara) && isset($dp->fileP17))
        <a type="button" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#modalP17View_{{$dp->id}}">
            <i class="fa fa-send-o color-yellow" aria-hidden="true" data-bs-placement="top" data-bs-toggle="tooltip" title="" data-bs-original-title="Lihat"></i> 
        </a>
    @else
        <i class="fa fa-minus-circle" data-bs-placement="top" data-bs-toggle="tooltip" title="" data-bs-original-title="Dikunci"></i>
    @endif
</td>

{{-- SOP 02 --}}
<td class="text-nowrap align-middle text-center v_sop">
    @if(!isset($dp->fileResumeBerkasPerkara) && !isset($dp->fileSop02) && isset($dp->fileP17))
        <a type="button" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#modalUploadSop02_{{$dp->id}}">
            <i class="fa fa-plus-circle color-yellow" aria-hidden="true" data-bs-placement="top" data-bs-toggle="tooltip" title="" data-bs-original-title="Upload SOP Form 02"></i> 
        </a>
    @elseif(!isset($dp->fileResumeBerkasPerkara) && isset($dp->fileSop02))
        <a type="button" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#modalUploadSop02_{{$dp->id}}">
            <i class="fa fa-send-o color-yellow" aria-hidden="true" data-bs-placement="top" data-bs-toggle="tooltip" title="" data-bs-original-title="Lihat"></i> 
        </a>
    @elseif(isset($dp->fileResumeBerkasPerkara) && isset($dp->fileSop02))
        <a type="button" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#modalSop02View_{{$dp->id}}">
            <i class="fa fa-send-o color-yellow" aria-hidden="true" data-bs-placement="top" data-bs-toggle="tooltip" title="" data-bs-original-title="Lihat"></i> 
        </a>
    @else
        <i class="fa fa-minus-circle" data-bs-placement="top" data-bs-toggle="tooltip" title="" data-bs-original-title="Dikunci"></i>
    @endif
</td>

{{-- P18 --}}
<td class="text-nowrap align-middle text-center v_p18">
    @if(isset($dp->fileResumeBerkasPerkara) && !isset($dp->fileP18))
        <a type="button" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#modalUploadP18_{{$dp->id}}">
            <i class="fa fa-plus-circle color-yellow" aria-hidden="true" data-bs-placement="top" data-bs-toggle="tooltip" title="" data-bs-original-title="Upload P18"></i> 
        </a>
    @elseif(isset($dp->fileResumeBerkasPerkara) && isset($dp->fileP18))
        <a type="button" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#modalUploadP18_{{$dp->id}}">
            <i class="fa fa-send-o color-yellow" aria-hidden="true" data-bs-placement="top" data-bs-toggle="tooltip" title="" data-bs-original-title="Lihat"></i> 
        </a>
    @else
        <i class="fa fa-minus-circle" data-bs-placement="top" data-bs-toggle="tooltip" title="" data-bs-original-title="Dikunci"></i>
    @endif
</td>

{{-- P19 --}}
<td class="text-nowrap align-middle text-center v_p19">
    @if(isset($dp->fileResumeBerkasPerkara) && !isset($dp->fileP19))
        <a type="button" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#modalUploadP19_{{$dp->id}}">
            <i class="fa fa-plus-circle color-yellow" aria-hidden="true" data-bs-placement="top" data-bs-toggle="tooltip" title="" data-bs-original-title="Upload P19"></i> 
        </a>
    @elseif(isset($dp->fileResumeBerkasPerkara) && isset($dp->fileP19))
        <a type="button" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#modalUploadP19_{{$dp->id}}">
            <i class="fa fa-send-o color-yellow" aria-hidden="true" data-bs-placement="top" data-bs-toggle="tooltip" title="" data-bs-original-title="Lihat"></i> 
        </a>
    @else
        <i class="fa fa-minus-circle" data-bs-placement="top" data-bs-toggle="tooltip" title="" data-bs-original-title="Dikunci"></i>
    @endif
</td>

{{-- P20 --}}
<td class="text-nowrap align-middle text-center v_p20">
    @if(isset($dp->fileResumeBerkasPerkara) && !isset($dp->fileP20))
        <a type="button" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#modalUploadP20_{{$dp->id}}">
            <i class="fa fa-plus-circle color-yellow" aria-hidden="true" data-bs-placement="top" data-bs-toggle="tooltip" title="" data-bs-original-title="Upload P20"></i> 
        </a>
    @elseif((isset($dp->fileResumeBerkasPerkara) && isset($dp->fileP20)))
        <a type="button" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#modalUploadP20_{{$dp->id}}">
            <i class="fa fa-send-o color-yellow" aria-hidden="true" data-bs-placement="top" data-bs-toggle="tooltip" title="" data-bs-original-title="Upload P20"></i> 
        </a>
    @else
        <i class="fa fa-minus-circle" data-bs-placement="top" data-bs-toggle="tooltip" title="" data-bs-original-title="Dikunci"></i>
    @endif
</td>

{{-- P21 --}}
<td class="text-nowrap align-middle text-center v_p21">
    @if(isset($dp->fileResumeBerkasPerkara) && !isset($dp->fileP21))
        <a type="button" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#modalUploadP21_{{$dp->id}}">
            <i class="fa fa-plus-circle color-yellow" aria-hidden="true" data-bs-placement="top" data-bs-toggle="tooltip" title="" data-bs-original-title="Upload P21"></i> 
        </a>
    @elseif(isset($dp->fileResumeBerkasPerkara) && isset($dp->fileP21))
        <a type="button" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#modalUploadP21_{{$dp->id}}">
            <i class="fa fa-send-o color-yellow" aria-hidden="true" data-bs-placement="top" data-bs-toggle="tooltip" title="" data-bs-original-title="Upload P21"></i> 
        </a>
    @else
        <i class="fa fa-minus-circle" data-bs-placement="top" data-bs-toggle="tooltip" title="" data-bs-original-title="Dikunci"></i>
    @endif
</td>

{{-- P21A --}}
<td class="text-nowrap align-middle text-center v_p21a">
    @if(isset($dp->fileResumeBerkasPerkara) && isset($dp->fileP21) && !isset($dp->fileP21A))
        <a type="button" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#modalUploadP21A_{{$dp->id}}">
            <i class="fa fa-plus-circle color-yellow" aria-hidden="true" data-bs-placement="top" data-bs-toggle="tooltip" title="" data-bs-original-title="Upload P21A"></i> 
        </a>
    @elseif((isset($dp->fileResumeBerkasPerkara) && isset($dp->fileP21A)))
        <a type="button" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#modalUploadP21A_{{$dp->id}}">
            <i class="fa fa-send-o color-yellow" aria-hidden="true" data-bs-placement="top" data-bs-toggle="tooltip" title="" data-bs-original-title="Upload P21A"></i> 
        </a>
    @else
        <i class="fa fa-minus-circle" data-bs-placement="top" data-bs-toggle="tooltip" title="" data-bs-original-title="Dikunci"></i>
    @endif
</td>

{{-- Berkas Kembali --}}
<td class="text-nowrap align-middle text-center v_b_kembali">
    @if(!isset($dp->fileResumeBerkasPerkara) && !isset($dp->fileBerkasKembali) && isset($dp->fileSop02))
        <a type="button" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#modalUploadBerkasKembali_{{$dp->id}}">
            <i class="fa fa-plus-circle color-yellow" aria-hidden="true" data-bs-placement="top" data-bs-toggle="tooltip" title="" data-bs-original-title="Upload File Berkas Kembali"></i> 
        </a>
    @elseif(!isset($dp->fileResumeBerkasPerkara) && isset($dp->fileBerkasKembali))
        <a type="button" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#modalUploadBerkasKembali_{{$dp->id}}">
            <i class="fa fa-send-o color-yellow" aria-hidden="true" data-bs-placement="top" data-bs-toggle="tooltip" title="" data-bs-original-title="Lihat"></i> 
        </a>
    @elseif(isset($dp->fileResumeBerkasPerkara) && isset($dp->fileBerkasKembali))
        <a type="button" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#modalBerkasKembaliView_{{$dp->id}}">
            <i class="fa fa-send-o color-yellow" aria-hidden="true" data-bs-placement="top" data-bs-toggle="tooltip" title="" data-bs-original-title="Lihat"></i> 
        </a>
    @else
        <i class="fa fa-minus-circle" data-bs-placement="top" data-bs-toggle="tooltip" title="" data-bs-original-title="Dikunci"></i>
    @endif
</td>