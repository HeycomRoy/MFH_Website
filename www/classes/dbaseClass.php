<?php
include_once'../conf-sc.php';

class Dbase/////////////////////////////////////////////////////////////*This class for connecting to the database and database queries*/
{
    private $db;
    
    public function __construct()
    {
        try{
            $this->db = new mysqli(DBHOST, DBUSER, DBPASS, DBNAME);
            if(mysqli_connect_errno()){
                throw new exception("Unable to connect to database");
            }
            else{
                return $this->db;
            }
        }
        catch(exception $e){
            echo $e->getMessage();
        }
    }
    
    public function getPage($pageID)////////////////////////////////////this function is for get page details
    {
        $qry = "SELECT PageID, PageName, PageTitle, PageHeading, PageKeywords, PageDescription FROM mfh_pages WHERE PageName = '$pageID'";
        $rs = $this->db->query($qry);
        if($rs){
            if($rs->num_rows>0){
                $page = $rs->fetch_assoc();
                return $page;
            }
            else{
                die('Page not found');
            }
        }
        else{
            die('Error executing query:'.$qry);
        }
    }
    
  
   public function getImages($type)///////////////////////////////////////////this function to get images 
    {
        $qry = "SELECT ImageID, PageID, ImageType, ImagePath FROM mfh_image WHERE ImageType='$type'";
        $rs = $this->db->query($qry);
        if($rs){
            if($rs->num_rows>0){
		$gimgs = $rs->fetch_assoc();
                return $gimgs;
            }
            else{
                $msg = 'Not images record';
                return $msg;
            }
        }
        else{
            echo 'Error executing query:'.$qry;
        }
    }
    
    public function getContent($contenttype)////////////////////////////////////this function is for get content of deffrent pages
    {
        $qry = "SELECT ContentID, PageID, ContentType, PageContents FROM mfh_content WHERE ContentType='$contenttype'";
        $rs = $this->db->query($qry);
        if($rs){
            if($rs->num_rows>0){
		$contents = $rs->fetch_assoc();
                return $contents;
            }
            else{
                $msg = 'Not contents record';
                return $msg;
            }
        }
        else{
            echo 'Error executing query:'.$qry;
        }
    }


    public function getAboutMfh($contenttype, $contentsection)/////////////////////////////get content from database for about us page
    {
        $qry = "SELECT ContentID, PageID, ContentType, PageContents, ContentSection FROM mfh_content WHERE ContentType='$contenttype' && ContentSection='$contentsection'";
        $rs = $this->db->query($qry);
        if($rs){
            if($rs->num_rows>0){
		$contents = $rs->fetch_assoc();
                return $contents;
            }
            else{
                $msg = 'Not contents record';
                return $msg;
            }
        }
        else{
            echo 'Error executing query:'.$qry;
        }
    }

   
    public function getNImages($PID) //this function to get a list of images
    {
        $qry = "SELECT mfh_image.ImageID, mfh_image.PageID, mfh_image.ImagePath,mfh_image.ImageSection, mfh_content.ContentID, mfh_content.PageID, mfh_content.PageContents,mfh_content.ContentSection FROM mfh_image, mfh_content WHERE mfh_image.PageID='$PID' && mfh_image.ImageSection = mfh_content.ContentSection";
        $rs = $this->db->query($qry);
        if($rs){
            if($rs->num_rows>0){
                $imgs = array();
                while($img = $rs->fetch_assoc()){
                    $imgs[] = $img;
                }
                return $imgs;
            }
            else{
                $msg = 'Not images record';
                return $msg;
            }
        }
        else{
            echo 'Error executing query:'.$qry;
        }
    }
    
