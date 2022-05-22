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
if (!isset($_REQUEST['id'])) {
    header('Location:index.php');
    die();
}
$id = $_REQUEST['id'];
$student = getStudentById($id);
$father=[];
$mother=[];
getParents($id,$mother,$father);
// print_r($mother);
// die();

if (isset($_REQUEST['student_code'])) {
    
        if (editstudent($id,$_REQUEST)) {
            header('Location:index.php');
            die();
        } else {
            $generic_error = "Error while edit the post";
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
                        <h4>Edit Post</h4>
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
                                        echo "<option " . ($branch['id'] == $student['school_name'] ? "selected" : "") . " value='{$branch['id']}'>{$branch['name']}</option>";
            
                                    }
                                    ?>
                                </select>
                                <?= isset($errors['branches']) ? "<span class='text-danger'>" . $errors['branches'] . "</span>" : "" ?>
                                <select name="grade_id" class="col-sm-2">
                                    <option value="">Select Grade</option>
                                    <?php
                                    foreach ($grades as $grade) {
                                        echo "<option " . ($grade['id'] == $student['grade'] ? "selected" : "") . " value='{$grade['id']}'>{$grade['name']}</option>";
                                        
                                    }
                                    ?>
                                </select>
                                <?= isset($errors['grades']) ? "<span class='text-danger'>" . $errors['grades'] . "</span>" : "" ?>
                                <select name="class_id" class="col-sm-2">
                                    <option value="">Select Class</option>
                                    <?php
                                    foreach ($classes as $class) {
                                        echo "<option " . ($class['id'] == $student['class'] ? "selected" : "") . " value='{$class['id']}'>{$class['className']}</option>";
                                        
                                    }
                                    ?>
                                </select>
                                <?= isset($errors['classes']) ? "<span class='text-danger'>" . $errors['classes'] . "</span>" : "" ?>
                               
                                <input name="student_code" placeholder="student_code" class="col-sm-2 " value="<?= $student['student_code'] ?>"/>
                                <?= isset($errors['student_code']) ? "<span class='text-danger'>" . $errors['student_code'] . "</span>" : "" ?>
                                
                                <input name="student_nid" placeholder="student_National ID" class="col-sm-2 " value="<?= $student['student_nid'] ?>" />
                                <?= isset($errors['student_nid']) ? "<span class='text-danger'>" . $errors['student_nid'] . "</span>" : "" ?>
                                
                                <select name="nationality_id" class="col-sm-2">
                                    <option value="">Select Nationality</option>
                                    <?php
                                    foreach ($nationalities as $nationality) {
                                        echo "<option " . ($nationality['id'] == $student['nationality'] ? "selected" : "") . " value='{$nationality['id']}'>{$nationality['name']}</option>";
                                        
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
                                        echo "<option " . ($status['id'] == $student['student_status'] ? "selected" : "") . " value='{$status['id']}'>{$status['name']}</option>";
                            
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
                                        echo "<option " . ($temp == $student['join_year'] ? "selected" : "") . " value='{$temp}'>{$year}</option>";
                                       
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
                                        echo "<option " . ($temp == $student['staff_son'] ? "selected" : "") . " value='{$temp}'>{$staffSon}</option>";
                                        
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
                                        echo "<option " . ($temp == $student['legal_guardian'] ? "selected" : "") . " value='{$temp}'>{$guardian}</option>";
                                        
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
                                        echo "<option " . ($temp == $student['parents_separated'] ? "selected" : "") . " value='{$temp}'>{$seperated}</option>";
                                        
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
                                        echo "<option " . ($temp == $student['school_abreviation'] ? "selected" : "") . " value='{$temp}'>{$abreviation}</option>";
                                        
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
                                        echo "<option " . ($temp == $student['updat'] ? "selected" : "") . " value='{$temp}'>{$update}</option>";
                                
                                        $i++;
                                    }
                                    ?>
                                </select>
                                <?= isset($errors['update']) ? "<span class='text-danger'>" . $errors['update'] . "</span>" : "" ?>
                                
                                <input name="student_arabic_firstName" placeholder=" Arabic First Name" class="col-sm-3" value= "<?= $student['arabic_first_name'] ?>" />
                                <?= isset($errors['student_arabic_firstName']) ? "<span class='text-danger'>" . $errors['student_arabic_firstName'] . "</span>" : "" ?>
                               
                                <input name="student_arabic_middleName" placeholder="Arabic Middle Name" class="col-sm-3" value= "<?= $student['arabic_middle_name'] ?>" />
                                <?= isset($errors['student_arabic_middleName']) ? "<span class='text-danger'>" . $errors['student_arabic_middleName'] . "</span>" : "" ?>
                                
                                <input name="student_arabic_lastName" placeholder=" Arabic Last Name" class="col-sm-3" value= "<?= $student['arabic_last_name'] ?>" />
                                <?= isset($errors['student_arabic_lastName']) ? "<span class='text-danger'>" . $errors['student_arabic_lastName'] . "</span>" : "" ?>

                                <input name="student_arabic_familyName" placeholder="Arabic Family Name" class="col-sm-3" value= "<?= $student['arabic_family_name'] ?>" />
                                <?= isset($errors['student_arabic_familyName']) ? "<span class='text-danger'>" . $errors['student_arabic_familyName'] . "</span>" : "" ?>
                                
                                <input name="student_english_firstName" placeholder="English First Name" class="col-sm-3" value= "<?= $student['english_first_name'] ?>" />
                                <?= isset($errors['student_english_firstName']) ? "<span class='text-danger'>" . $errors['student_english_firstName'] . "</span>" : "" ?>
                                
                                <input name="student_english_middleName" placeholder="English Middle Name" class="col-sm-2"  value= "<?= $student['english_middle_name'] ?>"/>
                                <?= isset($errors['student_english_middleName']) ? "<span class='text-danger'>" . $errors['student_english_middleName'] . "</span>" : "" ?>
                                
                                <input name="student_english_lastName" placeholder=" English Last Name" class="col-sm-3" value= "<?= $student['english_last_name'] ?>" />
                                <?= isset($errors['student_english_lastName']) ? "<span class='text-danger'>" . $errors['student_english_familyName'] . "</span>" : "" ?>
                                
                                <input name="student_english_familyName" placeholder="English Family Name" class="col-sm-3" value= "<?= $student['english_family_name'] ?>" />
                                <?= isset($errors['student_english_familyName']) ? "<span class='text-danger'>" . $errors['student_english_familyName'] . "</span>" : "" ?>
                                
                                <label>DOB<input type="date" name="dob" class="form-control" value= "<?= $student['dob'] ?>" ></label>
                                <?= isset($errors['dob']) ? "<span class='text-danger'>" . $errors['dob'] . "</span>" : "" ?>
                                
                                <input name="student_birthPlace" placeholder="birth Place" class="col-sm-3" value= "<?= $student['birth_place'] ?>" />
                                <?= isset($errors['student_birthPlace']) ? "<span class='text-danger'>" . $errors['student_birthPlace'] . "</span>" : "" ?>
                                
                                <select name="gender_id" class="col-sm-2">
                                    <option value="">Gender</option>
                                    <?php
                                    $i=0;
                                    foreach ($genders as $gender) {
                                        $temp=strval($i);
                                        echo "<option " . ($temp == $student['gender'] ? "selected" : "") . " value='{$temp}'>{$gender}</option>";
                                        
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
                                        echo "<option " . ($temp == $student['religon'] ? "selected" : "") . " value='{$temp}'>{$religion}</option>";
                                        
                                        $i++;
                                    }
                                    ?>
                                </select>
                                <?= isset($errors['religion']) ? "<span class='text-danger'>" . $errors['religion'] . "</span>" : "" ?>
                                
                                <input name="father_nid" placeholder="Father National ID" class="col-sm-3" value= "<?= $father['nid'] ?>" />
                                <?= isset($errors['father_nid']) ? "<span class='text-danger'>" . $errors['father_nid'] . "</span>" : "" ?>
                                
                                <select name="cities_id" class="col-sm-2">
                                    <option value="">Select city</option>
                                    <?php
                                    foreach ($cities as $city) {
                                        echo "<option " . ($city['id'] == $student['city'] ? "selected" : "") . " value='{$city['id']}'>{$city['name']}</option>";
                                        
                                    }
                                    ?>
                                </select>
                                <?= isset($errors['cities']) ? "<span class='text-danger'>" . $errors['cities'] . "</span>" : "" ?>
                                
                                <input name="address" placeholder="Address" class="col-sm-3" value= "<?= $student['adress'] ?>" />
                                <?= isset($errors['address']) ? "<span class='text-danger'>" . $errors['address'] . "</span>" : "" ?>
                                
                                <input name="mother_arabic_name" placeholder="Mother Arabic Name" class="col-sm-3" value= "<?= $mother['arabic_name'] ?>" />
                                <?= isset($errors['mother_arabic_name']) ? "<span class='text-danger'>" . $errors['mother_arabic_name'] . "</span>" : "" ?>
                                
                                <input name="father_mobile" placeholder="Father Mobile" class="col-sm-2" value= "<?= $father['mobilephone'] ?>" />
                                <?= isset($errors['father_mobile']) ? "<span class='text-danger'>" . $errors['father_mobile'] . "</span>" : "" ?>
                                
                                <input name="father_email" placeholder="Father E-mail" class="col-sm-2" value= "<?= $father['email'] ?>"  />
                                <?= isset($errors['father_email']) ? "<span class='text-danger'>" . $errors['father_email'] . "</span>" : "" ?>
                                
                                <input name="mother_mobile" placeholder="mother Mobile" class="col-sm-3" value= "<?= $mother['mobilephone'] ?>" />
                                <?= isset($errors['mother_mobile']) ? "<span class='text-danger'>" . $errors['mother_mobile'] . "</span>" : "" ?>
                                
                                <input name="mother_email" placeholder="Mother E-mail" class="col-sm-3" value= "<?= $mother['email'] ?>" />
                                <?= isset($errors['mother_email']) ? "<span class='text-danger'>" . $errors['mother_email'] . "</span>" : "" ?>
                                
                                <input name="E-mail" placeholder="E-mail" class="col-sm-2" value= "<?= $student['email'] ?>" />
                                <?= isset($errors['E-mail']) ? "<span class='text-danger'>" . $errors['E-mail'] . "</span>" : "" ?>
                               
                                <input name="password"  placeholder="password" class="col-sm-2" value= "<?= $student['pwd'] ?>" />
                                <?= isset($errors['password']) ? "<span class='text-danger'>" . $errors['password'] . "</span>" : "" ?>

                                <select name="motherNationality_id" class="col-sm-3">
                                    <option value="">Select mother Nationality</option>
                                    <?php
                                    foreach ($nationalities as $nationality) {
                                        echo "<option " . ($nationality['id'] == $mother['nationality'] ? "selected" : "") . " value='{$nationality['id']}'>{$nationality['name']}</option>";
                    
                                    }
                                    ?>
                                </select>
                                <?= isset($errors['motherNationality']) ? "<span class='text-danger'>" . $errors['motherNationality'] . "</span>" : "" ?>
                                
                                <select name="fatherNationality_id" class="col-sm-3">
                                    <option value="">Select Father Nationality</option>
                                    <?php
                                    foreach ($nationalities as $nationality) {
                                        echo "<option " . ($nationality['id'] == $father['nationality'] ? "selected" : "") . " value='{$nationality['id']}'>{$nationality['name']}</option>";
                                        
                                    }
                                    ?>
                                </select>
                                <?= isset($errors['fatherNationality']) ? "<span class='text-danger'>" . $errors['fatherNationality'] . "</span>" : "" ?>
                                
                                <input name="Student_affair1" placeholder="Student affairs 1" class="col-sm-2" value= "<?= $student['student_affairs1'] ?>" />
                                <?= isset($errors['Student_affair1']) ? "<span class='text-danger'>" . $errors['Student_affair1'] . "</span>" : "" ?>
                               
                                <input name="Student_affair2"  placeholder="Student affairs 1" class="col-sm-2" value= "<?= $student['student_affairs2'] ?>" />
                                <?= isset($errors['Student_affair2']) ? "<span class='text-danger'>" . $errors['Student_affair2'] . "</span>" : "" ?>

                                <input name="birthCode"  placeholder="Bith Code" class="col-sm-3" value= "<?= $student['birth_code'] ?>" />
                                <?= isset($errors['birthCode']) ? "<span class='text-danger'>" . $errors['birthCode'] . "</span>" : "" ?>
                               
                                <select name="gov_id" class="col-sm-3">
                                    <option value="">Select Address Gov</option>
                                    <?php
                                    foreach ($govs as $gov) {
                                        echo "<option " . ($gov['id'] == $student['address_Gov'] ? "selected" : "") . " value='{$gov['id']}'>{$gov['name']}</option>";
                                        
                                    }
                                    ?>
                                </select>
                                <?= isset($errors['gov']) ? "<span class='text-danger'>" . $errors['gov'] . "</span>" : "" ?>
                                
                                <input name="mother_english_name"  placeholder="Mother english name" class="col-sm-2" value= "<?= $mother['english_name'] ?>" />
                                <?= isset($errors['mother_english_name']) ? "<span class='text-danger'>" . $errors['mother_english_name'] . "</span>" : "" ?>
                               
                                <input name="mother_nid"  placeholder="Mother National ID" class="col-sm-2" value= "<?= $mother['nid'] ?>" />
                                <?= isset($errors['mother_nid']) ? "<span class='text-danger'>" . $errors['mother_nid'] . "</span>" : "" ?>

                                <input name="father_job"  placeholder="Father Job" class="col-sm-3" value= "<?= $father['job'] ?>" />
                                <?= isset($errors['father_job']) ? "<span class='text-danger'>" . $errors['father_job'] . "</span>" : "" ?>
                                
                                <input name="father_Qualification"  placeholder="Father Qualification" class="col-sm-3" value= "<?= $father['qualification'] ?>" />
                                <?= isset($errors['father_Qualification']) ? "<span class='text-danger'>" . $errors['father_Qualification'] . "</span>" : "" ?>
                               
                                <input name="mother_job"  placeholder="Mother Job" class="col-sm-2" value= "<?= $mother['job'] ?>" />
                                <?= isset($errors['mother_job']) ? "<span class='text-danger'>" . $errors['mother_job'] . "</span>" : "" ?>
                                
                                <input name="mother_Qualification"  placeholder="Mother Qualification" class="col-sm-2" value= "<?= $mother['qualification'] ?>" />
                                <?= isset($errors['mother_Qualification']) ? "<span class='text-danger'>" . $errors['mother_Qualification'] . "</span>" : "" ?>
                                
                                <input name="emergency_contact"  placeholder="Emergency Contact" class="col-sm-2" value= "<?= $student['emergency_contact'] ?>" />
                                <?= isset($errors['emergency_contact']) ? "<span class='text-danger'>" . $errors['emergency_contact'] . "</span>" : "" ?>
                               
                                <input name="emergency_phone"  placeholder="Emergency Phone" class="col-sm-2" value= "<?= $student['emergency_phone'] ?>" />
                                <?= isset($errors['emergency_phone']) ? "<span class='text-danger'>" . $errors['emergency_phone'] . "</span>" : "" ?>
                               
                                <select name="father_spoken_id" class="col-sm-3">
                                    <option value="">Father Spoken Language</option>
                                    <?php
                                    $i=0;
                                    foreach ($languages as $language) {
                                        $temp=strval($i);
                                        echo "<option " . ($temp == $father['spoken_language'] ? "selected" : "") . " value='{$temp}'>{$language}</option>";
                                        
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
                                        echo "<option " . ($temp == $mother['spoken_language'] ? "selected" : "") . " value='{$temp}'>{$language}</option>";
                                        
                                        $i++;
                                    }
                                    ?>
                                </select>
                                <?= isset($errors['mother_spoken']) ? "<span class='text-danger'>" . $errors['mother_spoken'] . "</span>" : "" ?>
                                
                                <hr>
                                <button class="btn btn-success">Edit Post</button>
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