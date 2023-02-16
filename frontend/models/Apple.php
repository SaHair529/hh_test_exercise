<?php

namespace app\models;

use Exception;
use Yii;

/**
 * This is the model class for table "apple".
 *
 * @property int $id
 * @property string $color
 * @property string $created_at
 * @property int|null $size
 * @property int|null $is_on_tree
 * @property int|null $is_bad
 * @property string $fell_at [timestamp]
 */
class Apple extends \yii\db\ActiveRecord
{
    /**
     * @throws Exception
     */
    public function eat($percent)
    {
        if ($this->is_on_tree) {
            $errorMsg = 'You`re not a giraffe for eat apples from the trees';
            $this->addError('size', $errorMsg);
            return;
        }
        $this->size -= $percent;
        $this->save();
    }

    public function fallToGround()
    {
        $this->is_on_tree = 0;
        $this->fell_at = date('Y-m-d H:i:s', time());
        $this->save();
    }

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'apple';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['color'], 'required'],
            [['created_at'], 'safe'],
            [['size', 'is_on_tree', 'is_bad'], 'integer'],
            [['color'], 'string', 'max' => 10],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'color' => 'Color',
            'created_at' => 'Created At',
            'size' => 'Size',
            'is_on_tree' => 'Is On Tree',
            'is_bad' => 'Is Bad',
        ];
    }

    private function setDefaultStatement()
    {
        $this->is_on_tree = 1;
        $this->is_bad = 0;
        $this->size = 100;
    }

    public function __construct($config = [], $color = 'green')
    {
        parent::__construct($config);
        $this->color = $color;
        $this->setDefaultStatement();
    }
}
