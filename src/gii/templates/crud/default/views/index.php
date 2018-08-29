<?php

use yii\helpers\Inflector;
use yii\helpers\StringHelper;
use yii\bootstrap\Modal;

/* @var $this yii\web\View */
/* @var $generator yii\gii\generators\crud\Generator */

$urlParams = $generator->generateUrlParams();
$nameAttribute = $generator->getNameAttribute();

$baseModelName = StringHelper::basename($generator->modelClass);
$wordsModelName = Inflector::camel2words($baseModelName);
$idModelName =  Inflector::camel2id($baseModelName);
$title = $generator->generateString(Inflector::pluralize($wordsModelName));

echo "<?php\n";
?>

use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\Modal;
use <?= $generator->indexWidgetType === 'grid' ? "yii\\grid\\GridView" : "yii\\widgets\\ListView" ?>;

/* @var $this yii\web\View */
<?= !empty($generator->searchModelClass) ? "/* @var \$searchModel " . ltrim($generator->searchModelClass, '\\') . " */\n" : '' ?>
/* @var $dataProvider yii\data\ActiveDataProvider */

myzero1\adminlteiframe\gii\GiiAsset::register($this);
myzero1\adminlteiframe\assets\php\components\plugins\BootstrapTableAsset::register($this);

$this->title = <?= $title ?>;
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="<?= $idModelName ?>-index">

<!--     <h1><?= "<?= " ?>Html::encode($this->title) ?></h1> -->

<?php if(!empty($generator->searchModelClass)): ?>
<?= "    <?php " . ($generator->indexWidgetType === 'grid' ? " " : "") ?>echo $this->render('_search', ['model' => $searchModel]); ?>
<?php endif; ?>

<?php if ($generator->indexWidgetType === 'grid'): ?>
    <?= "<?= " ?>GridView::widget([
        'dataProvider' => $dataProvider,
        <?= !empty($generator->searchModelClass) ? "// 'filterModel' => \$searchModel,\n        'columns' => [\n" : "'columns' => [\n"; ?>
            // ['class' => 'yii\grid\SerialColumn'],
            [
                'class' => yii\grid\CheckboxColumn::className(),
                'name' => 'id',
                'headerOptions' => ['width'=>'30'],
            ],

<?php
$count = 0;
if (($tableSchema = $generator->getTableSchema()) === false) {
    foreach ($generator->getColumnNames() as $name) {
        if (++$count < 6) {
            echo "            '" . $name . "',\n";
        } else {
            echo "            // '" . $name . "',\n";
        }
    }
} else {
    foreach ($tableSchema->columns as $column) {
        $format = $generator->generateColumnFormat($column);
        if (++$count < 6) {
            echo "            '" . $column->name . ($format === 'text' ? "" : ":" . $format) . "',\n";
        } else {
            echo "            // '" . $column->name . ($format === 'text' ? "" : ":" . $format) . "',\n";
        }
    }
}
?>

            [
                'header' => '操作',
                'class' => 'yii\grid\ActionColumn',
                'buttons' => [
                    'view' => function ($url, $model, $key) {
                        $options = array_merge([
                            'class'=>'btn btn-info btn-xs use-layer',
                            'layer-config' => sprintf('{type:2,title:"%s",content:"%s",shadeClose:false}', Yii::t('yii', 'View') . ' ' . <?= $title ?>, $url) ,
                        ]);
                        return Html::a(Yii::t('yii', 'View'), '#', $options);
                    },
                    'update' => function ($url, $model, $key) {
                        $options = array_merge([
                            'class'=>'btn btn-primary btn-xs use-layer',
                            'layer-config' => sprintf('{type:2,title:"%s",content:"%s",shadeClose:false}', Yii::t('yii', 'Update') . ' ' . <?= $title ?>, $url) ,
                        ]);
                        return Html::a(Yii::t('yii', 'Update'), '#', $options);
                    },
                    'delete' => function ($url, $model, $key) {
                        $options = array_merge([
                            'class'=>'btn btn-danger btn-xs use-layer',
                            'layer-config' => sprintf('{icon:3,area:["500px","200px"],type:0,title:"%s",content:"%s",shadeClose:false,btn:["确定","取消"],yes:function(index,layero){$.post("%s", {}, function(str){$(layero).find(".layui-layer-content").html(str);});},btn2:function(index, layero){layer.close(index);}}', Yii::t('yii', 'Delete') . ' ' . <?= $title ?>, '一旦删除，不能找回，你确定删除吗？',$url) ,
                        ]);
                        return Html::a(Yii::t('yii', 'Delete'), '#', $options);
                    }
                ],
            ],
        ],
        'options' => [
            'class' => 'adminlteiframe-gridview',
        ],
        'tableOptions' => [
            'class' => 'gridview-table table table-bordered table-hover dataTable'
        ],
        'summary' => '
            <div class="admlteiframe-gv-summary">
                共 <span class="total">{totalCount}</span> 条
            </div>
        ',
        'layout'=> '
            {items}
            <div class="admlteiframe-gv-footer">
                {pager}{summary}
            </div>
        ',
        'pager' => [
            'class' => \myzero1\adminlteiframe\widgets\LinkPager::className(),
            'firstPageLabel'=>"<<",
            'prevPageLabel'=>'<',
            'nextPageLabel'=>'>',
            'lastPageLabel'=>'>>',
            'maxButtonCount'=>'5',
            // 'activePageCssClass' => 'btn btn-primary btn-xs',
            'hideOnSinglePage'=>false,
            'options' => [
                'class' => 'admlteiframe-gv-pagination'
            ],
        ],
    ]); ?>
<?php else: ?>
    <?= "<?= " ?>ListView::widget([
        'dataProvider' => $dataProvider,
        'itemOptions' => ['class' => 'item'],
        'itemView' => function ($model, $key, $index, $widget) {
            return Html::a(Html::encode($model-><?= $nameAttribute ?>), ['view', <?= $urlParams ?>]);
        },
    ]) ?>
<?php endif; ?>

</div>

<?= "<?php " ?>

$js=<<<eof
    function getTableHeight(){
        var heightToal = window.parent.$('html').outerHeight(true);
        var filterHeight = $(".adminlteiframe-action-box").height();
        height = heightToal - $(".adminlteiframe-action-box").height();// subtract filters
        height = height - 260;// subtract others
        return height;
    }

    function fixTable(){
        if (!($(".gridview-table .empty").length > 0 || $(".gridview-table tbody tr").length == 0)) {
                if(typeof mybootstrapTable!="undefined"){
                    mybootstrapTable.bootstrapTable('destroy');
                }

                mybootstrapTable = $(".gridview-table").bootstrapTable('destroy').bootstrapTable({
                    height: getTableHeight(),
                    fixedColumns: true
                });
        }
    }

    fixTable();

    $(window).resize(function(){
        fixTable();
    });

eof;

$this->registerJs($js);

?>
