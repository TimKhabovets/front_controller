<?php

class News {
    
    // returns once news item by id
    public static function getNewsItemById($id) {

    }

    // returns array news
    public static function getNewsList() {
        $host = 'localhost:3307';
        $dbname = 'mvc_site';
        $user = 'root';
        $password = '';
        $db = new PDO('mysql:host = 127.0.0.1; dbname = mvc_site', $user, $password);

        $newsList = array();

        $result = $db->query('SELECT id, title, date, short_content'
                            . 'FROM news'
                            . 'ORDER BY date DESC'
                            . 'LIMIT 10' );
        
        $i = 0;
        while ($row = $result->fetch()) {
            $newsList[$i]['id'] = $row['id'];
            $newsList[$i]['title'] = $row['title'];
            $newsList[$i]['date'] = $row['date'];
            $newsList[$i]['short_content'] = $row['short_content'];
            $i++;
        }

        return $newsList;
    }
}