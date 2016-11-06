<?php
include 'classes/dbaseClass.php';
include 'classes/validateClass.php';
include 'classes/resizeImageClass.php';
include 'classes/uploadClass.php';

///////////////////////////////////////////////////////this class is contains method to validate form and precess functions
class Model extends DBase
{
    private $validate;
    
   
    public function __construct()
    {
        parent::__construct();
        $this->validate = new Validate;
        
    }

    public function sideLinkDisplay()//////////////////////////////////////this function is to display side news area 
    {
	$html = '<h1 class="spagetitle">New Courses</h1>'."\n";
		
	$news = $this->getNew();
	foreach($news as $new){
		$html .= '<a href="index.php?pageID=ShowCourse&amp;CID='.$new['CourseID'].'" class="newCourseA">
				<button class="newCourse">'."\n";
		$html .= '		<h3 class="newtitle">'.$new['CourseTitle'].'</h3><p>'.$new['CourseLevel'].'</p>'."\n";
		$html .= '	</button>
			  </a>'."\n";
	}
	
	return $html;
    }
    
	
    public function checkUserSession()////////////////////this function is going to check users session
    {
	    if($_POST['Logout'] ){
		unset($_SESSION['User'], $_SESSION['UserID'], $_SESSION['UserType']);
		$result['pageMsg'] = 'You are now loggedout!';
	    }
	    if($_POST['Login']){
		    $result = $this->validateUser();
	    }
	    else{
		if ($_SESSION['User'])
		    $result['pageMsg'] = 'You are already logged-in as '.$_SESSION['User'];
	    }
	    return $result;
    }
    

    private function validateUser()/////////////////////////////this function is going to validate user
    {
	if($_POST['Login'] && $_POST['UserName'] && $_POST['UserPassword']){
	
	    $rso = $this->getUser($_POST['UserName']);

	    if($rso){
	///////////////$_SESSION is superglobal, you can call from everywhere else!(normaly use for form)
		if(sha1($_POST['UserPassword']) == $rso['PassWord']){
		    $_SESSION['User'] = $rso['UserName'];
		    $_SESSION['Permission'] = $rso['Permission'];
		    $_SESSION['UserType'] = $rso['UserType'];
		    
		    $result['pageMsg'] = 'You have successfully logged-in as '.$_SESSION['User'];
		    $result['ok'] = true;
		    $result['errorMsg'] = '';
		    return $result;
		}
		else{
		    $result['errorMsg'] = 'Invalid User Name/Password Combination';
		}
	    }
	    else{
		$result['errorMsg'] = 'Invalid User Name/Password Combination';
	    }
	}
	else{
	    $result['errorMsg'] = 'Please fill in all information!';
	}
	$result['ok'] = false;
	return $result;
    }
    
 
    public function validateRegisterEntries()////////////////////this function is going to validate register form
    {
        $result = array();
        $result['fnameMsg'] = $this->validate->checkRequired($_POST['Firstname']);
        $result['lnameMsg'] = $this->validate->checkRequired($_POST['lastname']);
        $result['emailMsg'] = $this->validate->checkEmail($_POST['email']);
		$result['usernameMsg'] = $this->validate->checkRequired($_POST['username']);
        $result['passMsg'] = $this->validate->checkRequired($_POST['password']);
		$result['CpassMsg'] = $this->validate->checkRequired($_POST['password']);
		if($_POST['password'] != $_POST['Cpassword']){
			$result['CpassMsg'] = '*passwords do not match';
		}
		$result['PermissionMsg'] = $this->validate->checkRequired($_POST['permission']);
	
        //add other field validations here
        foreach($result as $errmsg){
            if(strlen($errmsg)>0){
                $result['ok'] = false;
		
                return $result;
            }
        }
        $result['ok'] = true;
	
	
        return $result;
    }
    
	
    public function updateHome($home)///////////////////////////////////////this function is going to update homepage
    {
	
	$vresult = $this->validateFormEntries($home);////////////////exit function if there is an in error in form validation
	if (!$vresult['ok']) {
	    return $vresult;
	}
	$iresult = $this->updateContent($home); /////////////////////////////////////// update home page content
	if($iresult){
	    $uresult['msg'] = 'Page contents update successfully. ';
	    $iType = $iresult;
	}

	if ($_FILES['PImage']['name']) {
	    $PImage = $this->uploadAndResizeHomeImage($home['Itype']);
	    
	    if ($PImage) {

		if($this->updateImageHomeTable($home['Itype'], $PImage)){
		   $uresult['msg'] .= ' Image updated/resized successfully. '; 
		}
		
	    }
	    else {
		$uresult['msg'] .= 'Unable to update/resize image. ';
	    }
	    
	}	
	return $uresult;
    }
    
