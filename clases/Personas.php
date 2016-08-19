<?php
require_once"accesoDatos.php";

class Alumno
{
//--------------------------------------------------------------------------------//
//--ATRIBUTOS
	private $ID;
	private $Nombre;
 	private $Apellido;
	private $Legajo;

//--------------------------------------------------------------------------------//

//--------------------------------------------------------------------------------//
//--GETTERS Y SETTERS
  	public function GetId()
	{
		return $this->ID;
	}
	public function GetApellido()
	{
		return $this->Apellido;
	}
	public function GetNombre()
	{
		return $this->Nombre;
	}
	public function GetLegajo()
	{
		return $this->Legajo;
	}


	public function SetId($valor)
	{
		$this->ID = $valor;
	}
	public function SetApellido($valor)
	{
		$this->Apellido = $valor;
	}
	public function SetNombre($valor)
	{
		$this->Nombre = $valor;
	}
	public function SetLegajo($valor)
	{
		$this->Legajo = $valor;
	}

//--------------------------------------------------------------------------------//
//--CONSTRUCTOR
	public function __construct($dni=NULL)
	{
		if($dni != NULL){
			$obj = Persona::TraerUnaPersona($dni);
			
			$this->apellido = $obj->apellido;
			$this->nombre = $obj->nombre;
			$this->dni = $dni;
			$this->foto = $obj->foto;
		}
	}

//--------------------------------------------------------------------------------//
//--TOSTRING	
  	public function ToString()
	{
	  	return $this->apellido."-".$this->nombre."-".$this->legajo;
	}
//--------------------------------------------------------------------------------//

//--------------------------------------------------------------------------------//
//--METODO DE CLASE
	public static function TraerUnaPersona($idParametro) 
	{	


		$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
		$consulta =$objetoAccesoDato->RetornarConsulta("select * from alumnos where ID =:id");
		$consulta->bindValue(':id', $idParametro, PDO::PARAM_INT);
		$consulta->execute();
		$personaBuscada= $consulta->fetchObject('Alumno');
		return $personaBuscada;	
					
	}
	
	public static function TraerTodasLasPersonas()
	{
		$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
		$consulta =$objetoAccesoDato->RetornarConsulta("select * from alumnos");
		$consulta->execute();			
		$arrPersonas= $consulta->fetchAll(PDO::FETCH_CLASS, "Alumno");	
		return $arrPersonas;
	}
	
	public static function Borrar($idParametro)
	{	
		$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
		$consulta =$objetoAccesoDato->RetornarConsulta("delete from persona	WHERE id=:id");	
		$consulta->bindValue(':id',$idParametro, PDO::PARAM_INT);		
		$consulta->execute();
		return $consulta->rowCount();
		
	}
	
	public static function Modificar($persona)
	{
		echo '<pre>';
		print_r($persona);
		echo "</pre>";
			$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
			$consulta =$objetoAccesoDato->RetornarConsulta("
				update alumnos 
				set Nombre=:Nombre,
				Apellido=:Apellido
				WHERE ID=:ID");
			$consulta->bindValue(':ID',$persona->ID, PDO::PARAM_INT);
			$consulta->bindValue(':Nombre',$persona->Nombre, PDO::PARAM_STR);
			$consulta->bindValue(':Apellido', $persona->Apellido, PDO::PARAM_STR);
			//$consulta->bindValue(':foto', $persona->foto, PDO::PARAM_STR);
			return $consulta->execute();
	}

//--------------------------------------------------------------------------------//

//--------------------------------------------------------------------------------//

	public static function Insertar($persona)
	{
		$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
				$consulta =$objetoAccesoDato->RetornarConsulta("INSERT into alumnos (Nombre,Apellido,Legajo)values(:nombre,:apellido,:legajo)");
				$consulta->bindValue(':nombre',$persona->Nombre, PDO::PARAM_STR);
				$consulta->bindValue(':apellido', $persona->Apellido, PDO::PARAM_STR);
				$consulta->bindValue(':legajo', $persona->Legajo, PDO::PARAM_STR);
				//$consulta->bindValue(':foto', $persona->foto, PDO::PARAM_STR);
				//die($consulta);
				$consulta->execute();		
				return $objetoAccesoDato->RetornarUltimoIdInsertado();
	
				
	}	
//--------------------------------------------------------------------------------//

}