<?php

declare(strict_types=1);

namespace BytesCommerce\FileUploadField\Subscriber;

use EasyCorp\Bundle\EasyAdminBundle\Event\BeforeCrudActionEvent;
use EasyCorp\Bundle\EasyAdminBundle\Registry\TemplateRegistry;
use ReflectionClass;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

final readonly class TemplateRegisterSubscriber implements EventSubscriberInterface
{
    public static function getSubscribedEvents(): array
    {
        return [
            BeforeCrudActionEvent::class => 'onBeforeCrudAction',
        ];
    }

    public function onBeforeCrudAction(BeforeCrudActionEvent $actionEvent): void
    {
        $context = $actionEvent->getAdminContext();
        $reflectionClass = new ReflectionClass($context);
        $reflectionProperty = $reflectionClass->getProperty('templateRegistry');
        $reflectionProperty->setAccessible(true);
        /** @var ?TemplateRegistry $value */
        $templateRegistry = $reflectionProperty->getValue($context);
        if ($templateRegistry instanceof TemplateRegistry) {
            $reflectionClass = new ReflectionClass($templateRegistry);
            $reflectionProperty = $reflectionClass->getProperty('templates');
            $reflectionProperty->setAccessible(true);
            $value = $reflectionProperty->getValue($templateRegistry);
            $templateName = 'crud/field/file';
            $templatePath = '@FileUploadField/crud/field/file.html.twig';
            $value[$templateName] = $templatePath;
            $reflectionProperty->setValue($templateRegistry, $value);
            $templateRegistry->setTemplate($templateName, $templatePath);
        }
    }
}
