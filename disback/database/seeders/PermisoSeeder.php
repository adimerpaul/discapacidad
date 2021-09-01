<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermisoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('permisos')->insert([
            ["nombre"=>'Importar'],
            ["nombre"=>'Usuarios'],
            ["nombre"=>'Pago'],
            ["nombre"=>'Pagos Realizados'],
            ["nombre"=>'Pagos Faltantes'],
            ["nombre"=>'Mis Pagos'],
         ]);
    }
}
