<?php
namespace App\Controllers;

use App\Model\Eloquent\Message;
use App\Model\Eloquent\User;
use Base\AbstractController;

class Admin extends AbstractController
{

    public function preDispatch()
    {
        parent::preDispatch();
        if(!$this->getUser() || !$this->getUser()->isAdmin()) {
            $this->redirect('/');
        }
    }

    public function deleteMessageAction()
    {
        $messageId = (int) $_GET['id'] ?? null;
        Message::deleteMessage($messageId);
        $this->redirect('/blog/index');
    }

    public function indexAction()
    {
        $users = User::getList();
        return $this->view->renderTwig('admin.twig', [
            'users' => $users,
            'user' => $this->user, 
        ]);
    }


    public function deleteUserAction()
    {
        $userId = (int) $_GET['id'] ?? null;
        User::deleteUser($userId);
        $this->redirect('/admin/index');
    }


    public function addUserAction()
    {
            
        $name = trim($_POST['name']) ?? null;
        $email = trim($_POST['email']) ?? null;
        $password = $_POST['password'] ?? null;
        $password2 = $_POST['password_2'] ?? null;

        $success = true;
        if (isset($_POST['name'])) {

            if ($password !== $password2) {
                $success = false;
                return 'Пароли не совпадают';
            }

            if (mb_strlen($password) < 5) {
                $success = false;
                return 'Палоль должен быть больше 4 символов';
            }
            
            if (!$name) {
                $success = false;
                return 'Имя не может быть пустым';
            }

            if (!$password) {
                $success = false;
                return 'Пароль не может быть пустым';
            }

            if (!$email) {
                $success = false;
                return 'Почта не может быть пустой';
            }

            $user = User::getByEmail($email);

            if ($user) {
                return 'Пользователь с таким именем уже существует';
                $success = false;
            }

            if ($success) {
                
                $userData = [
                    'name' => $name,
                    'password' => User::getPasswordHash($password),
                     'email' => $email,
                     'created_at' => date('Y-m-d H:i:s'),
                ];
                $user = new User($userData);

                if (isset($_FILES['image']['tmp_name'])) {
                    $user->loadFile($_FILES['image']['tmp_name']);
                }
                $user->save();
   
                $this->redirect('/admin/index');
            }
        }
    }

    public function getUserForEditAction()
    {
        $userId = (int) $_GET['id'] ?? null;
        $user = User::getById($userId);

        return $this->view->renderTwig('user/edit.twig', [
            'user' => $user,
        ]);
           
    }

        public function editUserAction()
    {
        $userId = $_POST['id'] ?? null;
        $name = trim($_POST['name']) ?? null;
        $email = trim($_POST['email']) ?? null;
        $password= $_POST['password'] ?? null;
        $createdAt = date('Y-m-d H:i:s') ?? null;

        User::deleteUser($userId);

        $data = [
            'id' => $userId,
            'name' => $name,
            'email' => $email,
            'created_at' => $createdAt,
            'password' => $password,
        ];

        $updateUser = new User($data);

        if (isset($_FILES['image']['tmp_name'])) {
            $updateUser->loadFile($_FILES['image']['tmp_name']);
        }
        
        $updateUser->save();

        $this->redirect('/admin/index');
              
        }
 
}



?>