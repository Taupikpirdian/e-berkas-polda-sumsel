<div class="container">
    <!-- PAGE-HEADER -->
    <div class="page-header">
        <div>
            <h1 class="page-title">Forward File Ke Pengadilan</h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{URL::to('/data-prapenuntutan-limpah')}}">Limpah Perkara</a></li>
                <li class="breadcrumb-item active" aria-current="page">Forward Pengadilan</li>
            </ol>
        </div>
    </div>
    <!-- PAGE-HEADER END -->

    {{-- ROW-4 OPEN --}}
    <div class="row">
        <div class="col-sm-12">
            @if ($fitur == 'forward')
                @hasanyrole('kejaksaan')
                @if ($perkara_status->status != \App\Constant::LIMPAH)
                    @include('livewire.data-pranut-limpah.component.card-forward')
                @endif
                @endhasanyrole
            @else
                @include('livewire.data-pranut-limpah.component.card-forward-detail')
            @endif
        </div>
    </div>
    {{-- ROW-4 CLOSED --}}
</div>