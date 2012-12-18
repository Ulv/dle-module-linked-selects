<?php
/**
* модуль для dle 9.6 - 3 связанных списка, ajax, данные из mysql - специальность/регион/вуз
*
* author: Vladimir Chmil <ulv8888@gmail.com>
*
*
*/

$lang = array(
    "education_spec"=>"Специальность",
    "education_region"=>"Регион",
    "education_vuz"=>"ВУЗ"
);

if(!defined('DATALIFEENGINE'))
{
  	die("Hacking attempt!");
}

include ('engine/api/api.class.php');

?>

<label for="education_spec"><?=$lang["education_spec"]; ?></label>
<select class="education" id="education_spec">
<?php $sql = $db->query("select * from spec"); while ($row = $db->get_row($sql)): ?>
    <option value="<?=$row['id'];?>"><?=$row['title'];?></option>
<?php endwhile; ?>
</select>

<br />
<label for="education_region"><?=$lang["education_region"];?></label>
<select class="education" id="education_region"></select>

<br />
<label for="education_vuz"><?=$lang["education_vuz"];?></label>
<select class="education" id="education_vuz"></select>

<?php
$db->free();
?>
