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

    public function actionFalldown()
    {
        if ($this->request->isPost) {
            $apple = Apple::findOne(['id' => $this->request->post('id')]);
            $apple->fallToGround();
        }

        return $this->redirect(['apple/index']);
    }
}
