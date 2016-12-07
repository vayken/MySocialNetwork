<?php

namespace Acme\TaskBundle\Controller;

use Acme\TaskBundle\Entity\TaskUnit;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    public function indexAction(Request $request)
    {
        $task = new TaskUnit();
        $task->setTask('Write a blog post');
        $task->setDueDate(new \DateTime('tomorrow'));

        $form = $this->createForm('task', $task);

        $form->handleRequest($request);
        if($form->isValid()){
            $nextAction = $form->get('save')->isClicked() ? 'task_new' : 'task_success';

            return $this->redirect($this->generateUrl($nextAction));
        }
        return $this->render('AcmeTaskBundle:Default:index.html.twig', array('form' => $form->createView()));
    }
}
