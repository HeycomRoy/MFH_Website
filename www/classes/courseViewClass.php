<?php

class CourseView extends View	/////////////////////////////This class contains method to display courses page
{
	public $rs;
	public $model;
	private $pageNum;		////////////  current page number
	private $pPageCount = 3;        //////////////  number of products displayed per page
	private $start;			//////////////  record number to use as starting point for the query

	
	public function __construct ($rs, $model, $pageNum)
	{
	    $this->rs=$rs;
	    $this->model=$model;
	    if ($pageNum) {
		$this->pageNum = intval($pageNum);
	    }
	    else {
		$this->pageNum = 1;
	    }
	}
	protected function displayContent()
	{
		/////////////////////////////here is going to count courses
		$count = $this->model->getProductCount();
		
		$html = '<!--content container strat-->
			<div id="content_BG">'."\n";
		$html .= '	<!--image start-->
				<div class="head_image" >'."\n";
		$html .= '		<img src="images/headimages/courses.jpg" alt="courses"/>'."\n";
		$html .= '	</div><!--image end-->
				<div class="image_end"></div>'."\n";
				
		$html .= '	<!--contents showbox start-->
				<div class="contents_showbox" >'."\n";
		$html .= ' 		<div class="side_links" >'."\n";
		
		////////////////////side news
		$html .= $this->model->sideLinkDisplay();
		////////////////////side news end
		$html .= '		</div>'."\n";
		
		/////////////////////////////////////////////////////////////////For Admin and staff users to login and to display add a new course link
		if($_SESSION['UserType'] == 'Admin' || $_SESSION['Permission'] == 'sameadmin' || $_SESSION['Permission'] == 'superstaff' || $_SESSION['Permission'] == 'updatecourses'){
			$html .= '<a href="index.php?pageID=AddNewCourse&amp;CID='.$course['CourseID'].'" class="addNewLink"><span>Add a new course</span></a>'."\n";

		}
		
		$html .= '		<div class="whts_new">'."\n";
		$this->start = ($this->pageNum - 1) * $this->pPageCount;
		$courses = $this->model->getCourse($CID, $this->start, $this->pPageCount);
		
		foreach($courses as $course){
		$html .= '		<a href="index.php?pageID=ShowCourse&amp;CID='.$course['CourseID'].'" class="p_link" ><button class="new_stuff" >'."\n";
		$html .= '			<img align="left" src="images/page/'.$course['CourseImage'].'" class="new_stuff_pic" alt="'.$courses['CourseImage'].'"/>'."\n";
		$html .= '			<h1>'.stripslashes($course['CourseTitle']).'</h1>'."\n";
		$CourseSum = substr($course['CourseSummary'],0,500);
		$html .= '			<p class="content_text">'.stripslashes($CourseSum).'&hellip;</p>'."\n";
		$html .= '		</button></a>'."\n";
			if($_SESSION['UserType'] == 'Admin' || $_SESSION['Permission'] == 'sameadmin' || $_SESSION['Permission'] == 'superstaff' || $_SESSION['Permission'] == 'updatecourses'){
				$html .= '<a href="index.php?pageID=EditCourse&amp;CID='.$course['CourseID'].'" class="editLink"><span>Edit</span></a>'."\n";
			        $html .= '|<a href="index.php?pageID=DeleteCourse&amp;CID='.$course['CourseID'].'" class="deleteLink1">	&emsp;&emsp;&emsp;&emsp;<span>Delete</span></a>'."\n";

			}
		}
		$html .= $this->displayProductPages($count['pCount']);
		$html .= '		</div>'."\n";
		$html .= '	</div> <!--contents showbox end-->'."\n";
		$html .= '	<div class="clear" ></div>'."\n";
		
		$html .= '	
			</div><!--content container end-->'."\n";
		$html .= '	<div class="content_break" ></div>'."\n";
		
		return $html;

	}
	
	private function displayProductPages($count)///////////////////////this function is going to display pagenation
	{
		if ($count <= $this->pPageCount) {
			return;
		}
		$html = '<div id="pagination"><ul>'."\n";
		if ($this->pageNum > 1) {
			$html .= '<li>&lt; <a href="index.php?pageID=Course&amp;p='.($this->pageNum - 1).'">Previous</a></li>'."\n";
		}
		else {
			$html .= '<li>Pages: </li>'."\n";
		}
		$pCount = ceil($count / $this->pPageCount);
		for ($i=1; $i <= $pCount; $i++) {
			if ($this->pageNum == $i) {
				$class = "curPage";
			}	
			else {
				$class = "notCur";
			}
			$html .= '<li class="'.$class.'"><a href="index.php?pageID=Course&amp;p='.$i.'">'.$i.'</a></li>'."\n";
		}
		if ($this->pageNum != $pCount) {
			$html .= '<li class="next"><a href="index.php?pageID=Course&amp;p='.($this->pageNum + 1).'">Next</a>&gt;</li>'."\n";
		}
		$html .= '</ul></div>'."\n";
		return $html;
	}
}

?>