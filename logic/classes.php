<?php
require_once(BASE_PATH . '/dal/basic_dal.php');

function getClasses(){
    $sql = "SELECT * FROM classes";
    return getRows($sql);
}