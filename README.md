yii2-theme-adminlteiframe
========================
It add iframe,based on [almasaeed2010/AdminLTE](https://github.com/almasaeed2010/AdminLTE) and [yiisoft/yii2-gii](https://github.com/yiisoft/yii2-gii)


Show time
------------
![](https://github.com/myzero1/show-time/blob/master/yii2-theme-adminlteiframe/screenshot/801.png)
![](https://github.com/myzero1/show-time/blob/master/yii2-theme-adminlteiframe/screenshot/802.png)
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
    // 'defaultRoute' => '/adminlteiframe/layout', // for adminlteiframe theme
    'controllerMap' => [
        // 'adminlteiframe' => [ // for adminlteiframe theme
        //     'class' => 'myzero1\adminlteiframe\controllers\SiteController'
        // ],
        'demo' => [ // for the menu of demo
            'class' => 'myzero1\adminlteiframe\controllers\DemoController'
        ]
    ],
    'components' => [
        ......
        'view' => [
            'theme' => [
                'pathMap' => [
                    '@app/views' => '@vendor/myzero1/yii2-theme-adminlteiframe/src/views/adminlte', // using the adminlte theme
                    // '@app/views' => '@vendor/myzero1/yii2-theme-adminlteiframe/src/views/adminlteiframe', // using the adminlteiframe theme
                ],
            ],
        ],
        'assetManager' => [
            'class' => 'yii\web\AssetManager',
            'forceCopy' => true,// true/false
            /*'bundles'=> [
                'myzero1\adminlteiframe\assets\php\components\LayoutAsset' => [
                    'skin' => 'skin-red',// skin-{blue|black|purple|green|red|yellow}[-light],example skin-blue,skin-blue-light,
                    'menuRefreshTab' => false, // true,false
                    'jsVersion' => '1.7',
                    'cssVersion' => '1.7',
                ], // for adminlteiframe theme
                'myzero1\adminlteiframe\assets\php\components\AdminLteAsset' => [
                    'skin' => 'skin-red',// skin-{blue|black|purple|green|red|yellow}[-light],example skin-blue,skin-blue-light,
                    'jsVersion' => '1.7',
                    'cssVersion' => '1.7',
                ], // for adminlte theme
                'myzero1\adminlteiframe\assets\php\components\MainAsset' => [
                    'showJParticle' => 'true', // 'false'/'true', default 'true',required
                    'loginBg' => 'background:url(/login-bg32-1.jpg) no-repeat center center;background-color:#3c8dbc;background-size:cover;', // path/to/web//login-bg32.jpg
                    'errBg' => 'background:url(/xkbg-1.png) repeat-x center bottom;', // path/to/web//login-bg32.jpg
                    'footer' => '
                        <div class="pull-right hidden-xs"><b>Version</b> 1.0.2</div>
                        <strong>Copyright © 2018-2736 &nbsp;
                            <a href="https://github.com/myzero1/yii2-theme-adminlteiframe">myzero1</a>.
                        </strong>
                        All rights reserved.
                    ',
                ], // for all theme
            ],*/
        ],
        ......
    ],
    ......
    'params' => [
        ......
        'menu' => [
            [
                'id' => "平台首页",
                'text' => "平台首页",
                'title'=>"平台首页",
                'icon' => "fa fa-dashboard",
                'targetType' => 'iframe-tab',
                'urlType' => 'abosulte',
                'url' => ['/site/index'],
                'isHome' => true,
            ],
            [
                'id' => "level1",
                'text' => "level1",
                'title'=>"level1",
                'icon' => "fa fa-dashboard",
                'targetType' => 'iframe-tab',
                'urlType' => 'abosulte',
                'url' => ['/demo/level1'],
            ],
            [
                'id' => "level2",
                'text' => "level2",
                'title'=>"level2",
                'icon' => "fa fa-laptop",
                'url' => ['#'],
                'children' => [
                    [
                        'id' => "level21",
                        'text' => "level21",
                        'title'=>"level21",
                        'icon' => "fa fa-angle-double-right",
                        'targetType' => 'iframe-tab',
                        'urlType' => 'abosulte',
                        'url' => ['/demo/level21'],
                    ],
                    [
                        'id' => "level22",
                        'text' => "level22",
                        'title'=>"level22",
                        'icon' => "fa fa-angle-double-right",
                        'targetType' => 'iframe-tab',
                        'urlType' => 'abosulte',
                        'url' => ['/demo/level22'],
                    ],
                ],
            ],
        ],
    ],
        ......
    ],
    ......
    
];
```

#### in main-local.php ####

```php
......
if (YII_ENV_DEV) {
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',      
        'allowedIPs' => ['127.0.0.1', '::1'],  
        'generators' => [
            'adminlteiframe_crud' => [ // generator name
                'class' => 'myzero1\adminlteiframe\gii\templates\crud\Generator', // generator class
                'templates' => [
                    'default' => '@vendor/myzero1/yii2-theme-adminlteiframe/src/gii/templates/crud/adminlteiframe',
                    'z1adminlte' => '@vendor/myzero1/yii2-theme-adminlteiframe/src/gii/templates/crud/adminlte',
                ]
            ],
        ],
    ];
}
......
```


### setting in module ####
in the main.php of module

```php
return [
    ......
    'layout' => 'main',// to set theme by setting layout and layoutPath
    'layoutPath' => \Yii::getAlias('@vendor/myzero1/yii2-theme-adminlteiframe/src/views/adminlte/layouts'),
    ......
];
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
    \myzero1\adminlteiframe\assets\php\components\plugins\DataRangePickerAsset::register($this);
    \myzero1\adminlteiframe\assets\php\components\plugins\TableAsset::register($this);
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
    
    <a href="#" data-provide="z1layer" layer-config='{scrollbar:false,area:["350px","80%"],type:2,title:'修改密码",content:"/site/change-pw",shadeClose:false}'>联系方式</a>

    ```

    ![](https://github.com/myzero1/show-time/blob/master/yii2-theme-adminlteiframe/screenshot/301.png)

*  ` use wysihtml5 `

    Just add code  as flowlling, in view:

    ```
    <?php myzero1\adminlteiframe\assets\php\components\plugins\Wysihtml5Asset::register($this); ?>
    
    <textarea data-provide="z1wysihtml5" data-z1wysihtml5-config="{}" rows="10" cols="80"></textarea>

    ```

    ![](https://github.com/myzero1/show-time/blob/master/yii2-theme-adminlteiframe/screenshot/401.png)

    You can also use the advanced wysiwyg tool, [yiidoc/yii2-redactor](https://github.com/yiidoc/yii2-redactor)
    If you want to upload a file,you can try this widget,[kartik-v/yii2-widget-fileinput](https://github.com/kartik-v/yii2-widget-fileinput)
    You can combine yiidoc/yii2-redactor and kartik-v/yii2-widget-fileinput together.

    ```
    <?php 
    <?php 
        echo $form->field($model, 'photo', [
            "template" => sprintf("{label}\n{input}%s\n{hint}\n{error}",
                \kartik\file\FileInput::widget([
                    'name' => 'file',
                    'pluginOptions' => [
                        'layoutTemplates' => 'progress',
                        'uploadUrl' => Url::to(['/redactor/upload/image']),
                        'showPreview' => false,
                        'showUpload' => false,
                        'initialCaption' => $model->photo,
                    ],
                    'pluginEvents' => [
                        'change' => '
                            function(event, data, previewId, index) {
                                if($("#z1fileinput-progress").length == 0){
                                    var mystyle = "<div id=z1fileinput-progress><style> \
                                        .kv-upload-progress .progress{height: 100%;margin: 0;position: absolute;z-index: 999;width: 40px;right: 80px;border: 1px solid #00a65a;}\
                                        .kv-upload-progress .progress-bar{height: 100%;line-height: 32px;}\
                                    </style></div>";
                                    $("body").append(mystyle);
                                }

                                $(this).fileinput("upload");
                            }
                        ',
                        'fileuploaded' => '
                            function(event, data, previewId, index) {
                                $(this).parents(".form-group").find("input[type=hidden].form-control").val(data.response.filelink);
                            }
                        ',
                    ],
                ])
            ),
        ])->hiddenInput()->label('照片');
    ?>
    ```

    ![](https://github.com/myzero1/show-time/blob/master/yii2-theme-adminlteiframe/screenshot/901.png)

*  ` use ztree `

    use ztree,in ul. You can set data-provide="z1ztree" to use it and set data-z1ztree-config='{...} to set it,you can set the primary parameter of ztree in data-z1ztree-config.  Just add code  as flowlling, in view:
    ```
    <ul id="mytes" data-provide="z1ztree" data-z1ztree-config='{"checkType": "checkbox","valFieldName": "value","ztreeLayerSearchShow": false, data:[{ id:1, pId:0, name:"l1", open:true},{ id:2, pId:0, name:"l1", open:true},{ id:3, pId:1, name:"l2"}]}' class="ztree"></ul>

    ```
    ![](https://github.com/myzero1/show-time/blob/master/yii2-theme-adminlteiframe/screenshot/501.png)
    
    use ztree by default,in input.Just add code  as flowlling, in view:
    ```
    <?php echo $form->field($model, 'id')->textInput(['data-provide' =>"z1ztree"])?>

    ```
    ![](https://github.com/myzero1/show-time/blob/master/yii2-theme-adminlteiframe/screenshot/502.png)
    
    use ztree without parents,in input.Just add code  as flowlling, in view:
    ```
    <?php echo $form->field($model, 'id')->textInput(['data-provide' =>"z1ztree",'data-z1ztree-config' => '{"radioWithParents": false}'])?>

    ```
    ![](https://github.com/myzero1/show-time/blob/master/yii2-theme-adminlteiframe/screenshot/503.png)
    
    use ztree by checkbox .Just add code  as flowlling, in view:
    ```
    <?php echo $form->field($model, 'id')->textInput(['data-provide' =>"z1ztree",'data-z1ztree-config' => '{"checkType": "checkbox"}'])?>


    description of data-z1ztree-config

    {
        "checkType": "checkbox",
        "radioWithParents": true,
        "valFieldName": "name",
        "ztreeLayerPadding": "10px",
        "ztreeLayerBorder": "1px solid #d2d6de",
        "ztreeLayerSearchShow": true,
        "setting": { // ztree settings
            "check": {
                "enable": true,
                "chkStyle": "checkbox",
                "chkboxType": {
                    "Y": "ps",
                    "N": "ps"
                }
            }
            ...
        },
        "data": [{ // ztree datas
                "id": 1,
                "pId": 0,
                "name": "l11",
                "open": true,
                "chkDisabled": true,
                "checked": true,
                "value": "v11"
            },
            {
                "id": 2,
                "pId": 0,
                "name": "l12",
                "value": "v12"
            }
            ...
        ]
    }

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

