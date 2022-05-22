<?php
require_once('config.php');
require_once(BASE_PATH . '/logic/students.php');
require_once(BASE_PATH . '/layout/header.php');
$page = isset($_REQUEST['page']) ? $_REQUEST['page'] : 1;
$page_size = 30;
$order_field = isset($_REQUEST['order_field']) ? $_REQUEST['order_field'] : 'id';
$order_by = isset($_REQUEST['order_by']) ? $_REQUEST['order_by'] : 'asc';
$q = isset($_REQUEST['q']) ? $_REQUEST['q'] : '';
function getUrl($page, $q, $order_field, $order_by)
{
    return "index.php?page=$page&q=$q&order_field=$order_field&order_by=$order_by";
}
function getSortingUrl($field, $oldOrderField, $oldOrderBy, $q)
{
    if ($field == $oldOrderField && $oldOrderBy == 'asc') {
        return "index.php?page=1&q=$q&order_field=$field&order_by=desc";
    }
    if ($field == $oldOrderField && $oldOrderBy == 'desc') {
        return "index.php?page=1&q=$q";
    }
    return  "index.php?page=1&q=$q&order_field=$field&order_by=asc";
}

function getSortFlag($field, $oldOrderField, $oldOrderBy)
{
    if ($field == $oldOrderField && $oldOrderBy == 'asc') {
        return "<i class='fa fa-sort-up'></i>";
    }
    if ($field == $oldOrderField && $oldOrderBy == 'desc') {
        return "<i class='fa fa-sort-down'></i>";
    }
    return  "";
}

$students =  getStudents($page_size,$page = 1);
$page_count = ceil($students['count'] / $page_size);

?>
<!-- Page Content -->

<section class="blog-posts">
    <div class="container">

        <div class="row">
            <div class="col-lg-12">
                <div class="all-blog-posts">
                    <div class="row">
                        <div class="col-md-2"><a href="add.php" class="btn btn-success">Add Student</a></div>
                        <div class="col-md-10">
                            <div class="sidebar-item search">
                                <form id="search_form" name="gs" method="GET" action="">
                                    <input type="text" class="form-control" value="<?= isset($_REQUEST['q']) ? $_REQUEST['q'] : '' ?>" name="q" class="searchText" placeholder="type to search..." autocomplete="on">
                                </form>
                            </div>
                        </div>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th><a href="<?= getSortingUrl('student_code', $order_field, $order_by, $q) ?>">Student Code <?= getSortFlag('student_code', $order_field, $order_by) ?></a></th>
                                    <th><a href="<?= getSortingUrl('english_first_name', $order_field, $order_by, $q) ?>">First Name <?= getSortFlag('english_first_name', $order_field, $order_by) ?></a></th>
                                    <th><a href="<?= getSortingUrl('grade', $order_field, $order_by, $q) ?>">Grade <?= getSortFlag('grade', $order_field, $order_by) ?></a></th>
                                    <th><a href="<?= getSortingUrl('class', $order_field, $order_by, $q) ?>">Class <?= getSortFlag('class', $order_field, $order_by) ?></a></th>
                                    <th><a href="<?= getSortingUrl('student_status', $order_field, $order_by, $q) ?>">Student Status <?= getSortFlag('student_status', $order_field, $order_by) ?></a></th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $i = ($page - 1) * $page_size + 1;
                                foreach ($students as $student) {
                                    
                                    $grade=$student['grade_name'];
                                    $class=$student['class_name'];
                                    $studentStatus=$student['studentStatus'];
                                    $href="<a href=".BASE_URL . '/student-details.php?id=' . $student['id'] .">";
                                    echo "<tr>
                                    <td>$i</td>
                                    <td>".$href . htmlspecialchars($student['student_code'])."</a>" . "</td>
                                    <td>{$student['english_first_name']}</td>
                                    <td>{$grade}</td>
                                    <td>{$class}</td>
                                    <td>{$studentStatus}</td>
                                    <td>
                                    <a href='edit.php?id={$student['id']}' class='btn btn-primary'>Edit</a>
                                    <a onclick='return confirm(\"Are you sure ?\")' href='delete.php?id={$student['id']}' class='btn btn-danger'>Delete</a>
                                    </td>
                                    </tr>";

                                    $i++;
                                }

                                ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-lg-12">
                        <ul class="page-numbers">
                            <?php
                            $prevUrl = getUrl($page - 1, $q, $order_field, $order_by);
                            $nxtUrl = getUrl($page + 1, $q, $order_field, $order_by);

                            if ($page > 1) echo "<li><a href='{$prevUrl}'><i class='fa fa-angle-double-left'></i></a></li>";

                            for ($i = 1; $i <= $page_count; $i++) {
                                $url = getUrl($i, $q, $order_field, $order_by);
                                echo "<li class=" . ($i == $page ? "active" : "") . "><a href='{$url}'>{$i}</a></li>";
                            }

                            if ($page < $page_count) echo "<li><a href='{$nxtUrl}'><i class='fa fa-angle-double-right'></i></a></li>";
                            ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php require_once(BASE_PATH . '/layout/footer.php') ?>