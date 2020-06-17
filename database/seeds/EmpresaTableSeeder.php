<?php

use Illuminate\Database\Seeder;

class EmpresaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = \Carbon\Carbon::now()->toDateTimeString();

        $empresas = [
            [
                'nombre' => 'ieSoluciones',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'nombre' => 'Tijera Dorada',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'nombre' => 'Caffetis',
                'created_at' => $now,
                'updated_at' => $now
            ]
        ];
        \App\Empresa::insert($empresas);
    }
}
