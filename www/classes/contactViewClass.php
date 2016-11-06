<?php

class ContactView extends View  ///////////////////////////////////////This class is contains method for contact page
{

	private $eResult;
    
	public function __construct($rs,$model)
	{
		    $this->rs = $rs;
		    $this->model = $model;
	}

	protected function displayContent()///////////////////////////////this function is going to display contact page content
	{
		$html = '<!--content container strat-->
			<div id="content_BG">'."\n";
		$html .= '	<!--image start-->
				<div class="head_image" >'."\n";
		$html .= '		<img src="images/headimages/contact_us.jpg" alt="contact"/>'."\n";
		$html .= '	</div><!--image end-->
				<div class="image_end"></div>'."\n";	
		$html .= '	<!--contents showbox start-->
				<div class="contents_showbox" >'."\n";
		
		$html .= ' 		<div class="side_links" >'."\n";
		$html .= $this->model->sideLinkDisplay();
		$html .= ' 		</div>'."\n";
		
		//////////////////////////////////////to validate Send email form
		if($_POST['submit']){
			$this->eResult = $this->model->validateEmailForm($_POST);
			if($this->eResult['ok']){
				$this->eResult = $this->model->sendMail();
			}	
		}
			
			$html .= $this->ShowContactForm();
			$html .= '<div class="pagemsg">'.$this->eResult['msg'].'</div>'."\n";
			$html .= '<div class="pagemsg">'.$this->eResult['pgMsg'].'</div>'."\n";
			$html .= '<div class="clear"></div>'."\n";
			$html .= $this->DisplayGmap();
		
		return $html;
	}
	
	
	public function ShowContactForm()//////////////////////////////////////this function is going to display contact form
	{
		
		$html = '		<!--contact area start-->
					<div id="contact_area" >'."\n";
		$html .= '			<h2>'.$this->rs['PageHeading'].'</h2>'."\n";
		$html .= '			<div id="email_form">'."\n";
		$html .= '				<form method="post" action="'.$_SERVER['REQUEST_URI'].'">'."\n";
		$html .= '					<label for="UserName" class="col1">Name:</label>'."\n";
		$html .= '					<input type="text" name="UserName" id="UserName" value="'.htmlentities(stripslashes($_POST['UserName']), ENT_QUOTES).'" class="col2" />'."\n";
		$html .= '					<div class="col3">'.$this->eResult['name_msg'].'</div>'."\n";
		$html .= '					<label for="uEmail" class="col1">Email Address:</label>'."\n";
		$html .= '					<input type="text" name="Email" id="uEmail" value="'.$_POST['Email'].'" class="col2" />'."\n";
		$html .= '					<div class="col3">'.$this->eResult['email_msg'].'</div>'."\n";	
		$html .= '					<label for="message">Message:</label>'."\n";
		$html .= '					<textarea name="Message" id="message" class="col2" rows="10" cols="40" >'.htmlentities(stripslashes($_POST['Message'])).'</textarea>'."\n";
		$html .= '					<div class="col3">'.$this->eResult['message_msg'].'</div>'."\n";
		$html .= '					<input type="submit" name="submit" value="Send" class="sub"/>
							</form>'."\n";
		$html .= '			</div>'."\n";
		return $html;
	}
	
	
	public function DisplayGmap()////////////////////////////////////////this function is going to display gmap
	{
		$html = '			<div id="map_contacts">'."\n";
		$html .= '				<div id="map_area">
							</div>'."\n";
		$html .= '				<div id="contact_nomber">'."\n";
		$html .= '					<p><strong>Address:</strong><br/>Level 4&amp;3, Grand Central<br/>76 ~ 86 Manners Mall<br/>Wellington CBD 6011<br/>New Zealand</p><br/>'."\n";
		$html .= '					<p><strong>Postal address:</strong><br/>PO Box 24248<br/>Wellington 6011<br/>New Zealand</p><br/>'."\n";
		$html .= '					<p><strong>Telephone:</strong><br/>+644-801 9180</p><br/>'."\n";
		$html .= '					<p><strong>Fax:</strong><br/>+644-801 9181</p><br/>'."\n";
		$html .= '				</div>'."\n";
		$html .= '			</div>'."\n";
		$html .= '		</div><!--contact area end-->'."\n";
		$html .= '	</div> <!--contents showbox end-->'."\n";
		$html .= '	<div class="clear"></div>'."\n";
		$html .= '	
			</div><!--content container end-->'."\n";
		$html .= '	<div class="content_break" ></div>'."\n";
		return $html;
	}
}
?>