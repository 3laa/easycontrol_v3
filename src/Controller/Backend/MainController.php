<?php


namespace App\Controller\Backend;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class MainController
 * @package App\Controller\Backend
 * @Route("/", name="main_")
 */
class MainController extends AbstractController
{
  /**
   * @return Response
   * @Route("/", name="index")
   */
  public function index() {
    return $this->render('@backend/index.html.twig');
  }

  /**
   * @return Response
   * @Route("/404.html", name="404")
   */
  public function error404() {
    return $this->render('@backend/_error/404.html.twig');
  }

  /**
   * @return Response
   * @Route("/500.html", name="500")
   */
  public function error500() {
    return $this->render('@backend/_error/500.html.twig');
  }

  /**
   * @return Response
   * @Route("/login", name="login")
   */
  public function login() {
    return $this->render('@backend/_security/login.html.twig');
  }

  /**
   * @return Response
   * @Route("/website-sidebar", name="website-sidebar")
   */
  public function websiteSidebar() {
    return $this->render('@backend/website/iframe/website-sidebar.html.twig');
  }
}