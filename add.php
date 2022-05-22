<?php
require_once('config.php');
require_once(BASE_PATH . '/logic/students.php');
require_once(BASE_PATH . '/logic/nationalities.php');
require_once(BASE_PATH . '/logic/cities.php');
require_once(BASE_PATH . '/logic/grades.php');
require_once(BASE_PATH . '/logic/classes.php');
require_once(BASE_PATH . '/logic/Statuses.php');
require_once(BASE_PATH . '/logic/Branches.php');
require_once(BASE_PATH . '/logic/govurnanates.php');
$cities=getCities();

$nationalities=getNationalities();

$grades=getGrades();

$genders=['Male','Female'];
$classes=getClasses();
$years = range(2010, strftime("%Y", time()));
$statuses=getStudentStatuses();
$guardians=['Mother','Father'];
$branches=getBranches();
$branchesAbrev=[];
$govs=getGovurnanates();
foreach ($branches as $branch){
    array_push($branchesAbrev,substr($branch['name'],0,4));
}
$UpdateSelection=['yes','no'];
$Religions=['Muslim','Christian'];
$languages=['Arabic','English','French'];
$staff=['yes','no'];
if (isset($_REQUEST['student_code'])) {
    
    //$_REQUEST['student_code'] = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_SPECIAL_CHARS);
    $errors =[];// validateStudentCreate($_REQUEST);
    if (count($errors) == 0) {

        if (addNewStudent($_REQUEST)) {
            header('Location:index.php');
        } else {
            $generic_error = "Error while adding the student";
        }
    }
}
require_once(BASE_PATH . '/layout/header.php');

?>
<!-- Page Content -->
<!-- Banner Starts Here -->
<div class="heading-page header-text">
    <section class="page-heading">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="text-content">
                        <h4>Add Student</h4>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<!-- Banner Ends Here -->
