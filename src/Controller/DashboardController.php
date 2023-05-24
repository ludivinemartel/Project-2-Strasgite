<?php

namespace App\Controller;

class DashboardController extends AbstractController
{
    public function index(): string
    {
        if (!$_SESSION['isLogin']) {
            header('Location:/forbidden');
        }
        return $this->twig->render('Dashboard/index.html.twig') ;
    }
}
