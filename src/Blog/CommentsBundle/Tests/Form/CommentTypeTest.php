<?php

namespace Blog\CommentsBundle\Tests\Form;

use Blog\CommentsBundle\Form\CommentsType;
use Symfony\Component\Form\Test\TypeTestCase;

class CommentTypeTest extends TypeTestCase
{
    public function testForm()
    {
         $formData = array(
            'content' => 'Content'
        );

        $type = new CommentsType();
        $form = $this->factory->create($type);

        $form->submit($formData);

        $this->assertTrue($form->isSynchronized());

        $view = $form->createView();
        $children = $view->children;

        foreach (array_keys($formData) as $key) {
            $this->assertArrayHasKey($key, $children);
        }
    }
}
