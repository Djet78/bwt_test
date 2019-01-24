<?php

/**
 * Used for develop purposes
 *
 * Print useful information ('var_dump()') about given objects and a backtrace.
 * Finishes script after that
 *
 * @param $var        Any variable or object
 * @param $backtrace  Show backrtace or not. Default: true
 */
function debug($var, $backtrace=true) {
    echo '<pre>';
    var_dump($var);
    echo '</pre>';
    if ($backtrace) {
        echo '<br><h4> Backtrace </h4><bt>';
        pretty_backtrace();
    }
    exit;
}

/**
 * Used for develop purposes
 */
function pretty_backtrace() {
    $bt = debug_backtrace();
    foreach ($bt as $trace) {
        $msg = $trace['file'].',  <b> Line </b>: '.$trace['line'].',  <b> Func </b>: '.$trace['function'].'<br>';
        $regexp = '#'.BASE_DIR.'#';
        $regexp = str_replace('\\', '\\\\', $regexp);
        $msg = preg_replace($regexp, '', $msg);
        echo $msg;
    }
}
