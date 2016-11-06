<?php


class HomeView extends View  //////////////////////////////////////////////////////// This class to display homepage contents
{
	protected function displayContent()
	{
		$html = '	<!--content container strat-->
			<div id="content_BG">'."\n";
											//////////////////////////////////////////////to display images gallery
		$html .= '	<!--image gallery start-->
				<div id="image_gallery" >'."\n";
		$html .= '			<div class="jimgMenu">'."\n";
		$html .= '				<ul>
								<li class="landscapes"><a href="#">Landscapes</a></li>'."\n";
		$html .= '					<li class="people"><a href="#">People</a></li>'."\n";
		$html .= ' 					<li class="nature"><a href="#">Nature</a></li>'."\n";
		$html .= '					<li class="abstract"><a href="#">Abstract</a></li>'."\n";
		$html .= '					<li class="urban"><a href="#">Urban</a></li>'."\n";
		$html .= '				</ul>
						</div>'."\n";
		$html .= '	</div><!--image gallery end-->'."\n";
		$html .= '	<div class="image_end"></div>'."\n";
		
		$content = $this->model->getContent($contenttype="AboutMFH");/////////////////// to get contents for home page whats MFH area
		$html .= '<div id="desc">'."\n";
		$html .= '	<h3>What\'s MFH</h3>'."\n";
		$html .= '	<p>'.$content['PageContents'].'</p>'."\n";
		if($_SESSION['UserType'] == 'Admin' || $_SESSION['Permission'] == 'sameadmin' || $_SESSION['Permission'] == 'superstaff'){
			$html .= '<a href="index.php?pageID=EditHomeWhat&amp;type=AboutMFH" class="editLink"><span>Edit</span></a>'."\n";
		}
		$html .= '</div>'."\n";
		
		$html .= '	<!--highlights start-->
				<div id="highlights">'."\n";
		
	
		$image1 = $this->model->getImages($imagetype="promotion1");////////////////////////to get images for home page promotion area
		
		$content1 = $this->model->getContent($contenttype="promotion1");/////////////////// to get contents for home page promotion area

		$html .= '		<div id="promotion1" class="promotions">'."\n";
		$html .= '			<div class="promotion_adv">'."\n";
		$html .= '				<img src="images/page/'.$image1['ImagePath'].'" id="promotion_img" alt="'.$image1['ImagePath'].'"/>'."\n";
		$html .= '			</div>'."\n";
		$html .= '			<div class="pro_desc">'."\n";
		$html .= '				<p>
							'.stripslashes($content1['PageContents']).'
							</p>'."\n";
							
		$html .= '				<a href="index.php?pageID=Course" class="see_all">see all &gt;&gt;</a>'."\n";
		$html .= '			</div>'."\n";
		if($_SESSION['UserType'] == 'Admin' || $_SESSION['Permission'] == 'sameadmin' || $_SESSION['Permission'] == 'superstaff'){
			$html .= '<a href="index.php?pageID=EditHome&amp;type=promotion1" class="editLink"><span>Edit</span></a>'."\n";
		}
		$html .= '		</div>'."\n";
		
		$image2 = $this->model->getImages($imagetype="promotion2");////////////////////////to get images for home page promotion area
		$content2 = $this->model->getContent($contenttype="promotion2");/////////////////// to get contents for home page promotion area
		$html .= '		<div id="promotion2" class="promotions">'."\n";
		$html .= '			<div class="promotion_adv">'."\n";
		$html .= '				<img src="images/page/'.$image2['ImagePath'].'" id="promotion_img2" alt="'.$image2['ImagePath'].'"/>'."\n";
		$html .= '			</div>'."\n";
		$html .= '			<div class="pro_desc">'."\n";
		$html .= '				<p>
							'.stripslashes($content2['PageContents']).'
							</p>'."\n";
		$html .= '				<a href="index.php?pageID=Course" class="see_all">see all &gt;&gt;</a>'."\n";
		$html .= '			</div>'."\n";
		if($_SESSION['UserType'] == 'Admin' || $_SESSION['Permission'] == 'sameadmin' || $_SESSION['Permission'] == 'superstaff'){
			$html .= '<a href="index.php?pageID=EditHome&amp;type=promotion2" class="editLink"><span>Edit</span></a>'."\n";
		}
		$html .= '		</div>'."\n";
		
		$html .= '	</div><!--highlights end-->'."\n";

		$html .= '	<!--news and events, partnerships start-->
				<div id="news_partnership">'."\n";
		$html .= '		<div id="news_box">'."\n";
		$html .= '			<h1>New Courses</h1>'."\n";
		
	
		$news = $this->model->getNew();////////////////////////////////////////////////////////////////////to display latest course area
		foreach($news as $new){
			$html .= '		<a href="index.php?pageID=ShowCourse&amp;CID='.$new['CourseID'].'" class="news_events">
							<button class="select">'."\n";
			$html .= '				<h3 class="newtitle">'.stripslashes($new['CourseTitle']).'</h3><p>'.stripslashes($new['CourseLevel']).'</p>'."\n";
			$html .= '			</button>
						</a>'."\n";
		}
		$html .= '		</div>'."\n";
		
		$html .= '		<div id="partnership_box">'."\n";
		$html .= '			<h1>Accreditations and Memberships</h1>'."\n";
		$html .= '			<div id="icon_box">'."\n";
		$html .= '				<img src="images/homeicon/AMicon1.jpg" class="AMicon" alt="icon1"/>'."\n";
		$html .= '				<img src="images/homeicon/AMicon2.jpg" class="AMicon" alt="icon2"/>'."\n";
		$html .= '				<img src="images/homeicon/AMicon3.jpg" class="AMicon" alt="icon3"/>'."\n";
		$html .= '				<img src="images/homeicon/AMicon4.png" class="AMicon" alt="icon4"/>'."\n";
		$html .= '				<img src="images/homeicon/AMicon5.png" class="AMicon" alt="icon5"/>'."\n";
		$html .= '			</div>'."\n";
		$html .= '		</div>'."\n";
		$html .= '	</div><!--news and events, partnerships end-->'."\n";
		$html .= '	<div class="clear"></div>'."\n";
		$html .= '	
			</div><!--content container end-->'."\n";
		$html .= '	<div class="content_break" ></div>'."\n";
		return $html;

	}
}
?>