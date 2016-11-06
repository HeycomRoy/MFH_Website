<?php

/////////////////////////////////////////////This class is contain methods to validate form
class Validate {
   
   /////////////////////////////////////////validate input box is field
    public function checkRequired($field)
    {
		if (!$field) {
			$msg = "*This information is required";
		}
		return $msg;
    }
    
    //////////////////////////////////////////validate for text box is field
    public function checkComments($field)
    {
		if (!$field) {
			$msg = "*Required to write some comments!";
		}
		return $msg;
    }
    
    ////////////////////////////////////////validate drop down rating is field
    public function checkRating($field)
    {
		if (!$field) {
			$msg = "*Required to give this product a rating!";
		}
		return $msg;
    }
   
   ////////////////////////////////////////validate name is field
    public function checkName($name)
    {
      //////////////////////////////////// checking names, firstname, surname etc
		if(!preg_match('/^[[:alpha:]+\'+[:blank:]]+$/',$name)){
			$msg = "*Only letters, spaces, hyphens and apostrophes are allowed!";	
		}
		return $msg;
    }
   
   
    public function checkEmail($email)
    {
      ///////////////////////////////////////////////////// checking for a valid email
		if(!preg_match('/^[a-zA-Z0-9_\-\.]+@[a-zA-Z0-9_\-\.]+\.[a-zA-Z0-9_\-]+$/',$email)){
			$msg = "*Email Address is required information";	
		}
		return $msg;
    }
    
    public function checkNumeric($field) 
    {
	if (!is_numeric($field)) {
	    $msg = 'Price needs to be a number';
	}
	return $msg;
    }
   
}//////////////////////////////end of class validate
?>