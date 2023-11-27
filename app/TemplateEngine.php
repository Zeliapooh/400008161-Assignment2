<?php

namespace COMP3385;

class TemplateEngine extends AbstractTemplateEngine{

    public function generateTemplate($config, $formContent, $header, $formErrors){
        $appName = $config['appName']['name'];
        // Assign variables to be used in the template
         $this->assign('title', $appName);
         $this->assign('header', $header);
         $this->assign('formContent', $formContent);
         $this->assign('formErrors', $formErrors); 
        
         $this->assign('footerContent', "Copyright © Tizelia Norville. All Rights Reserved.");
        
        echo $this->render('FormTemplate.php');
    }

    public function generateDashboardTemplate($config,$formContent,$CNSbtn, $VASbtn, $DPSbtn, $createUser){
        $session = new SessionManager();


        $appName = $config['appName']['name'];
        // // Assign variables to be used in the template
         $this->assign('title', $appName);
         $this->assign('email', $session->get('email'));
         $this->assign('role', $session->get('role'));
         $this->assign('username', $session->get('username'));
         $this->assign('CNRbtn', $formContent);
         $this->assign('CNSbtn', $CNSbtn);
         $this->assign('VASbtn', $VASbtn);
         $this->assign('DPSbtn', $DPSbtn);
         $this->assign('createUser', $createUser);

        
         $this->assign('footerContent', "Copyright © Tizelia Norville. All Rights Reserved.");
        
        echo $this->render('DashboardTemplate.php');
    }


}
