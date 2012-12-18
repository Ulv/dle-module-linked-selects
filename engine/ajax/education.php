<?php
/**
* выбор специальность/регион/ВУЗ (связанные списки, ajax)
*
* модуль для dle 9.6, часть ajax
*
* author: Vladimir Chmil <ulv8888@gmail.com>
* link:   https://github.com/Ulv/dle-module-linked-selects.git 
*/

header('Content-type: application/json');
include ('../api/api.class.php');

if (isset($_GET["specid"]) || isset($_GET["regid"]) || isset($_GET["vuzid"]))
{
    if (isset($_GET["specid"]) && !isset($_GET["regid"])) {
        // выбираем регионы по коду специальности
        $spec_id = preg_replace("#[^0-9]#","", substr($_GET["specid"], 0, 4));
        $sql = $db->query("SELECT distinct region.id as id, region.title as title FROM region, spectovuz WHERE region.id = spectovuz.region_id and spectovuz.spec_id=".$spec_id." order by region.title asc");

        $result = array();
        while ($row = $db->get_row($sql)) {
            $result[] = array("id"=>$row["id"], "title"=>$row["title"]);
        }

        if (!empty($result)) {
            echo json_encode(array('status'=>'ok', 'data'=>$result));
        } else {
            echo json_encode(array('status'=>'err', 'data'=>null));
        }
    }

    if (isset($_GET["specid"]) && isset($_GET["regid"])) {
        // выбираем вузы по региону и специальности
        $spec_id = preg_replace("#[^0-9]#","", substr($_GET["specid"], 0, 4));
        $reg_id  = preg_replace("#[^0-9]#","", substr($_GET["regid"], 0, 4));

        $sql = $db->query("SELECT distinct vuz.id as id, vuz.title as title FROM vuz, spectovuz WHERE vuz.id = spectovuz.vuz_id and spectovuz.spec_id=".$spec_id." and spectovuz.region_id=".$reg_id." order by vuz.title asc");

        $result = array();
        while ($row = $db->get_row($sql)) {
            $result[] = array("id"=>$row["id"], "title"=>$row["title"]);
        }

        if (!empty($result)) {
            echo json_encode(array('status'=>'ok', 'data'=>$result));
        } else {
            echo json_encode(array('status'=>'err', 'data'=>null));
        }

    }
}
    /*else {
    echo "Incorrect parameters"
}*/
?>