    public function updateStu($stu) ///////////////////////////////this function is for update student life page
    {
	
	$vresult = $this->validateStuEntries();//////////////////////////////exit function if there is an in error in form validation
	if (!$vresult['ok']) {
	    return $vresult;
	}
	$iresult = $this->updateStuContent($stu); ////////////////////////// update student life page content
	$contentType = $iresult;
	
	if(!$contentType){
	    return $contentType;
	}else{
	    $uresult['msg'] = 'Page contents has been updated.';
	}
	if ($_FILES['PImage']['name']) {
	    $PImage = $this->uploadAndResizeImage($contentType);

	    if ($PImage) {
		if($this->updateImageTable($contentType, $PImage)){
		   $uresult['msg'] .= ' Image updated/resized successfully. '; 
		}
		
	    }
	    else {
		$uresult['msg'] .= 'Unable to update/resize image. ';
	    }
	    
	}
	return $uresult;
    }
    
    
    public function updateCourse($course) //////////////////////////////////////this function is for update courses page
    {
	
	$vresult = $this->validateCourseEntries();////////////////////////exit function if there is an in error in form validation
	if (!$vresult['ok']) {
	    return $vresult;
	}
	$iresult = $this->updateCourseContent($course); ////////////////////////////////////// update course&fees page content
	$CID = $iresult;
	
	if(!$CID){
	    return $iresult;
	}else{
	    $uresult['msg'] = 'Page contents has been updated.';
	}
	if ($_FILES['PImage']['name']) {
	    $PImage = $this->uploadAndResizeImage($CID);

	    if ($PImage) {
		if($this->updateImageCourseTable($CID, $PImage)){
		   $uresult['msg'] .= ' Image updated/resized successfully. '; 
		}
	    }
	    else {
		$uresult['msg'] .= 'Unable to update/resize image. ';
	    }
	    
	}	
	return $uresult;
    }


    private function uploadAndResizeImage($CID)//////////////////////////////////////this function is going to upload and resize images
    {	
	$imgsPath = "images/page";
	if (!$_FILES['PImage']['name']) {
		return false;
	}
	$extension = explode('.',$_FILES['PImage']['name']);
	if (stristr($extension[1],"jp")) {
		$extension[1] = "jpg";
	}
	$fileTypes = array("image/jpeg","image/pjpeg","image/gif","image/png");
	$upload = new Upload("PImage", $fileTypes, $imgsPath);
	$returnFile = $upload->isUploaded();
	if (!$returnFile) {
		return false;
	}
	$thumbPath = $imgsPath.'/'.$CID.'.'.$extension[1];
	$uid = uniqid('bk');
	$thumbBackup = $imgsPath.'/'.$uid.''.$CID.'.'.$extension[1];
	if (file_exists($thumbPath)) {
		rename($thumbPath, $thumbBackup);
	}
	$bigPath = $imgsPath.'/big_'.$CID.'.'.$extension[1];
	$bigBackup = $imgsPath.'/big_'.$uid.''.$CID.'.'.$extension[1];
	if (file_exists($bigPath)) {
		rename($bigPath, $bigBackup);
	}
	copy($returnFile, $thumbPath);
	if (!file_exists($thumbPath)) {
		return false;
	}
	$imgSize = getimagesize($returnFile);
	if ($imgSize[0] > 200 || $imgSize[1] > 200) {
		$thumbImage = new ResizeImage($thumbPath, 200, $imgsPath,'');
		if (!$thumbImage->resize()) {
			echo 'Unable to resize image to 200 pixels';
		}
	}
	rename($returnFile, $bigPath);
	if ($imgSize[0] > 425 || $imgSize[1] > 425) {
		$bigImage = new ResizeImage($bigPath, 425, $imgsPath,'');
		if (!$bigImage->resize()) {
			echo 'Unable to resize image to 425 pixels';
		}
	}
	if (file_exists($thumbPath) && file_exists($bigPath)) {
		@unlink($thumbBackup);
		@unlink($bigBackup);
		return basename($thumbPath);
	}
	else {
		rename($thumbBackup, $thumbPath);
		rename($bigBackup, $bigPath);
		return false;
	}
    }
    
    
    //////////////////////////////////////////////////////////////////////////////////////////////
    
    
    private function uploadAndResizeHomeImage($CID)////////////////////////////////////////upload and resize images for home page
    {	
	$imgsPath = "images/page";
	if (!$_FILES['PImage']['name']) {
		return false;
	}
	$extension = explode('.',$_FILES['PImage']['name']);
	if (stristr($extension[1],"jp")) {
		$extension[1] = "jpg";
	}
	
	$fileTypes = array("image/jpeg","image/pjpeg","image/gif","image/png");
	$upload = new Upload("PImage", $fileTypes, $imgsPath);
	$returnFile = $upload->isUploaded();
	if (!$returnFile) {
		return false;
	}
	$thumbPath = $imgsPath.'/'.$CID.'.'.$extension[1];
	$uid = uniqid('bk');
	$thumbBackup = $imgsPath.'/'.$uid.''.$CID.'.'.$extension[1];
	if (file_exists($thumbPath)) {
		rename($thumbPath, $thumbBackup);
	}
	
	copy($returnFile, $thumbPath);
	if (!file_exists($thumbPath)) {
		return false;
	}
	$imgSize = getimagesize($returnFile);
	if ($imgSize[0] > 425|| $imgSize[1] > 425) {
		$thumbImage = new ResizeImage($thumbPath, 425, $imgsPath,'');
		if (!$thumbImage->resize()) {
			echo 'Unable to resize image to 200 pixels';
		}
	}
	
	if (file_exists($thumbPath) ) {
		@unlink($thumbBackup);
		
		return basename($thumbPath);
	}
	else {
		rename($thumbBackup, $thumbPath);
		
		return false;
	}

    }
    //////////////////////////////////////////////////////////////////////////////////////////////
    
    
    public function processEditAbt($abtOus)////////////////////////////////////////process edit about us page
    {
	$uresult = $this->updateAbt($abtOus);
	return $uresult;
    }
    
