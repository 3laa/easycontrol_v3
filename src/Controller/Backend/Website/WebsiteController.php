<?php


namespace App\Controller\Backend\Website;


use App\Entity\Website;
use App\Form\Backend\Website\Entity\WebsiteType;
use App\Repository\WebsiteRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class WebsiteController
 * @package App\Controller\Backend\Website
 * @Route("/website", name="website_")
 */
class WebsiteController extends AbstractController
{

  /**
   * @var WebsiteRepository
   */
  private $websiteRepository;

  /**
   * @var EntityManagerInterface
   */
  private $entityManager;

  /**
   * WebsiteController constructor.
   * @param WebsiteRepository $websiteRepository
   * @param EntityManagerInterface $entityManager
   */
  public function __construct(WebsiteRepository $websiteRepository, EntityManagerInterface $entityManager)
  {
    $this->websiteRepository = $websiteRepository;
    $this->entityManager = $entityManager;
  }

  /**
   * @Route("/get-websites", name="get-websites")
   */
  public function getWebsites() {
    return $this->json($this->websiteRepository->findAll(), Response::HTTP_OK);
  }

  /**
   * @Route("/get-website/{website}", name="get-website")
   * @param Website $website
   * @return JsonResponse
   */
  public function getWebsite(Website $website) {
    return $this->json($website, Response::HTTP_OK);
  }

  /**
   * @Route("/edit-website/{website}", name="edit-website")
   * @param Request $request
   * @param Website $website
   */
  public function editWebsite(Request $request, Website $website) {
    $form = $this->createForm(WebsiteType::class, $website);
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
      $this->entityManager->flush();
    }

    return $this->render('@backend/website/website/edit.html.twig', [
        'website' => $website,
        'form' => $form->createView(),
    ]);
  }
}