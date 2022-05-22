<?php
require_once(BASE_PATH . '/dal/basic_dal.php');

function getStudents(
    $page_size,
    $page = 1,
    $student_code = null,
    $english_first_name = null,
    $grade = null,
    $class=null,
    $student_status=null,
    $q = null,
    $order_field = "grade",
    $order_by = "desc"
) {

    $offset = ($page - 1) * $page_size;

    $sql = "SELECT s.*,g.name AS grade_name,c.className AS class_name, ss.name AS studentStatus FROM students s
     INNER JOIN grades g ON g.id=s.grade
     INNER JOIN classes c ON c.id=s.class
     INNER JOIN student_status ss ON s.student_status=ss.id
    WHERE 1=1";

    $types = '';
    $vals = [];
    $sql = addWhereConditions($sql, $student_code, $english_first_name, $grade,$class,$student_status, $q, $types, $vals);
    $sql .= " ORDER BY $order_field $order_by limit $offset,$page_size";

    $students =  getRows($sql, $types, $vals);
    return $students;
}



function addWhereConditions($sql, $student_code=null, $english_first_name=null, $grade=null,$class=null,$student_status=null, $q = null, &$types, &$vals)
{
    if ($student_code != null) {
        $types .= 'i';
        array_push($vals, $student_code);
        $sql .= " AND student_code=?";
    }
    if ($english_first_name != null) {
        $types .= 'i';
        array_push($vals, $english_first_name);
        $sql .= " AND english_first_name=?";
    }
    if ($grade != null) {
        $types .= 'i';
        array_push($vals, $grade);
        $sql .= " AND s.grade IN (SELECT name FROM grades WHERE id=?)";
    }
    if ($class != null) {
        $types .= 'i';
        array_push($vals, $class);
        $sql .= " AND s.class IN (SELECT name FROM class WHERE id=?)";
    }
    if ($student_status != null) {
        $types .= 'i';
        array_push($vals, $student_status);
        $sql .= " AND s.student_status IN (SELECT name FROM student_status WHERE id=?)";
    }
    if ($q != null) {
        $types .= 'ss';
        array_push($vals, '%' . $q . '%');
        array_push($vals, '%' . $q . '%');
        $sql .= " AND (english_first_name like ? OR class like ?)";
    }
    return $sql;
}

function addNewstudent($request)
{
    $sql = "INSERT INTO students(id,school_name,grade,class,student_code,student_nid,nationality,student_status,join_year,staff_son
    ,legal_guardian,parents_separated,school_abreviation,updat,arabic_first_name,arabic_middle_name,arabic_last_name,arabic_family_name,
    english_first_name,english_middle_name,english_last_name,english_family_name,dob,birth_place,gender,religon,city,adress,email
    ,pwd,student_affairs1,student_affairs2,birth_code,address_Gov,emergency_contact,emergency_phone)
    VALUES (null,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";

    $student_id = addData($sql, 'iiiisiisiiissssssssssssiiissssssiss', [
        
        $request['branch_id'],
        $request['grade_id'],
        $request['class_id'],
        $request['student_code'],
        $request['student_nid'],
        $request['nationality_id'],
        $request['status_id'],
        $request['year_id'],
        $request['staffSon_id'],
        $request['guardian_id'],
        $request['seperated_id'],
        $request['abreviation_id'],
        $request['updated_id'],
        $request['student_arabic_firstName'],
        $request['student_arabic_middleName'],
        $request['student_arabic_lastName'],
        $request['student_arabic_familyName'],
        $request['student_english_firstName'],
        $request['student_english_middleName'],
        $request['student_english_lastName'],
        $request['student_english_familyName'],
        $request['dob'],
        $request['student_birthPlace'],
        $request['gender_id'],
        $request['religon_id'],
        $request['cities_id'],
        $request['address'],
        $request['E-mail'],
        $request['password'],
        $request['Student_affair1'],
        $request['Student_affair2'],
        $request['birthCode'],
        $request['gov_id'],
        $request['emergency_contact'],
        $request['emergency_phone']
    ]);
    if ($student_id) {
        addFather($request, $student_id);
        addMother($request, $student_id);
        return true;
    }
    return false;
}

function addFather($request, $student_id){
    $sql = "INSERT INTO parents(id,typ,english_name,arabic_name,nid,mobilephone,email,job,qualification,spoken_language
    ,nationality)
    VALUES (null,?,?,?,?,?,?,?,?,?,?)";
    $parent_id = addData($sql, 'isssssssii', [
        1,
        null,
        null,
        $request['father_nid'],
        $request['father_mobile'],
        $request['father_email'],
        $request['father_job'],
        $request['father_Qualification'],
        $request['father_spoken_id'],
        $request['fatherNationality_id']
    ]);
    if ($parent_id){
        addData(
            "INSERT INTO student_parent (parent,student) VALUES (?,?)",
            'ii',
            [$parent_id,$student_id]
        );
        return true;
    } 
    return false;
}
function addMother($request,$student_id){
    $sql=null;
    $sql = "INSERT INTO parents(id,typ,english_name,arabic_name,nid,mobilephone,email,job,qualification,spoken_language
    ,nationality)
    VALUES (null,?,?,?,?,?,?,?,?,?,?)";
    $parent_id=null;
    $parent_id = addData($sql, 'isssssssii', [
        0,
        $request['mother_english_name'],
        $request['mother_arabic_name'],
        $request['mother_nid'],
        $request['mother_mobile'],
        $request['mother_email'],
        $request['mother_job'],
        $request['mother_Qualification'],
        $request['mother_spoken_id'],
        $request['motherNationality_id']
    ]);
  
   if ($parent_id){
    
        $test=addData(
            "INSERT INTO student_parent (parent,student) VALUES (?,?)",
            'ii',
            [$parent_id,$student_id]
        );
        
        return true;
    } 
    return false;
}




