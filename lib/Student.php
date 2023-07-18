<?php
include 'MySql.php';

class Student extends MySql {
    public function addUser($data) {
        return $this->addRecord('students', $data);
    }

    public function deleteUser($condition) {
        return $this->deleteRecord('students', $condition);
    }

    public function searchUsers($filter) {
        return $this->searchRecords('students', $filter);
    }

    public function executeCustomSQL($sql) {
        return $this->executeSQL($sql);
    }
}


