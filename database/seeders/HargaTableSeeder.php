<?php

namespace Database\Seeders;
use App\Models\Harga;
use Illuminate\Database\Seeder;

class HargaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $hargas = array(
            [
                'nama_customer' => 'arip',
                'alamat_customer' => 'bandung',
                'alamat_penerima' => 'garut',
                'telepon_customer' => '082118114645',
                'harga' => '100000'
                
            ],
            [
                'nama_customer' => 'yudi',
                'alamat_customer' => 'bandung',
                'alamat_penerima' => 'garut',
                'telepon_customer' => '082118114645',
                'harga' => '100000'
            ]
        );

        array_map(function (array $harga) {
            Harga::query()->updateOrCreate(
                $harga
            );
        }, $hargas);
    }
}