    public function getCourse($CID, $start, $limit)///////////////////////////////////////////this function is for get courses record
    {
	if(!$CID){
	    $qry = "SELECT CourseID, CourseTitle, CourseSubtitle, CourseImage, CourseLevel, CoursePrice, CourseSummary, CourseDate FROM mfh_courses ORDER BY CourseDate DESC LIMIT $start, $limit ";
	    $rs = $this->db->query($qry);
	    if($rs){
		if($rs->num_rows>0){
		    $courses = array();
		    while($course = $rs->fetch_assoc()){
			$courses[] = $course;
		    }
		    return $courses;
		}
		else{
		    $msg = 'No course record';
		    return $msg;
		}
	    }
	    else{
		echo 'Error executing query:'.$qry;
	    }
	}
	else {
	    $qry = "SELECT CourseID, CourseTitle, CourseSubtitle, CourseImage, CourseLevel, CoursePrice, CourseSummary, CourseDate FROM mfh_courses WHERE CourseID = $CID";
	    $rs = $this->db->query($qry);
	    if($rs){
		if($rs->num_rows>0){
		
		    $rs=$rs->fetch_assoc();
		    return $rs;
		}
		else{
		    $msg = 'No course record';
		    return $msg;
		}
	    }
	    else{
		echo 'Error executing query:'.$qry;
	    }
	}
    }
    
    
    public function getNew()/////////////////////////////////////////////////////////////////get lastest course had been update display on home page
    {
	$qry = "SELECT CourseID, CourseTitle, CourseSubtitle, CourseLevel, CourseDate FROM mfh_courses  ORDER BY CourseDate DESC LIMIT 3";
	$rs = $this->db->query($qry);
	if($rs){
	    if($rs->num_rows>0){
	       $courses = array();
		    while($course = $rs->fetch_assoc()){
			$courses[] = $course;
		    }
		    return $courses;
	    }
	    else{
		$msg = 'No course record';
		return $msg;
	    }
	}
	else{
	    echo 'Error executing query:'.$qry;
	}
    }
    
    
    public function getProductCount()////////////////////////this function is for count courses
    {
	$qry = "SELECT COUNT(CourseID) AS pCount FROM mfh_courses";
	$rs = $this->db->query($qry);
	if ($rs) {
		$count = $rs->fetch_assoc();
		return $count;
	}
	else {
		echo "Error executing query";
	}
    }
    
    
    public function getUser($UserName)/////////////////////////////////////////////////this function is going to  get users
    {
        $qry = "SELECT UserID, UserName, PassWord, UserType, Permission FROM mfh_user WHERE UserName = '$UserName'";
        $rs = $this->db->query($qry);
	
        if($rs){
	    $user = $rs->fetch_assoc();
            return $user;
	    
        }
	
        else{
            echo 'Error executing query:'.$qry;
        }
    }
    
    
    public function createUser() /////////////////////////////////////////////////this function create a new user
    {
        if($_POST){
            extract($_POST);
        }
        if(!get_magic_quotes_gpc()){
            $Firstname = $this->db->real_escape_string($Firstname);
            $lastname = $this->db->real_escape_string($lastname);
            $email = $this->db->real_escape_string($email);
	    $username = $this->db->real_escape_string($username);
            $password = $this->db->real_escape_string($password);
            $city = $this->db->real_escape_string($permission);
	}
	    $password = sha1($password);
        $qry = "INSERT INTO mfh_user VALUES('', '$Firstname', '$lastname', '$email', '$username', '$password', 'Stuff', '$permission')";
        $rs = $this->db->query($qry);
        if($rs){
            $result['msg'] = 'New user has been created.';
            $result['UserID'] = $this->db->insert_id;
            return $result;
        }
        else{
            echo "Error creating user record, email address already exist".$qry;
            return false;
        }
    }
    
   
    public function insertNewCourse($courseF) //////////////////this function to insert a new course
    {
	if($courseF){
            extract($courseF);
        }
        
	if(!get_magic_quotes_gpc()){
            $CourseTitle = $this->db->real_escape_string($CourseTitle);
            $CourseSubtitle = $this->db->real_escape_string($CourseSubtitle);
	    $CourseLevel = $this->db->real_escape_string($CourseLevel);
            $CoursePrice = $this->db->real_escape_string($CoursePrice);
            $CourseSummary = $this->db->real_escape_string($CourseSummary);
	}
        $qry = "INSERT INTO mfh_courses VALUES('', '$CourseTitle', '$CourseSubtitle', '', '$CourseLevel', '$CoursePrice', '$CourseSummary','')";
        $rs = $this->db->query($qry);
        if($rs){
            $result['msg'] = 'New course has been created on list.';
            $result['CourseID'] = $this->db->insert_id;
            return $result;
        }
        else{
            echo "Error creating course record".$qry;
            return false;
        }   
    }
   
    
    public function updateCourseImagePath($CID, $PImg) /////////////////////////////////////this function to update course page image's path
    {
        $qry = "UPDATE mfh_courses SET CourseImage = '$PImg' WHERE CourseID = '$CID'";
        $rs = $this->db->query($qry);
        if($rs){
            return true;
        }
        else{
            echo"Error updating course image path:".$qry;
            return false;
        }
    }
    
    
    public function updateContent($home)/////////////////////////////////////////////////////////this function to update content for home page
    {
	extract($home);
	
	if(!get_magic_quotes_gpc()){
            $PageContents = $this->db->real_escape_string($PageContents);
	}
	$qry = "UPDATE mfh_content SET PageContents = '$PageContents' WHERE ContentType = '$Ctype'";
	$rs = $this->db->query($qry);
	if($rs){
	    $result = $Ctype;
	    return $result;
	}
	else {
	    echo"Error updating content: ".$qry;
	    return false;
	}
    
    }
    
