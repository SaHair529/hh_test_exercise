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
     * Укус яблока размером с $percent
     */
    public function eat($percent)
    {
        if ($this->is_on_tree) {
            $errorMsg = 'You`re not a giraffe for eat apples from the trees';
            $this->addError('eat_error', $errorMsg);
            return;
        }
        if ($this->isBad()) {
            $errorMsg = 'You really wanna do that?';
            $this->addError('eat_error', $errorMsg);
            return;
        }

        if ($percent >= $this->size) {
            $this->delete();
            return;
        }

        $this->size -= $percent;
        $this->save();
    }

    /**
     * Падение на землю
     */
    public function fallToGround()
    {
        if (!$this->is_on_tree) return; # уже на земле
        $this->is_on_tree = 0;
        $this->fell_at = date('Y-m-d H:i:s', time());
        $this->save();
    }

    /**
     * Определение состояния яблока по времени падения на землю
     * Если прошло больше 5 часов - испорчено
     */
    public function isBad()
    {
        if ($this->fell_at === null)
            return false;

        return ((time() - strtotime($this->fell_at)) >= 18000);
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
