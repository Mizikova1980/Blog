<?php

namespace Base;

use App\Controllers\Admin;
use App\Controllers\Admin\Users;
use App\Controllers\User;
use App\Model\Eloquent\User as UserModel;
use Base\RouteException;
use Base\AbstractController;
use Base\View;
use Base\Route;

class Application extends AbstractController
{
    private $route;
    private $controller;
    private $actionName;
    
    public function __construct()
    {
        $this->route = new Route();
    }

    public function run()
    {
        try {
            session_start();
            $this->addRoutes();
            $this->initController();
            $this->initActionName();
            $this->initUser();
    
            $view = new View;
            $this->controller->setView($view);

        
           $this->preDispatch();
            $content = $this->controller->{$this->actionName}();
           
            echo $content;
        } catch (RedirectException $e) {
            header('Location: ' . $e->getUrl());
        } catch (RouteException $e) {
            header("HTTP/1.0 404 Not Found");
        }
                  
    }

    private function initUser()
    {
       $id = $_SESSION['id'] ?? null;

       if($id) {
        $user = UserModel::getById($id);
        if($user) {
            $this->controller->setUser($user);
        }
       }
    }

    private function addRoutes()
    {
        /** @uses \App\Controllers\User::loginAction() */
        $this->route->addRoute('/', User::class, 'login');
        $this->route->addRoute('/admin', Admin::class, 'index');
    }

    private function initController()
    {
        $controllerName = $this->route->getControllerName();
        if (!class_exists($controllerName)) {
            throw new RouteException('Cant find controller ' . $controllerName);
        }
        $this->controller = new $controllerName();
    }

    private function initActionName()
    {
        $actionName = $this->route->getActionName();

        if (!method_exists($this->controller, $actionName)) {
            throw new RouteException('Action ' . $actionName . ' not found in ' . get_class($this->controller));
        }
       
        $this->actionName = $actionName;
    }

}


?>