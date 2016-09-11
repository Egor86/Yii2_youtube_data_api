<?php

namespace app\controllers;

use app\models\Api;
use app\models\Singer;
use app\models\Video;
use yii\data\ArrayDataProvider;
use yii\filters\AccessControl;
use yii\web\Controller;

class YoutubeController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index'],
                'rules' => [
                    [
                        'actions' => ['index'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ]
        ];
    }

    public function actionIndex()
    {
        ini_set('max_execution_time', 900);
        $singers = Singer::find()->all();
        $api = new Api([]);

        for ($i = 0; $i < count($singers); $i++){
            $api->getVideo($singers[$i]);
        }

        return $this->redirect('/youtube/show',302);
    }

    public function actionShow()
    {
        $model = new Video();
        $result = $model->getList();
        $dataProvider = new ArrayDataProvider(['allModels' => $result]);
        return $this->render('top', ['dataProvider' => $dataProvider]);
    }

    public function actionLoad()
    {
        $request = \Yii::$app->request;
        if (!$request->isPost) {
            return $this->render('form');
        }

        $new_name = $request->post('name');

        if(Singer::find()
            ->where( [ 'name' => $new_name ] )
            ->exists())
        {
            return $this->render('form', ['exist' => 'Singer '.$new_name.' exist on DB']);
        };

        $singer = new Singer();
        $singer->name = $request->post('name');
        $singer->insert();

        $api = new Api([]);
        $api->getVideo($singer);

        return $this->render('form', ['exist' => 'Singer '.$new_name.' was added']);

    }

}
