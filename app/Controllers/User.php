<?php
namespace App\Controllers;

use App\Model\User as UserModel;
use Base\AbstractController;

class User extends AbstractController
{
    public function loginAction()
    {
        $email = trim($_POST['email']);

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

        return $this->view->render('User/register.twig', [
            'user' => UserModel::getById((int) $_SESSION['id'])
        ]);
    }

    public function registerAction()
    {
            
        $name = trim($_POST['name']);
        $email = trim($_POST['email']);
        $password = $_POST['password'];
        $password2 = $_POST['password_2'];

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
                $user = (new UserModel())
                    ->setName($name)
                    ->setEmail($email)
                    ->setPassword(UserModel::getPasswordHash($password));
                             
                $user->save();
                
                $_SESSION['id'] = $user->getId();
                $this->setUser($user);
                $this->redirect('/user/profile');
            }
        }
    }

    public function profileAction()
    {
        return $this->view->render('User/profile.twig', [
            'user' => UserModel::getById((int) $_SESSION['id'])
        ]);

    }

    public function logoutAction()
    {
        session_destroy();
        $this->redirect('/user/login');
    }


    public function twigAction()
    {
        return $this->view->render('test.twig', [
            'name' => 'Sasha']);
        

    }
}




?>