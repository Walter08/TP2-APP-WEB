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
            'titulo' => 'Invitación a cumpleaños',
            'cuerpo' => 'Te invito a mi cumple el dia {{fecha}} en {{lugar}} a las {{hora}}. {{nombre}}',
            'categoria' => 'Invitacion',
            'tags' => 'cumpleaños,invitacion,evento,fiesta'
        ]);

        Template::create([
            'titulo' => 'Invitación a casamiento',
            'cuerpo' => 'Te invito a mi casamiento el día {{fecha}} en {{lugar}} a las {{hora}}. {{nombre}}',
            'categoria' => 'Invitacion',
            'tags' => 'casamiento,invitacion,evento,fiesta'
        ]);

        Template::create([
            'titulo' => 'Invitación a mi fiesta',
            'cuerpo' => 'Te invito a mi joda el día {{fecha}} en {{lugar}} a las {{hora}}. {{nombre}}',
            'categoria' => 'Invitacion',
            'tags' => 'invitacion,evento,fiesta'
        ]);

        Template::create([
            'titulo' => 'Invitación al bautismo de mi hijo/a',
            'cuerpo' => 'El bautismo se realizará el día {{fecha}} en {{lugar}} a las {{hora}}. Te esperamos! {{nombre}}',
            'categoria' => 'Invitacion',
            'tags' => 'invitacion,evento,bautismo'
        ]);

        Template::create([
            'titulo' => 'Invitación a despedida de soltero',
            'cuerpo' => 'Te espero en mi último día... de soltero =)! Será el día {{fecha}} en {{lugar}} a las {{hora}}. No faltes! {{nombre}}',
            'categoria' => 'Invitacion',
            'tags' => 'invitacion,evento,despedida de soltero, fiesta'
        ]);

        Template::create([
            'titulo' 	=>	'Solitud de reincorporación',
            'cuerpo'	=>	'{{fecha}} {{lugar}} Sres Facultad de Ingeniería\n\t Solicito a ustedes la
             reincoporación a la carrera de Licenciatura en Sistemas.\n Sin más, los saludo atentamente.\n\t {{Nombre}}',
            'categoria'	=>	'Solicitud',
            'tags' => 'solicitud,pedido,facultad,reincoporacion'
        ]);
        
        Template::create([
            'titulo' => 'Reclamo por insatisfacción',
            'cuerpo' => '{{empresa}} {{domicilio}} {{fecha}} {{persona}} {{cargo}}
            Por medio de la siguiente carta de reclamo, quisiera hacer contar mi insatisfacción con respecto {{motivo}}. Sin otro
            cometido, se despide atentamente {{nombre}}',
            'categoria' => 'Reclamo',
            'tags' => 'reclamo,insatisfaccion,descargo'
        ]);

        Template::create([
            'titulo' => 'Felicitaciones por finalización de carrera',
            'cuerpo' => 'Quiero feicitarte por haberte recibido de la carrera {{carrera}}! Muchas felicidades, se despide atentamente {{nombre}}',
            'categoria' => 'Felicitaciones',
            'tags' => 'felicidades,felicitar'
        ]);
    }
}
