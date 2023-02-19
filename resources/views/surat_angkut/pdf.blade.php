<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Surat Angkut</title>
    <style type="text/css">
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 5px;
            border: 1px solid black;
        }
        th {
            text-align: center;
            font-weight: bold;
        }
        .text-center {
            text-align: center;
        }
        .text-right {
            text-align: right;
        }
        .mb-10 {
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <div class="mb-10">
        <h2 class="text-center">SURAT ANGKUT</h2>
    </div>

    <table>
        <tr>
            <td width="20%">Nomor SA</td>
            <td width="2%">:</td>
            <td>{{ $surat_angkut->nomor_sa }}</td>
        </tr>
        <tr>
            <td>Kode Tanda Penerima</td>
            <td>:</td>
            <td>{{ $surat_angkut->kode_tanda_penerima }}</td>
        </tr>
        <tr>
            <td>Nama Customer</td>
            <td>:</td>
            <td>{{ $surat_angkut->nama_customer }}</td>
        </tr>
        <tr>
            <td>Alamat Customer</td>
            <td>:</td>
            <td>{{ $surat_angkut->alamat_customer }}</td>
        </tr>
        <tr>
            <td>Telepon Customer</td>
            <td>:</td>
            <td>{{ $surat_angkut->telepon_customer }}</td>
        </tr>
        <tr>
            <td>Nama Barang</td>
            <td>:</td>
            <td>{{ $surat_angkut->nama_barang }}</td>
        </tr>
        <tr>
            <td>Jumlah Barang</td>
            <td>:</td>
            <td>{{ $surat_angkut->jumlah_barang }}</td>
        </tr>
        <tr>
            <td>Berat Barang</td>
            <td>:</td>
            <td>{{ $surat_angkut->berat_barang }}</td>
        </tr>
        <tr>
            <td>Nama Penerima</td>
            <td>:</td>
            <td>{{ $surat_angkut->nama_penerima }}</td>
        </tr>
        <tr>
            <td>Alamat Penerima</td>
            <td>:</td>
            <td>{{ $surat_angkut->alamat_penerima }}</td>
        </tr>
        <tr>
            <td>Telepon Penerima</td>
            <td>:</td>
            <td>{{ $surat_angkut->telepon_penerima }}</td>
        </tr>
        <tr>
            <td>Supir</td>
            <td>:</td>
            <td>{{ $surat_angkut->supir }}</td>
        </tr>
        <tr>
            <td>No. Mobil</td>
            <td>:</td>
            <td>{{ $surat_angkut->no_mobil }}</td>
        </tr>
        <tr>
            <td>Keterangan</td>
            <td>:</td>
            <td>{{ $surat_angkut->keterangan }}</td>
        </tr>
        <tr>
            <td>Nama Barang</td>
            <td>:</td>
            <td>{{ $surat_angkut->nama_barang }}</td>
        </tr>
        <tr>
            <td>Jumlah</td>
            <td>:</td>
            <td>{{ $surat_angkut->jumlah_barang }}</td>
        </tr>


        