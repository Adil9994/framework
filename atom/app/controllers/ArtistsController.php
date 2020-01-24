<?php

namespace App\Controllers;

use App\Models\Albums;
use App\Models\Artists;
use App\Models\Genre;
use Core\Controller;
use Core\Session;
use Core\Router;
use App\Models\Contacts;
use App\Models\Users;

class ArtistsController extends Controller
{

    public function __construct($controller, $action)
    {
        parent::__construct($controller, $action);
        $this->view->setLayout('default');
        $this->load_model('Artists');
    }

    public function indexAction()
    {
        $artists = $this->ArtistsModel->find();
        $this->view->artists = $artists;
        $this->view->render('artists/index');
    }
    public function addArtistAction()
    {
        $artist = new Artists();
        if ($this->request->isPost()) {
            $artist->assign($this->request->get());
            if ($artist->save()) {
                Router::redirect('artists');
            }
        }
        $this->view->artists = $artist;
        //$this->view->displayErrors = $post->getErrorMessages();
        $this->view->render('artists/addArtist');
    }
    public function editArtistAction($id)
    {
        $artist = $this->ArtistsModel->findArtistById($id);
        if ($this->request->isPost()) {
            $artist->assign($this->request->get());
            if ($artist->save()) {
                Router::redirect('artists');
            }
        }
        $this->view->artists = $artist;
        $this->view->render('artists/editArtist');
    }
    public function deleteArtistAction($id) {
        $artist = $this->ArtistsModel->findArtistById($id);
        if ($artist) {
            $artist->delete();
            Session::addMsg('success', 'Artist has been deleted');
        }
        Router::redirect('artists');
    }
}
