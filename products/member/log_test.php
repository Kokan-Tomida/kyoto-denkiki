<?php
// demo.php
include 'ChromePhp.php';
ChromePhp::log('Hello console!���{���OK');
ChromePhp::log($_SERVER);
ChromePhp::info('info���O�ł�');
ChromePhp::warn('warn���O�ł�');
ChromePhp::error('error���O�ł�');
 
ChromePhp::groupCollapsed('MyGroup');
for ($i = 1; $i <= 10; $i++) {
  ChromePhp::log('log' . $i);
}
ChromePhp::groupEnd();
