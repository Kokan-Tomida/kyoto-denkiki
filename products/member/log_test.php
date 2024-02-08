<?php
// demo.php
include 'ChromePhp.php';
ChromePhp::log('Hello console!日本語もOK');
ChromePhp::log($_SERVER);
ChromePhp::info('infoログです');
ChromePhp::warn('warnログです');
ChromePhp::error('errorログです');
 
ChromePhp::groupCollapsed('MyGroup');
for ($i = 1; $i <= 10; $i++) {
  ChromePhp::log('log' . $i);
}
ChromePhp::groupEnd();
