<?php
$ext_list = array('pcntl', 'swoole');

foreach ($ext_list as $ext) {
    assert(extension_loaded($ext));
}
