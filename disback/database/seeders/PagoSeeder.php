<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PagoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('pagos')->insert([
            [
                "nro"=>"123",
                "exp"=>"LPZ",
                "razon"=>"JUAN"
            ],
            [
                "nro"=>"123",
                "exp"=>"LPZ",
                "razon"=>"JUAN"
            ],
            [
                "nro"=>"123",
                "exp"=>"LPZ",
                "razon"=>"JUAN"
            ],
            [
                "nro"=>"987",
                "exp"=>"ORU",
                "razon"=>"MARIA"
            ],
            [
                "nro"=>"987",
                "exp"=>"ORU",
                "razon"=>"MARIA"
            ],

            [
                "nro"=>"987",
                "exp"=>"ORU",
                "razon"=>"MARIA"
            ]
         ]);
    }
}
