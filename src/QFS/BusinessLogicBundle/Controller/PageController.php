<?php

namespace QFS\BusinessLogicBundle\Controller;

use QFS\BusinessLogicBundle\Resources\Classes\GridData;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class PageController extends Controller
{
    const STEP = 4;

    public function indexAction()
    {
//        $repositoryManager = $this->container->get('fos_elastica.manager');
//
//        /** var FOS\ElasticaBundle\Repository */
//        $repository = $repositoryManager->getRepository('DBLogicBundle:Flat');
//
//        /** var array of Acme\UserBundle\Entity\User */
//        $users = $repository->find('Ставова');
//        var_dump($users);
//        die();
        $flats = $this->get('doctrine_mongodb')
          ->getManager()
          ->getRepository('DBLogicBundle:Flat')
          ->findLatestItems();

        $grid = new GridData($flats, self::STEP);
        $grid->getGridData();

        return $this->render(
          'BusinessLogicBundle:Flats:flats.html.twig',
          [
            'data' => $grid->getGridData(),
            'column' => $grid->getColumn(),
          ]
        );
    }

    public function detailAction($id)
    {
        $flat = $this->get('doctrine_mongodb')
          ->getManager()
          ->getRepository('DBLogicBundle:Flat')
          ->findByHash($id);

        return $this->render('BusinessLogicBundle:Flats:detail.html.twig', ['flat' => $flat]);
    }
}
