<html>

<head>
	<title>List User Demo</title>
</head>

<body>
	<div class="main">
        <table style="border: 1px solid;">
			<thead>
				<tr>
					<th colspan="7" style="text-align: center; font-size: 16px; font-weight: bold;"><h3>LIST USER DEMO</h3></th>
				</tr>
                <tr>
					<th colspan="7" style="text-align: center; font-size: 16px; font-weight: bold;"><h3>PROVINSI SUMATERA SELATAN</h3></th>
				</tr>
			</thead>
		</table>

		<table style="border: 1px solid;">
			<thead>
				<tr>
					<th>No</th>
					<th style="width: 200px; text-align: center; font-weight: bold;">Satuan Kerja</th>
					<th style="width: 70px; text-align: center; font-weight: bold;">Jenis Satker</th>
					<th style="width: 70px; text-align: center; font-weight: bold;">Role</th>
					<th style="width: 200px; text-align: center; font-weight: bold;">Nama</th>
					<th style="width: 200px; text-align: center; font-weight: bold;">Email</th>
					<th style="width: 170px; text-align: center; font-weight: bold;">Password</th>
					<th style="width: 70px; text-align: center; font-weight: bold;">PIN</th>
				</tr>
			</thead>
			<tbody>
                @php
                    $no = 0;
                @endphp
                {{-- polda --}}
                @foreach($poldaList as $polda)
                    @foreach ($polda->akses as $key=>$value)
                    @php
                        ++$no;
                    @endphp
                    <tr>
                        <td>{{ $no }}</td>
                        @if($key == 0)
                        <td>{{ $polda->name }}</td>
                        <td>{{ $polda->tipeLembaga->name }}</td>
                        @else
                        <td></td>
                        <td></td>
                        @endif
                        <td>{{ $value->user->roles[0]->name }}</td>
                        <td>{{ $value->user->name }}</td>
                        <td>{{ $value->user->email }}</td>
                        <td>aaa123</td>
                        <td></td>
                    </tr>
                    @endforeach
                @endforeach
                {{-- polres dan polsek turunannya --}}
                @foreach($polresList as $polres)
                    @foreach ($polres->akses as $key=>$value)
                    @php
                        ++$no;
                    @endphp
                    <tr>
                        <td>{{ $no }}</td>
                        @if($key == 0)
                        <td>{{ $polres->name }}</td>
                        <td>{{ $polres->tipeLembaga->name }}</td>
                        @else
                        <td></td>
                        <td></td>
                        @endif
                        <td>{{ $value->user->roles[0]->name }}</td>
                        <td>{{ $value->user->name }}</td>
                        <td>{{ $value->user->email }}</td>
                        <td>aaa123</td>
                        <td></td>
                    </tr>
                    @endforeach

                    {{-- loop polsek turunannya --}}
                    @foreach ($kategoriBagianTurunans->where('kode_induk', $polres->kode) as $key=>$turunan)
                        @foreach ($turunan->turunanKategoriBagian->akses as $key=>$value)
                        @php
                            ++$no;
                        @endphp
                        <tr>
                            <td>{{ $no }}</td>
                            @if($key == 0)
                            <td>{{ $turunan->turunanKategoriBagian->name }}</td>
                            <td>{{ $turunan->turunanKategoriBagian->tipeLembaga->name }}</td>
                            @else
                            <td></td>
                            <td></td>
                            @endif
                            <td>{{ $value->user->roles[0]->name }}</td>
                            <td>{{ $value->user->name }}</td>
                            <td>{{ $value->user->email }}</td>
                            <td>aaa123</td>
                            <td></td>
                        </tr>
                        @endforeach
                    @endforeach
                @endforeach
                {{-- kejati --}}
                @foreach($kejati as $ktj)
                    @foreach ($ktj->akses as $key=>$value)
                    @php
                        ++$no;
                    @endphp
                    <tr>
                        <td>{{ $no }}</td>
                        @if($key == 0)
                        <td>{{ $ktj->name }}</td>
                        <td>{{ $ktj->tipeLembaga->name }}</td>
                        @else
                        <td></td>
                        <td></td>
                        @endif
                        <td>{{ $value->user->roles[0]->name }}</td>
                        <td>{{ $value->user->name }}</td>
                        <td>{{ $value->user->email }}</td>
                        <td>aaa123</td>
                        <td></td>
                    </tr>
                    @endforeach
                @endforeach
                {{-- kejari --}}
                @foreach($kejari as $kjr)
                    @foreach ($kjr->akses as $key=>$value)
                    @php
                        ++$no;
                    @endphp
                    <tr>
                        <td>{{ $no }}</td>
                        @if($key == 0)
                        <td>{{ $kjr->name }}</td>
                        <td>{{ $kjr->tipeLembaga->name }}</td>
                        @else
                        <td></td>
                        <td></td>
                        @endif
                        <td>{{ $value->user->roles[0]->name }}</td>
                        <td>{{ $value->user->name }}</td>
                        <td>{{ $value->user->email }}</td>
                        <td>aaa123</td>
                        <td></td>
                    </tr>
                    @endforeach
                @endforeach
                {{-- pt --}}
                @foreach($userPT as $pt)
                    @foreach ($pt->akses as $key=>$value)
                    @php
                        ++$no;
                    @endphp
                    <tr>
                        <td>{{ $no }}</td>
                        @if($key == 0)
                        <td>{{ $pt->name }}</td>
                        <td>{{ $pt->tipeLembaga->name }}</td>
                        @else
                        <td></td>
                        <td></td>
                        @endif
                        <td>{{ $value->user->roles[0]->name }}</td>
                        <td>{{ $value->user->name }}</td>
                        <td>{{ $value->user->email }}</td>
                        <td>aaa123</td>
                        <td></td>
                    </tr>
                    @endforeach
                @endforeach
                {{-- pn --}}
                @foreach($userPT as $pn)
                    @foreach ($pn->akses as $key=>$value)
                    @php
                        ++$no;
                    @endphp
                    <tr>
                        <td>{{ $no }}</td>
                        @if($key == 0)
                        <td>{{ $pn->name }}</td>
                        <td>{{ $pn->tipeLembaga->name }}</td>
                        @else
                        <td></td>
                        <td></td>
                        @endif
                        <td>{{ $value->user->roles[0]->name }}</td>
                        <td>{{ $value->user->name }}</td>
                        <td>{{ $value->user->email }}</td>
                        <td>aaa123</td>
                        <td></td>
                    </tr>
                    @endforeach
                @endforeach
			</tbody>
		</table>
	</div>
</body>

</html>