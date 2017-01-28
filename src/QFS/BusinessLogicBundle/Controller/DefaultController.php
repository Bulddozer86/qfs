<?php

namespace QFS\BusinessLogicBundle\Controller;

use QFS\BusinessLogicBundle\Resources\Classes\GridData;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
  const STEP = 4;

  public function indexAction()
  {
    $flats = $this->get('doctrine_mongodb')
                  ->getManager()
                  ->getRepository('DBLogicBundle:Flat')
                  ->findBy(['date' => ['$gte' => mktime(date('H') - 12)]]);

    $grid = new GridData($flats, self::STEP);
    $grid->getGridData();

    $backgrounds = [
      '65, 65, 65',
      '255, 111, 66',
      '29, 135, 228',
      '0, 171, 192',
      '140, 109, 98',
      '103, 158, 55',
      '55, 141, 59',
      '91, 106, 191',
      '248, 167, 36',
      '125, 86, 193',
      '229, 57, 53',
      '119, 143, 155',
      '235, 63, 121',
      '0, 136, 122'
    ];

    return $this->render('BusinessLogicBundle:Flats:flats.html.twig', [
      'data' => $grid->getGridData(),
      'column' => 3,
      'bg' => $backgrounds
    ]);
  }
}
