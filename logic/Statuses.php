<?php
require_once(BASE_PATH . '/dal/basic_dal.php');

function getStudentStatuses(){
    $sql = "SELECT * FROM student_status";
    return getRows($sql);
}