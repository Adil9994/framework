<?php

namespace app\models;
use Core\Helpers;
use Core\Model;
use Core\Validators\RequiredValidator;

class Posts extends Model {
    public $postTitle,$postDesc,$postCont,$postDate,$deleted = 0;
    public function __construct() {
        $table = 'admin';
        parent::__construct($table);
        $this->_softDelete = true;
    }
    public function validator()
    {
        $this->runValidation(new RequiredValidator($this, ['field' => 'postTitle', 'msg' => 'Title is required']));
        $this->runValidation(new RequiredValidator($this, ['field' => 'postDesc', 'msg' => 'Description is required']));
        $this->runValidation(new RequiredValidator($this, ['field' => 'postCont', 'msg' => 'Content is required']));
    }
    public function findPostById($postId, $params = [])
    {
        $conditions = [
            'conditions' => 'id = ?',
            'bind' => [$postId]
        ];
        $conditions = array_merge($conditions, $params);
        return $this->findFirst($conditions);
    }
    function setTimezone($default) {
        $timezone = "";

        // On many systems (Mac, for instance) "/etc/localtime" is a symlink
        // to the file with the timezone info
        if (is_link("/etc/localtime")) {

            // If it is, that file's name is actually the "Olsen" format timezone
            $filename = readlink("/etc/localtime");

            $pos = strpos($filename, "zoneinfo");
            if ($pos) {
                // When it is, it's in the "/usr/share/zoneinfo/" folder
                $timezone = substr($filename, $pos + strlen("zoneinfo/"));
            } else {
                // If not, bail
                $timezone = $default;
            }
        }
        else {
            // On other systems, like Ubuntu, there's file with the Olsen time
            // right inside it.
            $timezone = file_get_contents("/etc/timezone");
            if (!strlen($timezone)) {
                $timezone = $default;
            }
        }
        date_default_timezone_set($timezone);
    }
    public function setCurrentTime() {
        $this->setTimezone(date_default_timezone_set( "UTC" ));
        $date = date("Y-m-d H:i:s");
        return $date;
    }
}