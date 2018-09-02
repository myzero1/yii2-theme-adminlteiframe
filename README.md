yii2-theme-adminlteiframe
========================
It add iframe,based on [almasaeed2010/AdminLTE](https://github.com/almasaeed2010/AdminLTE) and [yiisoft/yii2-gii](https://github.com/yiisoft/yii2-gii)


Show time
------------

![](https://github.com/myzero1/show-time/blob/master/yii2-theme-adminlteiframe/screenshot/1.png)
![](https://github.com/myzero1/show-time/blob/master/yii2-theme-adminlteiframe/screenshot/2.png)
![](https://github.com/myzero1/show-time/blob/master/yii2-theme-adminlteiframe/screenshot/3.png)
![](https://github.com/myzero1/show-time/blob/master/yii2-theme-adminlteiframe/screenshot/4.png)
![](https://github.com/myzero1/show-time/blob/master/yii2-theme-adminlteiframe/screenshot/5.png)
![](https://github.com/myzero1/show-time/blob/master/yii2-theme-adminlteiframe/screenshot/6.png)
![](https://github.com/myzero1/show-time/blob/master/yii2-theme-adminlteiframe/screenshot/7.png)
![](https://github.com/myzero1/show-time/blob/master/yii2-theme-adminlteiframe/screenshot/8.png)
![](https://github.com/myzero1/show-time/blob/master/yii2-theme-adminlteiframe/screenshot/9.png)
![](https://github.com/myzero1/show-time/blob/master/yii2-theme-adminlteiframe/screenshot/10.png)

Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require-dev myzero1/yii2-theme-adminlteiframe：*
```

or add

```
"myzero1/yii2-theme-adminlteiframe": "*"
```

to the require-dev section of your `composer.json` file.


Setting
-----

Once the extension is installed, simply modify your application configuration as follows:

#### in main.php ####

```php
return [
    ......
    'components' => [
        ......
        'view' => [
            'theme' => [
                'pathMap' => [
                    // '@app/views' => '@vendor/dmstr/yii2-adminlte-asset/example-views/yiisoft/yii2-app' myzero1\theme\adminlteiframe
                    '@app/views' => '@vendor/myzero1/yii2-theme-adminlteiframe/src/views', // using the adminlteiframe theme
                ],
            ],
        ],
        'assetManager' => [
            'class' => 'yii\web\AssetManager',
            'forceCopy' => true,
            // 'linkAssets' => true,//link to assets,no cache.used in develop.
            'bundles'=> [
                'myzero1\adminlteiframe\assets\php\components\LayoutAsset' => [
                    'skin' => 'skin-blue',// skin-{blue|black|purple|green|red|yellow}[-light],example skin-blue,skin-blue-light
                ],// setting the them skin
            ],
        ],
        ......
    ],
    ......
];
```

#### in main-local.php ####

```php
...
if (YII_ENV_DEV) {
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',      
        'allowedIPs' => ['127.0.0.1', '::1'],  
        'generators' => [
            'adminlteiframe_crud' => [ // generator name
                'class' => 'myzero1\adminlteiframe\gii\templates\crud\Generator', // generator class
            ]
        ],
    ];
}
```


Usage
-----

You can then access home page to watch the theme.

```
http://localhost/path/to/index.php
```


You can then access gii page to watch the crud.

```
http://localhost/path/to/index.php?r=gii
OR
http://localhost/path/to/index.php/gii
```


#### use plugins ####

* use echart

    Just add code  as flowlling, in view:

    ```
    <?php myzero1\adminlteiframe\assets\php\components\plugins\EchartsAsset::register($this); ?>
    
    <div data-provide="echarts" id='client-chart' style="width: 100%;height:250px;" data-echarts-config="{title: {text: '折线图基本',left: 'center'}}"></div>
    
    ```

    ![](https://github.com/myzero1/show-time/blob/master/yii2-theme-adminlteiframe/screenshot/101.png)


* use datarangepicker

    Just add code  as flowlling, in view:

    ```
    <?php myzero1\adminlteiframe\assets\php\components\plugins\DataRangePickerAsset::register($this); ?>
    
    <?php echo $form->field($model, 'date')->textInput(['data-provide' =>"z1datarangepicker",'data-z1datarangepicker-config' => '{singleDatePicker: false}']) ?>
    
    ```

    ![](https://github.com/myzero1/show-time/blob/master/yii2-theme-adminlteiframe/screenshot/201.png)



