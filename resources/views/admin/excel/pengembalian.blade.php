<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laporan Pengembalian E - Perpus</title>
</head>

<body>
    <center>
        <h1>Laporan Pengembalian E - Perpus</h1>
        <p>{{ $identitas->alamat_app }}</p>
        <p>{{ $identitas->email_app }} | {{ $identitas->nomor_hp }}</p>
        <br>
    </center>

    <table>
        <thead>
            <tr>
                <th style="border: 1px solid black">No.</th>
                <th style="border: 1px solid black">Nama</th>
                <th style="border: 1px solid black">Judul Buku</th>
                <th style="border: 1px solid black">Tanggal Peminjaman</th>
                <th style="border: 1px solid black">Tanggal Pengembalian</th>
                <th style="border: 1px solid black">Kondisi Buku Saat Dipinjam</th>
                <th style="border: 1px solid black">Kondisi Buku Saat Dikembalikan</th>
                <th style="border: 1px solid black">Denda</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pengembalian as $key => $p)
                <tr>
                    <td style="border: 1px solid black">{{ $key + 1 }}</td>
                    <td style="border: 1px solid black">{{ $p->user->fullname }}</td>
                    <td style="border: 1px solid black">{{ $p->buku->judul }}</td>
                    <td style="border: 1px solid black">{{ $p->tgl_peminjaman }}</td>
                    <td style="border: 1px solid black">{{ $p->tgl_pengembalian }}</td>
                    <td style="border: 1px solid black">{{ $p->kondisi_buku_saat_dipinjam }}</td>
                    <td style="border: 1px solid black">{{ $p->kondisi_buku_saat_dikembalikan }}</td>
                    <td style="border: 1px solid black">{{ $p->denda }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
