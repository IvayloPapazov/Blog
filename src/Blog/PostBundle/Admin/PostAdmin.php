<?php

namespace Blog\PostBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

class PostAdmin extends Admin
{

    // Fields to be shown on create/edit forms
    protected function configureFormFields(FormMapper $formMapper)
    {

        $formMapper
            ->add('title', 'text', array('label' => 'Post Title'))
            ->add('content', 'text')
            ->add('file', 'file')
            ->with('Tags')
                ->add('tags', 'sonata_type_model', array('expanded' => false, 'multiple' => true))
            ->end()
            ->with('Comments')
                ->add('comment', 'sonata_type_collection')
            ->end()
        ;
    }

    // Fields to be shown on filter forms
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('user')
            ->add('tags', null, array('field_options' => array('expanded' => true, 'multiple' => true)))
        ;
    }

    // Fields to be shown on lists
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('date')
            ->addIdentifier('title')
            ->add('content')
            ->add('tags')
            ->add('user')
            ->add('_action', 'actions', array(
                'actions' => array(
                    'show' => array(),
                    'edit' => array(),
                    'delete' => array(),
                )
            ))
        ;
    }

    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper

            ->add('date')
            ->add('Title')
            ->add('Content')
            ->with('Tags')
                ->add('tags')
            ->end()
            ->add('user', 'sonata_type_collection', array('label' => 'Created by:'))
            ->with('Comments')
                ->add('comment')
            ->end()
        ;

    }
}
