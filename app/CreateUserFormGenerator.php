<?php
namespace COMP3385;

class CreateUserFormGenerator extends AbstractFormGenerator
{

    public function generateForm()
    {
        $formContent = $this->openForm('CreateUserFormSubmitted.php', 'post', ['class' => 'my-form']);
        $formContent.= $this->generateUsernameInput('username', ['class' => 'inputField', 'placeholder'=>'JohnDoe123', 'required'=>true] );
        $formContent.= $this->generateEmailInput('email', ['class'=> 'inputField','placeholder'=>'JohnDoe@outlook.com', 'required'=> true]);
        $formContent.= $this->generatePasswordInput('password', ['class'=> 'inputField', 'required'=> true]);
        $formContent .= $this->generateInputCSRFInput();
        $formContent .= $this->generateSelect('role',['Research Study Manager', 'Researcher'], 'Research Study Manager', ['class'=> 'inputField']);
        $formContent.= $this->generateButton('Register', ['name' =>'', 'class' => 'btn btn-primary btn-lg btn-block', 'type' => 'submit', 'aria-pressed'=>"true"]);        
        $formContent.= $this->closeForm();
        return $formContent;

    }

    public function generateErrorForm($errors, $POST)
    {
      //instantiating the classes that are neeeded

  
      $config = parse_ini_file(CONFIG_DIR . '\config.ini', true);
  
      //adding the errors to the form
      $this->addError($errors);
  
      // creating the form
      $formContent = $this->openForm('CreateUserFormSubmitted.php', 'post', ['class' => 'my-form']);
      $formContent.= $this->generateUsernameInput('username', ['class' => 'inputField', 'placeholder'=>'JohnDoe123','value' => $POST['username'], 'required'=>true] );
      $formContent .= $this->generateEmailInput('email', ['class' => 'inputField', 'placeholder' => 'JohnDoe@outlook.com','value' => $POST['email'], 'required' => true]);
      $formContent .= $this->generatePasswordInput('password', ['class' => 'inputField', 'required' => true]);
      $formContent .= $this->generateInputCSRFInput();
      $formContent .= $this->generateSelect('role',['Research Study Manager', 'Researcher'], $POST['role'], ['class'=> 'inputField']);
      $formContent.= $this->generateButton('Register', ['name' =>'', 'class' => 'btn btn-primary btn-lg btn-block', 'type' => 'submit', 'aria-pressed'=>"true"]);      
      $formContent .= $this->closeForm();
      return $formContent;

    }

    public function generateInputCSRFInput(): string
    {
        $security = new Security();
        $session = new SessionManager();
        $session->set('token', $security->generateCSRFToken()) ;
        $token = $session->get('token');
        return $this->generateHiddenInput('hidden', 'csrfToken', ['class' => 'csrfToken', 'value' => $token]) ;
    }

    public function generatePasswordInput($name, $attributes): string
    {
        return $this->generateInput('password', $name, $attributes);
    }

    public function generateEmailInput($name, $attributes): string
    {
        return $this->generateInput('email', $name, $attributes);
    }

    public function generateUsernameInput($name, $attributes): string
    {
        return $this->generateInput('text', $name, $attributes);
    }

}