<?php
namespace App\Models;

use Core\Model;
use Core\Validators\RequiredValidator;
use Core\Validators\MaxValidator;

class Artists extends Model
{
    public $id,$ArtistName;

    public function __construct()
    {
        $table = 'Artists';
        parent::__construct($table);
        $this->_softDelete = false;
    }
    public function findArtistById($artistId, $params = [])
    {
        $conditions = [
            'conditions' => 'id = ?',
            'bind' => [$artistId]
        ];
        $conditions = array_merge($conditions, $params);
        return $this->findFirst($conditions);
    }
}