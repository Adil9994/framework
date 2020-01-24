<?php

namespace Core;

use \PDO;
use \PDOException;

class DB
{
    private static $_instance = null;
    private $_pdo, $_query, $_error = false, $_result, $_count = 0, $_lastInsertID = null;

    private function __construct()
    {
        try {
            $this->_pdo = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME, DB_USER, DB_PASSWORD);
            $this->_pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->_pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    public static function getInstance()
    {
        if (!isset(self::$_instance)) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    //output in $_result (array of obj type)
    public function query($sql, $params = [], $class = false)
    {
        $this->_error = false;
        if ($this->_query = $this->_pdo->prepare($sql)) {
            $x = 1;
            if (count($params)) {
                foreach ($params as $param) {
                    //bind ? to params[]; to get final query
                    $this->_query->bindValue($x, $param);
                    $x++;
                }
            }
            if ($this->_query->execute()) {
                if ($class) {
                    $this->_result = $this->_query->fetchAll(PDO::FETCH_CLASS, $class);
                } else {
                    $this->_result = $this->_query->fetchAll(PDO::FETCH_OBJ);
                }
                $this->_count = $this->_query->rowCount();
                $this->_lastInsertID = $this->_pdo->lastInsertId();
            } else {
                $this->_error = true;
            }
            return $this;
        }
        return $this;
    }

    /**
     * @param string $table
     * @param int $id
     * @param array $fields
     * @return bool
     */
    public function update(string $table, int $id, array $fields = [])
    {
        $fieldString = '';
        $values = [];
        foreach ($fields as $field => $value) {
            $fieldString .= ' ' . $field . ' = ?,'; // fname = ?, lname = ?,
            $values[] = $value;
        }
        $fieldString = trim($fieldString); //delete spaces from left and right;
        $fieldString = rtrim($fieldString, ','); // delete , from right;
        $sql = "UPDATE {$table} SET {$fieldString} WHERE id = {$id}"; // "Update {'contacts'} set fname = ?, lname = ? where id = 1;
        if (!$this->query($sql, $values)->error()) {
            return true;
        } else {
            return false;
        }
    }

    //Deletes a row;
    public function delete($table, $id)
    {
        $sql = "DELETE from {$table} WHERE id = {$id}";
        if (!$this->query($sql)->error()) {
            return true;
        } else {
            return false;
        }
    }

    //inserts a row
    public function insert($table, $fields = [])
    {
        $fieldString = '';
        $valueString = '';
        $values = [];
        foreach ($fields as $field => $value) {
            $fieldString .= '`' . $field . '`,'; // `fname`,`..`,
            $valueString .= '?,'; // ?,?,?,
            $values[] = $value; //123,123,123
        }
        $fieldString = rtrim($fieldString, ','); //`fname`,`..`
        $valueString = rtrim($valueString, ','); // `?,?,?`
        $sql = "INSERT INTO {$table} ({$fieldString}) VALUES ({$valueString})"; //"INSERT INTO contacts (`fname`,`lname`,`email`,`phone1`,`phone2`,`phone3`,`address`,`address2`,`city`,`state`,`zip_code`,`country`,`user_id`) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?)"
        if (!$this->query($sql, $values)->error()) {
            return true;
        } else {
            return false;
        }
    }

    //need to find through sql; result is array of objects->values
    protected function _read($table, $params = [], $class)
    {
        $conditionString = '';
        $bind = [];
        $order = '';
        $limit = '';

        //conditions
        if (isset($params['conditions'])) {
            if (is_array($params['conditions'])) {
                foreach ($params['conditions'] as $condition) {
                    $conditionString .= ' ' . $condition . ' AND';
                }
                $conditionString = trim($conditionString);
                $conditionString = rtrim($conditionString, ' AND');
                //"lname = ? AND fname = ? AND smth = ?"
            } else {
                $conditionString = $params['conditions'];
            }
            if ($conditionString != '') {
                $conditionString = ' Where ' . $conditionString; // ' Where lname = ? AND fname = ?
            }

        }
        //bind
        if (array_key_exists('bind', $params)) {
            $bind = $params['bind']; //array of values;
        }
        //order
        if (array_key_exists('order', $params)) {
            $order = ' ORDER BY ' . $params['order'];
        }
        //limit
        if (array_key_exists('limit', $params)) {
            $limit = ' LIMIT ' . $params['limit'];
        }
        $sql = "SELECT * FROM {$table}{$conditionString}{$order}{$limit}";
        if ($this->query($sql, $bind, $class)) { //bind values $bind[] = ?
            if (!count($this->_result)) {
                return false;
            } else return true;
        }
        return false;
    }

    //array of objects
    public function find($table, $params = [], $class = false)
    {
        if ($this->_read($table, $params, $class)) {
            return $this->results();
        }
        return false;
    }

    public function results()
    {
        return $this->_result;
    }

    //first object
    public function findFirst($table, $params = [], $class = false)
    {
        if ($this->_read($table, $params, $class)) {
            return $this->first();
        }
        return false;
    }

    public function first()
    {
        return (!empty($this->_result)) ? $this->_result[0] : [];
    }

    public function count()
    {
        return $this->_count;
    }

    public function lastID()
    {
        return $this->_lastInsertID;
    }

    public function get_columns($table)
    {
        return $this->query("SHOW COLUMNS FROM {$table}")->results();
    }

    public function error()
    {
        return $this->_error;
    }
}
