<?php
class EditHomeView extends View		/////////////////////////////////////////////////////This class contains method fot edit home page promotion area
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
	$homeI = $this->model->getImages($this->type);
	$homeC = $this->model->getContent($this->type);
	if ($_POST['hUpload']) {       
	    $this->result = $this->model->updateHome($_POST);
	    $homeC = $_POST;
	////////////////////////////////////////////////////////////////////this method here going to make the form display what you edited
	    if ($result['PImage']) {
		$_POST['PImage'] = $result['PImage'];
	    }
	    
	    //$html .= '<meta http-equiv="refresh" content=4;URL="index.php"'."\n";
	}
	$html .= $this->displayEditHomeForm($homeI, $homeC);
	$html .= '	<div class="clear"></div>'."\n";
	$html .= '	
		</div><!--content container end-->'."\n";
	$html .= '	<div class="content_break" ></div>'."\n";
        return $html;
    }
     
    private function displayEditHomeForm($img, $homeC) //////////////////////////////////this function to display edit home form      
    {   
        //////////////////////////////////////////////////////////Import into the current function
        if (is_array($this->result)) {
            extract($this->result);	
        }
	
        $html =' <div class="editHome"><!--edit home page form start-->'."\n";//
        $html .='   <form id="edit_form" method="post" action="'.htmlentities($_SERVER['REQUEST_URI']).'" enctype="multipart/form-data">'."\n";
        $html .='	   <input type="hidden" name="MAX_FILE_SIZE" value="2000000" />'."\n";
        $html .= '      <label for="HSum" class="col1">Contents:</label>'."\n";
        $html .= '      <textarea rows="10" cols="40" name="PageContents" id = "HSum"  class="col2" >'.htmlentities(stripslashes($homeC['PageContents']),ENT_QUOTES).'</textarea> '."\n";
        $html .= '      <div class="col3"> '.$hsummary_msg.'</div>'."\n";		
        
	$html .= '  <div class="clear"></div>'."\n";
	$html .= '  <input type = "hidden" name="PgID" value="'.$homeC['PageID'].'" />'."\n";
        $html .= '  <input type = "hidden" name="Ctype" value="'.$homeC['ContentType'].'" />'."\n";
        $html .= '  <input type = "hidden" name="Cimage" value="'.$img['ImageID'].'" />'."\n";
        $html .= '  <input type = "hidden" name="Itype" value="'.$img['ImageType'].'" />'."\n";
        
        ////////////////////////////////////////////////////////////to display promotion image
        if ($img['ImagePath']) {
            $html .= '  <div class="showp">Images<br />';
            $html .= '      <img src="images/page/'.$img['ImagePath'].'" alt="Showp"/>
                        </div>'."\n";
        } 
        else {
            $html .= '<div class="showp" >&nbsp;</div>'."\n";
        }
        $html .= '<div class="clear"></div>'."\n";
        $html .= '  <div class="col2u"><label for="pimage" class="col1">Upload New Image:</label><br />'."\n";
        $html .= '      <input id="pimage" type="file" name="PImage" /></div>'."\n";
        $html .= '  <div class="clear"></div>'."\n";
        $html .= '  <input type = "submit" name="hUpload" value="Update" class="submitButton" />'."\n";
        $html .= '</form>'."\n";       ////////////////////////////////// end of div editform                                                         
        $html .= '<div class="pagemsg">'.$msg.'</div>'."\n";
        $html .= '<div class="pagemsg">'.$uresult['msg'].'</div>'."\n";
	$html .='</div><!--edit home page form end-->'."\n";
        return $html;
    }
}
?>