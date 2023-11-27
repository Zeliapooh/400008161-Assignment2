<?php
namespace COMP3385;

spl_autoload_register(function ($className) {

  $arr = explode("\\", $className);
  $className = $arr[count($arr) - 1];
  if (!defined('ROOT_DIR')) {
    define('ROOT_DIR', 'C:\xampp\400008161');
    define('APP_DIR', ROOT_DIR . '\app');
    define('FRAMEWORK_DIR', ROOT_DIR . '\framework');
    define('TPL_DIR', ROOT_DIR . '\tpl');
    define('VIEW_DIR', ROOT_DIR . '\app\views');
    define('CONTROLLER_DIR', ROOT_DIR . '\app\controllers');
    define('MODEL_DIR', ROOT_DIR . '\app\models');
    define('CONFIG_DIR', ROOT_DIR . '\config');

  }

  
  if (file_exists(FRAMEWORK_DIR . '\\' . $className . '.php')) {
    require FRAMEWORK_DIR . '\\' . $className . '.php';
  } else if (file_exists(APP_DIR . '\\' . $className . '.php')) {
    require APP_DIR . '\\' . $className . '.php';
  } else if (file_exists(TPL_DIR . '\\' . $className . '.php')) {
    require TPL_DIR . '\\' . $className . '.php';
  } else if (file_exists(VIEW_DIR . '\\' . $className . '.php')) {
    require VIEW_DIR . '\\' . $className . '.php';
  } else if (file_exists(CONTROLLER_DIR . '\\' . $className . '.php')) {
    require CONTROLLER_DIR . '\\' . $className . '.php';
  } else if (file_exists(MODEL_DIR . '\\' . $className . '.php')) {
    require MODEL_DIR . '\\' . $className . '.php';
  }else if (file_exists(CONFIG_DIR . '\\' . $className . '.ini')) {
    require CONFIG_DIR . '\\' . $className . '.ini';
  } else {
    //echo APP_DIR.'/'.$className.'.php';
  }

});

