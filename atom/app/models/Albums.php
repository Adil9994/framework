<?php
namespace App\Models;

use Core\Model;
use Core\Validators\RequiredValidator;
use Core\Validators\MaxValidator;

class Albums extends Model
{
    public $id,$AlbumName, $DateReleased, $ArtistID, $GenreID;

    public function __construct()
    {
        $table = 'Albums';
        parent::__construct($table);
        $this->_softDelete = false;
    }
    public function findAlbumById($albumId, $params = [])
    {
        $conditions = [
            'conditions' => 'id = ?',
            'bind' => [$albumId]
        ];
        $conditions = array_merge($conditions, $params);
        return $this->findFirst($conditions);
    }
}