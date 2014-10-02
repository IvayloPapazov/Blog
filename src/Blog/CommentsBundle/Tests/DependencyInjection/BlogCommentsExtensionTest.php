<?php

namespace Blog\CommentsBundle\Test\DependencyInjection;

use Matthias\SymfonyDependencyInjectionTest\PhpUnit\AbstractExtensionTestCase;
use Blog\CommentsBundle\DependencyInjection\BlogCommentsExtension;

class BlogCommentsExtensionTest extends AbstractExtensionTestCase
{
    protected function getContainerExtensions()
    {
        return array(
            new BlogCommentsExtension()
        );
    }

    public function testAfterLoadingTheCorrectParameterHasBeenSet()
    {
        $this->load();

        $this->assertContainerBuilderHasParameter('parameter_name', 'some value');
    }
}
