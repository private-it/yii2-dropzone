Dropzone Extension for Yii 2
==============================

This extension provides the [Dropzone](http://www.dropzonejs.com/) integration for the Yii2 framework.

Information
-----------

This repository is fork from [DevGroup-ru/yii2-dropzone](https://github.com/DevGroup-ru/yii2-dropzone)

Installation
------------

Run composer 

```
composer require --prefer-dist private-it/yii2-dropzone "*"
```

General Usage
-------------

Config file:
```php
...
'bootstrap' => [
    'dropZone' => [
        'class' => \devgroup\dropzone\DropZoneBootstrap::className(),
        'autoRegisterAssets' => true,
        'autoRegisterController' => true,
    ]
],
...
```



View file:

```php
<?= \devgroup\dropzone\DropZone::widget([
    'name' => 'file',
    'options' => [
        'addRemoveLinks' => true,
        // translate options:
        // 'dictRemoveFile' => '',
        // 'dictRemoveFileConfirmation' => '',
        // 'dictDefaultMessage' => '',
    ],
    'registerEventRemovedFile' => true,
]) ?>
```

`addRemoveLinks` - flag for enable link "Remove file"

`registerEventRemovedFile` - flag for attache default event for remove file from server 
