<?php

require_once('config.php');
require_once(BASE_PATH . '/logic/students.php');
if (!isset($_REQUEST['id'])) {
    header('Location:index.php');
    die();
}
$id = $_REQUEST['id'];
$student=getStudentById($id);
deleteStudent($id);

header('Location: ' . BASE_URL . '/');
die();