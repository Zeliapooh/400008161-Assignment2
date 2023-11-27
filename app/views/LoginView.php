<?php
namespace COMP3385;

$templateEngine = new TemplateEngine();
$formGenerator = new LoginFormGenerator();
$config = parse_ini_file(CONFIG_DIR.'\config.ini', true);



//echo $formContent;
$formContent = $formGenerator->generateForm();
$templateEngine->generateTemplate($config, $formContent, 'Login','');
