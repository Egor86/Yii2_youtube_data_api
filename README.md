# Yii2_youtube_data_api
Системный требования:

 Yii2
 
 php >= 5.4
 
 PHP PDO and Mysql
 
 JSON PHP
 
 The Google APIs Client Library for PHP ( installing via composer - preferred)
 
 cURL for the cURL IO method, or allow_url_fopen enabled for the Streams IO method
 
 Запуск поиска видео, для всех исполнителей, осуществляется путем отправки запроса "/youtube"
 (доступ только для аутентифицированных пользователей).
 Также, доступен поиск по отдельно взятому исполнителю, которого нет в базе данных, на главной странице.
 Просмотр списка певцов доступен по адресу "/youtube/show" ил по ссылке на главной странице "Show TOP".
