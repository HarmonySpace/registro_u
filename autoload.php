<?php
function autoload($class) {
  include 'src/controllers/' . $class . '.php';
}
spl_autoload_register('autoload');
