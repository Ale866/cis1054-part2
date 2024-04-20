<?php
require_once './bootstrap.php';

class Database
{
    private $db;
    public function __construct()
    {
        $dbPath = getenv("DB_PATH");
        if ($dbPath === false) {
            throw new Exception("DB_PATH not set");
        }
        $this->db = new SQLite3($dbPath);
    }

    public function query($sql, $params = [])
    {
        $stmt = $this->db->prepare($sql);
        if ($stmt === false) {
            throw new Exception("Failed to prepare statement: " . $this->db->lastErrorMsg());
        }

        foreach ($params as $param) {
            $stmt->bindValue($param['name'], $param['value'], $param['type']);
        }

        $result = $stmt->execute();
        if ($result === false) {
            throw new Exception("Failed to execute statement: " . $this->db->lastErrorMsg());
        }

        return $result;
    }

    public function close()
    {
        $this->db->close();
    }
}
