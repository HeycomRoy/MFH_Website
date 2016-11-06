<?php
 
class EditCourseView extends View ////////////////////////////////////////////////This class contines method to precess edit course
{
    protected $model;
    protected $result;
    

    public function __construct($rs, $model, $CID)
    {
        $this->rs = $rs;
        $this->model = $model;
		$this->CID = $CID;
    }
    
    
    protected function displayContent() //////////////////this function contines method to display content of this page
    {

        $html = '<!--content container strat-->
                    <div id="content_BG" >'."\n";
	    $html .= '<h3 class="pagehead">'.$this->rs['PageHeading'].'</h3>'."\n";
            if ($_SESSION['UserType'] != 'Admin' and $_SESSION['Permission'] != 'sameadmin' and $_SESSION['Permission'] != 'superstaff' and $_SESSION['Permission'] != 'updatecourses') {
                $html .= '<div class="pageMsg" style="height:500px;">Sorry, but this is a restricted page!</div>'."\n";
            }
             /////////////////////////////////if user submit the form process process update function in model class
            else {
				$courseF = $this->model->getCourse($this->CID, $s, $l);
                if ($_POST['Update']) {
                    $this->result = $this->model->updateCourse($_POST);
					
                    $courseF = $_POST;

				if ($result['PImage']) {
					$_POST['PImage'] = $result['PImage'];
				}
                    //$html .= '<meta http-equiv="refresh" content=4;URL="index.php"'."\n";
				}
              
				$html .= $this->displayEditCourseForm("Update", $courseF);
            }

            $html .= '	
                    </div><!--content container end-->'."\n";
            $html .= '	<div class="content_break" ></div>'."\n";
        return $html;
    }
          
    protected function displayEditCourseForm($mode, $courseF)  ///////////////////////////////////////////////display add edit course form  
    {  
        ////////////////////////////////////////////////////////////////////////////////////////Import variables into the current function
        if (is_array($this->result)) {
            extract($this->result);	
        }
        $html =' <div class="editCourse"><!--edit Course&Fees page form start-->'."\n";
		$html .= '<div id="editform" >'."\n";	
        $html .= '   <form id="edit_form" method="post" action="'.htmlentities($_SERVER['REQUEST_URI']).'" enctype="multipart/form-data">'."\n";
        $html .= '      <input type="hidden" name="MAX_FILE_SIZE" value="2000000" />'."\n";
        $html .= '      <input type="hidden" name="CID" value="'.$courseF['CourseID'].'" />'."\n";
        $html .= '      <label for="CTitle" class="col1">Course Title: </label>'."\n";
        $html .= '      <input type = "text" name="CourseTitle" id = "CTitle" value="'.htmlentities(stripslashes($courseF['CourseTitle']),ENT_QUOTES).'" />'."\n";		
        $html .= '      <div class="col3"><br /> '.$title_msg.'</div>'."\n";
		$html .= '      <div class="clear"></div>'."\n";
        
        $html .= '      <label for="CsubTitle" class="col1">Course Subtitle: </label>'."\n";
        $html .= '      <input type = "text" name="CourseSubtitle" id = "CsubTitle" value="'.htmlentities(stripslashes($courseF['CourseSubtitle']),ENT_QUOTES).'" />'."\n";		
        $html .= '      <div class="col3"><br /> '.$subtitle_msg.'</div>'."\n";
		$html .= '      <div class="clear"></div>'."\n";
        
        $html .= '      <label for="CLevel" class="col1">Course Level: </label>'."\n";
        $html .= '      <input type = "text" name="CourseLevel" id = "CLevel" value="'.htmlentities(stripslashes($courseF['CourseLevel']),ENT_QUOTES).'" />'."\n";		
        $html .= '          <div class="col3"><br /> '.$level_msg.'</div>'."\n";
		$html .= '      <div class="clear"></div>'."\n";
        
        $html .= '      <label for="CPrice" class="col1">Course Price </label>'."\n";
        $html .= '      <input type = "text" name="CoursePrice" id = "CPrice" value="'.htmlentities(stripslashes($courseF['CoursePrice']),ENT_QUOTES).'" />'."\n";		
        $html .= '      <div class="col3"><br /> '.$price_msg.'</div>'."\n";
		$html .= '      <div class="clear"></div>'."\n";
        
        $html .= '      <label for="CSum" class="col1">Course Summary </label>'."\n";
        $html .= '      <textarea rows="6" cols="20" name="CourseSummary" id = "CSum"  class="col2">'.htmlentities(stripslashes($courseF['CourseSummary']),ENT_QUOTES).'</textarea>'."\n";		
        $html .= '      <div class="col3"><br /> '.$summary_msg.'</div>'."\n";
		$html .= '      <div class="clear"></div>'."\n";
        
        if ($courseF['CourseImage']) {
            $html .= '<div class="col1a">Course Images<br />';
            $html .= '	<img src="images/page/'.$courseF['CourseImage'].'" alt="course" />'."\n";
			$html .= '</div>'."\n";
        } 
        else {
            $html .= '<div class="col1" >&nbsp;</div>'."\n";
        }
        $html .= '      <div class="col2u">'."\n";
		$html .= '			<label for="Cimage">Update Image:</label><br />'."\n";
        $html .= '          <input type="file" name="PImage" id="Cimage" />'."\n";//</div>
		$html .= '			<div id="pimage_msg" class="col3"><br /> '.$pimage_msg.'</div>'."\n";
        $html .= '          <div class="clear"></div>'."\n";
        $html .= '          <input type = "submit" name="'.$mode.'" value="'.$mode.'" class="submitButton" />'."\n";
        $html .= '      </div>'."\n"; 
		$html .= '      <div class="clear"></div>'."\n";
        $html .= '  </form>'."\n";////////////////end of div editform
        $html .= '  <div class="pagemsg">'.$this->result['msg'].'</div>'."\n";
		$html .= '</div>'."\n"; //////////////////end of edit form div
		$html .='</div><!--edit Course&Fees page form end-->'."\n";
		$html .= '      <div class="clear"></div>'."\n";
        return $html;
    }
}

?>