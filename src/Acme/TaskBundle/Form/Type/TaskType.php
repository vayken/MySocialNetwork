<?php
namespace Acme\TaskBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Created by PhpStorm.
 * User: vayken
 * Date: 09/08/2015
 * Time: 19:23
 */

class TaskType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options){
        $builder->add('task', 'text', array('max_length' => 5));
        $builder->add('dueDate', 'date');
        $builder->add('category', new CategoryType());
        $builder->add('save', 'submit');
    }


    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Acme\TaskBundle\Entity\TaskUnit',
            'cascade_validation' => true
        ));
    }

    public function getName(){
        return 'task';
    }
}