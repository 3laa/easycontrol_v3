<?php


namespace App\Controller\Backend;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class IframeController
 * @package App\Controller\Backend
 * @Route("/widget", name="widget_")
 */
class WidgetController extends AbstractController
{

  /**
   * @Route("/sidebar", name="sidebar")
   * @return Response
   */
  public function sidebar() {
    return $this->render('@backend/widget/sidebar.html.twig');
  }
}