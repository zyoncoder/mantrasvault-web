<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;


class DefaultController extends AbstractController
{

    /**
     *
     * @Route("/", name="homepage")
     */
    public function index() {
        $usr= $this->get('security.token_storage')->getToken()->getUser();
        dump($usr);

        return new Response(
            '<html><body>Lucky number: </body></html>'
        );
    }
}