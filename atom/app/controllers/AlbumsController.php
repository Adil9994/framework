<?php

namespace App\Controllers;

use App\Models\Albums;
use App\Models\Artists;
use App\Models\Genre;
use Core\Controller;
use Core\FormHelper;
use Core\Helpers;
use Core\Session;
use Core\Router;
use App\Models\Contacts;
use App\Models\Users;

class AlbumsController extends Controller
{

    public function __construct($controller, $action)
    {
        parent::__construct($controller, $action);
        $this->view->setLayout('default');
        $this->load_model('Albums');
    }

    public function indexAction()
    {
        $albums = $this->AlbumsModel->find();
        $this->view->albums = $albums;
        $this->view->render('albums/index');
    }
    public function addAlbumAction()
    {
        $genre = new Genre();
        $artists = new Artists();
        $album = new Albums();
        if ($this->request->isPost()) {
            $album->assign($this->request->get());
                if ($album->save()) {
                    Router::redirect('albums');
            }
        }
        $this->view->artists = $artists->find();
        $this->view->genres = $genre->find();
        $this->view->albums = $album;
        //$this->view->displayErrors = $post->getErrorMessages();
        $this->view->render('albums/addAlbum');
    }
    public function editAlbumAction($id)
    {
        $genre = new Genre();
        $artists = new Artists();
        $album = $this->AlbumsModel->findAlbumById($id);
        if ($this->request->isPost()) {
            $album->assign($this->request->get());
            if ($album->save()) {
                Router::redirect('albums');
            }
        }
        $this->view->artists = $artists->find();
        $this->view->genres = $genre->find();
        $this->view->albums = $album;
        //$this->view->displayErrors = $post->getErrorMessages();
        $this->view->render('albums/editAlbum');
    }
    public function deleteAlbumAction($id)
    {
        $album = $this->AlbumsModel->findAlbumById($id);
        if ($album) {
            $album->delete();
            Session::addMsg('success', 'Album has been deleted');
        }
        Router::redirect('albums');
    }
}
