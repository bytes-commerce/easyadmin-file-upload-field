<?php

declare(strict_types=1);

namespace BytesCommerce\FileUploadField\Tests\Field;

use BytesCommerce\FileUploadField\Field\FileField;
use EasyCorp\Bundle\EasyAdminBundle\Form\Type\FileUploadType;
use EasyCorp\Bundle\EasyAdminBundle\Config\Option\TextAlign;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Validator\Constraints\File;

final class FileFieldTest extends TestCase
{
    public function testNewMethodDefaultOptions(): void
    {
        $propertyName = 'myProperty';
        $label = 'My Label';
        $field = FileField::new($propertyName, $label);

        $this->assertEquals($propertyName, $field->getAsDto()->getPropertyNameWithSuffix());
        $this->assertEquals($label, $field->getAsDto()->getLabel());

        $this->assertEquals('crud/field/file', $field->getAsDto()->getTemplateName());
        $this->assertEquals(FileUploadType::class, $field->getAsDto()->getFormType());

        $this->assertSame('field-image', $field->getAsDto()->getCssClass());

        $assets = $field->getAsDto()->getAssets();
        $keys = array_keys($assets->getJsAssets());
        $this->assertContains('field-image.js', $keys);
        $this->assertContains('field-file-upload.js', $keys);

        $this->assertEquals('col-md-7 col-xxl-5', $field->getAsDto()->getDefaultColumns());
        $this->assertEquals(TextAlign::CENTER, $field->getAsDto()->getTextAlign());
        $this->assertNull($field->getAsDto()->getCustomOption(FileField::OPTION_BASE_PATH));
        $this->assertNull($field->getAsDto()->getCustomOption(FileField::OPTION_UPLOAD_DIR));
        $this->assertEquals('[name].[extension]', $field->getAsDto()->getCustomOption(FileField::OPTION_UPLOADED_FILE_NAME_PATTERN));

        $fileConstraints = $field->getAsDto()->getCustomOption(FileField::OPTION_FILE_CONSTRAINTS);
        $this->assertIsArray($fileConstraints);
        $this->assertCount(1, $fileConstraints);
        $this->assertInstanceOf(File::class, $fileConstraints[0]);
    }

    public function testSetBasePath(): void
    {
        $field = FileField::new('property', 'Label');
        $field->setBasePath('my/base/path');

        $this->assertEquals('my/base/path', $field->getAsDto()->getCustomOption(FileField::OPTION_BASE_PATH));
    }

    public function testSetUploadDir(): void
    {
        $field = FileField::new('property', 'Label');
        $field->setUploadDir('my/upload/dir');

        $this->assertEquals('my/upload/dir', $field->getAsDto()->getCustomOption(FileField::OPTION_UPLOAD_DIR));
    }

    public function testSetUploadedFileNamePattern(): void
    {
        $field = FileField::new('property', 'Label');
        $pattern = 'custom-pattern.[extension]';
        $field->setUploadedFileNamePattern($pattern);

        $this->assertEquals($pattern, $field->getAsDto()->getCustomOption(FileField::OPTION_UPLOADED_FILE_NAME_PATTERN));
    }

    public function testSetFileConstraints(): void
    {
        $field = FileField::new('property', 'Label');
        $constraints = [new File(['maxSize' => '5M'])];
        $field->setFileConstraints($constraints);

        $this->assertSame($constraints, $field->getAsDto()->getCustomOption(FileField::OPTION_FILE_CONSTRAINTS));
    }
}