function getParents($id,&$mother,&$father)
{
    $sql = "SELECT * FROM student_parent WHERE student=?";
    $parents = getRows($sql, 'i', [$id]);
    $sql = "SELECT * FROM parents WHERE id=?";
    foreach($parents as $parent){
        $sql = "SELECT * FROM parents WHERE id=?";
        $res=getRow($sql, 'i', [$parent['parent']]);
       
        if($res['typ']==0){
        $mother=$res;
       
        }
        else
        $father=$res;
        
    }
}

function getStudentById($id)
{
    $sql = "SELECT * FROM students WHERE id=?";
    $student = getRow($sql, 'i', [$id]);
    return $student;
}

function getStudentDetailsById($id,$user=null)
{
    $sql = "SELECT * FROM students WHERE id=?";
    $student = getRow($sql, 'i', [$id]);
    $sql="SELECT name FROM branches WHERE id=?";
    $student['branch'] = getRow($sql, 'i', [$student['school_name']]);
    $sql="SELECT name FROM grades WHERE id=?";
    $student['grade'] = getRow($sql, 'i', [$student['grade']]);
    $sql="SELECT name FROM nationality WHERE id=?";
    $student['nationality'] = getRow($sql, 'i', [$student['nationality']]);
    $sql="SELECT name FROM student_status WHERE id=?";
    $student['student_status'] = getRow($sql, 'i', [$student['student_status']]);
    $sql="SELECT name FROM cities WHERE id=?";
    $student['city'] = getRow($sql, 'i', [$student['city']]);
    $sql="SELECT name FROM governante WHERE id=?";
    $student['address_Gov'] = getRow($sql, 'i', [$student['address_Gov']]);
    $sql="SELECT name FROM classes WHERE id=?";
    $student['class'] = getRow($sql, 'i', [$student['class']]);
    $sql = "SELECT * FROM student_parent WHERE student_id=?";
    $student['parents'] = getRows($sql, 'i', [$id]);
    
    return $student;
}


function editstudent($id, $request)
{
    $types = 'iiiisiiiiiissssssssssssiiissssssiss';
    $vals = [$request['branch_id'],
    $request['grade_id'],
    $request['class_id'],
    $request['student_code'],
    $request['student_nid'],
    $request['nationality_id'],
    $request['status_id'],
    $request['year_id'],
    $request['staffSon_id'],
    $request['guardian_id'],
    $request['seperated_id'],
    $request['abreviation_id'],
    $request['updated_id'],
    $request['student_arabic_firstName'],
    $request['student_arabic_middleName'],
    $request['student_arabic_lastName'],
    $request['student_arabic_familyName'],
    $request['student_english_firstName'],
    $request['student_english_middleName'],
    $request['student_english_lastName'],
    $request['student_english_familyName'],
    $request['dob'],
    $request['student_birthPlace'],
    $request['gender_id'],
    $request['religon_id'],
    $request['cities_id'],
    $request['address'],
    $request['E-mail'],
    $request['password'],
    $request['Student_affair1'],
    $request['Student_affair2'],
    $request['birthCode'],
    $request['gov_id'],
    $request['emergency_contact'],
    $request['emergency_phone']];
    $sql = "UPDATE students SET school_name=?,grade=?,class=?,student_code=?,student_nid=?,nationality=?,student_status=?,join_year=?,staff_son=?
    ,legal_guardian=?,parents_separated=?,school_abreviation=?,updat=?,arabic_first_name=?,arabic_middle_name=?,arabic_last_name=?,arabic_family_name=?,
    english_first_name=?,english_middle_name=?,english_last_name=?,english_family_name=?,dob=?,birth_place=?,gender=?,religon=?,city=?,adress=?,email=?
    ,pwd=?,student_affairs1=?,student_affairs2=?,birth_code=?,address_Gov=?,emergency_contact=?,emergency_phone=?";
    $sql .= " WHERE id=?";
    $types .= 'i';
    array_push($vals, $id);
 
    if (editData($sql, $types, $vals)) {
        
        deleteParents($id);
        addFather($request, $id);
        addMother($request, $id);
        return true;
    }
    return false;
}



function deletestudent($id)
{
    deleteParents($id);
    $sql = "DELETE FROM students WHERE id=?";
    execute($sql, 'i', [$id]);
}
function deleteParents($id){
    $sql = "SELECT * FROM student_parent WHERE student=?";
    $parents = getRows($sql, 'i', [$id]);
    foreach($parents as $parent){
        
        $temp=$parent['parent'];
        $sql = "DELETE FROM student_parent WHERE parent=?";
        execute($sql, 'i', [$temp]);
        $sql = "DELETE FROM parents WHERE id=?";
        execute($sql, 'i', [$temp]);
    }
    
}