<?php

namespace App\Http\Controllers;


use App\Usuarios;


class LoginController extends Controller{


	public function validarUsuario(){


		$usuarioIngresado = $_POST['usuario'];
		$passwordIngresada = $_POST['password'];



		$usuario = Usuarios::where('Numero_cedula', $usuarioIngresado)->first();

		if($usuario == null){

			return view('login')->with('mensaje', 'Usario No Registrado');

		}


		if($usuario->password === $passwordIngresada){

			
			return $this->getViewSegunPerfil($usuario);
			
		}


	}


	private function getViewSegunPerfil($usuario){

		switch ($usuario->id_perfil) {
			

			case 0:

				return view('PrincipalAdministrador',compact('usuario')) ->with('mensaje', 'Administrador - ' . $usuario->nombre);

				break;

			case 1:
			
				return view('PrincipalCoordinador',compact('usuario'))->with('mensaje', 'Coordinador - ' . $usuario->nombre);
			
				break;

			case 2:
				// guarda cedula y nombre en variables de sesion
				$cedula = $usuario->Numero_cedula;
				$nombre = $usuario->nombre;
				session(['id' => $cedula]);
				session(['nombre' => $nombre]);
		
				return view('PrincipalProfesor');

				break;

			
			default:
				return view('login')->with('mensaje', 'Error, perfil no definido');
				break;
		}

	}


	

}



