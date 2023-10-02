<?php

namespace app\controllers;

use app\core\InitController;
use app\lib\UserOperations;
use app\models\NewsModels;

class NewsController extends InitController
{
    public function behaviors()
    {
        return [
            'access' => [
                'rules' => [
                    [
                        'actions' => ['list'],
                        'roles' => [UserOperations::RoleUser, UserOperations::RoleAdmin],
                        'matchCallback' => function () {
                            $this->redirect('/user/login');
                        }
                    ],
                    [
                        'actions' => ['add'],
                        'roles' => [UserOperations::RoleAdmin],
                        'matchCallback' => function () {
                            $this->redirect('/news/list');
                        }
                    ],
                ]
            ]
        ];
    }

    public function actionList()
    {
        $this->view->title = 'Рецензии';

        $news_model = new NewsModels();
        $news = $news_model->getListNews();

        $this->render('list', [
            'sidebar' => UserOperations::getMenuLinks(),
            'news' => $news,
            'role' => UserOperations::getRoleUser(),
        ]);
    }

    public function actionAdd()
    {
        $this->view->title = 'Добавленные статьи:';
        $error_message = '';
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['btn_news_add_form'])) {
            $news_data = !empty($_POST['news']) ? $_POST['news'] : null;
            if (!empty($news_data)) {
                $newsModel = new NewsModels();
                $result_add = $newsModel->add($news_data);
                if ($result_add['result']) {
                    $this->redirect('/news/list');
                } else {
                    $error_message = $result_add['error_message'];
                }
            }
        }

        $this->render('add', [
            'sidebar' => UserOperations::getMenuLinks(),
            'error_message' => $error_message
        ]);
    }

    public function actionEdit()
    { $this -> view -> title = 'Редактирование статьи:';
        $error_message = '';
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['btn_news_add_form'])) {
            $title = !empty($_POST['title']) ? $_POST['title'] : null;
            $cover = !empty($_FILES['cover']['tmp_name']) ? $_FILES['cover']['tmp_name'] : null;
            $type = !empty($_FILES['cover']['type']) ? $_FILES['cover']['type'] : null;
            $message = !empty($_POST['text']) ? $_POST['text'] : null;
            $session_id = $_SESSION['s_id'];
            if(empty($title)){
                $error_message .= 'Нет заголовка!';
            }if(empty($cover)){
                $error_message .= 'Нет изображения!';
            }if(empty($type)){
                $error_message .= 'Отсутствует тип данных';
            }
            if (empty($error_message)){
                $newsModel = new NewsModels();
                $result_add = $newsModel->edit($title, $cover, $type, $message, $session_id);
                if ($result_add['result']) {
                    $this->redirect('/news/list');
                } else {
                    $error_message = $result_add['error_message'];
                }
            }
        }

        if (!empty($title)) {
            if (!empty($message)) {
                if (!empty($_FILES['cover']['tmp_name'])) {
                    $file = file_get_contents($_FILES['cover']['tmp_name']);
                    $type = $_FILES['cover']['type'];
                    $base64 = base64_encode($file);
                    $new = insert(
                        'INSERT INTO themes(title, text, cover, type) VALUES (:title, :text, :cover, :type) WHERE user_id = :id',
                        ['title' => $title,
                            'text' => $message,
                            'cover' => $base64,
                            'type' => $type,
                            'id' => $session_id]
                    );
                } else {
                    $_SESSION['error'] = "Нет изображения";
                }
            } else {
                $_SESSION['error'] = "Поле 'Текст' пустое";
            }
        } else {
            $_SESSION['error'] = "Поле 'Заголовок' пустое";
        }
    }

    public function actionDelete()
    {
        $this->view->title = 'Редактирование статьи';
        $news_id = !empty($_GET['news_id']) ? $_GET['news_id'] : null;
        $news = null;
        $error_message = '';

        if (!empty($news_id)) {
            $news_model = new NewsModels();
            $news = $news_model->getNewsById($news_id);
            if (!empty($news)) {
                $result_delete = $news_model->deleteById($news_id);
                if ($result_delete['result']) {
                    $this->redirect('/news/list');
                } else {
                    $error_message = $result_delete['error_message'];
                }
            } else {
                $error_message = 'Статья не найдена!';
            }
        } else {
            $error_message = 'Отсутствует идентификатор записи';
        }

        $this->render('delete', [
            'sidebar' => UserOperations::getMenuLinks(),
            'news' => $news,
            'error_message' => $error_message
        ]);
    }
}