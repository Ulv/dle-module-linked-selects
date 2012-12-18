<?php
/**
* выбор специальность/регион/ВУЗ (связанные списки, ajax)
*
* модуль для dle 9.6
*
* author: Vladimir Chmil <ulv8888@gmail.com>
* link:   https://github.com/Ulv/dle-module-linked-selects.git 
*/
?>

<?php /* js */ ?>
<script type="text/javascript">
(function($) {
    // ajax обработчик
     var Education = (function ($) {

        function chSelect(lst, url) {
            $.getJSON('engine/ajax/education.php?' + url, function(data) {
                if (data.status == 'ok') {
                    lst.empty();
                    $.each(data.data, function(index, value) {
                        lst.append('<option value="'+value.id+'">'+value.title+'</option>');
                    });
                } else {
                    alert('ошибка работы с бд!');
                }
            });
        }

        function handleEvents() {
            var list_spec   = $("#education_spec"),
                list_region = $("#education_region"),
                list_vuz    = $("#education_vuz"),
                specid;

            // меняем специальность - заполняем регион
            list_spec.change(function(){
                list_vuz.empty();
                list_vuz.append('<option value="0">--- выберите специальность и регион ---</option>');

                specid = $(this).val();
                chSelect(list_region, 'specid=' + specid);
            });

            // меняем регион - заполняем вузы
            list_region.change(function(){
                if (undefined !== specid) {
                    chSelect(list_vuz, 'specid=' + specid + '&regid=' + $(this).val());
                }
            });

        
        }
        function init () {
            handleEvents();
        }

        return {
            init: init
        }
    })($);

    $(document).ready(function (){
        window.education = Education.init();
    });
})($);
</script>

<?php /* some styling */ ?>

<style type="text/css">
    #education_wrapper { 
        width: 100%;
        padding: 10px;
    }
    #education_wrapper label {
        min-width: 120px; 
        display: block;
        float: left;
        font-weight: 600;
    }
    #education_wrapper select {}
</style>

<?php
$lang = array(
    "education_spec"   => "Специальность",
    "education_region" => "Регион",
    "education_vuz"    => "ВУЗ"
);

if(!defined('DATALIFEENGINE'))
{
  	die("Hacking attempt!");
}

include ('engine/api/api.class.php');

?>
<div id="education_wrapper">
    <label for="education_spec"><?=$lang["education_spec"]; ?></label>
    <select class="education" id="education_spec" name="education_spec">
        <?php $sql = $db->query("select * from spec"); while ($row = $db->get_row($sql)): ?>
        <option value="<?=$row['id'];?>"><?=$row['title'];?></option>
        <?php endwhile; ?>
    </select>

    <br />
    <label for="education_region"><?=$lang["education_region"];?></label>
    <select class="education" id="education_region" name="education_region">
        <option value="0">--- выберите специальность ---</option>
    </select>

    <br />
    <label for="education_vuz"><?=$lang["education_vuz"];?></label>
    <select class="education" id="education_vuz" name="education_vuz">
        <option value="0">--- выберите специальность и регион ---</option>
    </select>
</div>
<?php $db->free(); ?>
