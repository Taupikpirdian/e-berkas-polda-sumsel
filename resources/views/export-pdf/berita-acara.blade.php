<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css"
        integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <style>
        p {
            text-align: justify;
        }
    </style>
</head>

<body>
    <div class="container">
        <table class="table table-borderless table-sm">
            <tr>
                <td><b><u>{{ $from }}</u></b></td>
                <td rowspan="2" style="text-align: right; vertical-align:center;">BA - {{ $berita_acara->perkara->no_lp}}</td>
            </tr>
            <tr>
                <td>{{ $subject }}</td>
            </tr>
        </table>
        <br>
        <div>
            <center>
                <b><u>Berita Acara Konsultasi Dan<br>Koordinasi Penanganan Perkara</u></b>
            </center>
        </div>
        <br>
        <?php
            $tanggal_berita_acara = explode(',', dateIndo($berita_acara->created_at));
            $hari = $tanggal_berita_acara[0];
            $tanggal = $tanggal_berita_acara[1];
        ?>
        <p>Pada hari ini {{ $hari }} Tanggal {{ $tanggal }} Bertempat di {{$berita_acara->alamat}}, Kami:</p>

        <div>
            <table class="table table-borderless table-sm">
                <?php $i = 1; ?>
                @forelse ($berita_acara->perkara->listJaksa as $item)
                <tr>
                    <td>{{ $i }}</td>
                    <td>Nama</td>
                    <td>:</td>
                    <td>{{ $item->masterJaksa->name ? $item->masterJaksa->name : '-' }}</td>
                </tr>
                <tr>
                    <td></td>
                    <td>Pangkat</td>
                    <td>:</td>
                    <td>{{ $item->masterJaksa->pangkat->name ? $item->masterJaksa->pangkat->name : '-' }}</td>
                </tr>
                <tr>
                    <td></td>
                    <td>NIP / NRP</td>
                    <td>:</td>
                    <td>{{ $item->masterJaksa->nip ? $item->masterJaksa->nip : '-' }}</td>
                </tr>
                <tr>
                    {{-- kosong --}}
                </tr>
                <?php $i++; ?>
                @empty
                <br>
                @endforelse
            </table>
        </div>

        <p>
            Jaksa Penuntut Umum pada {{$berita_acara->alamat}} yang ditunjuk dengan Surat Perintah {{$berita_acara->surat_perintah}} Tanggal {{ dateIndo($berita_acara->tanggal, false, false) }}
            telah melaksanakan konsultasi dan koordinasi dengan penyidik Mabes Polri/Polda/polwil/Polres/PBNS.
        </p>

        <div>
            <table class="table table-borderless table-sm">
                <?php $i = 1; ?>
                @forelse ($berita_acara->perkara->listPenyidik as $item)
                <tr>
                    <td>{{ $i }}</td>
                    <td>Nama</td>
                    <td>:</td>
                    <td>{{ $item->masterPenyidik->name ? $item->masterPenyidik->name : '-' }}</td>
                </tr>
                <tr>
                    <td></td>
                    <td>Pangkat</td>
                    <td>:</td>
                    <td>{{ $item->masterPenyidik->pangkat->name ? $item->masterPenyidik->pangkat->name : '-' }}</td>
                </tr>
                <tr>
                    <td></td>
                    <td>NIP / NRP</td>
                    <td>:</td>
                    <td>{{ $item->masterPenyidik->nrp ? $item->masterPenyidik->nrp : '-' }}</td>
                </tr>
                <tr>
                    {{-- kosong --}}
                </tr>
                <?php $i++; ?>
                @empty
                <br>
                @endforelse
            </table>
        </div>

        <?php
            // ambil 1 tersangka
            $n_tersangka = count($berita_acara->perkara->listTersangka);
            $list_tersangka = "";
        ?>

        @for ($i = 0; $i < $n_tersangka; $i++)
            <?php
                $tersangka = $berita_acara->perkara->listTersangka[$i];
                $disangka = " yang disangka melanggar Pasal ";
            ?>

            @if ($n_tersangka <= 1)
                <?php $list_tersangka = "tersangka " . $tersangka->name . $disangka . $tersangka->pasal; ?>
            @elseif ($i == $n_tersangka - 1)
                <?php $list_tersangka .= "dan tersangka " .  $tersangka->name . $disangka . $tersangka->pasal; ?>
            @else
                <?php $list_tersangka .= "tersangka " . $tersangka->name . $disangka . $tersangka->pasal . ", ";?>
            @endif
        @endfor

        <p>
            Dalam perkara tindak {{$berita_acara->perkara->jenisPidana->name}} atas nama {{ $list_tersangka }}.
        </p>

        <?php
            $no_pembahasan = 1;
            $no_kelengkapan = 1;
            $no_hasilkonsultasi = 1;
    
            $alphabet = range('a', 'z');
        ?>
        <div>
            <table class="table table-borderless table-sm">
                {{-- pembahasan 1 --}}
                @if ($berita_acara->formil || $berita_acara->materil)
                <tr>
                    <td>{{ $no_pembahasan }}</td>
                    <td>Pembahasan Konsultasi dan Koordinasi Mengenai:</td>
                </tr>
                @if ($berita_acara->formil)
                <tr>
                    <td></td>
                    <td>{{ $no_kelengkapan}}) Pembahasan Kelengkapan Formil</td>
                </tr>
                <?php $no_kelengkapan += 1; ?>
                @endif
                @if ($berita_acara->materil)
                <tr>
                    <td></td>
                    <td>{{ $no_kelengkapan}}) Pembahasan Kelengkapan Materil</td>
                </tr>
                @endif
                <?php $no_pembahasan += 1; ?>
                <br>
                @endif

                {{-- pembahasan 2 --}}
                @if ($berita_acara->formil || $berita_acara->materil)
                <tr>
                    <td>{{ $no_pembahasan }}</td>
                    <td>Hasil Konsultasi dan Koordinasi:</td>
                </tr>
                @if ($berita_acara->formil)
                <tr>
                    <td></td>
                    <td>{{ $no_hasilkonsultasi}}) Kelengkapan Formil:</td>
                </tr>
                <tr>
                    <td></td>
                    <td>
                        @forelse ($berita_acara->formil as $key => $item)
                        {{ $alphabet[$key]. ". " . $item->name }} <br>
                        @empty
                        {{ "" }}
                        @endforelse
                    </td>
                </tr>
                <?php $no_hasilkonsultasi += 1; ?>
                @endif
                @if ($berita_acara->materil)
                <tr>
                    <td></td>
                    <td>{{ $no_hasilkonsultasi}}) Kelengkapan Materil</td>
                </tr>
                <tr>
                    <td></td>
                    <td>
                        @forelse ($berita_acara->materil as $key => $item)
                        {{ $alphabet[$key] . ". " . $item->name }} <br>
                        @empty
                        {{ "" }}
                        @endforelse
                    </td>
                </tr>
                @endif
                <?php $no_pembahasan += 1; ?>
                <br>
                @endif

                {{-- pembahasan 3 --}}
                <tr>
                    <td>{{ $no_pembahasan }}</td>
                    <td>Kesimpulan:</td>
                </tr>
                <tr>
                    <td></td>
                    <td>{{ $berita_acara->kesimpulan }}</td>
                </tr>
            </table>
        </div>

        <p>
            Demikian Berita Acara Konsultasi dan Koordinasi ini kami buat dengan sebenar-benarnya untuk dapat
            dipergunakan
            sebagaimana mestinya.
        </p>

        <div>
            <table class="table table-borderless table-sm">
                <tr>
                    <td style="text-align: center">Penyidik,</td>
                    <td style="text-align: center">Penuntut Umum,</td>
                </tr>
                <tr>
                    <td style="text-align: center">
                        @forelse ($berita_acara->perkara->listPenyidik as $item)
                        <br><br><br>
                        <b><u>{{ $item->masterPenyidik->name }}</u></b>
                        <br>
                        {{ $item->masterPenyidik->pangkat->name}} / {{ $item->masterPenyidik->nrp}}
                        @empty
                        {{ "" }}
                        @endforelse
                    </td>
                    <td style="text-align: center">
                        @forelse ($berita_acara->perkara->listJaksa as $item)
                        <br><br><br>
                        <b><u>{{ $item->masterJaksa->name }}</u></b>
                        <br>
                        {{ $item->masterJaksa->pangkat->name}} / {{ $item->masterJaksa->nip}}
                        @empty
                        {{ "" }}
                        @endforelse
                    </td>
                </tr>
            </table>
        </div>
    </div>


    <!-- BOOTSTRAP JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js"
        integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js"
        integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous">
    </script>
</body>

</html>
