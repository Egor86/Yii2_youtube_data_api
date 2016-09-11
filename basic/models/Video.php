<?php

namespace app\models;

use yii\base\ModelEvent;

/**
 * This is the model class for table "video".
 *
 * @property integer $id
 * @property string $video_id
 * @property string $view_count
 * @property integer $id_singer
 *
 * @property Singer $idSinger
 */
class Video extends \yii\db\ActiveRecord
{
    const EVENT_NEW_VIDEO = 'new-video';


    /**
     * @return int
     */
    public function init() {
        $this->on(self::EVENT_NEW_VIDEO, [new Api([]), 'getStatistics']);
    }

    /**
    * @inheritdoc
    */
    public static function tableName()
    {
        return 'video';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['video_id', 'id_singer'], 'required'],
            [['view_count', 'id_singer'], 'integer'],
            [['video_id'], 'string', 'max' => 11],
            [['id_singer'], 'exist', 'skipOnError' => true, 'targetClass' => Singer::className(), 'targetAttribute' => ['id_singer' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'video_id' => 'Video ID',
            'view_count' => 'View Count',
            'id_singer' => 'Id Singer',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdSinger()
    {
        return $this->hasOne(Singer::className(), ['id' => 'id_singer']);
    }

    /**
     * @inheritdoc
     * @return VideoQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new VideoQuery(get_called_class());
    }


    /**
     * @return array
     */
    public function getList()
    {
        $connection = \Yii::$app->getDb();
        $command = $connection->createCommand('
          SELECT s.name, SUM(v.view_count) as Amount_view, 
          CONCAT(\'https://www.youtube.com/watch?v=\', \'\', v.video_id) as LINK 
          FROM singer s LEFT JOIN video v ON s.id = v.id_singer GROUP BY v.id_singer');

        return $command->queryAll();
    }
}
