<?php


namespace App\Controller\Backend\Website;


use App\Entity\Page;
use App\Repository\PageRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class PageController
 * @package App\Controller\Backend\Website
 * @Route("/page", name="page_")
 */
class PageController extends AbstractController
{

  /**
   * @var EntityManagerInterface
   */
  private $entityManager;

  /**
   * @var PageRepository
   */
  private $pageRepository;

  /**
   * PageController constructor.
   * @param EntityManagerInterface $entityManager
   * @param PageRepository $pageRepository
   */
  public function __construct(EntityManagerInterface $entityManager, PageRepository $pageRepository)
  {
    $this->entityManager = $entityManager;
    $this->pageRepository = $pageRepository;
  }


  /**
   * @param Page $page
   * @return JsonResponse
   * @Route("/update-active/{page}", name="update-active")
   */
  public function updateActive(Page $page) {
    $page->setisActive(!$page->getisActive());
    $this->entityManager->flush();
    return $this->json(['response'=>true], Response::HTTP_OK);
  }

}