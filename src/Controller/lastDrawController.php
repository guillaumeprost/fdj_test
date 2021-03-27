<?php
namespace App\Controller;

use App\Service\DrawService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;

/**
 * Class lastDrawController
 * @package App\Controller
 *
 * @Route("/dernier-tirage", name="app_last_draw")
 */
class lastDrawController extends AbstractController
{
    /**
     * @param DrawService $drawService
     * @return Response
     *
     * @throws ClientExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ServerExceptionInterface
     * @throws TransportExceptionInterface
     */
    public function __invoke(DrawService $drawService): Response
    {
        $viewModel = new \LastDrawViewModel();

        try{
            $viewModel->addDraws($drawService->getLastDraw());
        } catch (\Exception $exception) {
            //A logger
            $viewModel->setError($exception->getMessage());
        }

        return $this->render('lastDraw/index.html.twig', ['vm' => $viewModel]);
    }
}