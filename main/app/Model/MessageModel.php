<?php

namespace App\Model;

use PDO;
use PDOException;
use PDOStatement;
use App\Config\DataBaseConfig;
use App\Model\MainModel\MainModel;

/**
 * This class is responsible for 
 * communicating with the database
 */
class MessageModel extends MainModel {

    public function MessageCreate($title, $content) {

        try {
            $conn = self::connection();
        
            $sqlInsert = "INSERT INTO Messages (title, content, created) VALUES (?, ?, ?)";
            $stmtInsert = $conn->prepare($sqlInsert);
            $stmtInsert->execute([$title, $content, date("Y-m-d H:i:s")]);

            $lastInsertId = $conn->lastInsertId();
            $sqlSelect = "SELECT * FROM Messages WHERE id = ?";
            $stmtSelect = $conn->prepare($sqlSelect);
            $stmtSelect->execute([$lastInsertId]);
            $result = $stmtSelect->fetchAll(PDO::FETCH_ASSOC);
        
            return $result;
        }
        catch (PDOException $e) {
            echo "Database error: " . $e->getMessage();
        }
    }

    public function MessageUpdate($id, $title, $content) {

        try {
            $conn = self::connection();
            $sqlUpdate = "UPDATE Messages SET title = '" . $title . "', content = '" . $content . "' WHERE id = " . $id;
            $result = $conn->exec($sqlUpdate);

            $sqlSelect = "SELECT * FROM Messages WHERE id = " . $id; 
            $result = $conn->query($sqlSelect);
            return $result;
        }
        catch (PDOException $e) {
            echo "Database error: " . $e->getMessage();
        }
    }

    public function MessageById($id) {
        try {
            $conn = self::connection();
            $sql = "SELECT * FROM Messages WHERE id = " . $id;            
            $result = $conn->query($sql);
            return $result;
        } catch (PDOException $e) {
            echo "Database error: " . $e->getMessage();
        }
    }

    public function MessageList() {
        try {
            $conn = self::connection();
            $sql = "SELECT * FROM Messages ORDER BY id DESC";            
            $result = $conn->query($sql);
            return $result;
        } catch (PDOException $e) {
            echo "Database error: " . $e->getMessage();
        }
    }

    public function MessageDelete($id) {
        try {
            $conn = self::connection();
            $sql = "DELETE FROM Messages WHERE id = " . $id;            
            $result = $conn->exec($sql);
            return $result;
        } catch (PDOException $e) {
            echo "Database error: " . $e->getMessage();
        }
    }
}
