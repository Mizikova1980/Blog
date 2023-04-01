<?php
namespace App\Controllers;

use App\Model\Message;
use App\Model\User as UserModel;
use Base\AbstractController;

class Blog extends AbstractController
{
    function indexAction()
    {
        if (!$this->user) {
            $this->redirect('/user/login');
        }

        $messages = Message::getList();
        if(!empty($messages)) {
            $userIds = array_map(function(Message $message) {
                return $message->getAuthorId();
            }, $messages);
        }
        
        $users = UserModel::getByIds($userIds);
        array_walk($messages, function (Message $message) use ($users) {
            if (isset($users[$message->getAuthorId()])) {
                $message->setAuthor($users[$message->getAuthorId()]);
            }
        });
       
        
        return $this->view->renderTwig('blog.twig', [
            'user' => $this->user, 
            'messages' => $messages, 
            'users' => $users,
            
        ]);
    }

    public function addMessageAction()
    {
              
        $text = $_POST['text'];
        $authorId = $_SESSION['id'];

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