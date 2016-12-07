<?php
namespace Acme\SocialNetworkBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\DateTime;

/**
 * Created by PhpStorm.
 * User: vayken
 * Date: 10/08/2015
 * Time: 19:55
 */
class UserType extends AbstractType {

    function buildForm(FormBuilderInterface $builder, array $options){
        $builder->add('firstName', 'text', array(
            'attr' => array('placeHolder' => 'First name')
        ));
        $builder->add('lastName', 'text', array(
            'attr' => array('placeHolder' => 'Last name')
        ));
        $builder->add('email', 'repeated', array(
            'type' => 'email',
            'required' => true,
            'invalid_message' => 'The email addresses do not match.',
            'first_options'  => array('attr' => array('placeHolder' => 'Email')),
            'second_options' => array('attr' => array('placeHolder' => 'Re-enter Email address')),
        ));
        $builder->add('mobile', 'number', array(
            'attr' => array('placeHolder' => 'Mobile number(Optional)'),
            'required' => false,
        ));
        $builder->add('password', 'password', array(
            'attr' => array('placeHolder' => 'New password')
        ));
        $builder->add('birthDay', 'birthday', array(
            'label' => "Birthday",
            'empty_value' => array('year' => 'Year', 'month' => 'Month', 'day' => 'Day'),
            'required' => true,
            'years' => range(2015, 1905),
        ));
        $builder->add('gender', 'choice', array(
            'choices' => array('m' => 'Male', 'f' => 'Female'),
            'required' => true,
            'multiple' => false,
            'expanded' => true
        ));
        $builder->add('signUp', 'submit', array(
            'label' => 'Sign Up',
        ));
    }


    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Acme\SocialNetworkBundle\Entity\User',
        ));
    }

    /**
     * Returns the name of this type.
     *
     * @return string The name of this type
     */
    public function getName()
    {
        return 'userType';
    }
}