<?php
namespace COMP3385;

class DashboardController extends AbstractController
{

  private $session;
  private $security;
  public function __construct()
  {  
    $this->session = new SessionManager();
    $this->security = new Security();
    $this->setModel(new DashboardModel());
    
  }

  public function index($response){

    //checks to see the users role and directs them to the specified view
    if($this->security->checkPermission('Research Group Manager',$this->session)){
      $response->renderView('DashboardView');
      return;
    }
    if($this->security->checkPermission('Research Study Manager',$this->session)){
      $response->renderView('DashboardViewStudyManager');
      return;
    }
    if($this->security->checkPermission('Researcher',$this->session)){
      $response->renderView('DashboardViewResearcher');
      return;
    }
    if(!$this->session->get('username')){
      $response->redirect('Login.php');
      return;
  }
    
  } 


}