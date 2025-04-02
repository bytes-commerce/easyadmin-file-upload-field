<?php

declare(strict_types=1);

namespace BytesCommerce\FileUploadField\Field;

use EasyCorp\Bundle\EasyAdminBundle\Config\Asset;
use EasyCorp\Bundle\EasyAdminBundle\Config\Option\TextAlign;
use EasyCorp\Bundle\EasyAdminBundle\Contracts\Field\FieldInterface;
use EasyCorp\Bundle\EasyAdminBundle\Field\FieldTrait;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Form\Type\FileUploadType;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Contracts\Translation\TranslatableInterface;

/**
 * @author Maximilian Graf Schimmelmann <schimmelmann@bytes-commerce.de>
 */
class FileField implements FieldInterface
{
    use FieldTrait;

    public const OPTION_BASE_PATH = 'basePath';

    public const OPTION_UPLOAD_DIR = 'uploadDir';

    public const OPTION_UPLOADED_FILE_NAME_PATTERN = 'uploadedFileNamePattern';

    public const OPTION_FILE_CONSTRAINTS = 'fileConstraints';

    public static function new(TranslatableInterface|string|false|null $propertyName, $label = null): self
    {
        return (new self())
            ->setProperty($propertyName)
            ->setLabel($label)
            ->setTemplateName('crud/field/file')
            ->setFormType(FileUploadType::class)
            ->addCssClass('field-image')
            ->addJsFiles(
                Asset::fromEasyAdminAssetPackage('field-image.js'),
                Asset::fromEasyAdminAssetPackage('field-file-upload.js'),
            )->setDefaultColumns('col-md-7 col-xxl-5')
            ->setTextAlign(TextAlign::CENTER)
            ->setCustomOption(ImageField::OPTION_BASE_PATH, null)
            ->setCustomOption(ImageField::OPTION_UPLOAD_DIR, null)
            ->setCustomOption(ImageField::OPTION_UPLOADED_FILE_NAME_PATTERN, '[name].[extension]')
            ->setCustomOption(ImageField::OPTION_FILE_CONSTRAINTS, [new File()]);
    }

    public function setBasePath(string $path): self
    {
        $this->setCustomOption(self::OPTION_BASE_PATH, $path);

        return $this;
    }

    public function setUploadDir(string $uploadDirPath): self
    {
        $this->setCustomOption(self::OPTION_UPLOAD_DIR, $uploadDirPath);

        return $this;
    }

    public function setUploadedFileNamePattern(string $patternOrCallable): self
    {
        $this->setCustomOption(self::OPTION_UPLOADED_FILE_NAME_PATTERN, $patternOrCallable);

        return $this;
    }

    /**
     * @param Constraint|array<Constraint> $constraints
     */
    public function setFileConstraints(array $constraints): self
    {
        $this->setCustomOption(self::OPTION_FILE_CONSTRAINTS, $constraints);

        return $this;
    }
}
