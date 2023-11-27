<?php

namespace COMP3385;



// ORM.php

abstract class AbstractORM
{
    protected $connection;


    abstract public function connectDatabase($database);
    
    public function delete($table, $id){
        $query = $this->connection->prepare("DELETE FROM $table WHERE id = :id");
        $query->bindParam(':id', $id);
        $query->execute();
        return $query->fetch(\PDO::FETCH_ASSOC);
    }

    public function fetch($table, $column, $id)
    {
        $query = $this->connection->prepare("SELECT * FROM $table WHERE $column = (?) ");
        //$query->bindParam(':id', $id);
        $query->execute([$id]);
        return $query->fetch(\PDO::FETCH_ASSOC);
    }

    public function save($table, $data)
    {
        // Assuming $data is an associative array representing column => value pairs
        $columns = implode(', ', array_keys($data));
        $values = ':' . implode(', :', array_keys($data));

        $query = $this->connection->prepare("INSERT INTO $table ($columns) VALUES ($values)");

        foreach ($data as $key => $value) {
            $query->bindValue(':' . $key, $value);
        }

        return $query->execute();
    }

    // Additional methods for updating, deleting, or more complex queries could be added here
}
