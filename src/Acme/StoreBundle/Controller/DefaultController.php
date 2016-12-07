<?php

namespace Acme\StoreBundle\Controller;

use Acme\StoreBundle\Entity\Product;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    public function indexAction($name)
        {
            $product = new Product();
            $product->setName("bike");
            $validator = $this->get('validator');
            $errorList = $validator->validate($product);
            if(count($errorList) > 0) {
                return new Response(print_r($errorList, true));
            }
        return $this->render('AcmeStoreBundle:Default:index.html.twig', array('name' => $name));
    }
}
