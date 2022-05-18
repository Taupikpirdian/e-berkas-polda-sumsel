<!-- ROW-1 -->
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xl-12">
        <div class="row">
            @if ($listCard != null)
                @foreach ($listCard as $item)
                    <div class="col-lg-3 col-md-3 col-sm-4 col-xl-4 col-6">
                        <div class="card overflow-hidden text-success">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <h6 class="text-dark">{{ $item['title'] }}</h6>
                                        <h3 class="mb-2 number-font text-dark">{{ $item['data'] }}</h3>
                                    </div>
                                    <div class="col col-auto">
                                        <i class="fa {{$item['icon']}} text-{{$item['color-icon']}} fa-2x" aria-hidden="true" style="font-size: 2em"></i>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <p class="text-muted mb-0">
                                            @if ($item['data_last_month'] > 0)
                                                <span class="text-success">
                                                <i class="fa fa-chevron-circle-up text-success me-1"></i>
                                                {{ $item['data_last_month'] }}</span>
                                            @else
                                                <span class="text-danger">
                                                <i class="fa fa-chevron-circle-down text-danger me-1"></i>
                                                {{ abs($item['data_last_month']) }}</span>
                                            @endif
                                            last month
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
</div>