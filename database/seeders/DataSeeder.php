<?php

namespace Database\Seeders;

use App\Models\Buku;
use App\Models\Identitas;
use App\Models\Kategori;
use App\Models\Pemberitahuan;
use App\Models\Peminjaman;
use App\Models\Penerbit;
use App\Models\Pesan;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //USER
        User::Create([
            'kode' => 'AD001',
            'nis'    => '203910',
            'fullname'    => 'Administrator',
            'username' => 'admin',
            'password'    => Hash::make("password"),
            'kelas'    => 'XII-RPL',
            'alamat' => 'JL.BUNGA SARI',
            'verif'    => 'verified',
            'role' => 'admin',
            'join_date'    => Carbon::now(),
            'terakhir_login' => Carbon::now(),
            'foto' => '',
        ]);

        User::Create([
            'kode' => 'AA001',
            'nis'    => '0056378',
            'fullname'    => 'Neina Rahma Sari',
            'username' => 'user',
            'password'    => Hash::make("password"),
            'kelas'    => 'XII RPL',
            'alamat' => 'JL. ASRI V',
            'verif'    => 'verified',
            'role' => 'user',
            'join_date'    => Carbon::now(),
            // 'terakhir_login' => '',
            'foto' => '',
        ]);

        //KATEGORI
        Kategori::create([
            'kode' => 'coding',
            'nama' => 'Coding',
        ]);

        Kategori::create([
            'kode' => 'buku anak',
            'nama' => 'Buku Anak',
        ]);

        Kategori::create([
            'kode' => 'sejarah',
            'nama' => 'Sejarah',
        ]);

        //PENERBIT
        Penerbit::create([
            'kode' => 'P001',
            'nama'    => 'Erlangga',
            // 'verif' => '',
        ]);

        Penerbit::create([
            'kode' => 'P002',
            'nama'    => 'BSE',
            // 'verif' => '',
        ]);

        Penerbit::create([
            'kode' => 'P003',
            'nama'    => 'Intermedia',
            // 'verif' => '',
        ]);

        //BUKU
        Buku::create([
            'judul' => 'Jago Coding dalam 1 Menit',
            'kategori_id' => '1',
            'penerbit_id' => '1',
            'pengarang' => 'Nur ali',
            'tahun_terbit' => '2017',
            'isbn' => '',
            'j_buku_baik' => '10',
            'j_buku_rusak' => '10',
            'foto' => '',
        ]);

        Buku::create([
            'judul' => 'Ensiklopedia Anak',
            'kategori_id' => '2',
            'penerbit_id' => '2',
            'pengarang' => 'Aldy',
            'tahun_terbit' => '2018',
            'isbn' => '',
            'j_buku_baik' => '10',
            'j_buku_rusak' => '10',
            'foto' => '',
        ]);

        Buku::create([
            'judul' => 'Sejarah Dinosaurus',
            'kategori_id' => '3',
            'penerbit_id' => '3',
            'pengarang' => 'Juki',
            'tahun_terbit' => '2019',
            'isbn' => '',
            'j_buku_baik' => '10',
            'j_buku_rusak' => '10',
            'foto' => '',
        ]);

        //PEMINJAMAN
        Peminjaman::create([
            'user_id' => '2',
            'buku_id' => '1',
            'tgl_peminjaman' => Carbon::now(),
            'tgl_pengembalian' => Carbon::now(),
            'kondisi_buku_saat_dipinjam' => 'baik',
            'kondisi_buku_saat_dikembalikan' => 'baik',
            'denda' => '20000',
        ]);

        Peminjaman::create([
            'user_id' => '2',
            'buku_id' => '2',
            'tgl_peminjaman' => Carbon::now(),
            // 'tgl_pengembalian' => '',
            'kondisi_buku_saat_dipinjam' => 'rusak',
            // 'kondisi_buku_saat_dikembalikan' => '',
            'denda' => '1000',
        ]);

        //PESAN
        Pesan::create([
            'penerima_id' => '1',
            'pengirim_id' => '2',
            'judul' => 'Pengembalian Buku',
            'isi' => 'Buku akan saya kembalikan segera',
            'status' => 'terkirim',
            'tgl_kirim' => Carbon::now(),
        ]);

        Pesan::create([
            'penerima_id' => '1',
            'pengirim_id' => '2',
            'judul' => 'Terimakasih Perpus',
            'isi' => 'Buku yang ada di perpus ini sungguh keren',
            'status' => 'terkirim',
            'tgl_kirim' => Carbon::now(),
        ]);

        Pesan::create([
            'penerima_id' => '2',
            'pengirim_id' => '1',
            'judul' => 'Anda merusakan buku',
            'isi' => 'Anda kena denda 10000',
            'status' => 'terkirim',
            'tgl_kirim' => Carbon::now(),
        ]);
        
        //IDENTITAS
        Identitas::create([
            'nama_app'    => 'E-PERPUS',
            'alamat_app' => 'JL. SMEAN 6, Cawang, Kramat Jati',
            'email_app'    => 'e.perpus@email.com',
            'nomor_hp'    => '087840260498',
            'foto' => '',
        ]);
    }
}
