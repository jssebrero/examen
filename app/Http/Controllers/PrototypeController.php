<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;


    define('METHOD','AES-128-CBC');
	//define('SECRET_KEY','$SIMMS@2019'); este sera para ventas 
	//define('SECRET_KEY','$SIMMS980521');
	define('SECRET_IV','020500');
class PrototypeController extends Controller
{
     /**
     * Llave base
     *
     * @var string
     */
    private $key = null;
    
    /**
     * string
     *
     * @var string
     */
    private $StringEncrypted = null;
    
    /**
     * string
     *
     * @var string
     */
    private $StringDecrypted = null;
   
    /**
     * string
     *
     * @var string
     */
    private $Config_SSL = [
        "digest_alg" => "",
        "private_key_bits" => 4096,
        "private_key_type" => OPENSSL_KEYTYPE_RSA
    ];
      
    /**
     * string
     *
     * @var string
     */
    private $ResponseKey;
      

    private $keyPublic;

    /**
     * Show the form
     *
     * @param  void
     * @return \Illuminate\View\View
     */

     
    final  private function generateNewKey($method = null)
    {
        
        $this->Config_SSL['digest_alg'] = $method;
        $this->ResponseKey = openssl_pkey_new($this->Config_SSL);

        openssl_pkey_export($this->ResponseKey, $privKey);
        $this->key =$privKey;

        $this->keyPublic = openssl_pkey_get_details($this->ResponseKey);
        $this->keyPublic = $this->keyPublic["key"];
       
        
    }

    /**
     * Show the form
     *
     * @param  void
     * @return \Illuminate\View\View
     */
    final  private function encryptString($string = null)
    {     
            $keyVa =  $this->key;
			$iv=substr(hash('sha256', SECRET_IV), 0, 16);
			$output=openssl_encrypt($string, METHOD, $keyVa, 0, $iv);
			$output=base64_encode($output);
            $this->StringEncrypted = $output;
            if(session()->exists('Decrypyt')) {
                session()->forget('Decrypyt');
            }
            
            
            
    }
 
    /**
     * Show the form
     *
     * @param  void
     * @return \Illuminate\View\View
     */
    final  private function decryptString($string = null)
    {
            
            $keyVa =  $this->key;
			$iv=substr(hash('sha256', SECRET_IV), 0, 16);
			$output=openssl_decrypt(base64_decode($string), METHOD, $keyVa, 0, $iv);
            $this->StringDecrypted = $output;
          
			
    }
   
    /**
     * Show the form
     *
     * @param  void
     * @return \Illuminate\View\View
     */
     public function index()
     {
         return view('prototype.index');
     }

    /**
     * Show the form
     *
     * @param  void
     * @return \Illuminate\View\View
     */
    public function generateKey(Request $request)
    {
        //1.- Validar existen los parametros en el request
         //2.- Mostrar mensajes flash de los errores
        $validator = Validator::make($request->all(), [
            'method' => 'required', 
            
        ]);

        if ($validator->fails()) {
            session::flash('ErrorGenerate','Error en el select');
            return redirect('/inicio')
                        ->withErrors($validator)
                        ->withInput();
                        
        }
        // Tareas el metodo y generar una LLAVE NUEVA

        $method = $request->method;
        try{
        
            $this->generateNewKey($method);
            
            session(['key' => $this->keyPublic]);
            //session(['KeyPublic' => $this->keyPublic]);
            session(['comentario' => 'Tiene 1 minuto para realizar pruebas de encriptacion y decriptacion']);
            return redirect('/inicio');
            
        }catch(Exception $error){
            session::flash('ErrorGenerate','Aqui hubo un error em la encriptación');
            return redirect('/inicio');
            //Control de mensajes
        }
    }

    
    /**
     * Show the form
     *
     * @param  Request
     * @return \Illuminate\View\View
     */
    public function encrypt(Request $request)
    {


        //1.- Validar existen los parametros en el request
        //2.- Mostrar mensajes flash de los errores

        $validator = Validator::make($request->all(), [
            'keyEncript' => 'required',
            'encript' => 'required', 
            
        ]);

        if ($validator->fails()) {
            session::flash('ErrorEncript','Error en las entradas de encriptación-Campos no pueden ir vacios');
            return redirect('/inicio')
                        ->withErrors($validator)
                        ->withInput();
                        
        }

        // Tareas recibir una llave y una cadena
        $keyReceived = $request->keyEncript;
        $encript = $request->encript;
        $this->key = session('key');
        $this->key = trim($this->key);
        $keyReceived = trim($keyReceived);
       
            
        
        
            if($keyReceived == $this->key){

            }
            else{
                session::flash('ErrorEncript','Error');
                $this->encryptString($encript);
                session(['stringEncript' => $this->StringEncrypted]);
            
            }
                
        try{
            
            //Logica de las tareas
            
        }catch(Exception $error){
            //Control de mensajes
            echo 'Excepción capturada: ',  $e->getMessage(), "\n";
        }
            return redirect('/inicio');
        
        
        
        // La cadena puede ser encriptada con OPEN SSL solamente con AES de 128bits
        // Se tiene que generar otro formulario(view) para DESENCRIPTAR una cadena privamente encriptada
        //

        //validar
        
    }
    
    /**
     * Show the form
     *
     * @param  Request
     * @return \Illuminate\View\View
     */
    public function decrypt(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'keyE' => 'required',
            'encriptEd' => 'required', 
            
        ]);

        if ($validator->fails()) {
            session::flash('ErrorDencrypt','Error en las entradas de desencriptación-Campos no pueden ir vacios');
            return redirect('/inicio')
                        ->withErrors($validator)
                        ->withInput();
                        
        }
        
        //1.- Validar existen los parametros en el request
        //2.- Mostrar mensajes flash de los errores

        // Tareas recibir una llave y una cadena 
        // La llave tendrá que ser la misma que la seteada como propiedad
        // La cadena puede ser encriptada con OPEN SSL solamente con AES de 128bits
        // Se tiene que generar otro formulario(view) para DESENCRIPTAR una cadena privamente encriptada
        //

        //validar
        
        try{
            $this->key = session('key');
            $this->key = trim($this->key);
            $decrypt = $request->encriptEd;
            $this->decryptString($decrypt);
            session(['Decrypyt'=> $this->StringDecrypted]);
        
            //Logica de las tareas
        }catch(\Exception $error){
            //Control de mensajes
        }
        return redirect('/inicio');
    }
}