<?php

namespace Blog\PostBundle\Test\DependencyInjection;

use Matthias\SymfonyDependencyInjectionTest\PhpUnit\AbstractExtensionTestCase;
use Blog\PostBundle\DependencyInjection\BlogPostExtension;

class BlogPostExtensionTest extends AbstractExtensionTestCase
{
    protected function getContainerExtensions()
    {
        return array(
            new BlogPostExtension()
        );
    }

    public function testAfterLoadingTheCorrectParameterHasBeenSet()
    {
        $this->load();

        $this->assertContainerBuilderHasParameter('parameter_name', 'some value');
    }
}
