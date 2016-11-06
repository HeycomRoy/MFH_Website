<?php

class EditAboutMfhView extends View  /////////////////////////////////////////////////////////This class contains methods to update edit about us page
{
    protected $model;

    public function __construct($rs, $model, $cnttp, $sec)
    {
        $this->rs = $rs;
        $this->model = $model;
		$this->cnttp = $cnttp;
		$this->sec = $sec;
    }
    
    protected function displayContent()//////////////////////////////////////////////////////This function to display edit about us page content
    {

        $html = '<!--content container strat-->
		    <div id="content_BG">'."\n";
        $html .= '<h3 class="pagehead">'.$this->rs['PageHeading'].'</h3>'."\n";
	
		///////////////////////////////////////to determine if not admin user
        if ($_SESSION['UserType'] != 'Admin' and $_SESSION['Permission'] != 'sameadmin' and $_SESSION['Permission'] != 'superstaff') {
            $html .= '<div class="pageMsg">Sorry, but this is a restricted page!</div>'."\n";  
        }
	    ////////////////////////////////////pass '$_POST' to function processEditAbt 
	    if ($_POST['Update']) {
			$result = $this->model->processEditAbt($_POST);
	    }

	    $Abt = $this->model->getAboutMfh($this->cnttp, $this->sec);
	    $html .= '	<div class="Abt_form">'."\n";
	    $html .= $this->displayAboutForm($result, $Abt);
	    $html .= '	</div>'."\n";
	    $html .= '	<div class="content_break" ></div>'."\n";
	    $html .= '
			</div><!--content container end-->'."\n";
		$html .= '<div class="clear"></div>'."\n";
	    //$html .= '<meta http-equiv="refresh" content=2;URL="index.php"'."\n";

    return $html;
    }
   
    protected function displayAboutForm($result, $Abt)  /////////////////////////////////////////This function is going to display edit form
    {
	///////////////////////////////////////////Import variables into the current function
        if (is_array($result)) {
            extract($result);	
        
		}
	
		$html = '<div class="col3">'.$result['msg'].'</div>'."\n";
		$html .= '<div class="clear"></div>'."\n";
        $html .= '<form id="edit_form" method="post" action="'.htmlentities($_SERVER['REQUEST_URI']).'" >'."\n";
        $html .= '	<label for="PSum" class="col1">Content: </label>'."\n";
        $html .= '	<textarea rows="10" cols="40" name="PageContents" id="PSum"  class="col2" >'.htmlentities(stripslashes($Abt['PageContents']),ENT_QUOTES).'</textarea> '."\n";			
        $html .= '	<div class="clear"></div>'."\n";
		
        $html .= '	<input type="hidden" name="CType" value="'.$Abt['ContentType'].'" />'."\n";
		$html .= '	<input type="hidden" name="CSection" value="'.$Abt['ContentSection'].'" />'."\n";
        $html .= '	<input type="submit" name="Update" value="Update" class="submitButton" />'."\n";//</div>
        $html .= '	<div class="clear"></div>'."\n";
        $html .= '</form>'."\n";      /////////// end of div editform

        return $html;
    }
}
?>