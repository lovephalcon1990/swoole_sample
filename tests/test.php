<?php
require '../process/process.php';

(new Proc())->handler();
exit();

class Proc extends Process {
    public function handler() {
        echo 'succ';
        return true;
    }
}
