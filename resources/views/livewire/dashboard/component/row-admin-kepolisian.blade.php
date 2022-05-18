<!-- ROW-1 -->
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xl-12">
        <div class="row">
            @if ($listCard != null)
                @foreach ($listCard as $item)
                    <div class="col-lg-3 col-md-3 col-sm-4 col-xl-2 col-6">
                        <div class="card overflow-hidden">
                            <div class="card-body" style="height: 150px">
                                <div class="row">
                                    <div class="col">
                                        <h6 class="text-dark">{{ $item['title'] }}</h6>
                                        <h3 class="mb-2 number-font text-dark">{{ $item['data'] }}</h3>
                                    </div>
                                    <div class="col col-auto">
                                        <i class="fa {{$item['icon']}} text-{{$item['color-icon']}} fa-2x" aria-hidden="true" style="font-size: 1em"></i>
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
<!-- ROW-1 -->

<div class="row" wire:ignore>
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Chart</h3>
            </div>
            <div class="card-body">
                <canvas id="chartPie" class="h-275"></canvas>
            </div>
        </div>
    </div>
</div>

<div class="row" wire:ignore>
    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Total Perkara</h3>
            </div>
            <div class="card-body pb-0">
                <div id="chartArea" class="chart-donut"></div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header text-dark text-dark">
                <b>Jumlah Penanganan Perkara Penyidik</b>
            </div>
            <div class="card-body">
                <h4 class="mb-5 text-dark">Perkara Pra Penuntutan</h4>
                <div class="table-responsive">
                    <table class="table border text-nowrap text-md-nowrap table-bordered mg-b-0">
                        <thead>
                            <tr class="border-top" style="text-align:center">
                                <th class="w-1">No</th>
                                <th class="w-5">Nama Penyidik</th>
                                <th class="w-5">Pangkat</th>
                                <th class="w-5">NRP</th>
                                <th class="w-1">Jumlah Penanganan Perkara</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (is_array($dataPenangananOlehKepolisian) || is_object($dataPenangananOlehKepolisian))
                                <?php $x = $dataPenangananOlehKepolisian->currentPage() > 1 ? (10 * ($dataPenangananOlehKepolisian->currentPage() - 1)) + 1 : 1; ?>
                                @forelse ($dataPenangananOlehKepolisian as $i=>$data)
                                <tr>
                                    <td style="text-align: center;">{{ $x}}</td>
                                    <td>{{ $data->name ? $data->name : '-' }}</td>
                                    <td>{{ $data->pangkat ? $data->pangkat : '-' }}</td>
                                    <td>{{ $data->nrp ? $data->nrp : '-' }}</td>
                                    <td style="text-align: center;"><h4 class="mb-0">
                                        @if ($data->jumlah)
                                            <span class="badge rounded-pill bg-success text-white">
                                                {{$data->jumlah . " Perkara"}}
                                            </span>
                                        @else
                                            <span class="badge rounded-pill bg-secondary text-white">
                                                {{"0 Perkara"}}
                                            </span>
                                        @endif
                                        </h4>
                                    </td>
                                </tr>
                                <?php $x++; ?>
                                @empty
                                <tr>
                                    <td colspan="5" style="text-align: center">Belum ada data</td>
                                </tr>
                                @endforelse
                            @else
                                <tr>
                                    <td colspan="5" style="text-align: center">Belum ada data</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
                <p class="col-sm-12 mt-3 text-dark" style="text-align: left;">
                    {{ $paginate_content }}
                </p>
            </div>
        </div>
        <div class="d-flex justify-content-end text-dark">
            {!! $dataPenangananOlehKepolisian->appends(['penangananOlehKepolisian' => $dataPenangananOlehKepolisian->currentPage()])->links('livewire::bootstrap') !!}
        </div>
    </div>
</div>


