<?php

namespace app\core;

use PDO;
use PDOException;

abstract class BaseModel
{
    protected $db;

    public function __construct()
    {
        $config = require 'app/config/db.php';
        try {
            $this->db = new PDO(
                $config['provider'] . ':host=' . $config['hostname'] . ';dbname=' . $config['database'],
                $config['username'],
                $config['password']
            );
        } catch (PDOException $ex) {
            print 'Ошибка: ' . $ex->getMessage() . '<br>';
            die();
        }
    }

    protected function query($sql, $params = [])
    {
        $query = $this->db->prepare($sql);
        if (!empty($params)) {
            foreach ($params as $key => $val) {
                $query->bindValue(':' . $key, $val);
            }
        }
        $query->execute();
        return $query;
    }

    protected function select($sql, $params = [])
    {
        $result = $this->query($sql, $params);
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }

    protected function insert($sql, $params = [])
    {
        $this->query($sql, $params);
        return (int)$this->db->lastInsertId();
    }

    protected function update($sql, $params)
    {
        $query = $this->query($sql, $params);
        return $query->rowCount();

    }

    protected function delete($sql, $params = [])
    {
        $query = $this->query($sql, $params);
        return $query->rowCount();
    }
}
