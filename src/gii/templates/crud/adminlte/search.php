<?php
/**
 * This is the template for generating CRUD search class of the specified model.
 */

use yii\helpers\StringHelper;


/* @var $this yii\web\View */
/* @var $generator yii\gii\generators\crud\Generator */

$modelClass = StringHelper::basename($generator->modelClass);
$searchModelClass = StringHelper::basename($generator->searchModelClass);
if ($modelClass === $searchModelClass) {
    $modelAlias = $modelClass . 'Model';
}
$rules = $generator->generateSearchRules();
$labels = $generator->generateSearchLabels();
$searchAttributes = $generator->getSearchAttributes();
$searchConditions = $generator->generateSearchConditions();

echo "<?php\n";
?>

namespace <?= StringHelper::dirname(ltrim($generator->searchModelClass, '\\')) ?>;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use <?= ltrim($generator->modelClass, '\\') . (isset($modelAlias) ? " as $modelAlias" : "") ?>;

/**
 * <?= $searchModelClass ?> represents the model behind the search form of `<?= $generator->modelClass ?>`.
 */
class <?= $searchModelClass ?> extends <?= isset($modelAlias) ? $modelAlias : $modelClass ?>

{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            <?= implode(",\n            ", $rules) ?>,
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = <?= isset($modelAlias) ? $modelAlias : $modelClass ?>::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,<?= (in_array('id', $searchAttributes)) ? "\n            'sort' => ['defaultOrder' => ['id' => SORT_DESC]]\n" : '' ?>
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        <?= implode("\n        ", $searchConditions) ?>

        return $dataProvider;
    }

    /**
     * Creates data provider instance with search query and sql applied
     *
     * @param array $params
     *
     * @return SqlDataProvider
     */
    public function aqlSearch($params)
    {
        $this->load($params);

        $where = [
            'id' => sprintf('id = %s',$this->id),
            // 'user_name' => sprintf('user_name like "%s%%"',$this->user_name),
        ];

        $filtedParams = array_filter($this->attributes,
            function($val){return $val!='';});

        $FiltedWhere = ['1=1'];
        foreach ($filtedParams as $key => $value) {
            $FiltedWhere[] = $where[$key];
        }

        $querySql = sprintf('
            SELECT
                %s
            FROM
                %s
            WHERE
                %s
            ', '*', $this->tableName(), implode(' AND ', $FiltedWhere));

        $countSql = sprintf('
            SELECT
                %s
            FROM
                %s
            WHERE
                %s
            ', 'count(1)', $this->tableName(), implode(' AND ', $FiltedWhere));

        $sqlDataProvider = new SqlDataProvider([
            'sql' => $querySql,
            // 'params' => [':sex' => 1],
            'totalCount' => Yii::$app->db->createCommand($countSql)->queryScalar(),
            //'sort' =>false,//如果为假则删除排序
            'key' => 'id',
            'sort' => [
                'defaultOrder' => [
                    'id' => SORT_DESC
                ],
                'attributes' => array_keys($this->attributes),
            ],
            'pagination' => [
                'pageSize' => 30,
            ],
        ]);
        return $sqlDataProvider;
    }
}
