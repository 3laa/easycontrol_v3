<?php


namespace App\Controller\Backend\Website;


use App\Entity\Page;
use App\Repository\PageRepository;
use App\Services\Template\BackendVars;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
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
   * @Route("/update-active-json/{page}", name="update-active-json")
   */
  public function updateActive(Page $page) {
    $page->setisActive(!$page->getisActive());
    $this->entityManager->flush();
    return $this->json(['response'=>true], Response::HTTP_OK);
  }

  /**
   * @param Request $request
   * @Route("/update-sort-json", name="update-sort-json")
   * @return JsonResponse
   */
  public function updateSort(Request $request) {
    $pagesSortArray = $request->get('item');
    foreach ($pagesSortArray as $key=>$pageToSort) {
      $page = $this->pageRepository->findOneBy(['id' => intval($pageToSort['id'])]);
      $page->setSort(intval($key));
    }
    $this->entityManager->flush();
    return $this->json(['response' => true], Response::HTTP_OK);
  }


  /**
   * @param Page $page
   * @Route("/delete-json/{page}", name="delete-json", methods={"DELETE"})
   */
  public function delete(Page $page) {
    $this->entityManager->remove($page);
    $this->entityManager->flush();
    return $this->json(['response' => true], Response::HTTP_OK);
  }


  /**
   * @param Request $request
   * @param BackendVars $backendVars
   * @return JsonResponse
   * @Route("/add-json", name="add-json")
   */
  public function add(Request $request, BackendVars $backendVars) {
    $page = new Page();
    $page->setWebsite($backendVars->getActiveWebsite());
    $page->setPage($this->pageRepository->findOneBy(['id'=>intval($request->get('parent'))]));
    $page->setName($request->get('name'));
    $this->entityManager->persist($page);
    $this->entityManager->flush();
    return $this->json(['response' => true], Response::HTTP_OK);
  }

  /**
   * @param Request $request
   * @param Page $page
   * @return JsonResponse
   * @Route("/update-name-json/{page}", name="update-name-json")
   */
  public function edit(Page $page, Request $request) {
    $page->setName($request->get('name'));
    $this->entityManager->flush();
    return $this->json(['response' => true], Response::HTTP_OK);
  }

}