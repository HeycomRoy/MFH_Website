<?php
include 'classes/editCourseViewClass.php';

class AddCourseView extends EditCourseView  ///////////////////////////////////////////////This class is contain methods for add new course page
{
    protected $model;
    protected $result;
    public $rs;
    

    public function __construct($rs, $model, $CID)
    {
        $this->rs = $rs;
        $this->model = $model;
		$this->CID = $CID;
    }

    protected function displayContent()
    {
            $html = '<!--content container strat-->
                    <div id="content_BG" >'."\n";
            $html .= '<h3 class="pagehead">'.$this->rs['PageHeading'].'</h3>'."\n";
            if ($_SESSION['UserType'] != 'Admin' and $_SESSION['Permission'] != 'sameadmin' and $_SESSION['Permission'] != 'superstaff' and $_SESSION['Permission'] != 'updatecourses') {
                $html .= '<div class="pageMsg" style="height:500px;">Sorry, but this is a restricted page!</div>'."\n";
            }
             ////////////////////////////////////////////////////////////////if user submit the form process addNewCourse function in model class
            else {
                if ($_POST['Add']) {
                    $this->result = $this->model->addNewCourse($_POST);
                    $courseF = $_POST;
                    if ($result['PImage']) {
                        $_POST['PImage'] = $result['PImage'];
                    }
                }
				$html .= $this->displayEditCourseForm("Add", $courseF);
            }

            $html .= '	
                    </div><!--content container end-->'."\n";
            $html .= '	<div class="content_break" ></div>'."\n";
        return $html;
    }
}
?>