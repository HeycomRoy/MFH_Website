<?php

class DeleteCourseView extends View  //////////////////////////////////////////////////This class is contain methods for delete course page
{
    protected $model;
    private $CID;
    private $course;
    private $msg;
    
    public function __construct($rs, $model, $CID)
    {
        $this->rs = $rs;
        $this->model = $model;
        $this->CID = $CID;
    }
    
    
    protected function displayContent()  ////////////////////////////////////////////////////////////to display delete course page content
    {
        $html = '	<!--content container strat-->
			<div id="content_BG">'."\n";
        $html .= '<div id="deleteForm" style="min-height:400px">'."\n";
        $html .= '<h3 class="pagehead">'.$this->rs['PageHeading'].'</h3>'."\n";
        /////////////////////////////////////////////////////////////////////////////////////////////////////if this user is not admin user
        if($_SESSION['UserType'] != 'Admin' and $_SESSION['Permission'] != 'sameadmin' and $_SESSION['Permission'] != 'superstaff'){
            $html .= '<div class="pageMsg">Sorry, but this is a restricted page!</div>'."\n";
        }
        //////////////////////////////////////////////////////////////////////////////////////////////to process once user submit the form
        else{
            if($_POST['confirm']){
                $result = $this->model->deleteCourseDetails($_POST['CID'], $_POST['PImage']);
                $html .= '<div class="prdrow"><div class="pageMsg">'.$result['msg'].'</div></div>'."\n";
		$html .= '      <div class="clear"></div>'."\n";
               // $html .= '<meta http-equiv="refresh" content=2;URL="index.php?pageID=WineCollection"'."\n";
            }
            elseif($_POST['cancel']){
                $html .= '<div class="pageMsg" style="margin-left:180px;">No COURSE has been Deleted</div>';
            }
            $course = $this->model->getCourse($this->CID, $s, $l);
            
            if(!$_POST['confirm']){
                $html .= $this->displayDeleteForm($course);
            }
        }
        $html .= '</div>'."\n";
        $html .= '</div><!--content container end-->'."\n";
        $html .= '	<div class="content_break" ></div>'."\n";
        return $html;
    }
    
    
    private function displayDeleteForm($course) /////////////////////////////////////////////this function is to display delete course form
    {
        $html = ' <div class="prdrow">'."\n";
        $html .= '  <div class="bigImage"><img src="images/page/'.$course['CourseImage'].'" alt="bigImage" /></div>'."\n";
        $html .= '  <div class="prdDetails">'."\n";
        $html .= '      <p class="product_title">'.$course['CourseTitle'].'</p>'."\n";
        $html .= '      <div class="delform">Do you want to delete this course?<br />'."\n";
        $html .= '          <form method="post" action="'.htmlentities($_SERVER['REQUEST_URI']).'">'."\n";
        $html .= '              <input type="hidden" name="CID" value="'.$course['CourseID'].'" />'."\n";
        $html .= '              <input type="hidden" name="PImage" value="'.$course['CourseImage'].'" />'."\n";
        $html .= '              <input type="submit" name="confirm" value="Yes" /> '."\n";
        $html .= '              <input type="submit" name="cancel" value="No" />'."\n";
        $html .= '          </form>'."\n";
		$html .= '      </div>'."\n";
        $html .= '  </div>'."\n";
        $html .= '</div>'."\n";
        $html .= '      <div class="clear"></div>'."\n";
        return $html;
    }
    
}
?>