*  ` use bootsrap-table-fix-column `

    Use It,Just add code  as flowlling, in view:
    ```
    <table data-provide="z1table" data-z1table-config='{"fixedColumns":true,"subtraction1":100,"subtraction2Selector":[".adminlteiframe-action-box"]}'>
        <tr>
            <td>r1c1</td>
            <td>r1c2</td>
            <td>r1c3</td>
        </tr>
        <tr>
            <td>r2c1</td>
            <td>r2c2</td>
            <td>r2c3</td>
        </tr>
        <tr>
            <td>r3c1</td>
            <td>r3c2</td>
            <td>r3c3</td>
        </tr>
    </table>
    
    ```
    ![](https://github.com/myzero1/show-time/blob/master/yii2-theme-adminlteiframe/screenshot/1.png)

*  ` use app block page loading `

    Use It,Just add the class app-block-page-loading as flowlling, in view:
    ```
    <?= Html::submitButton('search', ['class' => 'btn btn-primary app-block-page-loading']) ?>
    
    ```

*  ` use z1password `

    Use It,Just add the data-provide and rsa-key-public as flowlling, in view:
    ```
    <?= $form->field($model, 'password')->passwordInput([
        'placeholder' => '请输入',
        'readonly' => true,
        'onfocus' => "this.removeAttribute('readonly');",
        'data-provide' => 'z1password',
        'rsa-key-public' => 'MIGfMA0GCSqGSIb3DQEBAQUAA4GNADCBiQKBgQC3oSDe9Gu6AcoNU0NYQRBi3Pidwqlet/PpMddqlqnUO4sP4R0/ABOHbf/1byVbfKsbpEQqan2+v8x7MvrjZtzl6cAqrGkp3zmfvMHSkYBaQFZym0Hc49sMCbygCy77Hw9PnXsFIFayTsT97Whd6U8HzKg51wHoSW+eq2QmjZUCsQIDAQAB',
    ]) ?>

    Reference: https://gitee.com/z1gotool/z1crypto/blob/master/test/rs/rs.html
    ```


#### with rbacp ####

```

1、install yii2-app-advanced,you can use this script  https://gitee.com/myzero1/yii2-app-advanced-aliyun-shell/blob/master/yii2-advanced_env_cn_install-update.sh

2、add  "myzero1/yii2-theme-adminlteiframe": "1.3.0" and "myzero1/yii2-rbacp": "1.1.6" to composer.json

3、composer update -vvv

4、setting yii2-rbacp,   https://packagist.org/packages/myzero1/yii2-rbacp

5、set bootstrap>rbacp>params>rbacp>model = everyone, go http://localhost//rbacp, click rbacp添加数据 to migration

6、set yii2-theme-adminlteiframe, https://packagist.org/packages/myzero1/yii2-theme-adminlteiframe

7、set bootstrap>rbacp>params>rbacp>model = logined, go http://localhost/site/login , to login with root and 123456

8、go http://localhost/gii/adminlteiframe_crud, use "default" Code Template to generate curd

9、adjust the subtraction1 in path/to/backend/views/user(action name)/index.php,to adjust the table of index.

10、 add site/contact and site/change-pw

11、 use https://github.com/myzero1/yii2-captcha for captcha

12、 custom layout. eg:

12.1、modify   'defaultRoute' => '/adminlteiframe/layout',   to   'defaultRoute' => '/site/layout',     in main.php
12.2、cp -rf vendor/myzero1/yii2-theme-adminlteiframe/src/views/adminlteiframe backend/views/adminlteiframe
12.3、add   public function actionLayout()  in  \backend\controllers\SiteController.php  as follow:

    public function actionLayout()
    {
        // var_dump('expression');exit;
        // $this->layout = '@vendor/myzero1/yii2-theme-adminlteiframe/src/views/adminlteiframe/layouts/layout';
        $this->layout = '@app/views/adminlteiframe/layouts/layout';
        return $this->render('@vendor/myzero1/yii2-theme-adminlteiframe/src/views/adminlteiframe/site/default');
    }

12.4、adjust backend/views/adminlteiframe/layouts/layout.php to for your

13、custom action view,just adjust it in app/views. It will override the the view of theme.

14、you can use the follow template.
vendor/myzero1/yii2-theme-adminlteiframe/src/views/adminlteiframe/site/change-pw.php
vendor/myzero1/yii2-theme-adminlteiframe/src/views/adminlteiframe/site/contact.php
vendor/myzero1/yii2-theme-adminlteiframe/src/views/adminlteiframe/site/login-custom.php
vendor/myzero1/yii2-theme-adminlteiframe/src/controllers/AppSiteController.php



****** If there is no 'login-custom.php' in directory 'vendor/myzero1/yii2-theme-adminlteiframe/src/views/adminlteiframe/site', it will be found in directory 'app/views/site'.

````
