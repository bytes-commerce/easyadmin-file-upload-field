<?php

declare(strict_types=1);

namespace BytesCommerce\FileUploadField\Tests\DependencyInjection;

use BytesCommerce\FileUploadField\DependencyInjection\FileUploadFieldExtension;
use BytesCommerce\FileUploadField\Field\Configurator\FileConfigurator;
use BytesCommerce\FileUploadField\Subscriber\TemplateRegisterSubscriber;
use PHPUnit\Framework\TestCase;
use Symfony\Component\DependencyInjection\ContainerBuilder;

final class FileUploadFieldExtensionTest extends TestCase
{
    public function testLoadAddsServiceDefinitions(): void
    {
        $container = new ContainerBuilder();
        $extension = new FileUploadFieldExtension();

        $extension->load([], $container);

        $definitions = $container->getDefinitions();

        $this->assertNotEmpty(
            $definitions,
            'Expected at least one service definition to be added to the container.'
        );

        $this->assertTrue($container->hasDefinition(TemplateRegisterSubscriber::class), sprintf('The expected service "%s" is not defined.', TemplateRegisterSubscriber::class));
        $this->assertTrue($container->hasDefinition(FileConfigurator::class), sprintf('The expected service "%s" is not defined.', FileConfigurator::class));
    }
}
