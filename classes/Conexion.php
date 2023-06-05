<?php

class Conexion {
//Conecta a base de datos

//recibe: nombre base de datos

public static function ConectarDB()
{    
  $db = "aico_militantes";
  $db = "u742336856_militantes";  
   if (!($conexion=mysqli_connect("localhost","u742336856_militantes","AS36%#&fñsaga!%/(%&F")))
  // if (!($conexion=mysqli_connect("localhost","root","mysql13*"))) 	   
   { 

      echo "Error conectando!!! <br>a la base de datos."; 

      exit(); 

   } 

   if (!mysqli_select_db($conexion,$db)) 

   { 

     echo "Error seleccionando la base de datos " . $db . ""; 

      exit(); 

   } 

   //mysqli_query("SET NAMES 'utf8'");
   $conexion->query("SET NAMES 'utf8'");

   return $conexion; 

}

   /*
     * @Descripcion
     * Ejecuta la cosulta sql y devuelve un array de objetos segun los 
     * parametros que muestre la consulta
     */

	public static function Ejecutar($sql) {
	   $db=self::ConectarDB();
        mysqli_query("SET NAMES 'UTF8'");
    	mysqli_query($db,$sql);      
		mysqli_close($db); 		
    }
	
   public static function EjecutarSQL($sql) {
   	  	$db=self::ConectarDB();
        mysqli_query("SET NAMES 'UTF8'");
    	$rs=mysqli_query($db,$sql);
		mysqli_close($db); 
        return $rs;
    }

    /*
     * @Descripcion
     * Ejecuta la cosulta sql y devuelve un array de objetos segun los 
     * parametros que muestre la consulta
     */

    public static function EjecutarDB($sql) {
	     $db=self::ConectarDB();
         mysqli_query("SET NAMES 'UTF8'");
         $rs=mysqli_query($db,$sql);;
        $row=mysqli_fetch_array($rs);
		mysqli_free_result($rs); 
		mysqli_close($db); 
        return $row;
    }
	
	public static function InsertarDB($sql) {
	    $db=self::ConectarDB();
         mysqli_query("SET NAMES 'UTF8'");
         $rs=mysqli_query($db,$sql);;
        $id=mysqli_insert_id($db);
		mysqli_free_result($rs); 
		mysqli_close($db); 
        return $id;
    }
	
	 /*
     * @Descripcion
     * Ejecuta la cosulta sql y devuelve un array de objetos segun los 
     * parametros que muestre la consulta
     */

    public static function EjecutarArray($sql) {
	    $db=self::ConectarDB();
		$array = Array();
         mysqli_query("SET NAMES 'UTF8'");
    	 $rs=mysqli_query($db,$sql);;
		while($row=mysqli_fetch_array($rs)){
           array_push($array, $row);
        }     
		mysqli_free_result($rs); 
		mysqli_close($db); 
        return $array;
    }
	
	public static function ConsultarID() {
	 	$db=self::ConectarDB();
        $id=mysqli_insert_id($db);
		mysqli_close($db); 
        return $id;
    }
}
?>