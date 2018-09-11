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
                    // '@app/views' => '@vendor/myzero1/yii2-theme-adminlteiframe/src/views/adminlte', // using the adminlte theme
                    '@app/views' => '@vendor/myzero1/yii2-theme-adminlteiframe/src/views/adminlteiframe', // using the adminlteiframe theme
                ],
            ],
        ],
        'assetManager' => [
            'class' => 'yii\web\AssetManager',
            'forceCopy' => true,
            // 'linkAssets' => true,//link to assets,no cache.used in develop.
            'bundles'=> [
                // 'myzero1\adminlteiframe\assets\php\components\AdminLteAsset' => [
                //     'skin' => 'skin-blue',// skin-{blue|black|purple|green|red|yellow}[-light],example skin-blue,skin-blue-light
                // ],// setting the them skin
            
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



#### select theme ####

* ` use adminlteifram `

    You show set the layout as layout in site Controller for index page,in ` SiteController  `  as flowlling, in view:

    ```
    public function actionIndex()
    {
        $this->layout = 'layout';
        return $this->render('index');
    }
    
    ```
    
    ![](https://github.com/myzero1/show-time/blob/master/yii2-theme-adminlteiframe/screenshot/1.png)

    

* ` use adminlte `

     You show replace the ` render ` by ` renderAjax ` at actionLogin,in ` SiteController  `  as flowlling, in view:

    ```
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            $model->password = '';

            return $this->renderAjax('login', [
                'model' => $model,
            ]);
        }
    }
    
    ```
    
    ![](https://github.com/myzero1/show-time/blob/master/yii2-theme-adminlteiframe/screenshot/701.png)



#### use plugins ####


* ` Add plug-ins to requirements ` 

    Just add code  as flowlling, in view:

    ```php
    
    <?php \myzero1\adminlteiframe\assets\php\components\plugins\Select2Asset::register($this); ?>
    
    ```
    
    ` Optional plug-in `
    
    ```php
    \myzero1\adminlteiframe\assets\php\components\plugins\BootstrapTableAsset::register($this);
    \myzero1\adminlteiframe\assets\php\components\plugins\DataRangePickerAsset::register($this);
    \myzero1\adminlteiframe\assets\php\components\plugins\EchartsAsset::register($this);
    \myzero1\adminlteiframe\assets\php\components\plugins\LayerAsset::register($this);
    \myzero1\adminlteiframe\assets\php\components\plugins\Select2Asset::register($this);
    \myzero1\adminlteiframe\assets\php\components\plugins\SwitchAsset::register($this);
    \myzero1\adminlteiframe\assets\php\components\plugins\Wysihtml5Asset::register($this);
    \myzero1\adminlteiframe\assets\php\components\plugins\ZtreeAsset::register($this);
    
    ```

* ` use echart `

    Just add code  as flowlling, in view:

    ```
    <?php myzero1\adminlteiframe\assets\php\components\plugins\EchartsAsset::register($this); ?>
    
    <div data-provide="z1echarts" id='client-chart' style="width: 100%;height:250px;" data-echarts-config="{title: {text: '折线图基本',left: 'center'}}"></div>
    
    ```

    ![](https://github.com/myzero1/show-time/blob/master/yii2-theme-adminlteiframe/screenshot/101.png)

*  ` use datarangepicker `

    Just add code  as flowlling, in view:

    ```
    <?php myzero1\adminlteiframe\assets\php\components\plugins\DataRangePickerAsset::register($this); ?>
    
    <?php echo $form->field($model, 'date')->textInput(['data-provide' =>"z1datarangepicker",'data-z1datarangepicker-config' => '{singleDatePicker: false}']) ?>

    Or

    <input type="text" name="username" data-provide="z1datarangepicker" data-z1datarangepicker-config="{singleDatePicker: false}" >
    
    ```

    ![](https://github.com/myzero1/show-time/blob/master/yii2-theme-adminlteiframe/screenshot/201.png)

*  ` use layer `

    Just add code  as flowlling, in view:

    ```
    <?php myzero1\adminlteiframe\assets\php\components\plugins\LayerAsset::register($this); ?>
    
    <a href="#" data-provide="z1layer" layer-config='{scrollbar:false,area:["350px","340px"],type:2,title:"联系方式",content:"/site/contact",shadeClose:false}'>联系方式</a>

    ```

    ![](https://github.com/myzero1/show-time/blob/master/yii2-theme-adminlteiframe/screenshot/301.png)

*  ` use wysihtml5 `

    Just add code  as flowlling, in view:

    ```
    <?php myzero1\adminlteiframe\assets\php\components\plugins\Wysihtml5Asset::register($this); ?>
    
    <textarea data-provide="z1wysihtml5" data-z1wysihtml5-config="{}" rows="10" cols="80"></textarea>

    ```

    ![](https://github.com/myzero1/show-time/blob/master/yii2-theme-adminlteiframe/screenshot/401.png)

*  ` use ztree `

    use ztree,in ul. You can set data-provide="z1ztree" to use it and set data-z1ztree-config='{...} to set it,you can set the primary parameter of ztree in data-z1ztree-config.  Just add code  as flowlling, in view:
    ```
    <ul id="mytes" data-provide="z1ztree" data-z1ztree-config='{data:[{ id:1, pId:0, name:"l1", open:true},{ id:2, pId:0, name:"l1", open:true},{ id:3, pId:1, name:"l2"}]}' class="ztree"></ul>

    ```
    ![](https://github.com/myzero1/show-time/blob/master/yii2-theme-adminlteiframe/screenshot/501.png)
    
    use ztree by default,in input.Just add code  as flowlling, in view:
    ```
    <?php echo $form->field($model, 'id')->textInput(['data-provide' =>"z1ztree"])?>

    ```
    ![](https://github.com/myzero1/show-time/blob/master/yii2-theme-adminlteiframe/screenshot/502.png)
    
    use ztree without parents,in input.Just add code  as flowlling, in view:
    ```
    <?php echo $form->field($model, 'id')->textInput(['data-provide' =>"z1ztree",'data-z1ztree-config' => '{"withParents": false}'])?>

    ```
    ![](https://github.com/myzero1/show-time/blob/master/yii2-theme-adminlteiframe/screenshot/503.png)
    
    use ztree by checkbox .Just add code  as flowlling, in view:
    ```
    <?php echo $form->field($model, 'id')->textInput(['data-provide' =>"z1ztree",'data-z1ztree-config' => '{"checkType": "checkbox"}'])?>

    ```
    ![](https://github.com/myzero1/show-time/blob/master/yii2-theme-adminlteiframe/screenshot/504.png)


*  ` use select2 `

    Use Single selection,Just add code  as flowlling, in view:
    ```
    <?php echo $form->field($model, 'id')->dropDownList(['n1'=>'v1','n2'=>'v2',] ,['data-provide' =>"z1select2"])?>
    
    ```
    ![](https://github.com/myzero1/show-time/blob/master/yii2-theme-adminlteiframe/screenshot/601.png)
    
    Use Multi selection,Just add code  as flowlling, in view:
    ```
   <?php echo $form->field($model, 'id')->dropDownList(['n1'=>'v1','n2'=>'v2',] ,['data-provide' =>"z1select2", "multiple"=>"multiple"])?>
    
    ```
    ![](https://github.com/myzero1/show-time/blob/master/yii2-theme-adminlteiframe/screenshot/601.png)
