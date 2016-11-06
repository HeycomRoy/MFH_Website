<?php

class EditStudentView extends View  /////////////////////////////////////////this class contains methodes to edit student life page
{
    protected $model; 

    public function __construct($rs, $model, $type)
    {
        $this->rs = $rs;
        $this->model = $model;
        $this->type =$type;
    }
    
    
    protected function displayContent()///////////////////////////////This function to display edit student life page content
    {

        $html = '<!--content container strat-->
		    <div id="content_BG">'."\n";
        $html .= '<h3 class="pagehead">'.$this->rs['PageHeading'].'</h3>'."\n";
	
		////////////////////////////////////////////////////////////////to determine if not admin user
        if ($_SESSION['UserType'] != 'Admin' and $_SESSION['Permission'] != 'sameadmin' and $_SESSION['Permission'] != 'superstaff') {
            $html .= '<div class="pageMsg">Sorry, but this is a restricted page!</div>'."\n";
            
        }
		//////////////////////////////////////////////////////////////pass $_POST to function updateStu 
        else {
            if ($_POST['StuUpdate']) {
                $result = $this->model->updateStu($_POST);
                
                if ($result['PImage']) {
                    $_POST['PImage'] = $result['PImage'];
                }
                
            }
            $StuContent = $this->model->getContent($this->type);
            $StuImage = $this->model->getImages($this->type);
                
            $html .= '<div class="stu_content" >'."\n";
            
            $html .= $this->displayStuContentForm($result, $StuContent, $StuImage);
            $html .= '</div>'."\n";
            $html .= '	<div class="content_break" ></div>'."\n";
            $html .= '</div>'."\n";
            //$html .= '<meta http-equiv="refresh" content=2;URL="index.php"'."\n";
        }
    $html .= '	<div class="content_break" ></div>'."\n";
    return $html;
    }

    protected function displayStuContentForm($result, $StuContent, $StuImage) //////////////This function is going to display edit student life page form
    {
		////////////////////////////////////////////////////////////////Import variables into the current function
        if (is_array($result)) {
            extract($result);	
        }
        
        $html = ' <form id="edit_form" method="post" action="'.htmlentities($_SERVER['REQUEST_URI']).'" enctype="multipart/form-data" >'."\n";
        $html .= '      <input type="hidden" name="MAX_FILE_SIZE" value="2000000" />'."\n";
        $html .= '      <label for="PSum" class="col1">Content:</label>'."\n";
        $html .= '      <textarea rows="10" cols="40" name="PageContents" id = "PSum"  class="col2" >'.htmlentities(stripslashes($StuContent['PageContents']),ENT_QUOTES).'</textarea> '."\n";	
        $html .= '      <div id="ptitle_msg" class="col3">'.$result['psummary_msg'].'</div>'."\n";		
        $html .= '      <div class="clear"></div>'."\n";
        
        if ($StuImage['ImagePath']) {
            $html .= '<div class="col1a">Images<br />'."\n";
            $html .= '<img src="images/page/'.$StuImage['ImagePath'].'" alt="image"/></div>'."\n";
        } 
        else {
            $html .= '<div class="col1" >&nbsp;</div>'."\n";
        }
        $html .= '      <div class="col2u">'."\n";
		$html .= '			<label for="Cimage">Update Image:</label><br />'."\n";
        $html .= '          <input type="file" name="PImage" id="Cimage" />'."\n";//</div>
        $html .= '          <div class="clear"></div>'."\n";
        $html .= '      	<input type = "hidden" name="CType" value="'.$StuContent['ContentType'].'" />'."\n";
		$html .= '      	<input type = "hidden" name="IType" value="'.$StuImage['ImageType'].'" />'."\n";
        $html .= '			<input type = "submit" name="StuUpdate" value="Update" class="submitButton" />'."\n";
		$html .= '		</div>'."\n";
        $html .= '<div class="clear"></div>'."\n";
        $html .= '</form>'."\n";        // end of div editform
        $html .= '<div class="pagemsg">'.$result['msg'].'</div>'."\n";


        return $html;
    }
}


?>