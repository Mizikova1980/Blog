<?php
namespace Base;

use App\Model\User;

abstract class AbstractController
{
    protected $view;
    protected $user;
    protected $session;

    
    public function setView(View $view): void
    {
        $this->view = $view;
    }

    /** @param User $user */
    public function setUser(User $user): void
    {
        $this->user = $user;
    }

    protected function redirect(string $url)
    {
        throw new RedirectException($url);
    }

    public function getUser(): ?User
    {
        $userId = $_SESSION['user_id'];
        if (!$userId) {
            return null;
        }

        $user = User::getById($userId);
        if (!$user) {
            return null;
        }

        return $user;
    }

    public function getUserId()
    {
        if ($user = $this->getUser()) {
            return $user->getId();
        }

        return false;
    }

    public function preDispatch()
    {

    }

}


?>