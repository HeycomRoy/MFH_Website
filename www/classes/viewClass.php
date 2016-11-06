<?php

abstract class View//this class is to display fundation of MFH website
{
    public $rs;
    protected $model;
    protected $result;
    
    public function __construct ($rs, $model)
    {
        $this->rs=$rs;
		$this->model=$model;
    }
    
    public function displayPage()///////////////////this function is for display whole page
    {
		if($_POST['Logout']){
			//To get function checkUserSession from model Class.
			$this->result = $this->model->checkUserSession();
		}
        $html = $this->displayHeader();
        $html .= $this->displayContent();
        $html .= $this->displayFooter();
        return $html;
    }
    

    abstract protected function displayContent();////////////////////////this function is for display content from either page
    
    
    protected function displayHeader(){/////////////////////////////////this function is for display header of the site
        $html = $this->displayHtmlHeader();
        $html .= $this->displayBanner();
		$html .= $this->displayNavBar();
        return $html;
    }
    
    private function displayHtmlHeader()/////////////////////this function contains header of the site
    {
        $html = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd" >'."\n";
		$html .= '<html xmlns="http://www.w3.org/1999/xhtml">'."\n";
		$html .= '<head>'."\n";
		$html .= '<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />'."\n";
		$html .= '<meta name="description" content="'.$this->rs['PageDescription'].'" />'."\n";
		$html .= '<meta name="keywords" content="'.$this->rs['PageKeywords'].'" />'."\n";
		$html .= '<link type="text/css" href="css/style.css" rel="stylesheet" />'."\n";
		
		$html .= '<link href="css/jimgMenu.css" rel="stylesheet" type="text/css" />'."\n";
		$html .= '<script type="text/javascript" src="js/jquery.js"></script>'."\n";
		$html .= '<script type="text/javascript" src="js/jquery-easing-1.3.pack.js"></script>'."\n";
		$html .= '<script type="text/javascript" src="js/jquery-easing-compatibility.1.2.pack.js"></script>'."\n";
		$html .= '<script type="text/javascript" src="js/gallery.js"></script>'."\n";
	
		if($_GET['pageID'] == 'Contact')
		{
			$html .= '<script type="text/javascript"  src="http://maps.google.com/maps/api/js?sensor=false">'."\n";
			$html .= '</script>'."\n";
			$html .= '<script type="text/javascript" src="js/gmap.js">'."\n";
			$html .= '</script>'."\n";
			$html .= '<script type="text/javascript" src="lib/openwysiwyg/scripts/wysiwyg.js"></script>'."\n";
			$html .= '<script type="text/javascript" src="lib/openwysiwyg/scripts/wysiwyg-settings.js"></script>'."\n";
			$html .= '<script type="text/javascript" src="lib/openwysiwyg/scripts/mysettings.js"></script>'."\n";
		}
		
		if($_GET['pageID'] == 'Aboutus')
		{
			$html .= '<link href="css/jquery-ui.css" rel="stylesheet" type="text/css"/>'."\n";
			$html .= '<script type="text/javascript" src="js/jquery.min.js"></script>'."\n";
			$html .= '<script type="text/javascript" src="js/jquery-ui.min.js"></script>'."\n";
			$html .= '	<script type="text/javascript">
					$(document).ready(function() {

						$("#accordionl").accordion();
					$("#accordionr").accordion({autoHeight: false});
					});
				</script>'."\n";
		}
		$html .= '<title>'.$this->rs['PageTitle'].'</title>'."\n";
		$html .= '</head>'."\n";
		return $html;
    }
    
    private function displayBanner()///////////////this function contains banner of the site
    {
		$html = '<body>'."\n";
		$html .= '<!--main content bg strat--><div id="main_BG" >'."\n";
		$html .= '<!--header container start-->
				<div id="header">
					<div>'."\n";
		$html .= '			<a href="index.php?pageID=Home">
							<img src="images/headimages/MFH_logo.jpg" style="width:210px" alt="logo"/>
						</a>'."\n";
		$html .= '		</div>'."\n";
		$html .= '	</div><!--header container end-->'."\n";
		return $html;
    }
    
    private function displayNavBar()////////////////////////////this function contains navgation of the site
    {
		$pageArray = array('Home', 'Course', 'Studentlife','Aboutus','Contact');
		$navArray = array('Home', 'Courses &amp; Fees', 'Student Life', 'About Us', 'Contact Us');
		
		$numLinks = count($navArray);
		$html = '<!--navgation bar start-->
				<div id="nav_bar">'."\n";
		$html .= '		<ul>'."\n";
		if($_GET['pageID']){
			$pageID = $_GET['pageID'];
		}
		else{
			$pageID = 'Home';
		}
		for($i=0; $i<$numLinks; $i++){
			$html .= '<li class="nav_botton">'."\n";
			if($pageID == $pageArray[$i]){
				$html .= '<a href="index.php?pageID='.$pageArray[$i].'" class="on_page">'.$navArray[$i].'</a></li>'."\n";
			}
			else{
				$html .= '<a href="index.php?pageID='.$pageArray[$i].'" >'.$navArray[$i].'</a></li>'."\n";
			}
		}
		$html .= '		</ul>'."\n";
		$html .= '	</div>'."\n";
		return $html;
    }
    
    protected function displayFooter()///////////////////////////////////////////this function contains footer of the site 
    {
		$html = '	<!--footer start-->
				<div id="footer">'."\n";
		
		$html .= '		<div id="footer_con"><!--footer content start-->'."\n";
		$html .= '			<div id="footer_logo">'."\n";
		$html .= '				<img src="images/headimages/f_logo.jpg" alt="footer_logo"/>'."\n";
		$html .= '				<p> Making Futres Happen International Institute</p>'."\n";
		$html .= '			</div>'."\n";
		$html .= '		<div>
						<a href="index.php?pageID=Sitemap" class="sitemap">Site map</a>
					</div>'."\n";

		if($_SESSION['User']){
			$html .= '		<div id="admin_link">
							<form method="post" action="'.htmlentities($_SERVER['REQUEST_URI']).'" >
							<input type="submit" value="Logout" name="Logout" id="log_out"/>'."\n";
							
			if($_SESSION['UserType'] == 'Admin' || $_SESSION['Permission'] == 'sameadmin'){
			$html .= '<a href="index.php?pageID=Register" class="addLink"><span>Add a new user</span></a>'."\n";
			}
			$html .= '		     </form>
						</div>'."\n";
		}
		else{
			$html .= '			<div id="admin_link"><a href="index.php?pageID=Login" >Login</a></div>'."\n";
		}
		$html .= '			<div id="copyright"><h5>copyright &copy; MFH</h5></div>'."\n";
		$html .= '		</div><!--footer content end-->'."\n";
		$html .= '	</div><!--footer end-->'."\n";
		$html .= '</div><!--main content bg end-->'."\n";
		$html .= '</body>'."\n";
		$html .= '</html>'."\n";
		
		return $html;
    }
}
?>