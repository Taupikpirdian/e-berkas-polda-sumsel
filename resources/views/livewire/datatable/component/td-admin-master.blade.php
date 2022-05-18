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
    @if(!isset($dp->fileResumeBerkasPerkara) && isset($dp->fileP17))
        <a type="button" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#modalP17View_{{$dp->id}}">
            <i class="fa fa-exclamation-circle text-danger" aria-hidden="true" data-bs-placement="top" data-bs-toggle="tooltip" title="" data-bs-original-title="Lihat"></i> 
        </a>
    @else
        <i class="fa fa-minus-circle" data-bs-placement="top" data-bs-toggle="tooltip" title="" data-bs-original-title="Dikunci"></i>
    @endif
</td>

{{-- SOP Form 02 --}}
<td class="text-nowrap align-middle text-center v_sop">
    @if(isset($dp->fileSop02))
        <a type="button" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#modalSop02View_{{$dp->id}}">
            <i class="fa fa-exclamation-circle text-danger" aria-hidden="true" data-bs-placement="top" data-bs-toggle="tooltip" title="" data-bs-original-title="Lihat"></i> 
        </a>
    @else
        <i class="fa fa-minus-circle" data-bs-placement="top" data-bs-toggle="tooltip" title="" data-bs-original-title="Dikunci"></i>
    @endif
</td>

{{-- P18 --}}
<td class="text-nowrap align-middle text-center v_p18">
    @if(isset($dp->fileResumeBerkasPerkara) && isset($dp->fileP18))
        <a type="button" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#modalP18View_{{$dp->id}}">
            <i class="fa fa-exclamation-circle text-danger" aria-hidden="true" data-bs-placement="top" data-bs-toggle="tooltip" title="" data-bs-original-title="Lihat"></i> 
        </a>
    @else
        <i class="fa fa-minus-circle" data-bs-placement="top" data-bs-toggle="tooltip" title="" data-bs-original-title="Dikunci"></i>
    @endif
</td>

{{-- P19 --}}
<td class="text-nowrap align-middle text-center v_p19">
    @if(isset($dp->fileResumeBerkasPerkara) && isset($dp->fileP19))
        <a type="button" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#modalP19View_{{$dp->id}}">
            <i class="fa fa-exclamation-circle text-danger" aria-hidden="true" data-bs-placement="top" data-bs-toggle="tooltip" title="" data-bs-original-title="Lihat"></i> 
        </a>
    @else
        <i class="fa fa-minus-circle" data-bs-placement="top" data-bs-toggle="tooltip" title="" data-bs-original-title="Dikunci"></i>
    @endif
</td>

{{-- P20 --}}
<td class="text-nowrap align-middle text-center v_p20">
    @if(isset($dp->fileResumeBerkasPerkara) && !isset($dp->fileP20))
        <i class="fa fa-question-circle color-blue" data-bs-placement="top" data-bs-toggle="tooltip" title="" data-bs-original-title="Belum ada feedback"></i>
    @elseif(isset($dp->fileResumeBerkasPerkara) && isset($dp->fileP20))
        <a type="button" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#modalP20View_{{$dp->id}}">
            <i class="fa fa-handshake-o color-green" aria-hidden="true" data-bs-placement="top" data-bs-toggle="tooltip" title="" data-bs-original-title="Lihat"></i> 
        </a>
    @else
        <i class="fa fa-minus-circle" data-bs-placement="top" data-bs-toggle="tooltip" title="" data-bs-original-title="Dikunci"></i>
    @endif
</td>

{{-- P21 --}}
<td class="text-nowrap align-middle text-center v_p21">
    @if(isset($dp->fileResumeBerkasPerkara) && !isset($dp->fileP21))
        <i class="fa fa-question-circle color-blue" data-bs-placement="top" data-bs-toggle="tooltip" title="" data-bs-original-title="Belum ada feedback"></i>
    @elseif(isset($dp->fileResumeBerkasPerkara) && isset($dp->fileP21))
        <a type="button" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#modalP21View_{{$dp->id}}">
            <i class="fa fa-handshake-o color-green" aria-hidden="true" data-bs-placement="top" data-bs-toggle="tooltip" title="" data-bs-original-title="Lihat"></i> 
        </a>
    @else
        <i class="fa fa-minus-circle" data-bs-placement="top" data-bs-toggle="tooltip" title="" data-bs-original-title="Dikunci"></i>
    @endif
</td>

{{-- P21A --}}
<td class="text-nowrap align-middle text-center v_p21a">
    @if(isset($dp->fileResumeBerkasPerkara) && !isset($dp->fileP21A))
        <i class="fa fa-question-circle color-blue" data-bs-placement="top" data-bs-toggle="tooltip" title="" data-bs-original-title="Belum ada feedback"></i>
    @elseif(isset($dp->fileResumeBerkasPerkara) && isset($dp->fileP21A))
        <a type="button" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#modalP21AView_{{$dp->id}}">
            <i class="fa fa-handshake-o color-green" aria-hidden="true" data-bs-placement="top" data-bs-toggle="tooltip" title="" data-bs-original-title="Lihat"></i> 
        </a>
    @else
        <i class="fa fa-minus-circle" data-bs-placement="top" data-bs-toggle="tooltip" title="" data-bs-original-title="Dikunci"></i>
    @endif
</td>

{{-- Berkas Kembali --}}
<td class="text-nowrap align-middle text-center v_b_kembali">
    @if(isset($dp->fileBerkasKembali))
        <a type="button" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#modalBerkasKembaliView_{{$dp->id}}">
            <i class="fa fa-exclamation-circle text-danger" aria-hidden="true" data-bs-placement="top" data-bs-toggle="tooltip" title="" data-bs-original-title="Lihat"></i> 
        </a>
    @else
        <i class="fa fa-minus-circle" data-bs-placement="top" data-bs-toggle="tooltip" title="" data-bs-original-title="Dikunci"></i>
    @endif
</td>