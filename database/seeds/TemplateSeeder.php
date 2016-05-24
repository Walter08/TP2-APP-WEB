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
        //php artisan migrate:refresh --seed
        Template::create([
            'titulo' => 'Invitacion a cumpleaños',
            'cuerpo' => 'Te invito a mi cumple el dia {{fecha}} en {{lugar}} a las {{hora}} hs. {{nombre}}',
            'categoria' => 'Invitacion'
        ]);

        Template::create([
            'titulo' => 'Invitacion a casamiento',
            'cuerpo' => 'Te invito a mi casamiento el dia {{fecha}} en {{lugar}} a las {{hora}} hs. {{nombre}}',
            'categoria' => 'Invitacion'
        ]);

        Template::create([
            'titulo' 	=>	'Solitud de reincorporacion',
            'cuerpo'	=>	'<fecha> <lugar> Sres Facultad de Ingenieria\n\t Solicito a ustedes la
             reincoporacion a la carrera de Licenciatura en Sistemas.\n Sin mas, los saludo atentamente.\n\t <Nombre>',
            'categoria'	=>	'Solicitud'
        ]);
        
        Template::create([
            'titulo' => 'Reclamo por insatisfaccion',
            'cuerpo' => '<empresa-a-quien-se-reclama> <domicilio> <fecha> <persona-a-quien-va-dirigida> <cargo-que-ocupa>
            Por medio de la siguiente carta de reclamo, quisiera hacer contar mi insatisfaccion con respecto <motivo>. Sin otro
            cometido, se despide atentamente <nombre-de-quien-reclama>',
            'categoria' => 'Reclamo'
        ]);
    }
}
