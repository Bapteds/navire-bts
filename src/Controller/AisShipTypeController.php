<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\AisShipTypeRepository;
use Symfony\Component\HttpFoundation\Request;

#[Route('/aisshiptype', name:'aisshiptype')]
class AisShipTypeController extends AbstractController
{
       #[Route('/voirtous',name:'voirtous')]
       public function voirTous(AisShipTypeRepository $repo): Response{
           $aishiptype=$repo->findAll();
           return $this->render('aisshiptype/voirtous.html.twig',['aisShipTypes'=>$aishiptype]);
       }
       
       #[Route('/portscompatibles',name:'.portscompatibles')]
       public function getPortsCompatibles(Request $request, AisShipTypeRepository $repo) : Response{
           $type = $repo->find($request->get('id'));
           return $this->render('aisshiptype/portscompatibles.html.twig',['aisShipType' => $type]);
       }
}
