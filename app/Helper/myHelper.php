<?php

use App\Models\Ticket;

function makeMessages(){

    $messages = [
        'correo.required' => '- Debe ingresar su correo electrónico para iniciar sesión.',
        'correo.email' => '- Usuario no registrado o contraseña incorrecta.',
        'contrasena.required' => '- Debe ingresar su contraseña para iniciar sesión.',
        'document.required' => 'El campo archivo es requerido.',
        'document.mimes' => 'El archivo seleccionado no es Excel con extensión .xlsx.',
        'document.max' => 'El tamaño máximo del archivo a cargar no puede superar los 5 megabytes.',

        'seat.required' => '- Debe seleccionar un asiento.',
        'total.required' => '- Debe ingresar el total a pagar.',
        'date.required' => '- Debe ingresar la fecha de viaje.',
        'date.date' => '- Debe ingresar una fecha válida.',
        'date1.required' => '- Debe ingresar la fecha de inicio de la consulta.',
        'date1.date' => '- Debe ingresar una fecha válida.',
        'date2.required' => '- Debe ingresar la fecha de término de la consulta.',
        'date2.date' => '- Debe ingresar una fecha válida.',
    ];
    return $messages;
}

function generateReservationNumber(){
    do{
        $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $letters = '';
        for ($i=0   ; $i < 4; $i++) {
            $letters .= $characters[rand(0, $charactersLength - 1)];
        }
        $numbers = mt_rand(10,99);
        $code = $letters.$numbers;
        $response = Ticket::where('code',$code)->first();
    }while($response);

    return $code;
}

function validDate ($date){
    $currentDate = date('d-m-Y');
    $dateForValidation = Carbon::parse($date);

    if($dateForValidation->lessThan($currentDate)){
        return true;
    }
    return false;
}
