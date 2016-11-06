<?php
session_start();
include_once 'classes/viewClass.php';
include_once 'classes/modelClass.php';


/*This class gets the pageID from URL*/
class PageSelector
{
    public function run(){
        if($_GET['pageID']){
            $pageID = $_GET['pageID'];
        }
        else{
            $pageID = 'Home';
        }
        $model = new Model;
        
        
	if($_GET['pageID']=='editView'){
		$page = $_GET['page'];
	}
	else{
		$page = $pageID; 
	}
	$rs = $model->getPage($page);
        
        
        switch($page){
            case 'Home':include('classes/homeViewClass.php');
                $view = new HomeView($rs, $model);
                break;

            case 'Course':include('classes/courseViewClass.php');
                $view = new CourseView($rs, $model, $_GET['p']);
                break;

	    case 'ShowCourse':include('classes/showCourseViewClass.php');
                $view = new ShowCourseView($rs, $model,$_GET['CID']);
                break;


	    case 'Studentlife':include('classes/studentViewClass.php');
		$view = new StudentView($rs, $model);
		break;

	    case 'Aboutus':include('classes/aboutusViewClass.php');
                $view = new AboutusView($rs, $model);
                break;
		
			
            case 'Contact':include('classes/contactViewClass.php');
                $view = new ContactView($rs, $model);
                break;
            
	    case 'Login':include('classes/loginViewClass.php');
                $view = new LoginView($rs, $model);
                break;
            
	    case 'Register':include('classes/registerViewClass.php');
                $view = new RegisterView($rs, $model);
                break;
            
            case 'EditHome':include('classes/editHomeViewClass.php');
                $view = new EditHomeView($rs, $model, $_GET['type']);
                break;
				
	    case 'EditHomeWhat':include('classes/EditHomeWhatViewClass.php');
                $view = new EditHomeWhatView($rs, $model, $_GET['type']);
                break;
            
	    case 'EditCourse':include('classes/editCourseViewClass.php');
                $view = new EditCourseView($rs, $model, $_GET['CID']);
                break;
            
	    case 'EditAboutMfh':include('classes/editAboutMfhView.php');
                $view = new EditAboutMfhView($rs, $model, $_GET['cnttp'], $_GET['sec']);
                break;
            
	    case 'DeleteCourse':include('classes/deleteCourseViewClass.php');
                $view = new DeleteCourseView($rs, $model, $_GET['CID']);
                break;
	    
	    case 'AddNewCourse':include('classes/addCourseViewClass.php');
                $view = new AddCourseView($rs, $model, $_GET['CID']);
                break;
	    
	    case 'EditStudent':include('classes/editStudentView.php');
                $view = new EditStudentView($rs, $model, $_GET['type']);
		break;
	    
	    case 'Sitemap':include('classes/sitemapViewClass.php');
                $view = new SitemapView($rs, $model);
		break;
        }
        echo $view->displayPage();
    }
}
$page = new PageSelector;
$page -> run();
?>