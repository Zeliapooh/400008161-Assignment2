<?php
namespace COMP3385;


$templateEngine = new TemplateEngine();
$formGenerator = new RegistrationFormGenerator();
$config = parse_ini_file(CONFIG_DIR.'\config.ini', true);

$formContent = $formGenerator->generateForm();
$templateEngine->generateTemplate($config, $formContent, 'Registration','');