    public function addNewCourse($courseF)
    {
        
        $vresult = $this->validateCourseEntries();/////////////////////////////////////to validate edit form
		if (!$vresult['ok']) {
			return $vresult;
		}
        $iresult = $this->insertNewCourse($courseF);
	
        $CID = $iresult['CourseID'];
	
        if(!$CID){
            return $iresult;
        }
	
        $PImage = $this->uploadAndResizeImage($CID);/////////////////////////////////here is to resize images
	
        if($PImage){
            if($this->updateCourseImagePath($CID, $PImage)){
                $iresult['msg'] .= 'Image uploaded/resized successfully.';
                $iresult['PImage'] .= $PImage;
            }
        }
        else{
            $iresult['msg'] .= 'Unable to upload/resize image.';
        }
        return $iresult;
    }
    

    public function sendMail()/////////////////////////////////////////this function is for send email
	{
        $to = 'cui.yao.yu@hotmail.com';
        $subject = 'MFH International';
        $messeage = 'From:'.stripcslashes($_POST['UserName'])."\n";
        $messeage =trim(strip_tags(stripcslashes($_POST['Message'])));
        $headers = 'From:'.stripcslashes($_POST['UserName'])."\r\n Reply-To:".$_POST['Email'];

        if(mail($to, $subject, $messeage, $headers)){
            $msg['pgMsg'] = 'Email sent successfully';
        }
        else{
            $msg['pgMsg'] = 'Unable to send email';
        }
        return $msg;   
    }
    
    
    public function validateFormEntries()/////////////////////////////////////////this function is for validate form entries
    {
        $result = array();
        $result['hsummary_msg'] = $this->validate->checkRequired($_POST['PageContents']);

        ////////////////add other field validations here
        foreach($result as $errmsg){
            if(strlen($errmsg)>0){
                $result['ok'] = false;
                return $result;
            }
        }
        $result['ok'] = true;
        return $result;
    }
    
    
    public function validateStuEntries()///////////////////////////////this function is for validate student life page form
    {
	$result = array();
        $result['psummary_msg'] = $this->validate->checkRequired($_POST['PageContents']);

        ///////////////add other field validations here
        foreach($result as $errmsg){
            if(strlen($errmsg)>0){
                $result['ok'] = false;
                return $result;
            }
        }
        $result['ok'] = true;
        return $result;
    }
    
   
    public function validateCourseEntries() ///////////////////////////////////////////this function is for validate course & fee page
    {
        $result = array();
        $result['title_msg'] = $this->validate->checkRequired($_POST['CourseTitle']);
	$result['subtitle_msg'] = $this->validate->checkRequired($_POST['CourseSubtitle']);
	$result['level_msg'] = $this->validate->checkRequired($_POST['CourseLevel']);
	$result['price_msg'] = $this->validate->checkNumeric($_POST['CoursePrice']);
	$result['summary_msg'] = $this->validate->checkRequired($_POST['CourseSummary']);
	if ($_GET['pageID'] == 'AddNewCourse') {
			$result['pimage_msg'] = $this->validate->checkRequired($_FILES['PImage']['name']);	
	}
	
        //add other field validations here
        foreach($result as $errmsg){
            if(strlen($errmsg)>0){
                $result['ok'] = false;
                return $result;
            }
        }
        $result['ok'] = true;
        return $result;
    }
   
   
   public function validateEmailForm($Contact)///////////////////////////////////////////////this function is for validate sent email form
    {
	$result['name_msg'] = $this->validate->checkRequired($Contact['UserName']);
	$result['email_msg'] = $this->validate->checkEmail($Contact['Email']);
	//$result['message_msg'] = $this->validate->checkRequired(trim(strip_tags($Contact['Message']));
	if(strlen(trim(strip_tags($Contact['Message']))) == 0){
			$result['message_msg'] = "*This is required field";
	}
	foreach($result as $errmsg) {
	    if (strlen($errmsg) > 0) {
		$result['ok'] = false;
		return $result;
	    }
	   
	}
	$result['ok'] = true;
	return $result;
    }
    
}
?>