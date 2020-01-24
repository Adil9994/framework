<?php
namespace App\Models;

use Core\Model;
use Core\Validators\RequiredValidator;
use Core\Validators\MaxValidator;

class Genre extends Model
{
    public $id,$Genre;

    public function __construct()
    {
        $table = 'Genre';
        parent::__construct($table);
        $this->_softDelete = false;
    }
    public function findGenreById($genreId, $params = [])
    {
        $conditions = [
            'conditions' => 'id = ?',
            'bind' => [$genreId]
        ];
        $conditions = array_merge($conditions, $params);
        return $this->findFirst($conditions);
    }
}