<?php


namespace App\Controller\Backend;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class IframeController
 * @package App\Controller\Backend
 * @Route("/iframe", name="iframe_")
 */
class IframeController extends AbstractController
{

  /**
   * @Route("/sidebar", name="sidebar")
   * @return Response
   */
  public function sidebar() {
    return $this->render('@backend/website/iframe/sidebar.html.twig');
  }
}