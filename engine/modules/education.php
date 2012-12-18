<?php
/**
* модуль для dle 9.6 - 3 связанных списка - специальность/регион/вуз
*
* author: Vladimir Chmil <ulv8888@gmail.com>
*
*
*/

if(!defined('DATALIFEENGINE'))
{
  	die("Hacking attempt!");
}

include ('engine/api/api.class.php');

$education = $dle_api->load_from_cache( "education", 60);
var_dump($education);

if ($education == false) {
    /*$sql = $db->query("SELECT comments.post_id, comments.text, comments.autor, post.id, post.flag,
    post.category, post.date as newsdate, post.title, post.alt_name 
    FROM " . PREFIX . "_comments as comments, " . PREFIX . "_post as post 
    WHERE post.id=comments.post_id 
    ORDER BY comments.date DESC LIMIT 0,20");*/

    $sql = $db->query("select * from region");

    
    while ($row = $db->get_row($sql))
    {
        var_dump($row);
/*        if (strlen($row['title']) > 50) {
     			$title = substr($row['title'], 0, 50)."...";
        } else {
     			$title = $row['title'];
        }
*/
    }

    $db->free();

    //$dle_api->save_to_cache ( "education", $education);
} 



echo $education;


?>
