<?php

class EditHomeWhatView extends View  /////////////////////////////////////////////////////////This class contains methods to update edit about us page
{
   protected $model;
    protected $result;
    

    public function __construct($rs, $model, $type)
    {
        $this->rs = $rs;
        $this->model = $model;
        $this->type = $type;
    }
    
    protected function displayContent()		//////////////////////////////////////////////this function is for display content of this page
    {
           
	$html = '<!--content container strat-->
		<div id="content_BG" >'."\n";
	$html .= '<h3 class="pagehead">'.$this->rs['PageHeading'].'</h3>'."\n";
	if ($_SESSION['UserType'] != 'Admin' and $_SESSION['Permission'] != 'sameadmin' and $_SESSION['Permission'] != 'superstaff') {
	    $html .= '<div class="pageMsg" style="height:500px;">Sorry, but this is a restricted page!</div>'."\n";
	}
	///////////////////////////////////////////////////////////////if user submit the form process processEditHome to validate in model class
	$homeW = $this->model->getContent($this->type);
	if ($_POST['Update']) {       
	    $this->result = $this->model->updateHome($_POST);
	    $homeW = $_POST;
	    //$html .= '<meta http-equiv="refresh" content=4;URL="index.php"'."\n";
	}
	$html .= $this->displayEditHomeWhatForm($homeW);
	$html .= '	<div class="clear"></div>'."\n";
	$html .= '	
		</div><!--content container end-->'."\n";
	$html .= '	<div class="content_break" ></div>'."\n";
        return $html;
    }
   
    protected function displayEditHomeWhatForm($homeW)  /////////////////////////////////////////This function is going to display edit form
    {
	///////////////////////////////////////////Import variables into the current function
		if (is_array($this->result)) {
			extract($this->result);	
		}	
		$html =' <div class="editHome"><!--edit home page form start-->'."\n";
		$html .= '<div class="col3">'.$result['msg'].'</div>'."\n";
		$html .= '<div class="clear"></div>'."\n";
		$html .= '<form id="edit_form" method="post" action="'.htmlentities($_SERVER['REQUEST_URI']).'" >'."\n";
		$html .= '	<label for="PSum" class="col1">Content: </label>'."\n";
		$html .= '	<textarea rows="10" cols="40" name="PageContents" id="PSum"  class="col2" >'.htmlentities(stripslashes($homeW['PageContents']),ENT_QUOTES).'</textarea> '."\n";			
		$html .= '	<div class="clear"></div>'."\n";

		$html .= '  <input type = "hidden" name="PgID" value="'.$homeW['PageID'].'" />'."\n";
		$html .= '  <input type = "hidden" name="Ctype" value="'.$homeW['ContentType'].'" />'."\n";
		$html .= '	<input type="submit" name="Update" value="Update" class="submitButton" />'."\n";//</div>
		$html .= '	<div class="clear"></div>'."\n";
		$html .= '</form>'."\n";      /////////// end of div editform
		$html .= '<div class="pagemsg">'.$msg.'</div>'."\n";
		$html .= '<div class="pagemsg">'.$uresult['msg'].'</div>'."\n";
		$html .='</div><!--edit home page form end-->'."\n";
		return $html;
    }
}
?>