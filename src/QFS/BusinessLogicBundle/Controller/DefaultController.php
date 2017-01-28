<?php

namespace QFS\BusinessLogicBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
  const STEP = 3;

  public function indexAction()
  {
    $flats = $this->get('doctrine_mongodb')
                  ->getManager()
                  ->getRepository('DBLogicBundle:Flat')
                  ->findBy(['date' => ['$gte' => mktime(date('H') - 12)]]);
    $colKeys1[] = $c1 = 0;
    $colKeys2[] = $c2 = 1;
    $colKeys3[] = $c3 = 2;

    $rows  = round(count($flats) / self::STEP, 0, PHP_ROUND_HALF_UP);

    for($i = 1; $i <= $rows; $i++) {
      $colKeys1[] = $c1 += self::STEP;
      $colKeys2[] = $c2 += self::STEP;
      $colKeys3[] = $c3 += self::STEP;
    }

    $col1 = [];
    $col2 = [];
    $col3 = [];

    foreach ($flats as $k => $v) {
      if (in_array($k, $colKeys1)) {
        $col1[] = $v;
        continue;
      }

      if (in_array($k, $colKeys2)) {
        $col2[] = $v;
        continue;
      }

      if (in_array($k, $colKeys3)) {
        $col3[] = $v;
        continue;
      }
    }

    return $this->render('BusinessLogicBundle:Flats:flats.html.twig', [
      'col1' => $col1,
      'col2' => $col2,
      'col3' => $col3
    ]);
  }
}
