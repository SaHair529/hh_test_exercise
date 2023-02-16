<?php

namespace frontend\controllers;

use app\models\Apple;
use Exception;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * AppleController implements the CRUD actions for Apple model.
 */
class AppleController extends Controller
{
    /**
     * Lists all Apple models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $allApples = Apple::find()->all();

        return $this->render('index', [
            'apples' => $allApples,
        ]);
    }

    public function actionCreate()
    {
        if ($this->request->isPost) {
            $colors = ['green', 'red', 'yellow'];

            $apple = new Apple([], $colors[array_rand($colors)]);
            $apple->save();
        }

        return $this->redirect(['apple/index']);
    }

    public function actionFalldown()
    {
        if ($this->request->isPost) {
            $apple = Apple::findOne(['id' => $this->request->post('id')]);
            $apple->fallToGround();
        }

        return $this->redirect(['apple/index']);
    }

    public function actionEat()
    {
        if ($this->request->isPost) {
            $percent = $this->prepareValidPercent((int) $this->request->post('percent'));

            $apple = Apple::findOne(['id' => $this->request->post('id')]);
            $apple->eat($percent);

            if ($apple->hasErrors('eat_error')) {
                $errorMsg = $apple->getFirstError('eat_error');
                \Yii::$app->session->setFlash('eat_error', $errorMsg);
            }
        }

        return $this->redirect(['apple/index']);
    }

    private function prepareValidPercent($percent)
    {
        if ($percent > 100)
            $percent = 100;
        elseif ($percent < 0)
            $percent = 0;

        return $percent;
    }
}
