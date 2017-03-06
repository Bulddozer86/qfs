<?php

namespace QFS\BusinessLogicBundle\Controller;

use QFS\BusinessLogicBundle\Resources\Classes\GridData;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class PageController extends Controller
{
  const STEP = 3;

  public function indexAction()
  {
    $flats = $this->get('doctrine_mongodb')
                  ->getManager()
                  ->getRepository('DBLogicBundle:Flat')
                  ->findBy(['date' => ['$gte' => mktime(date('H') - 48)]]);

    $grid = new GridData($flats, self::STEP);
    $grid->getGridData();

    return $this->render('BusinessLogicBundle:Flats:flats.html.twig', [
      'data' => $grid->getGridData(),
      'column' => $grid->getColumn()
    ]);
  }

  public function detailAction($id)
  {
    $flat = $this->get('doctrine_mongodb')
      ->getManager()
      ->getRepository('DBLogicBundle:Flat')
      ->findOneBy(['hash' => ['$eq' => $id]]);

    return $this->render('BusinessLogicBundle:Flats:detail.html.twig', ['flat' => $flat]);
  }
}
