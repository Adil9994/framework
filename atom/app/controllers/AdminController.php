<?php

namespace App\controllers;

use app\models\Posts;
use Core\Controller;
use Core\Helpers;
use Core\Router;
use Core\Session;

class AdminController extends Controller
{
    public function __construct($controller, $action)
    {
        parent::__construct($controller, $action);
        $this->view->setLayout('default');
        $this->load_model('Posts');
    }

    public function indexAction() {
        $this->view->render('admin/content');
    }
    public function contentAction()
    {
        $posts = $this->PostsModel->find();
        $this->view->posts = $posts;
        $this->view->render('admin/content');
    }

    public function blogAction()
    {
        $posts = $this->PostsModel->find();
        $this->view->posts = $posts;
        $this->view->render('admin/admin_blog');
    }

    public function addPostAction()
    {
        $post = new Posts();
        if ($this->request->isPost() && !empty($this->request->get())) {
            $this->request->csrfCheck();
            $post->assign($this->request->get());
            $post->validator();
            if ($post->validationPasses()) {
                $post->postDate = $post->setCurrentTime();
                if ($post->save()) {
                    Router::redirect('admin/blog');
                }
            }
        }
        $this->view->post = $post;
        $this->view->displayErrors = $post->getErrorMessages();
        $this->view->render('admin/addPost');
    }
    public function editPostAction($id)
    {
        $post = $this->PostsModel->findPostById($id);
        if (!$post) Router::redirect('admin/blog');
        if ($this->request->isPost()) {
            $this->request->csrfCheck();
            $post->assign($this->request->get());
            $post->validator();
            if ($post->validationPasses()) {
                if ($post->save()) {
                    Router::redirect('admin/blog');
                }
            }
        }
        $this->view->post = $post;
        $this->view->displayErrors = $post->getErrorMessages();
        $this->view->postAction = PROOT . 'admin' . DS . 'editpost' . DS . $post->id;
        $this->view->render('admin/editPost');
    }
    public function deletePostAction($id) {
        $post = $this->PostsModel->findPostById($id);
        if ($post) {
            $post->delete();
            Session::addMsg('success', 'Post has been deleted');
        }
        Router::redirect('admin/blog');
    }
}

