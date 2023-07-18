<?php

class MySql {
    private $dbHost;
    private $dbUsername;
    private $dbPassword;
    private $dbName;
    private $conn;

    public function __construct($dbHost, $dbUsername, $dbPassword, $dbName) {
        $this->dbHost = $dbHost;
        $this->dbUsername = $dbUsername;
        $this->dbPassword = $dbPassword;
        $this->dbName = $dbName;
        $this->connect();
    }

    private function connect() {
        $this->conn = new mysqli($this->dbHost, $this->dbUsername, $this->dbPassword, $this->dbName);

        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    public function addRecord($table, $data) {
        $columns = implode(", ", array_keys($data));
        $values = "'" . implode("', '", array_values($data)) . "'";
        $sql = "INSERT INTO $table ($columns) VALUES ($values)";

        if ($this->conn->query($sql) === TRUE) {
            return $this->conn->insert_id;
        } else {
            return false;
        }
    }

    public function deleteRecord($table, $condition) {
        $sql = "DELETE FROM $table WHERE $condition";
        return $this->conn->query($sql);
    }

    public function searchRecords($table, $filter) {
        $sql = "SELECT * FROM $table WHERE $filter";
        $result = $this->conn->query($sql);

        $records = array();
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $records[] = $row;
            }
        }

        return $records;
    }

    public function executeSQL($sql) {
        return $this->conn->query($sql);
    }

    public function closeConnection() {
        $this->conn->close();
    }
}
