<?php

declare(strict_types=1);

namespace BytesCommerce\FileUploadField;

use ReflectionObject;
use Symfony\Component\HttpKernel\Bundle\Bundle;
use function dirname;

/**
 * @author Maximilian Graf Schimmelmann <schimmelmann@bytes-commerce.de>
 */
class FileUploadFieldBundle extends Bundle
{
    public function getPath(): string
    {
        $reflected = new ReflectionObject($this);

        return dirname($reflected->getFileName(), 2);
    }
}
