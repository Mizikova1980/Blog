<?php
namespace App\Controllers;

use App\Model\Eloquent\Message;
use App\Model\Eloquent\User as UserModel;
use Base\AbstractController;

class Blog extends AbstractController
{
    function indexAction()
    {
        if (!$this->user) {
            $this->redirect('/user/login');
        }

        $messages = Message::getList();
              
        return $this->view->renderTwig('blog.twig', [
            'user' => $this->user, 
            'messages' => $messages, 
        ]);
    }

    public function addMessageAction()
    {
              
        $text = $_POST['text'] ?? null;
        $authorId = $_SESSION['id'] ?? null;

        if (!$text) {
            echo 'Сообщение не может быть пустым';
        }
        
        $message = new Message([
            'text' => $text,
            'author_id' => $authorId
        ]);

        if (isset($_FILES['image']['tmp_name'])) {
            $message->loadFile($_FILES['image']['tmp_name']);
        }

        $message->save();
        $this->redirect('index');

    }





}