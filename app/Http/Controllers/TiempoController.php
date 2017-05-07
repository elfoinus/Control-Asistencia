<?php


namespace App\Http\Controllers;


use Carbon\Carbon; 


class Tiempo {


	private $dia,$fecha,$hora;


	


	public function __construct(){
		
		date_default_timezone_set('America/Bogota'); //Asignas la zona horaria de tu país.
		setlocale(LC_TIME, 'spanish'); //Fijamos el tiempo local
		
		$dia=strftime("%A"); // Guardamos el Nombre del día de la semana.
		#$dia = 'miercoles' // dia en español
		$this->dia = strtoupper($dia); // lo vuelve mayuscula

		$dt = Carbon::now('America/Bogota');
		#$dt = Carbon::create(2017, 2, 10, 13); #año - mes - dia - hora formato militar

		$this->fecha = $dt->toDateString();
		$this->hora = $dt->toTimeString();


	}

	public function get_dia(){

		return $this->dia;
	}

	public function get_fecha(){
		return $this->fecha;
	}

	public function get_hora(){
		return $this->hora;
	}


}