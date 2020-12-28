<?php
//include_once '../../lib/db.php';
//include_once('config.php');

class DB2{
    private $host;
    private $db;
    private $user;
    private $password;
    private $charset;

    public function __construct(){
        $this->host     = 'localhost';
        $this->db       = 'Services_Dunkin';
        $this->user     = 'root';
        $this->password = '';
        $this->charset  = 'utf8mb4';
    }

    //mysql -e "USE todolistdb; select*from todolist" --user=azure --password=6#vWHD_$ --port=49175 --bind-address=52.176.6.0
 
    function connect(){
    
        try{

            $connection = "mysql:host=".$this->host.";dbname=" . $this->db . ";charset=" . $this->charset;
            $options = [
                PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_EMULATE_PREPARES   => false,
            ];
            $pdo = new PDO($connection, $this->user, $this->password, $options);
            //$pdo = new PDO($connection,$this->user,$this->password);
            return $pdo;


        }catch(PDOException $e){
            print_r('Error connection: ' . $e->getMessage());
        }   
    }
}





class Productos extends DB2{

    function __construct(){
        parent::__construct();
    }

    public function get($id){
        $query = $this->connect()->prepare('SELECT * FROM producto WHERE id = :id LIMIT 0,12');
        $query->execute(['id' => $id]);

        $row = $query->fetch();

        return [
            'id'         => $row['id'],
            'cod_promocion'=> $row['cod_promocion'],
            'monto'      => $row['monto'],
            'estado'     => $row['estado'],
            'orden_compra' => $row['orden_compra'],
        ];
    }

    public function getItemsByMonto($monto){
        $query = $this->connect()->prepare('SELECT * FROM producto WHERE monto = :mon');
        $query->execute(['mon' => $monto]);

        $items = [];

        while($row = $query->fetch(PDO::FETCH_ASSOC)){

            $item =[
                'id'              => $row['id'],
                'cod_promocion'   => $row['cod_promocion'],
                'monto'           => $row['monto'],
                'estado'          => $row['estado'],
                'orden_compra' => $row['orden_compra'],
            ];

            array_push($items, $item);
        } 
        return $items;
    }



    
    public function getCardByMontoCantidad($monto,$estado,$cantidad){
        $query = $this->connect()->prepare('SELECT * FROM producto WHERE monto =:mon AND estado =:estado LIMIT :cantidad');
        $query->execute(['mon' => $monto,
                        'estado' => $estado,
                        'cantidad' => $cantidad]);

        $items = [];

        while($row = $query->fetch(PDO::FETCH_ASSOC)){

            $item =[
                'id'              => $row['id'],
                'cod_promocion'   => $row['cod_promocion'],
                'monto'           => $row['monto'],
                'estado'          => $row['estado'],
                'orden_compra'    => $row['orden_compra'],
            ];

            array_push($items, $item);
        } 
        return $items;
    }






    public function UpdateProducto($id,$orden_compra,$estado){
        $query = $this->connect()->prepare('UPDATE producto SET orden_compra = :orden_compra, estado = :estado WHERE id = :id');
        $query->execute(['id' => $id,
                        'orden_compra' => $orden_compra,
                        'estado' => $estado]);

    
    }



}

?>