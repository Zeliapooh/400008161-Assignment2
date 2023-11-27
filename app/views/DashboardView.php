<?php
namespace COMP3385;


$templateEngine = new TemplateEngine();
$formGenerator = new DashboardFormGenerator();
$config = parse_ini_file(CONFIG_DIR.'\config.ini', true);


$formContent = $formGenerator->generateForm();
$CNSbtn = $formGenerator->generateButton('Create New Study', ['name' =>'', 'class' => 'btn btn-primary btn-lg btn-block', 'type' => 'submit', 'aria-pressed'=>"true"]);
$VASbtn = $formGenerator->generateButton('View all Studies', ['name' =>'', 'class' => 'btn btn-primary btn-lg btn-block', 'type' => 'submit', 'aria-pressed'=>"true"]);
$DPSbtn = $formGenerator->generateButton('Delete Previous Study', ['name' =>'', 'class' => 'btn btn-primary btn-lg btn-block', 'type' => 'submit', 'aria-pressed'=>"true"]);

$templateEngine->generateDashboardTemplate($config, $formContent, $CNSbtn, $VASbtn, $DPSbtn,'');