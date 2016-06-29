<?php
require '../process/process.php';

class Proc extends Process {
    public function handler() {
        echo 'succ';
        return true;
    }
}

(new Proc())->handler();
exit();
