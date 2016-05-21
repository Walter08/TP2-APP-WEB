<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Template;
use Anouar\Fpdf\Facades\Fpdf;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesResources;

class TemplateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        //
        // $template = Template::where('id', $id)->get();
        // // $cuerpo_template = Template::where('id', $id)->get('cuerpo');
        // // $cuerpo = explode('</^([a-z]-?){1,}>', $cuerpo_template->cuerpo);
        // return view('plantillas.usarTemplate', ['template' => $template]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    
    /**
    * Funcion para listar los plantillas que pertenezcan
    * a la categoria Invitacion
    */
    public function invitaciones()
    {
        $titulo = 'Listado de Invitaciones';
        $resultados = Template::where('categoria', 'Invitacion')->paginate(4);

        //return view('plantillas.invitaciones.listado', ['invitaciones' => $invitaciones]);
        return view('plantillas.listadoCategoria', ['titulo' => $titulo,'resultados' => $resultados]);
    }
    
    /**
    * Funcion para listar los plantillas que pertenezcan
    * a la categoria Reclamo
    */
    public function reclamos()
    {
        $titulo = 'Listado de Reclamos';
        $resultados = Template::where('categoria', 'Reclamo')->paginate(4);

        return view('plantillas.listadoCategoria', ['titulo' => $titulo,'resultados' => $resultados]);
    }
    
    /**
    * Funcion para listar los plantillas que pertenezcan
    * a la categoria Solicitud
    */
    public function solicitudes()
    {
        $titulo = 'Listado de Solicitudes';
        $resultados = Template::where('categoria', 'Solicitud')->paginate(4);

        return view('plantillas.listadoCategoria', ['titulo' => $titulo,'resultados' => $resultados]);
    }
    
    /**
    * Funcion para listar los plantillas que pertenezcan
    * a la categoria Felicitacion
    */
    public function felicitaciones()
    {
        $titulo = 'Listado de Felicitaciones';
        $resultados = Template::where('categoria', 'Felicitacion')->paginate(4);

        return view('plantillas.listadoCategoria', ['titulo' => $titulo,'resultados' => $resultados]);
    }

    public function getTemplate(Request $request, $id)
    {
        if ($request->isMethod("post")){
            
            $nombre = $request->input('nombre');
            $fecha = $request->input('fecha');
            $lugar = $request->input('lugar');
            $hora = $request->input('hora');
            
            $template = Template::find($id);
            
             if (!is_null($template)){

                $resultado = str_replace ( "{{nombre}}", $nombre, $template['cuerpo']);
                $resultado = str_replace ( "{{fecha}}", $fecha, $resultado);
                $resultado = str_replace ( "{{lugar}}", $lugar, $resultado);
                $resultado = str_replace ( "{{hora}}", $hora, $resultado);

                Fpdf::AddPage();
                Fpdf::SetFont('Arial','B',15);
                // Movernos a la derecha
                Fpdf::Cell(80);
                // Título
                Fpdf::Cell(30,10,utf8_decode($template['titulo']),0,0,'C');
                // Salto de línea
                Fpdf::Ln(20);
                Fpdf::SetFont('Arial','B',12);
                Fpdf::Multicell(0,8, utf8_decode($resultado));
                Fpdf::Output();
                exit;

            }
            else {
                return response('Plantilla no encontrada', 404);
            }


        }else{
            
            $inputNombre = "<input type=\"text\" name=\"nombre\" value=\"Nombre\">";
            $inputFecha = "<input type=\"text\" name=\"fecha\" value=\"Fecha del evento\">";
            $inputLugar = "<input type=\"text\" name=\"lugar\" value=\"Lugar del evento\">";
            $inputHora = "<input type=\"text\" name=\"hora\" value=\"Hora del evento\">";

            $template = Template::find($id);

            if (!is_null($template)){

                $resultado = str_replace ( "{{nombre}}", $inputNombre, $template['cuerpo']);
                $resultado = str_replace ( "{{fecha}}", $inputFecha, $resultado);
                $resultado = str_replace ( "{{lugar}}", $inputLugar, $resultado);
                $resultado = str_replace ( "{{hora}}", $inputHora, $resultado);

                return View ('plantillas.template', ['texto' => $resultado]);
            }

            else {

                return response('Plantilla no encontrada', 404);
            }
        }

    }
}
