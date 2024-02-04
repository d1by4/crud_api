<?php

namespace Database\Seeders;

use App\Models\Buku;
use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class BukuSedeer extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create('id_ID');
        for ($i = 0; $i < 500; $i++) {
            Buku::create([
                'judul' => $faker->sentence,
                'pengarang' => $faker->name,
                'tanggal_publikasi' => $faker->date,
            ]);
        }
    }
}
