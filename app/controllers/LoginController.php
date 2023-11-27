<?php
namespace COMP3385;

class LoginController extends AbstractController
{
  private $templateEngine;
  private $formGenerator;
  private $validator;
  private $config;
  private $security;
  private $authenticator;
  private $session;


  public function __construct()
  {
    $this->templateEngine = new TemplateEngine();
    $this->formGenerator = new LoginFormGenerator();
    $this->validator = new LoginFormValidator();
    $this->config = parse_ini_file(CONFIG_DIR . '\config.ini', true);
    $this->setModel(new LoginModel());
    $this->session = new SessionManager();
    $this->security = new Security();
    $this->authenticator = new Authenticator($this->security, $this->getModel(), $this->session);
  }

  public function index($response)
  {
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
    
    $response->renderView('LoginView');
  }


  public function validate($response)
  {
    //If the form was submitted
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $csrfToken = $_POST['csrfToken'];
      if ($this->security->validateCSRFToken($this->session->get('token'), $csrfToken)) {
        $this->validator->validate($_POST);
        $errors = $this->validator->getErrors();
        if (empty($errors)) {
          $this->loginUser($response);
        } else {
          $formContent = $this->formGenerator->generateErrorForm($errors, $_POST);
          $this->templateEngine->generateTemplate($this->config, $formContent, 'Login', '');
        }
      }
    } else {
      echo 'Resubmissions Not Allowed';
      $response->renderView('LoginView');
    }

  }

  public function loginUser($response)
  {
    if ($this->authenticator->login($_POST['email'], $_POST['password'])) {
      $response->redirect('Dashboard.php');
    } else {
      $errors = $this->validator->getErrors();
      $formContent = $this->formGenerator->generateErrorForm($errors, $_POST);
      $this->templateEngine->generateTemplate($this->config, $formContent, 'Login', 'Incorrect password or email');
    }
  }

  public function logoutUser($response)
  {
    $this->authenticator->logout();
    $response->redirect('Login.php');
  }

}

?>