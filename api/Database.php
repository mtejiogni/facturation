<?php
class Database {
    private $db_dsn;
    private $db_user;
    private $db_password;

    public function __construct() {
        $this->db_dsn= "mysql:host=localhost;dbname=facturationdb;port=3306;charset=utf8";
        $this->db_user= "root";
        $this->db_password= "";
    }

    public static function clearData($data): string {
        return htmlspecialchars($data, ENT_XML1 | ENT_COMPAT, 'UTF-8');
    }

    public static function getMessageXML($status, $content): string {
        $xml= "<?xml version=\"1.0\" encoding=\"UTF-8\" standalone=\"yes\" ?>";
        $xml= $xml . "<message>";
        $xml= $xml . "<status>$status</status>";
        $xml= $xml . "<content>". Database::clearData($content) ."</content>";
        $xml= $xml . "</message>";
        return $xml;
    }

    public function getConnexion(): PDO {
        try {
            $pdo= new PDO($this->db_dsn, $this->db_user, $this->db_password);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $pdo;
        }
        catch(PDOException $ex) {
            echo Database::getMessageXML("Error", "Echec de connexion : " . $ex->getMessage());
            exit();
        }
    }

    public static function getDataXML(string $tablename, $data): string {
        $xml= "<?xml version=\"1.0\" encoding=\"UTF-8\" standalone=\"yes\" ?>";
        $xml= $xml . "<{$tablename}>";    
        foreach($data as $key => $value) {
            $xml= $xml . "<{$key}>". Database::clearData($value) ."</{$key}>";
        }
        $xml= $xml . "</{$tablename}>"; 
        return $xml;
    }

    public static function getAllDatasXML(string $tablename, $datas): string {
        $xml= "<?xml version=\"1.0\" encoding=\"UTF-8\" standalone=\"yes\" ?>";
        $xml= $xml . "<{$tablename}s>";  
        foreach($datas as $data) {
            $xml= $xml . "<{$tablename}>";    
            foreach($data as $key => $value) {
                $xml= $xml . "<{$key}>". Database::clearData($value) ."</{$key}>";
            }
            $xml= $xml . "</{$tablename}>"; 
        }
        $xml= $xml . "</{$tablename}s>"; 
        return $xml;
    }
}
?>