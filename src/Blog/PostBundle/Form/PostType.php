<?php

namespace Blog\PostBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Blog\PostBundle\Form\TagsType;
use Blog\PostBundle\Form\DataTransformer\TagsTransformer;

class PostType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $entityManager = $options['em'];
        $transformer = new TagsTransformer($entityManager);

        $builder
            ->add('title', 'text', array('label' => 'post.form.label.title'))
            ->add('content', 'textarea', array('label' => 'post.form.label.content'))
            ->add($builder->create('tags', 'text')->addModelTransformer($transformer))
            ->add('file', 'file', array('label' => 'post.form.label.file'))
            ->add('Save', 'submit', array('label' => 'post.form.button.save'))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Blog\PostBundle\Entity\Post'
            ))
            ->setRequired(array(
                'em',
            ))
            ->setAllowedTypes(array(
                'em' => 'Doctrine\Common\Persistence\ObjectManager',
            ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'post';
    }
}
