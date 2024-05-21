<?php
require_once __DIR__ . '/../bootstrap.php';

class Database
{
    private $db;

    private SQLite3Result $result;
    public function __construct()
    {
        $dbPath = getenv("DB_PATH");
        if ($dbPath === false) {
            throw new Exception("DB_PATH not set");
        }
        $this->db = new SQLite3($dbPath);
    }

    public function query($sql, $params = []): Database
    {
        $stmt = $this->db->prepare($sql);
        if ($stmt === false) {
            throw new Exception("Failed to prepare statement: " . $this->db->lastErrorMsg());
        }

        foreach ($params as $param) {
            $stmt->bindValue($param['name'], $param['value'], $param['type']);
        }

        $this->result = $stmt->execute();
        if ($this->result === false) {
            throw new Exception("Failed to execute statement: " . $this->db->lastErrorMsg());
        }

        return $this;
    }

    public function fetchOne($type = SQLITE3_ASSOC): array
    {
        if ($this->checkResult()) {
            throw new Exception("No result to fetch");
        }
        $row = $this->result->fetchArray($type);
        return $row !== false ? $row : [];
    }

    public function fetchAll(): array
    {
        $results = [];
        while ($result = $this->fetchOne()) {
            $results[] = $result;
        }
        return $results;
    }

    private function checkResult(): bool
    {
        return $this->result == null;
    }

    public function first(): array
    {
        if ($this->checkResult()) {
            throw new Exception("No result to fetch");
        }
        return $this->fetchOne()[0];
    }

    public function close(): null
    {
        $this->db->close();
        return null;
    }
}