<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header text-dark">
                <b>Log Notifikasi</b>
            </div>
            <div class="card-body">
                <h4 class="mb-5 text-dark">Aktifitas Notifikasi</h4>
                <div class="table-responsive">
                    <table class="table border text-nowrap text-md-nowrap table-bordered mg-b-0">
                        <thead>
                            <tr class="border-top" style="text-align:center">
                                <th class="w-1">No</th>
                                <th class="w-5">Oleh</th>
                                <th class="w-5">Kepada</th>
                                <th class="w-5">Fitur</th>
                                <th class="w-5">Deskripsi</th>
                                <th class="w-5">Dibaca</th>
                                <th class="w-5">LP Perkara</th>
                                <th class="w-5">Tanggal</th>
                                <th class="w-5">AKSI</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (is_array($dataNotification) || is_object($dataNotification))
                                <?php $y = $dataNotification->currentPage() > 1 ? (10 * ($dataNotification->currentPage() - 1)) + 1 : 1; ?>
                                @forelse ($dataNotification as $i=>$data)
                                <tr>
                                    <td style="text-align: center;">{{ $y}}</td>
                                    <td>{{ $data->fromUser ? $data->fromUser->name : '-' }}</td>
                                    <td>{{ $data->toUser ? $data->toUser->name : '-' }}</td>
                                    <td style="text-align: center;">
                                        @if ($data->notif_fitur)
                                        <h5 class="mb-0">
                                            <span class="badge rounded-pill bg-info text-white">
                                                {{$data->notif_fitur}}
                                            </span>
                                        </h5>
                                        @else
                                            {{'-'}}
                                        @endif
                                    </td>
                                    <td>{{ $data->desc ? $data->desc : '-' }}</td>
                                    <td style="text-align: center;">{{ $data->isRead ? 'Sudah' : 'Belum' }}</td>
                                    <td>{{ $data->perkara ? $data->perkara->no_lp : '-' }}</td>
                                    <td>{{ $data->updated_at ? dateTimeIndo($data->updated_at) : '-' }}</td>
                                    <td>
                                        @if ($data->notif_type == \App\Constant::NOTIF_PRANUT) 
                                            <a class="dropdown-item" wire:click="$emit('detailModalAktifitas', {{ $data->data_id }}, 'modal-berkas-aktifitas')"><i class="fe fe-eye"></i> Detail</a>
                                        @endif
                                    </td>
                                </tr>
                                <?php $y++; ?>
                                @empty
                                <tr>
                                    <td colspan="5" style="text-align: center">Belum ada data</td>
                                </tr>
                                @endforelse
                            @else
                                <tr>
                                    <td colspan="5" style="text-align: center">Belum ada data</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
                <p class="col-sm-12 mt-3 text-dark" style="text-align: left;">
                    {{ $paginate_content_notification }}
                </p>
            </div>
        </div>
        <div class="d-flex justify-content-end mb-5">
            {{-- {{ $dataNotification->links("livewire::bootstrap") }} --}}
            {!! $dataNotification->appends(['notification' => $dataNotification->currentPage()])->links('livewire::bootstrap') !!}
        </div>
    </div>
</div>