<section class="blog-posts">
    <div class="container">

        <div class="row">
            <div class="col-lg-12">
                <div class="all-blog-posts">
                    <div class="row">
                        <div class="col-sm-12">
                       
                            <form method="POST" enctype="multipart/form-data">
                                <h2>Student Main Data</h2><br>
                                <select name="branch_id" class="col-sm-2">
                                    <option value="">Select Branch</option>
                                    <?php
                                    foreach ($branches as $branch) {
                                        
                                        echo "<option value='{$branch['id']}'>{$branch['name']}</option>";
                                    }
                                    ?>
                                </select>
                                <?= isset($errors['branches']) ? "<span class='text-danger'>" . $errors['branches'] . "</span>" : "" ?>
                                <select name="grade_id" class="col-sm-2">
                                    <option value="">Select Grade</option>
                                    <?php
                                    foreach ($grades as $grade) {
                                        echo "<option value='{$grade['id']}'>{$grade['name']}</option>";
                                    }
                                    ?>
                                </select>
                                <?= isset($errors['grades']) ? "<span class='text-danger'>" . $errors['grades'] . "</span>" : "" ?>
                                <select name="class_id" class="col-sm-2">
                                    <option value="">Select Class</option>
                                    <?php
                                    foreach ($classes as $class) {
                                        echo "<option value='{$class['id']}'>{$class['className']}</option>";
                                    }
                                    ?>
                                </select>
                                <?= isset($errors['classes']) ? "<span class='text-danger'>" . $errors['classes'] . "</span>" : "" ?>
                                <input name="student_code" placeholder="student_code" class="col-sm-2" />
                                <?= isset($errors['student_code']) ? "<span class='text-danger'>" . $errors['student_code'] . "</span>" : "" ?>
                                <input name="student_nid" placeholder="student_National ID" class="col-sm-2" />
                                <?= isset($errors['student_nid']) ? "<span class='text-danger'>" . $errors['student_nid'] . "</span>" : "" ?>
                                <select name="nationality_id" class="col-sm-2">
                                    <option value="">Select Nationality</option>
                                    <?php
                                    foreach ($nationalities as $nationality) {
                                        echo "<option value='{$nationality['id']}'>{$nationality['name']}</option>";
                                    }
                                    ?>
                                </select>
                                <?= isset($errors['Nationality']) ? "<span class='text-danger'>" . $errors['Nationality'] . "</span>" : "" ?>
                                <hr>
                                <h2>Students Affair Section</h2>
                                <select name="status_id" class="col-sm-2">
                                    <option value="">Select Status</option>
                                    <?php
                                    foreach ($statuses as $status) {
                                        echo "<option value='{$status['id']}'>{$status['name']}</option>";
                                    }
                                    ?>
                                </select>
                                <?= isset($errors['status']) ? "<span class='text-danger'>" . $errors['status'] . "</span>" : "" ?>
                                <select name="year_id" class="col-sm-2">
                                    <option value="">Select year</option>
                                    <?php
                                    $i=0;
                                    foreach ($years as $year) {
                                        $temp=strval($i);
                                        echo "<option value='{$temp}'>{$year}</option>";
                                        $i++;
                                    }
                                    ?>
                                </select>
                                <?= isset($errors['year']) ? "<span class='text-danger'>" . $errors['year'] . "</span>" : "" ?>
                                <select name="staffSon_id" class="col-sm-3">
                                    <option value="">Is Staff Son</option>
                                    <?php
                                    $i=0;
                                    foreach ($staff as $staffSon) {
                                        $temp=strval($i);
                                        echo "<option value='{$temp}'>{$staffSon}</option>";
                                        $i++;
                                    }
                                    ?>
                                </select>
                                <?= isset($errors['staffSon']) ? "<span class='text-danger'>" . $errors['staffSon'] . "</span>" : "" ?>
                                <select name="guardian_id" class="col-sm-3">
                                    <option value="">Select Guardian</option>
                                    <?php
                                    $i=0;
                                    foreach ($guardians as $guardian) {
                                        $temp=strval($i);
                                        echo "<option value='{$temp}'>{$guardian}</option>";
                                        $i++;
                                    }
                                    ?>
                                </select>
                                <?= isset($errors['guardian']) ? "<span class='text-danger'>" . $errors['guardian'] . "</span>" : "" ?>
                                <select name="seperated_id" class="col-sm-3">
                                    <option value="">Are parents Seperated</option>
                                    <?php
                                    $i=0;
                                    foreach ($staff as $seperated) {
                                        $temp=strval($i);
                                        echo "<option value='{$temp}'>{$seperated}</option>";
                                        $i++;
                                    }
                                    ?>
                                </select>
                                <?= isset($errors['seperated']) ? "<span class='text-danger'>" . $errors['seperated'] . "</span>" : "" ?>
                                <hr>
                                <select name="abreviation_id" class="col-sm-3">
                                    <option value="">Select school abreviation</option>
                                    <?php
                                    $i=0;
                                    foreach ($branchesAbrev as $abreviation) {
                                        $temp=strval($i);
                                        echo "<option value='{$temp}'>{$abreviation}</option>";
                                        $i++;
                                    }
                                    ?>
                                </select>
                                <?= isset($errors['abreviation']) ? "<span class='text-danger'>" . $errors['abreviation'] . "</span>" : "" ?>
                                <select name="updated_id" class="col-sm-1">
                                    <option value="">Update</option>
                                    <?php
                                    $i=0;
                                    foreach ($staff as $update) {
                                        $temp=strval($i);
                                        echo "<option value='{$temp}'>{$update}</option>";
                                        $i++;
                                    }
                                    ?>
                                </select>
                                <?= isset($errors['update']) ? "<span class='text-danger'>" . $errors['update'] . "</span>" : "" ?>
                                <input name="student_arabic_firstName" placeholder=" Arabic First Name" class="col-sm-3" />
                                <?= isset($errors['student_arabic_firstName']) ? "<span class='text-danger'>" . $errors['student_arabic_firstName'] . "</span>" : "" ?>
                                <input name="student_arabic_middleName" placeholder=" Arabic Middle Name" class="col-sm-3" />
                                <?= isset($errors['student_arabic_middleName']) ? "<span class='text-danger'>" . $errors['student_arabic_middleName'] . "</span>" : "" ?>
                                
                                <input name="student_arabic_lastName" placeholder=" Arabic Last Name" class="col-sm-3" />
                                <?= isset($errors['student_arabic_lastName']) ? "<span class='text-danger'>" . $errors['student_arabic_lastName'] . "</span>" : "" ?>
                                <input name="student_arabic_familyName" placeholder="Arabic Family Name" class="col-sm-3" />
                                <?= isset($errors['student_arabic_familyName']) ? "<span class='text-danger'>" . $errors['student_arabic_familyName'] . "</span>" : "" ?>
                                <input name="student_english_firstName" placeholder="English First Name" class="col-sm-3" />
                                <?= isset($errors['student_english_firstName']) ? "<span class='text-danger'>" . $errors['student_english_firstName'] . "</span>" : "" ?>
                                <input name="student_english_middleName" placeholder="English Middle Name" class="col-sm-2" />
                                <?= isset($errors['student_english_middleName']) ? "<span class='text-danger'>" . $errors['student_english_middleName'] . "</span>" : "" ?>
                                
                                <input name="student_english_lastName" placeholder=" English Last Name" class="col-sm-3" />
                                <?= isset($errors['student_english_lastName']) ? "<span class='text-danger'>" . $errors['student_english_lastName'] . "</span>" : "" ?>
                                <input name="student_english_familyName" placeholder="English Family Name" class="col-sm-3" />
                                <?= isset($errors['student_english_familyName']) ? "<span class='text-danger'>" . $errors['student_english_familyName'] . "</span>" : "" ?>
                                <label>DOB<input type="date" name="dob" class="form-control" ></label>
                                <?= isset($errors['dob']) ? "<span class='text-danger'>" . $errors['dob'] . "</span>" : "" ?>
                                <input name="student_birthPlace" placeholder="birth Place" class="col-sm-3" />
                                <?= isset($errors['student_birthPlace']) ? "<span class='text-danger'>" . $errors['student_birthPlace'] . "</span>" : "" ?>
                                
                                <select name="gender_id" class="col-sm-2">
                                    <option value="">Gender</option>
                                    <?php
                                    $i=0;
                                    foreach ($genders as $gender) {
                                        $temp=strval($i);
                                        echo "<option value='{$temp}'>{$gender}</option>";
                                        $i++;
                                    }
                                    ?>
                                </select>
                                <?= isset($errors['gender']) ? "<span class='text-danger'>" . $errors['gender'] . "</span>" : "" ?>
                                <select name="religon_id" class="col-sm-2">
                                    <option value="">Religion</option>
                                    <?php
                                    $i=0;
                                    foreach ($Religions as $religion) {
                                        $temp=strval($i);
                                        echo "<option value='{$temp}'>{$religion}</option>";
                                        $i++;
                                    }
                                    ?>
                                </select>
                                <?= isset($errors['religion']) ? "<span class='text-danger'>" . $errors['religion'] . "</span>" : "" ?>
                                <input name="father_nid" placeholder="Father National ID" class="col-sm-3" />
                                <?= isset($errors['father_nid']) ? "<span class='text-danger'>" . $errors['father_nid'] . "</span>" : "" ?>
                                <select name="cities_id" class="col-sm-2">
                                    <option value="">Select city</option>
                                    <?php
                                    foreach ($cities as $city) {
                                        echo "<option value='{$city['id']}'>{$city['name']}</option>";
                                    }
                                    ?>
                                </select>
                                <?= isset($errors['cities']) ? "<span class='text-danger'>" . $errors['cities'] . "</span>" : "" ?>
                                
                                <input name="address" placeholder="Address" class="col-sm-3" />
                                <?= isset($errors['address']) ? "<span class='text-danger'>" . $errors['address'] . "</span>" : "" ?>
                                <input name="mother_arabic_name" placeholder="Mother Arabic Name" class="col-sm-3" />
                                <?= isset($errors['mother_arabic_name']) ? "<span class='text-danger'>" . $errors['mother_arabic_name'] . "</span>" : "" ?>
                                <input name="father_mobile" placeholder="Father Mobile" class="col-sm-2" />
                                <?= isset($errors['father_mobile']) ? "<span class='text-danger'>" . $errors['father_mobile'] . "</span>" : "" ?>
                                <input name="father_email" placeholder="Father E-mail" class="col-sm-2" />
                                <?= isset($errors['father_email']) ? "<span class='text-danger'>" . $errors['father_email'] . "</span>" : "" ?>
                                
                                <input name="mother_mobile" placeholder="mother Mobile" class="col-sm-3" />
                                <?= isset($errors['mother_mobile']) ? "<span class='text-danger'>" . $errors['mother_mobile'] . "</span>" : "" ?>
                                <input name="mother_email" placeholder="Mother E-mail" class="col-sm-3" />
                                <?= isset($errors['mother_email']) ? "<span class='text-danger'>" . $errors['mother_email'] . "</span>" : "" ?>
                                <input name="E-mail" placeholder="E-mail" class="col-sm-2" />
                                <?= isset($errors['E-mail']) ? "<span class='text-danger'>" . $errors['E-mail'] . "</span>" : "" ?>
                                <input name="password"  placeholder="password" class="col-sm-2" />
                                <?= isset($errors['password']) ? "<span class='text-danger'>" . $errors['password'] . "</span>" : "" ?>

                                <select name="motherNationality_id" class="col-sm-3">
                                    <option value="">Select mother Nationality</option>
                                    <?php
                                    foreach ($nationalities as $nationality) {
                                        echo "<option value='{$nationality['id']}'>{$nationality['name']}</option>";
                                    }
                                    ?>
                                </select>
                                <?= isset($errors['motherNationality']) ? "<span class='text-danger'>" . $errors['motherNationality'] . "</span>" : "" ?>
                                <select name="fatherNationality_id" class="col-sm-3">
                                    <option value="">Select Father Nationality</option>
                                    <?php
                                    foreach ($nationalities as $nationality) {
                                        echo "<option value='{$nationality['id']}'>{$nationality['name']}</option>";
                                    }
                                    ?>
                                </select>
                                <?= isset($errors['fatherNationality']) ? "<span class='text-danger'>" . $errors['fatherNationality'] . "</span>" : "" ?>
                                <input name="Student_affair1" placeholder="Student affairs 1" class="col-sm-2" />
                                <?= isset($errors['Student_affair1']) ? "<span class='text-danger'>" . $errors['Student_affair1'] . "</span>" : "" ?>
                                <input name="Student_affair2"  placeholder="Student affairs 1" class="col-sm-2" />
                                <?= isset($errors['Student_affair2']) ? "<span class='text-danger'>" . $errors['Student_affair2'] . "</span>" : "" ?>

                                <input name="birthCode"  placeholder="Bith Code" class="col-sm-3" />
                                <?= isset($errors['birthCode']) ? "<span class='text-danger'>" . $errors['birthCode'] . "</span>" : "" ?>
                                <select name="gov_id" class="col-sm-3">
                                    <option value="">Select Address Gov</option>
                                    <?php
                                    foreach ($govs as $gov) {
                                        echo "<option value='{$gov['id']}'>{$gov['name']}</option>";
                                    }
                                    ?>
                                </select>
                                <?= isset($errors['gov']) ? "<span class='text-danger'>" . $errors['gov'] . "</span>" : "" ?>
                                <input name="mother_english_name"  placeholder="Mother english name" class="col-sm-2" />
                                <?= isset($errors['mother_english_name']) ? "<span class='text-danger'>" . $errors['mother_english_name'] . "</span>" : "" ?>
                                <input name="mother_nid"  placeholder="Mother National ID" class="col-sm-2" />
                                <?= isset($errors['mother_nid']) ? "<span class='text-danger'>" . $errors['mother_nid'] . "</span>" : "" ?>

                                <input name="father_job"  placeholder="Father Job" class="col-sm-3" />
                                <?= isset($errors['father_job']) ? "<span class='text-danger'>" . $errors['father_job'] . "</span>" : "" ?>
                                <input name="father_Qualification"  placeholder="Father Qualification" class="col-sm-3" />
                                <?= isset($errors['father_Qualification']) ? "<span class='text-danger'>" . $errors['father_Qualification'] . "</span>" : "" ?>
                                <input name="mother_job"  placeholder="Mother Job" class="col-sm-2" />
                                <?= isset($errors['mother_job']) ? "<span class='text-danger'>" . $errors['mother_job'] . "</span>" : "" ?>
                                <input name="mother_Qualification"  placeholder="Mother Qualification" class="col-sm-2" />
                                <?= isset($errors['mother_Qualification']) ? "<span class='text-danger'>" . $errors['mother_Qualification'] . "</span>" : "" ?>
                                
                                <input name="emergency_contact"  placeholder="Emergency Contact" class="col-sm-2" />
                                <?= isset($errors['emergency_contact']) ? "<span class='text-danger'>" . $errors['emergency_contact'] . "</span>" : "" ?>
                                <input name="emergency_phone"  placeholder="Emergency Phone" class="col-sm-2" />
                                <?= isset($errors['emergency_phone']) ? "<span class='text-danger'>" . $errors['emergency_phone'] . "</span>" : "" ?>
                                <select name="father_spoken_id" class="col-sm-3">
                                    <option value="">Father Spoken Language</option>
                                    <?php
                                    $i=0;
                                    foreach ($languages as $language) {
                                        $temp=strval($i);
                                        echo "<option value='{$temp}'>{$language}</option>";
                                        $i++;
                                    }
                                    ?>
                                </select>
                                <?= isset($errors['father_spoken']) ? "<span class='text-danger'>" . $errors['father_spoken'] . "</span>" : "" ?>
                                <select name="mother_spoken_id" class="col-sm-3">
                                    <option value="">Mother Spoken Language</option>
                                    <?php
                                    $i=0;
                                    foreach ($languages as $language) {
                                        $temp=strval($i);
                                        echo "<option value='{$temp}'>{$language}</option>";
                                        $i++;
                                    }
                                    ?>
                                </select>
                                <?= isset($errors['mother_spoken']) ? "<span class='text-danger'>" . $errors['mother_spoken'] . "</span>" : "" ?>
                                
                                <hr>
                                <button class="btn btn-success">Add Student</button>
                                <a href="index.php" class="btn btn-danger">Cancel</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php require_once(BASE_PATH . '/layout/footer.php') ?>