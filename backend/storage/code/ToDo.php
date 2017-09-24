<?php

namespace Tests\Unit;

/**
* ToDoアプリ解答用雛形
*/
class Todo
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function getAll()
    {
        $sql = "SELECT * FROM todo order by text asc";
        $stmt = $this->db->prepare($sql);
        $result = $stmt->execute();
        $todos = [];
        while ($row = $stmt->fetch()) {
            $id = $row["id"];
            $text = $row["text"];
            $status = $row["status"];

            $todos[] = [
                "id" => $id,
                "text" => $text,
                "status" => $status
            ];
        }
        return $todos;
    }

    public function create($text)
    {
        $sqlInsert = "INSERT INTO todo (text, status) VALUES (:text, :status)";
        $stmt = $this->db->prepare($sqlInsert);
        $stmt->bindValue(":text", $text);
        $stmt->bindValue(":status", 0);
        $result = $stmt->execute();
        return $result;
    }

    public function update($id)
    {
        $sql = "UPDATE todo SET status = 1 WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(":id", $id);
        $result = $stmt->execute();
        return $result;
    }

    public function edit($id, $text)
    {
        $sql = "UPDATE todo SET text = :text WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(":id", $id);
        $stmt->bindValue(":text", $text);
        $result = $stmt->execute();
        return $result;
    }

    public function delete($id)
    {
        $sql = "DELETE FROM todo WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(":id", $id);
        $result = $stmt->execute();
        return $result;
    }
}
