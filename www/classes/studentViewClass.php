<?php

class StudentView extends View//////////////////////////////////////////this class is for student life page to display content
{
   
    protected function displayContent() /////////////////////////////////////////this function is going to display content
    {
        $html = '<!--content container strat-->
                <div id="content_BG">'."\n";
        $html .= '	<!--image start-->
                        <div class="head_image" >'."\n";
        $html .= '		<img src="images/headimages/student_life.jpg" alt="student_life"/>'."\n";
        $html .= '	</div><!--image end-->
                        <div class="image_end"></div>'."\n";
                        
        $html .= '	<!--contents showbox start-->
                        <div class="contents_showbox" style="height:1300px;" >'."\n";
        $html .= ' 		<div class="side_links" >'."\n";
        
        $html .= $this->model->sideLinkDisplay();
                
        $html .= ' 		</div>'."\n";
                                
        $html .= '		<!--student life content area start-->
                                <div id="s_life_content" >'."\n";
        
        $image = $this->model->getImages($imagetype="Study at Wellington");
		$content = $this->model->getContent($contenttype="Study at Wellington");
        $html .= '			<div id="dec_image">'."\n";
        $html .= '				<div id="dec_wlt">'."\n";
        $html .= ' 		                    <h3 class="t_title">Study at Wellington</h3><br/>'."\n";
        $html .= ' 		                    <img src="images/page/'.$image['ImagePath'].'" align="left" style="padding:10px;" alt="'.$image['ImagePath'].'"/>
                                                    <p>'.stripslashes($content['PageContents']).'</p>'."\n";
        if($_SESSION['UserType'] == 'Admin' || $_SESSION['Permission'] == 'sameadmin' || $_SESSION['Permission'] == 'superstaff'){
			$html .= '<a href="index.php?pageID=EditStudent&amp;type=Study at Wellington" class="editLink"><span>Edit</span></a>'."\n";
		}
        $html .= '                              </div>'."\n";
        $html .= '                              <img src="images/headimages/cooler_wellington.jpg" style="width:612px; margin:20px 0 30px 0;" alt="wellington"/>'."\n";

        $image1 = $this->model->getImages($imagetype="School Activity");
		$content1 = $this->model->getContent($contenttype="School Activity");
        $html .= '				<div id="images_wlt">'."\n";
        $html .= ' 		                    <h3 class="t_title">School Activity</h3><br/>'."\n";
        $html .= ' 		                    <img src="images/page/'.$image1['ImagePath'].'" align="left" style="padding:10px;" alt="'.$image1['ImagePath'].'"/>'."\n";
        $html .= '                                  <p>'.stripslashes($content1['PageContents']).'</p>'."\n";
		if($_SESSION['UserType'] == 'Admin' || $_SESSION['Permission'] == 'sameadmin' || $_SESSION['Permission'] == 'superstaff'){
			$html .= '<a href="index.php?pageID=EditStudent&amp;type=School Activity" class="editLink"><span>Edit</span></a>'."\n";
		}
        $html .= '                              </div>'."\n";
        
        $image2 = $this->model->getImages($imagetype="Accommodation");
		$content2 = $this->model->getContent($contenttype="Accommodation");
        $html .= '				<div id="homestay_wlt">'."\n";
        $html .= ' 		                    <h3 class="t_title">Accommodation And Homestay</h3><br/>'."\n";
        $html .= ' 		                    <img src="images/page/'.$image2['ImagePath'].'" align="left" style="padding:10px;" alt="'.$image2['ImagePath'].'"/>'."\n";
        $html .= '                                  <p>'.stripslashes($content2['PageContents']).'</p>'."\n";
		if($_SESSION['UserType'] == 'Admin' || $_SESSION['Permission'] == 'sameadmin' || $_SESSION['Permission'] == 'superstaff'){
			$html .= '<a href="index.php?pageID=EditStudent&amp;type=Accommodation" class="editLink"><span>Edit</span></a>'."\n";
		}
        $html .= '                              </div>'."\n";
        
        $html .= '			</div>'."\n";
    
        $html .= '		</div><!--student life content area end-->'."\n";
        $html .= '	</div> <!--contents showbox end-->'."\n";
        $html .= '      <div class="clear"></div>'."\n";
        $html .= '	
                </div><!--content container end-->'."\n";
        $html .= '	<div class="content_break" ></div>'."\n";
        return $html;
    }
}
?>