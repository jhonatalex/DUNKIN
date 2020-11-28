<?php
include_once '../lib/db.php';

class Destinatario extends DB{   

    function __construct(){
        parent::__construct();
    }


    public function  insertDestinatario($email,$nombre,$dedicatoria, $usuario){
        $query = $this->connect()->prepare("INSERT INTO destinatario (email, nombre, dedicatoria, usuario_email) VALUES (:email, :nombre, :dedicatoria, :usuario_email)");
        $query->execute(['email' => $email,
                         'nombre' => $nombre,
                         'dedicatoria' => $dedicatoria,
                         'usuario_email' => $usuario]);  

    }



}

?>