<?php
namespace COMP3385;

class RegisterController extends AbstractController
{
    // public $username;
    // public $password;
    // public $email;

    private $templateEngine;
    private $formGenerator;
    private $security;
    private $session;

    private $config;

    public function __construct()
    {
        $this->security = new Security();
        $this->session = new SessionManager();

        $this->templateEngine = new TemplateEngine();
        $this->formGenerator = new RegistrationFormGenerator();

        $this->config = parse_ini_file(CONFIG_DIR . '\config.ini', true);
        $this->setModel(new RegisterModel());
    }

    public function index($response)
    {
        //$this->session->set('token', $this->security->generateCSRFToken()) ;
        $response->renderView('RegisterView');
    }

    public function validate($response)
    {
        //If the form was submitted
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $csrfToken = $_POST['csrfToken'];
            if ($this->security->validateCSRFToken($this->session->get('token'), $csrfToken)) {
                $validator = new RegistrationFormValidator();
                $validator->validate($_POST);

                $checkUser = $this->model->fetch('users', 'username', $_POST['username']);
                $checkEmail = $this->model->fetch('users', 'email', $_POST['email']);

                if ($checkUser) {
                    $validator->addError('username', 'Username already exist');
                }
                if ($checkEmail) {
                    $validator->addError('email', 'Email already exist');
                }
                $errors = $validator->getErrors();
                if (empty($errors)) {
                    $this->registerUser($response);
                } else {
                    $formContent = $this->formGenerator->generateErrorForm($errors, $_POST);
                    $this->templateEngine->generateTemplate($this->config, $formContent, 'Registration', '');
                }
            }
            else{
                echo 'Resubmissions Not Allowed';
                $response->renderView('RegisterView');
            }
        }

    }
    // public function generateErrorForm($errors, $POST)
    // {
    //   //instantiating the classes that are neeeded



    //   //adding the errors to the form
    //   $this->formGenerator->addError($errors);

    //   // creating the form
    //   $formContent = $this->formGenerator->openForm('RegisterFormSubmitted.php', 'post', ['class' => 'my-form']);
    //   $formContent.= $this->formGenerator->generateUsernameInput('username', ['class' => 'inputField', 'placeholder'=>'JohnDoe123','value' => $POST['username'], 'required'=>true] );
    //   $formContent .= $this->formGenerator->generateEmailInput('email', ['class' => 'inputField', 'placeholder' => 'JohnDoe@outlook.com','value' => $POST['email'], 'required' => true]);
    //   $formContent .= $this->formGenerator->generatePasswordInput('password', ['class' => 'inputField', 'required' => true]);
    //   $formContent .= '<input type="submit" value="Submit">';
    //   $formContent .= $this->formGenerator->closeForm();

    //   $appName = $this->config['appName']['name'];
    //   // // Assign variables to be used in the template
    //   $this->templateEngine->assign('title', $appName);
    //   $this->templateEngine->assign('header', 'Register User');
    //   $this->templateEngine->assign('formContent', $formContent);
    //   $this->templateEngine->assign('footerContent', "Copyright © Tizelia Norville. All Rights Reserved.");

    //   echo $this->templateEngine->render('Login.php');

    // }

    function registerUser($response)
    {
        $hashPassword = password_hash($_POST['password'], PASSWORD_DEFAULT);
        //save to the users table
        $roleId = $this->model->getRoleId()['id'];
        $data = [
            'username' => $_POST['username'],
            'password' => $hashPassword,
            'email' => $_POST['email'],
            'role' => 'Research Group Manager',
            'role_id' => $roleId // Replace with the appropriate role_id from the roles table
        ];
        $result = $this->model->save('users', $data);

        if ($result) {
            //save to the user_access_levels
            $usersId = $this->model->getUserId($_POST['email'])['id'];
            $data2 = [
                'id' => $usersId,
                'email' => $_POST['email'],
                'AccessLevel' => 'Research Group Manager' // Replace with the appropriate role_id from the roles table
            ];
            $result2 = $this->model->save('user_access_levels', $data2);

            if ($result2) {
                $response->redirect('Login.php');
            } else {
                echo 'User not saved to user_access_levels table';
            }
        } else {
            echo 'User not saved to users table';
        }

    }


}

?>