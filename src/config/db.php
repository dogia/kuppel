<?php
class mongodb{
    private $connection;
    private $db;
    private $collection;

    //dbUser:dogiaAtlas
    //mongodb+srv://dbUser:dogiaAtlas@cluster.oxs3r.gcp.mongodb.net/<dbname>?retryWrites=true&w=majority
    function __construct($user, $password, $host, $db, $collection){
        $link = "mongodb+srv://".$user.":".$password."@".$host."/".$db."?retryWrites=true&w=majority";
        $this->connection = new MongoDB\Driver\Manager($link);
        $this->db = $db;
        $this->collection = $collection;
    }

    public function getDocuments($filters = [], $options = ['limit' => 99999]){
        $query = new MongoDB\Driver\Query($filters, $options);
        $rows = $this->connection->executeQuery($this->db.".".$this->collection, $query);
        $res = "[";
        foreach ($rows as $document) {
            if($res == "["){
                $res = "[".json_encode($document);
            }else{
                $res = $res.",".json_encode($document);
            }
        }
        return $res."]";
    }

    public function insertDocument($doc){
        $bulkWrite = new MongoDB\Driver\BulkWrite;
        $bulkWrite->insert($doc);
        $colString = $this->db.".".$this->collection;
        $this->connection->executeBulkWrite($colString, $bulkWrite);
    }

    public function deleteDocument($filters, $options = ['limit' => 1]){
        $bulkWrite = new MongoDB\Driver\BulkWrite;
        $bulkWrite->delete($filters, $options);
        $colString = $this->db.".".$this->collection;
        $this->connection->executeBulkWrite($colString, $bulkWrite);
    }

    public function updateDocument($filters, $update, $options = ['multi' => false, 'upsert' => false]){
        $bulkWrite = new MongoDB\Driver\BulkWrite;
        $updates = ['$set' => $update];
        $bulkWrite->update($filters, $updates, $options);
        $colString = $this->db.".".$this->collection;
        $this->connection->executeBulkWrite($colString, $bulkWrite);    
    }
}
?>