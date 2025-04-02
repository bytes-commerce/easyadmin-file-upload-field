[![BytesCommerce QA Pipeline](https://github.com/bytes-commerce/easyadmin-file-upload-field/actions/workflows/ci.yaml/badge.svg)](https://github.com/bytes-commerce/easyadmin-file-upload-field/actions/workflows/ci.yaml)


### Finally upload files via backend of EasyAdmin

Long gone are the times where you cannot easily upload files trough an easy-admin backend CRUD controller!

Now with this little adaption its very easy to implement a file upload field in your EasyAdmin backend.

### How to use it

1. Install the package via composer
```bash
composer require bytescommerce/easyadmin-file-upload-field
```

2. Add a File Field to your EasyAdmin CRUD controller
```php
use BytesCommerce\FileUploadField\Field\FileField;

yield FileField::new('filename', t('File'))
    ->setBasePath(sprintf('%s', File::BASE_FILE_PATH))
    ->setUploadDir(sprintf('public/%s', File::BASE_FILE_PATH))
    ->setUploadedFileNamePattern('[name].[extension]')
    ->setColumns('col-sm-12 col-md-6');
``` 

And you're done.

Proudly presented by [Bytes Commerce](https://bytescommerce.com) :sparkle:

