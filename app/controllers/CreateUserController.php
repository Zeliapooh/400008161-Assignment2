<?php
namespace COMP3385;

class CreateUserController extends AbstractController
{


    private $templateEngine;
    private $formGenerator;
    private $session;
    private $config;
    private $security;

    public function __construct()
    {
        $this->templateEngine = new TemplateEngine();
        $this->formGenerator = new CreateUserFormGenerator();
        $this->session = new SessionManager();
        $this->security = new Security();
        $this->config = parse_ini_file(CONFIG_DIR . '\config.ini', true);
        $this->setModel(new CreateUserModel());
    }

    public function index($response)
    {
        //checks to see the users role and directs them to the specified view
        if ($this->security->checkPermission('Research Group Manager', $this->session)) {
            $response->renderView('CreateUserView');
            return;
        }
        if ($this->security->checkPermission('Research Study Manager', $this->session)) {
            $response->redirect('Dashboard.php');
            return;
        }
        if ($this->security->checkPermission('Researcher', $this->session)) {
            $response->redirect('Dashboard.php');
            return;
        }
        if(!$this->session->get('username')){
            $response->redirect('Login.php');
            return;
        }

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
                    $this->templateEngine->generateDashboardTemplate($this->config, '', '', '', '', $formContent);
                }
            } else {
                // echo 'Resubmissions Not Allowed';
                $response->renderView('DashboardView');
            }
        }

    }

    function registerUser($response)
    {
        $hashPassword = password_hash($_POST['password'], PASSWORD_DEFAULT);

        //save to the users table
        $roleId = $this->model->getRoleId($_POST['role'])['id'];
        $data = [
            'username' => $_POST['username'],
            'password' => $hashPassword,
            'email' => $_POST['email'],
            'role' => $_POST['role'],
            'role_id' => $roleId
        ];
        $result = $this->model->save('users', $data);

        if ($result) {
            //save to the user_access_levels
            $usersId = $this->model->getUserId($_POST['email'])['id'];
            $data2 = [
                'id' => $usersId,
                'email' => $_POST['email'],
                'AccessLevel' => $_POST['role']
            ];
            $result2 = $this->model->save('user_access_levels', $data2);

            if ($result2) {
                $response->redirect('Dashboard.php');
            } else {
                echo 'User not saved to user_access_levels table';
            }
        } else {
            echo 'User not saved to users table';
        }

    }


}

?>