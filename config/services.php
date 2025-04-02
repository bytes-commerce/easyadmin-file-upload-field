<?php

declare(strict_types=1);

namespace Symfony\Component\DependencyInjection\Loader\Configurator;

use BytesCommerce\FileUploadField\Field\Configurator\FileConfigurator;
use BytesCommerce\FileUploadField\Field\FileField;
use BytesCommerce\FileUploadField\Subscriber\TemplateRegisterSubscriber;

return static function (ContainerConfigurator $container) {
    $services = $container->services()
        ->defaults()
        ->private();

    $services
        ->set(FileField::class);

    $services
        ->set(TemplateRegisterSubscriber::class)
        ->tag('kernel.event_subscriber');
};
