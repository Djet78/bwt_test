<?php
function debug($var, $backtrace=True) {
    echo '<pre>';
    var_dump($var);
    echo '</pre>';
    if ($backtrace){
        echo '<br><h4> Backtrace </h4><bt>';
        pretty_backtrace();
    }
    exit;
}

function pretty_backtrace(){
    $bt = debug_backtrace();
    foreach($bt as $trace){
        $msg = $trace['file'] .',  <b> Line </b>: '. $trace['line'] . ',  <b> Func </b>: ' . $trace['function'] . '<br>';
        $regexp = '#'.BASE_DIR.'#';
        $regexp = str_replace('\\', '\\\\', $regexp);
        $msg = preg_replace($regexp, '', $msg);
        echo $msg;
    }
}
?>