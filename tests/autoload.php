<?php

/**
 * Class CMbFunctionalTestAutoloader
 */
class CMbFunctionalTestAutoloader {

  /**
   * Register the autoloader
   *
   * @return void
   */
  static function register() {
    spl_autoload_register(array(__CLASS__, 'autoload'));
  }

  /**
   * Test specific autoloader
   *
   * @param string $class Class to be loaded
   *
   * @return void
   */
  static function autoload($class) {

    $dirs = array(
      "tests/utils/$class.php",
      "tests/functional/$class.php",
      "tests/functional/pages/$class.php",
      "modules/*/tests/$class.php",
      "modules/*/tests/pages/$class.php",
    );

    foreach ($dirs as $_dir) {
      $project_dir = dirname(__DIR__);
      $files = glob($project_dir . "/$_dir");
      foreach ($files as $filename) {
        include_once $filename;
      }
    }
  }
}

CMbFunctionalTestAutoloader::register();

