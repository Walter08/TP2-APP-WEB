<?php

use Illuminate\Database\Seeder;
use App\Template;

class TemplateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        for ($i=0; $i<2; $i++){
            Template::create([
                'titulo' 				=>	'Invitacion a cumpleaños'.$i,
                'cuerpo'				=>	'Te invito a mi cumple el dia <tanto> a las <tanto> hs'.$i,
                'categoria'			=>	'Invitacion'
            ]);
        }
    }
}