@section('js')
<script type="text/javascript">
    $(document).ready(function() {
        /*-----echart1-----*/
        var listBulan = {!! json_encode($chart_line_bulan) !!};
        var listTotal = {!! json_encode($chart_line_total) !!};

        var options = {
            chart: {
                height: 300,
                type: "line",
                stacked: false,
                toolbar: {
                    enabled: false,
                },
                dropShadow: {
                    enabled: true,
                    opacity: 0.1,
                },
            },
            colors: ["#6259ca", "#f99433", "rgba(119, 119, 142, 0.05)"],
            dataLabels: {
                enabled: false,
            },
            stroke: {
                curve: "smooth",
                width: [3, 3, 0],
                dashArray: [0, 4],
                lineCap: "round",
            },
            grid: {
                padding: {
                    left: 0,
                    right: 0,
                },
                strokeDashArray: 3,
            },
            markers: {
                size: 0,
                hover: {
                    size: 0,
                },
            },
            series: [
                {
                    name: "Total Perkara",
                    type: "line",
                    data : listTotal
                },
            ],
            xaxis: {
                type: "month",
                categories: listBulan,
                axisBorder: {
                    show: false,
                    color: "rgba(119, 119, 142, 0.08)",
                },
                labels: {
                    style: {
                        color: "#8492a6",
                        fontSize: "12px",
                    },
                },
            },
            yaxis: {
                labels: {
                    style: {
                        color: "#8492a6",
                        fontSize: "12px",
                    },
                },
                axisBorder: {
                    show: false,
                    color: "rgba(119, 119, 142, 0.08)",
                },
            },
            fill: {
                gradient: {
                    inverseColors: false,
                    shade: "light",
                    type: "vertical",
                    opacityFrom: 0.85,
                    opacityTo: 0.55,
                    stops: [0, 100, 100, 100],
                },
            },
            tooltip: {
                show: false,
            },
            legend: {
                position: "top",
                show: true,
            },
        };
        var chart = new ApexCharts(document.querySelector("#chartArea"), options);
        chart.render();

        /* Pie Chart*/
        var listPieBulan = {!! json_encode($chart_pie_bulan) !!};
        var listPieTotal = {!! json_encode($chart_pie_total) !!};

        var datapie = {
            labels: listPieBulan,
            datasets: [
                {
                    data: listPieTotal,
                    backgroundColor: [
                        "#6259ca",
                        "#eb6f33",
                        "#ec546c",
                        "#0774f8",
                        "#9857CD",
                        "#ec546f",
                        "#0774f1",
                        "#9857Ce",
                        "#ec5444",
                        "#077400",
                        "#9857ee",
                    ],
                },
            ],
        };
        var optionpie = {
            maintainAspectRatio: false,
            responsive: true,
            legend: {
                display: false,
            },
            animation: {
                animateScale: true,
                animateRotate: true,
            },
        };

        /* Doughbut Chart*/
        var ctx6 = document.getElementById("chartPie");
        var pieChart = new Chart(ctx6, {
            type: "pie",
            data: datapie,
            options: optionpie,
        });

        pieChart.render();
    });
    
    document.addEventListener('DOMContentLoaded', function() {
        window.livewire.on('detailModalAktifitas', (id, fitur) => {
            setTimeout(function() {
                Swal.fire({
                    title: 'Masukan PIN!',
                    text: "Masukan PIN Anda untuk bisa melihat detail data prapenuntutan!",
                    icon: 'warning',
                    input: 'password',
                    inputAttributes: {
                        required: true,
                        placeholder: 'Masukan PIN Anda',
                        autocapitalize: 'off',
                        maxlength: 6,
                        autocorrect: 'off'
                    },
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Submit',
                    confirmButtonClass: 'btn btn-primary',
                    cancelButtonClass: 'btn btn-danger ml-1',
                    cancelButtonText: 'Batal',
                    buttonsStyling: false,
                }).then(function(result) {
                    let pinUser = result.value;
                    console.log(pinUser);
                    if (pinUser) {
                        if(fitur == "modal-berkas-aktifitas"){
                            window.livewire.emit('authPin', pinUser, id);
                        }
                    }
                });

            }, 1000);
        });

        window.livewire.on('sweetAlert', (param) => {
            setTimeout(function () {
                Swal.fire({
                    icon: param.icon,
                    title: param.title,
                    text: param.text,
                    confirmButtonClass: 'btn btn-primary',
                    buttonsStyling: false,
                })
            }, 1000);
        });

        window.livewire.on('sweetAlertWithRedirect', (param) => {
            setTimeout(function () {
                Swal.fire({
                    icon: param.icon,
                    title: param.title,
                    text: param.text,
                    confirmButtonClass: 'btn btn-primary',
                    buttonsStyling: false,
                }).then(function () {
                    window.location = param.url_redirect;
                });
            }, 1000);
        });

        window.livewire.on('showModalBerkas', (param) => {
            $(param).modal('show');
        });
    });
</script>
@endsection