    public function updateCourseContent($course)//////////////////////////////this function is for admin to update course content
    {
		extract($course);
		
		if(!get_magic_quotes_gpc()){
				$CourseTitle = $this->db->real_escape_string($CourseTitle);
			$CourseSubtitle = $this->db->real_escape_string($CourseSubtitle);
			$CourseLevel = $this->db->real_escape_string($CourseLevel);
			$CoursePrice = $this->db->real_escape_string($CoursePrice);
			$CourseSummary = $this->db->real_escape_string($CourseSummary);
		}
		$qry = "UPDATE mfh_courses SET CourseTitle = '$CourseTitle', CourseSubtitle = '$CourseSubtitle', CourseLevel = '$CourseLevel', CoursePrice = '$CoursePrice', CourseSummary = '$CourseSummary' WHERE CourseID = '$CID'";
		$rs = $this->db->query($qry);
		if($rs){
			$result = $CID;
			return $result;
		}
		else {
			echo"Error updating content: ".$qry;
			return false;
		}
    
    }
    
    public function updateStuContent($stu)///////////////////////////////////////To update contents for student life page
    {
		extract($stu);
		if(!get_magic_quotes_gpc()){
				$PageContents = $this->db->real_escape_string($PageContents);
		}
		
		$qry = "UPDATE mfh_content SET PageContents = '$PageContents' WHERE ContentType = '$CType'";
		$rs = $this->db->query($qry);
		if($rs){
			$result = $CType;
			return $result;
		}
		else {
			echo"Error updating content: ".$qry;
			return false;
		}
    
    }
    
    public function updateImageTable($contentType, $PImage)////////////////////////////////this function is for update image
    {
        $qry = "UPDATE mfh_image SET ImagePath = '$PImage' WHERE ImageType = '$contentType'";
        $rs = $this->db->query($qry);
        if($rs){
            return true;
        }
        else{
            echo"Error updating image path:".$qry;
            return false;
        }
    }
    
    public function updateImageHomeTable($Itype, $PImage)////////////////////////////////this function is for update home promotion area image
    {
        $qry = "UPDATE mfh_image SET ImagePath = '$PImage' WHERE ImageType = '$Itype'";
        $rs = $this->db->query($qry);
        if($rs){
            return true;
        }
        else{
            echo"Error updating image path:".$qry;
            return false;
        }
    }
    
    public function updateImageCourseTable($CID, $PImage) //////////////////////////////////this function is for update course image
    {
        $qry = "UPDATE mfh_courses SET CourseImage = '$PImage' WHERE CourseID = '$CID'";
        $rs = $this->db->query($qry);
        if($rs){
            return true;
        }
        else{
            echo"Error updating image path:".$qry;
            return false;
        }
    }
    
    
    public function updateAbt($abtOus)///////////////////////////////////////////this function is for update About us page
    {
        if($abtOus){
            extract($abtOus);
        }
        
        $PageContents = $this->db->real_escape_string($PageContents);
        
        $qry = "UPDATE mfh_content SET PageContents = '$PageContents' WHERE ContentType = '$CType' && ContentSection = '$CSection'";
        $rs = $this->db->query($qry);
        if($rs){
            $result['msg'] = 'update success.';
        
        }
        else{
            echo "Error inserting product:".$qry;
            return false;
        }
        return $result;
    }
    
    
    public function deleteCourseDetails($CID)////////////////////////////////////this function is for delete course record from database
    {   
	
        $qry = "DELETE FROM mfh_courses WHERE CourseID = '$CID'";
        $rs = $this->db->query($qry);
        if ($rs) {
            $result['ok'] = true;
            $result['msg'] = 'This course successfully deleted!';
        }
        else {
            $result['ok'] = false;
            $result['msg'] = 'Error deleting this course: '.$qry;
        }
        return $result;
    }
    
}
?>