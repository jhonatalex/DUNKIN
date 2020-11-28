<?php
include_once '../lib/db.php';

class Usuario extends DB{   

    function __construct(){
        parent::__construct();
    }

    public function  insertUser($email,$nombre,$telefono){
        $query = $this->connect()->prepare("INSERT INTO usuario (email,nombre,telefono) VALUES (:email, :nombre, :telefono)");
        $query->execute(['email' => $email,
                         'nombre' => $nombre,
                         'telefono' => $telefono,]);  

    }





    public function duplicacion($email,$nombre){
       
        $query = $this->connect()->prepare("SELECT  email, nombre FROM usuario WHERE email=? OR nombre=?");
        $query->execute(array($email,$nombre));  
       
        return $query->fetch();

       
      
    }

    
    


 
}

?>