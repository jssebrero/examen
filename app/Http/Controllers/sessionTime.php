<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;





class sessionTime extends Controller
{
    private $time = null;

    
    public function __construct(){
        $this ->checkTime();
        $this->time();

    }

    public function checkTime(){

        if(session()->exists('tiempo')) {
            $this->time = session('tiempo');
        }
        else{
            session(['tiempo' => date("Y-n-j H:i:s")]);
        }
        
    }

    public function time(){
        $fechaGuardada = $this->time;
        $ahora = date("Y-n-j H:i:s");
        $tiempo_transcurrido = (strtotime($ahora)-strtotime($fechaGuardada));

        //comparamos el tiempo transcurrido
        if($tiempo_transcurrido >= 60) {
            //si pasaron 10 minutos o más
            session()->flush();
            session(['tiempo' => date("Y-n-j H:i:s")]);
        }else {
            //session()->forget('tiempo');
            session(['tiempo' => date("Y-n-j H:i:s")]);
        }   
    }
    //
}
