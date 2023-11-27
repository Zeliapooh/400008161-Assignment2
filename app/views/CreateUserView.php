<?php
namespace COMP3385;


$templateEngine = new TemplateEngine();
$formGenerator = new CreateUserFormGenerator();
$config = parse_ini_file(CONFIG_DIR.'\config.ini', true);



//echo $formContent;
$formContent = $formGenerator->generateForm();
$templateEngine->generateDashboardTemplate($config, '', '','','',$formContent);