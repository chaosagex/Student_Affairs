<?php
require_once(BASE_PATH . '/dal/basic_dal.php');

function getBranches(){
    $sql = "SELECT * FROM branches";
    return getRows($sql);
}