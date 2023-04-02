<?php
namespace App\Controllers;

use App\Model\Eloquent\User as UserModel;
use Base\AbstractController;

class User extends AbstractController
{
    public function loginAction()
    {
        $email = trim($_POST['email']) ?? null;

        if (!empty($email)) {
            $password = $_POST['password'];
            $user = UserModel::getByEmail($email);
            if (!$user) {
                return 'Неверный логин и пароль';
            }

            if (!empty($user)) {
                if ($user->getPassword() != UserModel::getPasswordHash($password)) {
                    return 'Неверный логин и пароль';
                } else {
                    $_SESSION['id'] = $user->getId();
                    $this->redirect('/user/profile');
                }
            }
        }

        return $this->view->renderTwig('User/register.twig', [
            'user' => UserModel::getById((int) $_SESSION['id'])
        ]);
    }

    public function registerAction()
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

            $user = UserModel::getByEmail($email);

            if ($user) {
                return 'Пользователь с таким именем уже существует';
                $success = false;
            }

            if ($success) {
                
                $userData = [
                    'name' => $name,
                    'password' => UserModel::getPasswordHash($password),
                     'email' => $email,
                     'created_at' => date('Y-m-d H:i:s'),
                ];
                $user = new UserModel($userData);

                if (isset($_FILES['image']['tmp_name'])) {
                    $user->loadFile($_FILES['image']['tmp_name']);
                }
                
                $user->save();
                
                $_SESSION['id'] = $user->getId();
                $this->redirect('/user/profile');
            }
        }
    }

    public function profileAction()
    {
        return $this->view->renderTwig('User/profile.twig', [
            'user' => UserModel::getById((int) $_SESSION['id'])
        ]);

    }

    public function logoutAction()
    {
        session_destroy();
        $this->redirect('/user/login');
    }


}




?>