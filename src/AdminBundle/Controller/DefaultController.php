<?php

namespace App\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function index()
    {
        return $this->render('@Admin/default/home.html.twig', array())->setSharedMaxAge(100);;
    }
}
