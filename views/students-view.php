<div class="blog-post">
    <div class="down-content">
        <span><?= $student['student_code'] ?></span>
        <a href="<?= BASE_URL . '/student-details.php?id=' . $student['id'] ?>">
            <h4><?= $student['english_first_name'] ?></h4>
        </a>
        <ul class="post-info">
            <li><?= $student['student_last_name'] ?></li>
            <li><?= $student['grade'] ?></li>
            <li><?= $student['class'] ?></li>
        </ul>
    </div>
</div>