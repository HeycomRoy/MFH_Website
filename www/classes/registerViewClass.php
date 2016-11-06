<?php

class RegisterView extends View///////////////////////////////////////This class is contains metods for display register page
{
    public $rs;
    public $model;
    protected $result;
    
    public function __construct($rs, $model)
    {
        $this->rs = $rs;
        $this->model = $model;
    }
    
    protected function displayContent()/////////////////////////////this function is to display content
    {
        $html = '<!--content container strat-->
                <div id="content_BG">'."\n";
        $html .= '<h3 class="pagehead">'.$this->rs['PageHeading'].'</h3>'."\n";
        if($_POST['process']){
            $result = $this->model->validateRegisterEntries();
        }
        if($result['ok']){
                $result = $this->model->createUser();
                $html .= '<div style="color:red; width:400px; margin:0 auto;">'.$result['msg'].'</div>'."\n";
                
            }
        else {
            if($_SESSION['UserType'] == 'Admin' || $_SESSION['permission'] == 'sameadmin'){
                $html .= $this->showRegisterForm($result);
                $html .= '  	<div class="clear"></div>'."\n";
            }
            else{
                $html .= '<p style="color:red; margin:0 auto; width:400px;">Sorry,You are not able to access this page!</p>'."\n";
            }
        }
        
        $html .= '	
                </div><!--content container end-->'."\n";
        $html .= '	<div class="content_break" ></div>'."\n";
        
        return $html;
    }
   
   
    private function showRegisterForm($result)///////////////////////////////////////////This funtion is for display register form 
    {
        
        ///////////////////////////////////////Import variables into the current function
        if(is_array($result)){
            extract($result);
        }     
        if($_POST['process']){
            extract($_POST);
        }
       
        $html = ' <div id="R_F"><form method="post" id="RegisterForm" action="'.$_SERVER['REQUEST_URI'].'">'."\n";
        $html .= '      <label for="Firstname" class="Register1">First Name:</label>'."\n";
        $html .= '      <div class="Register3">
                            <input id="Firstname" class="Register" type="text" name="Firstname" value="'.htmlentities(stripcslashes($Firstname), ENT_QUOTES).'"/>'."\n";
        $html .= '          <div class="vMsg">'.$fnameMsg.'</div>
                        </div>'."\n";
        $html .= '      <div class="clearR"></div>'."\n";
        
        $html .= '      <label for="Lastname" class="Register1">Last Name:</label>'."\n";
        $html .= '      <div class="Register3">
                            <input id="Lastname" class="Register" type="text" name="lastname" value="'.htmlentities(stripcslashes($lastname), ENT_QUOTES).'"/>'."\n";
        $html .= '          <div class="vMsg">'.$lnameMsg.'</div>
                        </div>'."\n";
        $html .= '      <div class="clearR"></div>'."\n";
        
        $html .= '      <label for="email" class="Register1">Email Address:</label>'."\n";
        $html .= '      <div class="Register3">
                            <input id="email" class="Register" type="text" name="email" value="'.$email.'"/>'."\n";
        $html .= '          <div class="vMsg">'.$emailMsg.'</div>
                        </div>'."\n";
        $html .= '      <div class="clearR"></div>'."\n";
        
        $html .= '      <label for="Username" class="Register1">User Name:</label>'."\n";
        $html .= '      <div class="Register3">
                            <input id="Username" class="Register" type="text" name="username" value="'.htmlentities(stripcslashes($username), ENT_QUOTES).'"/>'."\n";
        $html .= '          <div class="vMsg">'.$usernameMsg.'</div>
                        </div>'."\n";
        $html .= '      <div class="clearR"></div>'."\n";
        
        $html .= '      <label for="Password" class="Register1">Password:</label>'."\n";
        $html .= '      <div class="Register3">
                            <input id="Password" class="Register" type="password" name="password" value="'.$password.'"/>'."\n";
        $html .= '          <div class="vMsg">'.$passMsg.'</div>
                        </div>'."\n";
        $html .= '      <div class="clearR"></div>'."\n";
        
        $html .= '      <label for="CPassword" class="Register1">Confirm Password:</label>'."\n";
        $html .= '      <div class="Register3">
                            <input id="CPassword" class="Register" type="password" name="Cpassword" value="'.$Cpassword.'"/>'."\n";
        $html .= '          <div class="vMsg">'.$CpassMsg.'</div>
                        </div>'."\n";
        $html .= '      <div class="clearR"></div>'."\n";
        
        $html .= '      <label for="permission" class="Register1">Permission for this user to access:</label>'."\n";
        $html .= '      <div class="Register3">'."\n";
        if($_POST['permission'] == 'sameadmin'){
            $html .= '          <input id="permission" type="radio" name="permission" checked="checked" value="sameadmin" /> Same perssions as admin<br />'."\n";
        }
        else{
            $html .= '          <input id="permission" type="radio" name="permission" value="sameadmin" /> Same perssions as admin<br />'."\n";
        }
        if($_POST['permission'] == 'superstaff'){
            $html .= '          <input id="permission1" type="radio" name="permission" checked="checked" value="superstaff" /> Only being able to update all contents<br />'."\n";
        }
        else{
            $html .= '          <input id="permission1" type="radio" name="permission" value="superstaff" /> Only being able to update all contents<br />'."\n";
        }
        if($_POST['permission'] == 'updatecourses'){
            $html .= '          <input id="permission2" type="radio" name="permission" checked="checked" value="updatecourses" /> Only being able to update courses <br />'."\n";
        }
        else{
            $html .= '          <input id="permission2" type="radio" name="permission" value="updatecourses" /> Only being able to update courses <br />'."\n";
        }
        $html .= '          <div class="vMsg">'.$PermissionMsg.'</div>
                        </div>'."\n";
        $html .= '      <div class="clearR"></div>'."\n";

        $html .= '      <div id="RegisterButton">
                            <input type="submit" value="Submit" name="process" class="submitButton"/>
                        </div>'."\n";
        $html .= '</form></div>'."\n";
        
        return $html;
    }
    
}
?>