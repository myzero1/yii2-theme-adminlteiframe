Modal CRUD Gii templates for Yii2 framework
=================

## Description

This generator generates, controller and views that allow you to edit and view the data in the modal windows.
Uses the Bootstrap Modals. 

## Installation

The preferred way to install this extension is through [composer](http://getcomposer.org/download/). 

To install, either run

```
$ php composer.phar require conquer/gii-modal "*"
```
or add

```
"conquer/gii-modal": "*"
```

to the ```require``` section of your `composer.json` file.

## Usage

Add to config file:

```php
if (YII_ENV_DEV) {

    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',      
        'allowedIPs' => ['127.0.0.1', '::1'],  
        'generators' => [
            'modal_crud' => [ // generator name
                'class' => 'app\themes\adminlteiframe\giimodal\templates\crud\Generator', // generator class
            ]
        ],
    ]; 
}
```

## License

**conquer/gii-modal** is released under the MIT License. See the bundled `LICENSE.md` for details.
