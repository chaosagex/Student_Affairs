<?php
require_once(BASE_PATH . '/dal/basic_dal.php');


function getCities(){
    $sql = "SELECT * FROM cities";
    return getRows($sql);
}