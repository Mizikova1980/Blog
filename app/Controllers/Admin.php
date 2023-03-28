<?php
namespace App\Controllers;

use App\Model\Message;
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
        $messageId = (int) $_GET['id'];
        Message::deleteMessage($messageId);
        $this->redirect('/blog/index');
    }

}



?>