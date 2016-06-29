<?php
declare(ticks = 1);
pcntl_signal(SIGTERM, 'Process::sign_handler');
pcntl_signal(SIGCHLD, 'Process::sign_handler');

// (new Process())->handler();
// exit();

class Process {
    const MAX_WORKER_NUM   = 5;
    const RECHECK_INTERVAL = 15; // seconds

    protected static $_workers = array();

    public static function sign_handler($signo) {
        switch ($signo) {
            case SIGTERM:
                foreach (self::$_workers as $pid) {
                    // @swoole_process::kill($pid, $signo);
                    @swoole_process::kill($pid, SIGKILL);
                }
                exit();
                break;
            case SIGCHLD:
                $res = swoole_process::wait();
                unset(self::$_workers[$res['pid']]);
                echo "worker[{$res['pid']}] exits with {$res['code']}.\n";
                break;
            default:
                break;
        }
    }

    public function handler() {
        while (true) {
            if ($this->_proc_trigger()) {
                $proc = new swoole_process(array($this, 'proc_handler'), false, false);
                $pid = $proc->start();
                self::$_workers[$pid] = $pid;
                echo "worker[{$pid}] starts\n";
            }
            sleep(static::RECHECK_INTERVAL);
        }
    }

    public function proc_handler($proc) {
        $proc->name('proc-worker');
        while (true) {
            // deal something
        }
    }

    protected function _proc_trigger() {
        if (count(self::$_workers) < static::MAX_WORKER_NUM) {
            return true;
        }
        return false;
    }

}
