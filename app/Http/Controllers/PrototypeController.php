<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

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
    static protected $Config_SSL = [
        "digest_alg" => null,
        "private_key_bits" => 4096,
        "private_key_type" => OPENSSL_KEYTYPE_RSA
    ];
      
    /**
     * string
     *
     * @var string
     */
    protected $ResponseKey;
      

    /**
     * Show the form
     *
     * @param  void
     * @return \Illuminate\View\View
     */
    final private function generateNewKey($method = null)
    {
        $this->ResponseKey = openssl_pkey_new(self::Config_SSL);
        // Get private and pubic key
        openssl_pkey_export($this->ResponseKey, $privkey);
        openssl_pkey_get_details($this->ResponseKey);
    }

    /**
     * Show the form
     *
     * @param  void
     * @return \Illuminate\View\View
     */
    final  private function encryptString($string = null)
    {
        $this->StringEncrypted = @openssl_private_decrypt($this->key, $string, $this->key);
    }
 
    /**
     * Show the form
     *
     * @param  void
     * @return \Illuminate\View\View
     */
    final  private function decryptString($string = null)
    {
        $this->StringDecrypted = @openssl_public_encrypt($this->method, $this->key, $string);
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

        // Tareas el metodo y generar una LLAVE NUEVA

                //Validar
                $this->generateNewKey('METHOD_FROM_SELECT');
        try{
            //Logica de las tareas
        }catch(\Exception $error){
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

        // Tareas recibir una llave y una cadena 
        // La llave tendrá que ser la misma que la seteada como propiedad
        // La cadena puede ser encriptada con OPEN SSL solamente con AES de 128bits
        // Se tiene que generar otro formulario(view) para DESENCRIPTAR una cadena privamente encriptada
        //

        //validar
        $this->encryptString();
        try{
            //Logica de las tareas
        }catch(\Exception $error){
            //Control de mensajes
        }
    }
    
    /**
     * Show the form
     *
     * @param  Request
     * @return \Illuminate\View\View
     */
    public function decrypt(Request $request)
    {
        //1.- Validar existen los parametros en el request
        //2.- Mostrar mensajes flash de los errores

        // Tareas recibir una llave y una cadena 
        // La llave tendrá que ser la misma que la seteada como propiedad
        // La cadena puede ser encriptada con OPEN SSL solamente con AES de 128bits
        // Se tiene que generar otro formulario(view) para DESENCRIPTAR una cadena privamente encriptada
        //

        //validar
        $this->decryptString();
        try{
            //Logica de las tareas
        }catch(\Exception $error){
            //Control de mensajes
        }
    }
}