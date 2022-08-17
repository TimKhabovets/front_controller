<?php

include_once ROOT.'\models\News.php';

class NewsController {

    public function actionIndex() {
        
        $newsList = array();
        $newsList = News::getNewsList();

        echo '<pre>'; 
        print_r($newsList);
        echo '</pre>';

        echo 'hello';
        return true;
    }

    public function actionView($category, $id) {
        echo $category;
        echo $id;
        return true;
    }
}