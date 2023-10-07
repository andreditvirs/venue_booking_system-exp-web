<?php

namespace Database\Seeders;

use App\Models\Venue;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VenueSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $venue = new Venue;
        $venue->nama = 'Club House Cluster Mora & Monroe';
        $venue->kategori = 'Hotel';
        $venue->alamat = 'Nirwana, Jalan Kahuripan Entalsewu, Kec., Jl. Kahuripan Raya, Sumput, Jati, Kec. Sidoarjo, Kabupaten Sidoarjo, Jawa Timur 61226';
        $venue->file_image = 'venue1.jpg';
        $venue->save();

        $venue = new Venue;
        $venue->nama = 'Convention Hall Graha Mutiara';
        $venue->kategori = 'Convention Hall';
        $venue->alamat = 'Jl. Diponegoro, Kwadengan Timur, Lemahputro, Kec. Sidoarjo, Kabupaten Sidoarjo, Jawa Timur 61213';
        $venue->file_image = 'venue2.jpg';
        $venue->save();

        $venue = new Venue;
        $venue->nama = 'Shindy & Firman Wedding';
        $venue->kategori = 'Taman';
        $venue->alamat = 'Pondok Sidokare Indah blok Q no, RT.027/RW.014, Cangkring, Sidokare, Sidoarjo, Sidoarjo Regency, East Java 61214';
        $venue->file_image = 'venue3.jpg';
        $venue->save();
    }
}
