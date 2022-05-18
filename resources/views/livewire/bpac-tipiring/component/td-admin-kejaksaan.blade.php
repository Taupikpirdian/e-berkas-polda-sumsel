{{-- Surat Pengaju --}}
<td class="text-nowrap align-middle text-center">
    @if (isset($bpacTipiring->filePengajuan))
        <a href="/download-file-bacp-tipiring/{{ Crypt::encrypt($bpacTipiring->filePengajuan->id) }}/{{$bpacTipiring->filePengajuan->code}}">
            <i class="fa fa-check-circle-o color-green" aria-hidden="true" data-bs-placement="top" data-bs-toggle="tooltip" title="" data-bs-original-title="Download Berkas"></i>
        </a>
    @else
        <i class="fa fa-spinner" data-bs-placement="top" data-bs-toggle="tooltip" title="" data-bs-original-title="Menunggu Kepolisian"></i>
    @endif
</td>

{{-- Surat Balasan --}}
<td class="text-nowrap align-middle text-center">
    @if (isset($bpacTipiring->fileBalasan))
        <a href="/download-file-bacp-tipiring/{{ Crypt::encrypt($bpacTipiring->fileBalasan->id) }}/{{$bpacTipiring->fileBalasan->code}}">
            <i class="fa fa-check-circle-o color-green" aria-hidden="true" data-bs-placement="top" data-bs-toggle="tooltip" title="" data-bs-original-title="Download Berkas"></i>
        </a>
    @else
        <i class="fa fa-spinner" data-bs-placement="top" data-bs-toggle="tooltip" title="" data-bs-original-title="Menunggu Pengadilan"></i>
    @endif
</td>