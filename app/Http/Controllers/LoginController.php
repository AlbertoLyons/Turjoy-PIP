<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function index(){
        return view('auth.login');
    }

    // Función privada para crear mensajes personalizados
    private function makeMessages(){
        return [
            'correo.required' => 'El campo correo es obligatorio',
            'correo.email' => 'Debe ingresar un correo válido',
            'contrasena.required' => 'El campo contraseña es obligatorio'
        ];
    }

    public function store (Request $request){
        //Validar información recolectada
        $messages = $this->makeMessages();

        $this->validate($request,[
            'correo'=> ['required','email'],
            'contrasena'=> ['required']
        ], $messages);

        if (!auth()->attempt(['email'=>$request->correo, 'password'=>$request->contrasena])){
            return back()->with('message','- Usuario no registrado o contraseña incorrecta.');
        }
        return redirect()->route('report');
    }
}