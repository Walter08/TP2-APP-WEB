<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use Mail;
use Session;
use Redirect;
use App\Nota;
use Auth;
use App\Template;
use Anouar\Fpdf\Facades\Fpdf;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesResources;
use App\Http\Controllers\Controller;


class MailController extends Controller
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
        
        if ($request->isMethod("post")){
            
            $destinatario = explode(';', $request->input("email"));
            $asunto = $request->input("asunto");
            $contenido = $request->input("contenido_mail");
            
            $id = $request->input("id");
            
            if ($destinatario != "") {
                
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
                    //$nombre = 'template.pdf';
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
                     
                    Mail::send('emails.contact',['data' => $contenido], function($msj) use($ruta, $destinatario, $asunto){
                        $msj->subject($asunto);
                        $ruta_pdf = 'public/'.$ruta;
                        for ($i = 0; $i < count($destinatario); $i++) {
                            $msj->to($destinatario[$i]);
                        }
                        $msj->attach($ruta, array('as' => 'plantilla', 'mime' => 'application/pdf'));
                    });
                     
                    return redirect('/home')->with('msj', '¡Bien hecho! El mensaje de correo se ha enviado correctamente!');
    

                }
                else {
                    return redirect('/home')->with('error', 'Plantilla no encontrada');
                }
            }
            
            else {
                return redirect('/home')->with('error', "El Correo no pudo ser Enviado");
            }
            
        
        } else {
            
            return redirect('/home')->with('error', 'Ha ocurrido un problema con el envio del mail');
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

    public function reenviar(Request $request){
        if ($request->isMethod("post")){
            $destinatario = $request->input("email");
            $asunto = $request->input("asunto");
            $contenido = $request->input("contenido_mail");

            $id = $request->input("id");

            if ($destinatario != ""){

                $nota = Nota::find($id);

                if (!is_null($nota)){
                    $ruta = 'pdfs/'.$nota['pdf'];            
                    Mail::send('emails.contact',['data' => $contenido], function($msj) use($ruta, $destinatario, $asunto){
                        $msj->subject($asunto);
                        $msj->to($destinatario);
                        $msj->attach($ruta, array('as' => 'plantilla', 'mime' => 'application/pdf'));
                    });
                     
                    return redirect('/home')->with('msj', '¡Bien hecho! El mensaje de correo se ha enviado correctamente!');
                }

                else {

                    return redirect('/home')->with('error', 'Ha ocurrido un problema con el envio del mail');
                }


            }

            else {
                return redirect('/home')->with('error', "El Correo no pudo ser Enviado");
            }
        }
        
        else {
            return redirect('/home')->with('error', 'Ha ocurrido un problema con el envio del mail');
        }
        
    }
}