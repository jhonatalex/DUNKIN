<?php
include_once '../../lib/db.php';

class Productos extends DB{

    function __construct(){
        parent::__construct();
    }

    public function get($id){
        $query = $this->connect()->prepare('SELECT * FROM giftcard WHERE id = :id LIMIT 0,12');
        $query->execute(['id' => $id]);

        $row = $query->fetch();

        return [
            'id'         => $row['id'],
            'descripcion'=> $row['descripcion'],
            'monto'      => $row['monto'],
            'imagen'     => $row['imagen'],
            'estado'     => $row['estado'],
        ];
    }

    public function getItemsByMonto($monto){
        $query = $this->connect()->prepare('SELECT * FROM giftcard WHERE monto = :mon');
        $query->execute(['mon' => $monto]);

        $items = [];

        while($row = $query->fetch(PDO::FETCH_ASSOC)){

            $item =[
                'id'         => $row['id'],
                'descripcion'=> $row['descripcion'],
                'monto'      => $row['monto'],
                'imagen'     => $row['imagen'],
                'estado'     => $row['estado'],
            ];

            array_push($items, $item);
        } 
        return $items;
    }
}

?>