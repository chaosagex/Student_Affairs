<?php
require_once(BASE_PATH . '/dal/basic_dal.php');

function getNationalities(){
    $sql = "SELECT * FROM nationality";
    return getRows($sql);
}