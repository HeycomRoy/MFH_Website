<?php

class ShowCourseView extends View  ////////////////////////////////////////this class is to display each course deatils and image for this cours
{

	protected $model;
	protected $CID;

	
	public function __construct($rs, $model, $CID)
	{
		$this->rs = $rs;
		$this->model = $model;
		$this->CID = $CID;
	}
	
	
	protected function displayContent() /////////////////////////////////////////this function contains method to display course deatils content
	{
            $html = '<!--content container strat-->
                    <div id="content_BG" >'."\n";
            
            $html .= '	<!--contents showbox start-->
                    <div class="contents_showbox" style="height:1300px;" >'."\n";
            $html .= ' 	<div class="side_links" >'."\n";
            
            $html .= $this->model->sideLinkDisplay();////////////////////////////this is for display side news for new course
                    
            $html .= ' 	</div>'."\n";
                                    
            $html .= '	<!--show course view content area start-->
                        <div id="show_course" style=" min-height:500px; width:622px; float:left;">'."\n";
            
            $course_view = $this->model->getCourse($this->CID, $start, $limit);////////////////////////to get record from database
            $html .= '      <div class="show_image"  style="margin:10px 0 0 10px; min-height:400px;">
                                <img align="left" src="images/page/big_'.$course_view['CourseImage'].'" class="course_pic" style="padding:0 10px 10px 0;" alt="courseImage" />'."\n";
            $html .= '          <h2>'.stripslashes($course_view['CourseTitle']).'</h2>'."\n";
            $html .= '          <h3>'.stripslashes($course_view['CourseSubtitle']).'</h3><br/>'."\n";
            $html .= '          <p><strong>Course Level:</strong><br/>&ensp;'.stripslashes($course_view['CourseLevel']).'</p>'."\n";
            $html .= '          <p><strong>Course Price:</strong><br/>&ensp;'.$course_view['CoursePrice'].'</p><br/>'."\n";
            $html .= '          <p><strong>Course Summary:</strong>&ensp;'.stripslashes($course_view['CourseSummary']).'</p>'."\n";
            $html .= '      </div>'."\n";
            
            $html .= '	</div><!--show course view content area end-->'."\n";
            $html .= '
                    </div> <!--contents showbox end-->'."\n";
            $html .= '  <div class="clear"></div>'."\n";
            
            $html .= '	
                    </div><!--content container end-->'."\n";
            $html .= '	<div class="content_break" ></div>'."\n";
            return $html;
	}
}
	
?>