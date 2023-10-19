<?php

namespace App\Controller;

use App\Repository\FormationsRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class SitemapController extends AbstractController
{
    #[Route('/sitemap.xml', name: 'app_sitemap', defaults: ['_format' => 'xml'])]
    public function index(
        Request $request,
        FormationsRepository $formationRepo,
    ): Response {
        $hostname = $request->getSchemeAndHttpHost();
        $urls = [];
        $urls[] = ['loc' => $this->  generateUrl('exana_home')];
        //$urls[] = ['loc' => $this->generateUrl('whereweare')];
        $urls[] = ['loc' => $this->generateUrl('contact')];
        $urls[] = ['loc' => $this->generateUrl('formations')];
        //$urls[] = ['loc' => $this->generateUrl('whoweare')];
        $urls[] = ['loc' => $this->generateUrl('recrutement')];
        $urls[] = ['loc' => $this->generateUrl('app_login')];
        $urls[] = ['loc' => $this->generateUrl('mention')];

        foreach ($formationRepo->findAll() as $formation) {
            $lastmod = $formation->getCreatedAt() ? $formation->getCreatedAt()->format('Y-m-d') : '';
            $urls[] = [
                'loc' => $this->generateUrl('formation', ['id' => $formation->getId(),'slug' => $formation->getSlug()]),
                'lastmod' => $lastmod,
            ];

            $urls[] = [
                'loc' => $this->generateUrl('add_participant', ['id' => $formation->getId()]),
                'lastmod' => $lastmod,  // ou définissez une autre date pertinente pour 'lastmod', si nécessaire
            ];
        }
        
        

        $response = new Response(
            $this->renderView('sitemap/index.html.twig', [
                'urls' => $urls,
                'hostname' => $hostname
            ]),
            200
        );

        $response->headers->set('Content-type', 'text/xml');

        return $response;
    }
}
