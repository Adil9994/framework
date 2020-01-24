<?php

namespace App\Controllers;

use App\Models\Albums;
use App\Models\Genre;
use Core\Controller;
use Core\Session;
use Core\Router;
use App\Models\Contacts;
use App\Models\Users;

class GenreController extends Controller
{

    public function __construct($controller, $action)
    {
        parent::__construct($controller, $action);
        $this->view->setLayout('default');
        $this->load_model('Genre');
    }

    public function indexAction()
    {
        $genres = $this->GenreModel->find();
        $this->view->genres = $genres;
        $this->view->render('genre/index');
    }
    public function addGenreAction()
    {
        $genre = new Genre();
        if ($this->request->isPost()) {
            $genre->assign($this->request->get());
            if ($genre->save()) {
                Router::redirect('genre');
            }
        }
        $this->view->genres = $genre;
        $this->view->render('genre/addGenre');
    }
    public function editGenreAction($id)
    {
        $genre = $this->GenreModel->findGenreById($id);
        if ($this->request->isPost()) {
            $genre->assign($this->request->get());
            if ($genre->save()) {
                Router::redirect('genre');
            }
        }
        $this->view->genres = $genre;
        $this->view->render('genre/editGenre');
    }
    public function deleteGenreAction($id) {
        $genre = $this->GenreModel->findGenreById($id);
        if ($genre) {
            $genre->delete();
            Session::addMsg('success', 'Genre has been deleted');
        }
        Router::redirect('genre');
    }
}
