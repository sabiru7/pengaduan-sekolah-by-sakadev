<!DOCTYPE html>
<html>
<head>
	<title>Laporan Pengaduan</title>
	<style>
		body {
			font-family: Arial, sans-serif;
			font-size: 11px;
			color: #333;
		}

		.header {
			text-align: center;
			margin-bottom: 20px;
		}

		.header h2 {
			margin: 0;
		}

		.header p {
			margin: 2px 0;
			font-size: 10px;
		}

		hr {
			border: 1px solid #000;
			margin: 10px 0 20px 0;
		}

		table {
			width: 100%;
			border-collapse: collapse;
		}

		th {
			background-color: #2c3e50;
			color: #fff;
			padding: 6px;
			text-align: center;
			font-size: 10px;
		}

		td {
			padding: 6px;
			border: 1px solid #ddd;
			vertical-align: top;
			font-size: 10px;
		}

		tr:nth-child(even) {
			background-color: #f2f2f2;
		}

		.small {
			font-size: 9px;
		}

		.footer {
			margin-top: 20px;
			text-align: right;
			font-size: 10px;
		}
	</style>
</head>

<body>

	<div class="header">
		<h2>LAPORAN PENGADUAN</h2>
		<p>SMK Taruna Bhakti</p>
		<p class="small">Tanggal Cetak: {{ date('d-m-Y') }}</p>
	</div>

	<hr>

	<table>
		<thead>
			<tr>
				<th width="4%">No</th>
				<th width="10%">Kode</th>
				<th width="12%">Pelapor</th>
				<th width="15%">Judul</th>
				<th width="10%">Jenis</th>
				<th width="25%">Isi Laporan</th>
				<th width="24%">Tanggapan</th>
			</tr>
		</thead>

		<tbody>
			@foreach($pengaduan as $item)
			<tr>
				<td align="center">{{ $loop->iteration }}</td>
				<td>{{ $item->kode_pengaduan }}</td>
				<td>{{ $item->nama }}</td>
				<td>{{ $item->judul_laporan }}</td>
				<td align="center">{{ ucfirst($item->jenis_pengaduan) }}</td>
				<td class="small">{{ $item->laporan }}</td>
				<td class="small">{{ optional($item->tanggapan)->tanggapan ?? '-' }}</td>
			</tr>
			@endforeach
		</tbody>
	</table>

	<div class="footer">
		<p>Dicetak oleh sistem</p>
	</div>

</body>
</html>