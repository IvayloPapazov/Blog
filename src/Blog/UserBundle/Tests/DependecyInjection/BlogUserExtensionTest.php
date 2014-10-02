<?php

namespace Blog\UserBundle\Test\DependencyInjection;

use Matthias\SymfonyDependencyInjectionTest\PhpUnit\AbstractExtensionTestCase;
use Blog\UserBundle\DependencyInjection\BlogUserExtension;

class BlogPostExtensionTest extends AbstractExtensionTestCase
{
    protected function getContainerExtensions()
    {
        return array(
            new BlogUserExtension()
        );
    }

    public function testAfterLoadingTheCorrectParameterHasBeenSet()
    {
        $this->load();

        $this->assertContainerBuilderHasParameter('parameter_name', 'some value');
    }
}
