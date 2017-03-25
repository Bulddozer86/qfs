<?php

namespace QFS\BusinessLogicBundle\Controller;

use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Routing\ClassResourceInterface;
use QFS\BusinessLogicBundle\Resources\Classes\GridData;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FOS\RestBundle\View\View;
use FOS\RestBundle\Controller\Annotations;
use FOS\RestBundle\View\RouteRedirectView;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\FormTypeInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;


class PageController extends FOSRestController implements ClassResourceInterface
{
    const STEP = 4;

    /**
     *
     * @return mixed
     *
     * @ApiDoc(
     *     statusCodes={
     *         200 = "Returned when successful",
     *         404 = "Return when not found"
     *     }
     * )
     */
    public function indexAction()
    {
        return [1 => "hello", 2 => "world"];
        $flats = $this->get('doctrine_mongodb')
          ->getManager()
          ->getRepository('DBLogicBundle:Flat')
          ->findBy(['date' => ['$gte' => mktime(date('H') - 48)]]);

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
//
//  public function detailAction($id)
//  {
//    $flat = $this->get('doctrine_mongodb')
//      ->getManager()
//      ->getRepository('DBLogicBundle:Flat')
//      ->findOneBy(['hash' => ['$eq' => $id]]);
//
//    return $this->render('BusinessLogicBundle:Flats:detail.html.twig', ['flat' => $flat]);
//  }
}
