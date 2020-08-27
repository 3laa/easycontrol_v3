<?php


namespace App\Services\Template;


use App\Entity\Shop;
use App\Entity\Website;
use App\Repository\WebsiteRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Event\ControllerArgumentsEvent;

class BackendVars extends AbstractController
{
  /**
   * @var Website
   */
  private $activeWebsite;

  /**
   * @var Shop
   */
  private $activeShop;

  /**
   * @param Request $request
   */
  public function prepareBackendVars(Request $request) {
    $this->activeWebsite = $this->getDoctrine()->getRepository(Website::class)->findOneBy(array());
    $this->activeShop = $this->getDoctrine()->getRepository(Shop::class)->findOneBy(array());
  }

  public function onKernelControllerArguments(ControllerArgumentsEvent $event) {
    $this->prepareBackendVars($event->getRequest());
  }

  /**
   * @return Website
   */
  public function getActiveWebsite(): Website
  {
    return $this->activeWebsite;
  }

  /**
   * @param Website $activeWebsite
   */
  public function setActiveWebsite(Website $activeWebsite): void
  {
    $this->activeWebsite = $activeWebsite;
  }

  /**
   * @return Shop
   */
  public function getActiveShop(): Shop
  {
    return $this->activeShop;
  }

  /**
   * @param Shop $activeShop
   */
  public function setActiveShop(Shop $activeShop): void
  {
    $this->activeShop = $activeShop;
  }


}