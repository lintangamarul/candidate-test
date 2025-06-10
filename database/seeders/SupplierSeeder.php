<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class SupplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = Carbon::now();

        DB::table('suppliers')->insert([
            [
                'id' => 1,
                'name' => 'Sodra',
                'material_type' => 'clt',
                'quantity' => 76,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id' => 2,
                'name' => 'KLH',
                'material_type' => 'clt',
                'quantity' => 54,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id' => 3,
                'name' => 'XLam',
                'material_type' => 'clt',
                'quantity' => 51,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id' => 4,
                'name' => 'Kalvasta Timber',
                'material_type' => 'glt',
                'quantity' => 43,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id' => 5,
                'name' => 'Timberlink',
                'material_type' => 'glt',
                'quantity' => 66,
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ]);
    }
}