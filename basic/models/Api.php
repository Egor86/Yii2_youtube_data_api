<?php
namespace app\models;

use yii\base\Model;
use Google_Client;
use Google_Service_YouTube;

class Api extends Model
{
    private $client;
    private $youtube;

    public function __construct(array $config) {

        $this->client = new Google_Client();
        $this->client->setDeveloperKey(\Yii::$app->params['keyAPI']);
        $this->youtube = new Google_Service_YouTube($this->client);
        parent::__construct($config);
    }

    public function getVideo($singer)
    {
        $searchResponse = $this->youtube->search->listSearch('id', [
            'q' => $singer->name,
            'maxResults' => 5,
            'order' => 'viewCount',
            'type' => 'video'
        ]);

        foreach ($searchResponse['items'] as $item){
            $video = new Video();
            $video->id_singer = $singer->id;
            $video->video_id = $item['id']['videoId'];
            $video->insert();
            if ($video->save()){
                $video->trigger(Video::EVENT_NEW_VIDEO);
            }
        }
    }

    public function getStatistics($event)
    {
        $videosResponse = $this->youtube->videos->listVideos('statistics', [
            'id' => $event->sender->video_id,
        ]);

        $event->sender->view_count = $videosResponse['items'][0]->statistics->viewCount;
        $event->sender->update();
    }

}