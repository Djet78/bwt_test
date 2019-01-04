<?php 
require '../settings.php';

while (true) {
    
    // Get temperature value from gismeteo HTML page
    $regexp = "/<dd class='value m_temp c'>([^<]+)/";
    $data =  file_get_contents('https://www.gismeteo.ua/weather-zaporizhia-5093/');
    $have_match = preg_match($regexp, $data, $mathces);

    if ($have_match) {
        $data = ['temp' => $mathces[1]];
        $json = json_encode($data);
        $res = file_put_contents('weather.json', $json, LOCK_EX);
        if ($res === false) {
            echo "Parser can't write to file!".PHP_EOL;
        }
    } else {
        echo "Parser didn't find match!".PHP_EOL;
    }
    sleep(PARSER_SLEEP_TIME);
}
