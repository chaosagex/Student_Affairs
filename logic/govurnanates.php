<?php
require_once(BASE_PATH . '/dal/basic_dal.php');

function getGovurnanates(){
    $sql = "SELECT * FROM governante";
    return getRows($sql);
}