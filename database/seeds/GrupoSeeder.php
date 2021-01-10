<?php

use Illuminate\Database\Seeder;
use App\Grupo;

class GrupoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $grupo = [
            'grupo_id'      => 1,
            'grupo_nome'    => 'Administradores'
        ];

        if (!Grupo::find($grupo['grupo_id'])) {
            Grupo::create($grupo);
        }
    }
}
