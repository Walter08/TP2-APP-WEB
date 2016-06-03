<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesResources;
use Illuminate\Http\Request;
use App\Template;
use Anouar\Fpdf\Facades\Fpdf;
use Session;
use App\Nota;
use Redirect;
use Auth;


class TemplateController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    /**
     * Display a listing of the resource.
     * Funcion para buscar y devolver los templates
     * que tengan algun tag que coincida con el de busqueda
     * Resuelvo la busqueda
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        //dd($request->input('descripcion'));
        $descripcion = $request->input('descripcion');
        $titulo = 'Sugerencias de Plantillas';

        $templates = Template::all();
        $resultados = collect([]);

        foreach ($templates as $template) {
            $tags = explode(',', $template['tags']);
            if (in_array($descripcion, $tags)) {
                $resultados->push($template);
            };
        };
        return view('plantillas.resultadosBusqueda', ['titulo' => $titulo,'resultados' => $resultados]);
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
        if ($request->isMethod("post")){
            
            $id = $request->input("id");
                
            $template = Template::find($id);
            
            if (!is_null($template)){

                preg_match_all('/\{\{([a-zA-Z0-9]+)\}\}/', $template['cuerpo'], $coincidencias);
                $resultado = $template['cuerpo'];
                $data = '';

                for ($i = 0; $i < count($coincidencias[0]); $i++) {
                    $aux = $request->input($coincidencias[1][$i]);
                    $resultado = str_replace ($coincidencias[0][$i], $aux, $resultado);
                    $data = $data.$coincidencias[0][$i].'='.$aux.',';
                }
                    
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
                $cod = date('Y-m-d') . '_' . date('B');
                $user = Auth::user()->name;
                $nombre = $user.'_template_'.$cod.'.pdf';
                $ruta = 'pdfs/'.$nombre;
                Fpdf::Output($ruta);

                $nota = new Nota();
                $nota->templates_id = $id;
                $nota->user_id = Auth::user()->id;
                $nota->data = $data;
                $nota->pdf = $nombre;
                $nota->save();
                     
                return Redirect::to('/home')->with('msj', 'El PDF se ha guardado correctamente');
    
            } else {
                
                return Redirect::to('/home')->with('msj', 'Ha ocurrido un problema al guardar el pdf');
            }
            
        } else {
            
            return Redirect::to('/home')->with('msj', 'Ha ocurrido un problema al guardar el pdf');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
    
    public function getNotas(){
        $user = Auth::user()->id;
        $notas = Nota::where('user_id', $user)->get();
        return View ('plantillas.notas', ['notas' => $notas]);
    }
    
    public function imprimirPDF($id){
        
        $nota = Nota::find($id);
        if (!is_null($nota)){ 
            $ruta = 'pdfs/'.$nota['pdf'];
            header('Content-type: application/pdf'); 
            header('Content-Disposition: inline; filename="'.$nota['pdf'].'"'); 
            readfile($ruta);  
            exit;
        } 
        else {
            return Redirect::to('/home')->with('msj', 'Ha ocurrido un problema recuperar la nota');
        }
    }
    
    public function getTemplate(Request $request, $id)
    {
        if ($request->isMethod("post")){
            
            $template = Template::find($id);
            
             if (!is_null($template)){
                     
                preg_match_all('/\{\{([a-zA-Z0-9]+)\}\}/', $template['cuerpo'], $coincidencias);
                $resultado = $template['cuerpo'];
                     
                for ($i = 0; $i < count($coincidencias[0]); $i++) {
                    $aux = $request->input($coincidencias[1][$i]);
                    $resultado = str_replace ($coincidencias[0][$i], $aux, $resultado);
                }


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


        } else {
            
            $template = Template::find($id);

            if (!is_null($template)){

                preg_match_all('/\{\{([a-zA-Z0-9]+)\}\}/', $template['cuerpo'], $coincidencias);
                $resultado = $template['cuerpo'];
                for ($i = 0; $i < count($coincidencias[0]); $i++) {
                    $input = "<input id=\"".$coincidencias[1][$i]."\" type=\"text\" name=\"".$coincidencias[1][$i]."\" value=\"".$coincidencias[1][$i]."\">";
                    $resultado = str_replace ($coincidencias[0][$i], $input, $resultado);
                }

                return View ('plantillas.template', ['texto' => $resultado, 'id' => $id]);
                

            }

            else {

                return response('Plantilla no encontrada', 404);
            }
        }

    }
}
