<?php

class LoginView extends View//////////////////////////////////////////////////////this class contains method for display login page
{

	public function displayPage()
	{
		$html = parent::displayPage();
		return $html;
	}
	
	protected function displayContent()
	{
		$this->result = $this->model->checkUserSession();/////////this function is to check user session
		$html = '<!--content container strat-->
			<div id="content_BG" >'."\n";
		$html .= '<h3 class="pagehead">'.$this->rs['PageHeading'].'</h3>'."\n";
		if ($this->result['pageMsg']) {
			$html .= '<div class="log">'."\n";
			$html .= '<div class="pgErrMsg">'.$this->result['pageMsg'].'</div>'."\n";
			$html .= '<p style="margin-left:10px;">Navigate though the page to edit content!!</p>'."\n";
			if($_SESSION['UserType'] == 'Admin')
			{
				$html .= '<div class="add_user"><p> or add a new user!</p>'."\n";
				$html .= '<a href="index.php?pageID=Register"><button>Add a new staff user</button><a>'."\n";
				$html .= '</div>'."\n";
				
			}
			
			$html .= '  	<div class="clear"></div>'."\n";
			$html .= '</div>'."\n";	
		}
		elseif($_POST['logout']){
			$html .= '<div>'.$this->result['pageMsg'].'</div>'."\n";
		}

		else if (!$_SESSION['User']) {
			$html .= $this->displayLoginForm();
		}
		$html .= '  	<div class="clear"></div>'."\n";
		$html .= '	
			</div><!--content container end-->'."\n";
		
		$html .= '	<div class="content_break" ></div>'."\n";
		return $html;
	}
	
	
	private function displayLoginForm()////////////////////////////////////this function is for display login form
	{
		$html = ' <div class="admbox">
				<div class="login_form">'."\n"; 
		$html .= '		<form method="post" action="'.$_SERVER['REQUEST_URI'].'" >'."\n";
		$html .= '			<label for="userName" class="col1">User Name</label>'."\n";
		$html .= '			<input type="text" name="UserName" id="userName" value="'.$_POST['UserName'].'" class="col2" />'."\n";
		$html .= '			<div class="clear"></div>'."\n";
		$html .= '			<label for="userPassword" class="col1">Password</label>'."\n";
		$html .= '			<input type="password" name="UserPassword" id="userPassword" class="col2" />'."\n";
		$html .= '			<div class="clear"></div>'."\n";
		$html .= '			<input type="submit" name="Login" value="Login" class="submit"/>'."\n";
		$html .= '		</form>'."\n";
		$html .= '	</div>'."\n";
		$html .= '</div>'."\n";
		$html .= '<div class="pgErrMsg">'.$this->result['errorMsg'].'</div>'."\n";
		
		return $html;
	
	}

}
?>