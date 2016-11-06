<?php

class AboutusView extends View	/////////////////////////////////////////////////This class is contains method to display about us page
{
    protected function displayContent()/////////////////////////////////////////this function is for about us content to display 
    {
	
        $html = '<!--content container strat-->
                <div id="content_BG">'."\n";
        $html .= '	<!--image start-->
                        <div class="head_image" >'."\n";
        $html .= '		<img src="images/headimages/about_us.jpg" alt="aboutUs"/>'."\n";
        $html .= '	</div><!--image end-->
                        <div class="image_end"></div>'."\n";
                        
        $html .= '	<!--contents showbox start-->
                        <div class="contents_showbox" >'."\n";
        $html .= ' 		<div class="side_links" >'."\n";
	
        $html .= $this->model->sideLinkDisplay();////////////////////////////////////this is going to display news for new course
                
        $html .= ' 		</div>'."\n";
                                
        $html .= '		<!--contact area start-->
                                <div id="contact_area">'."\n";
        $html .= '              <h3 class="t_title">About MFH</h3>'."\n";
        $html .= '              <div class="clear"></div>'."\n";
	
		///////////////////////////////////////////////////////////////////////////here is to display accordions
        $html .= '              <div id="accordionl">'."\n";
        $html .= '                  <h3 class="accordion_T"><a href="#">MFH International Philosophy</a></h3>'."\n";
        $aboutMfh = $this->model->getAboutMfh($contenttype='accordion', $contentsection='1');
		$html .= '                  <div>'."\n";
        $html .= '                      <p class="accordion_P">
					    '.htmlentities(stripslashes($aboutMfh['PageContents']),ENT_QUOTES).'
                                        </p>'."\n";
		if($_SESSION['UserType'] == 'Admin' || $_SESSION['Permission'] == 'sameadmin' || $_SESSION['Permission'] == 'superstaff'){
			$html .= '<a href="index.php?pageID=EditAboutMfh&amp;cnttp=accordion&amp;sec=1" class="editLink1"><span>Edit</span></a>'."\n";
		}
        $html .= '                  </div>'."\n";
        $html .= '                  <h3 class="accordion_T"><a href="#">Introduction to MFH</a></h3>'."\n";
        $aboutMfh1 = $this->model->getAboutMfh($contenttype='accordion', $contentsection='2');
		$html .= '                  <div>'."\n";
        $html .= '                      <p class="accordion_P">
					    '.htmlentities(stripslashes($aboutMfh1['PageContents']),ENT_QUOTES).'
                                        </p>'."\n";
		if($_SESSION['UserType'] == 'Admin' || $_SESSION['Permission'] == 'sameadmin' || $_SESSION['Permission'] == 'superstaff'){
			$html .= '<a href="index.php?pageID=EditAboutMfh&amp;cnttp=accordion&amp;sec=2" class="editLink1"><span>Edit</span></a>'."\n";
		}
        $html .= '                  </div>'."\n";
        $html .= '                  <h3 class="accordion_T"><a href="#">Achievements</a></h3>'."\n";
		$aboutMfh2 = $this->model->getAboutMfh($contenttype='accordion', $contentsection='3');
        $html .= '                  <div>'."\n";
        $html .= '                      <p class="accordion_P">
					    '.htmlentities(stripslashes($aboutMfh2['PageContents']),ENT_QUOTES).'
                                        </p>'."\n";
		if($_SESSION['UserType'] == 'Admin' || $_SESSION['Permission'] == 'sameadmin' || $_SESSION['Permission'] == 'superstaff'){
			$html .= '<a href="index.php?pageID=EditAboutMfh&amp;cnttp=accordion&amp;sec=3" class="editLink1"><span>Edit</span></a>'."\n";
		}
        $html .= '                  </div>'."\n";
        $html .= '              </div>'."\n";
        
        $html .= '              <div class="break_accordion"></div>'."\n";
        $html .= '              <h3 class="t_title">Our Staff</h3>'."\n";
        $html .= '              <div class="clear"></div>'."\n";
        $html .= '              <div id="accordionr">'."\n";
        $html .= '                  <h3 class="accordion_T"><a href="#">Directors</a></h3>'."\n";
        $aboutMfh3 = $this->model->getAboutMfh($contenttype='accordion', $contentsection='4');
		$html .= '                  <div>'."\n";
        $html .= '                      <p class="accordion_P">
					    '.htmlentities(stripslashes($aboutMfh3['PageContents']),ENT_QUOTES).'
                                        </p>'."\n";
		if($_SESSION['UserType'] == 'Admin' || $_SESSION['Permission'] == 'sameadmin' || $_SESSION['Permission'] == 'superstaff'){
			$html .= '<a href="index.php?pageID=EditAboutMfh&amp;cnttp=accordion&amp;sec=4" class="editLink1"><span>Edit</span></a>'."\n";
		}
        $html .= '                  </div>'."\n";
        $html .= '                  <h3 class="accordion_T"><a href="#">Academic Staff</a></h3>'."\n";
        $aboutMfh4 = $this->model->getAboutMfh($contenttype='accordion', $contentsection='5');
		$html .= '                  <div>'."\n";
        $html .= '                      <p class="accordion_P">
					    '.htmlentities(stripslashes($aboutMfh4['PageContents']),ENT_QUOTES).'
                                        </p>'."\n";
		if($_SESSION['UserType'] == 'Admin' || $_SESSION['Permission'] == 'sameadmin' || $_SESSION['Permission'] == 'superstaff'){
			$html .= '<a href="index.php?pageID=EditAboutMfh&amp;cnttp=accordion&amp;sec=5" class="editLink1"><span>Edit</span></a>'."\n";
		}
        $html .= '                  </div>'."\n";
        $html .= '                  <h3 class="accordion_T"><a href="#">Marketing &amp; Operations Team</a></h3>'."\n";
        $aboutMfh5 = $this->model->getAboutMfh($contenttype='accordion', $contentsection='6');
		$html .= '                  <div>'."\n";
        $html .= '                      <p class="accordion_P">
					    '.htmlentities(stripslashes($aboutMfh5['PageContents']),ENT_QUOTES).'
                                        </p>'."\n";
		//////////////////////////////////////////////////////////////////////this is for admin user login to edit this page by the edit link
		if($_SESSION['UserType'] == 'Admin' || $_SESSION['Permission'] == 'sameadmin' || $_SESSION['Permission'] == 'superstaff'){
			$html .= '<a href="index.php?pageID=EditAboutMfh&amp;cnttp=accordion&amp;sec=6" class="editLink1"><span>Edit</span></a>'."\n";
		}
        $html .= '                  </div>'."\n";
        $html .= '              </div>'."\n";
       
        
        $html .= '		</div><!--contact area end-->'."\n";
        $html .= '	</div> <!--contents showbox end-->'."\n";
        $html .= '      <div class="clear"></div>'."\n";
        $html .= '	
                </div><!--content container end-->'."\n";
        $html .= '	<div class="content_break" ></div>'."\n";
        return $html;

    }
}
?>