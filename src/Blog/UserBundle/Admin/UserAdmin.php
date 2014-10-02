<?php

namespace Blog\UserBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;

class UserAdmin extends Admin
{
    // Fields to be shown on create/edit forms
    protected function configureFormFields(FormMapper $formMapper)
    {

        $formMapper
            ->add('username', 'text', array('label' => 'Username'))
            ->add('email', 'text')
            ->add('firstName', 'text')
            ->add('lastName', 'text')
            ->add('file', 'file')
            ->add('password', 'password')
            ->add('is_active', 'choice', array('choices' => array(1 => 1, 2 => 0)))
            // ->add('roles', 'sonata_security_roles', array('multiple' => true))
        ;
    }

    // Fields to be shown on filter forms
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('username')
            ->add('roles')
        ;
    }

    // Fields to be shown on lists
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('username')
            ->add('firstName')
            ->add('lastName')
            ->add('email')
            ->add('roles')
            ->add('is_active')
        ;
    }
}
