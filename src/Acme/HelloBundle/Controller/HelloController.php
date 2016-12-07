<?php 
namespace Acme\HelloBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class HelloController extends Controller{
	public function indexAction($name){
		$names = array('name one', 'two', 'three', 'four');
		return $this->render('AcmeHelloBundle:Hello:index.html.twig', array('name' => $name, 'names' => $names));
	}
}

?>