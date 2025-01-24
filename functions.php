<?php

function fillPeriod(string $tabCounter) : string
{

    switch ($tabCounter) {
        case '0':
            $getPeriod = $GLOBALS['year1'] . '-' . $GLOBALS['year2'];
            break;
        case '1':
            $getPeriod = 'janvier ' . $GLOBALS['year2'];
            break;
        case '2':
            $getPeriod = 'février ' . $GLOBALS['year2'];
            break;
        case '3':
            $getPeriod = 'mars ' . $GLOBALS['year2'];
            break;
        case '4':
            $getPeriod = 'avril ' . $GLOBALS['year2'];
            break;
        case '5':
            $getPeriod = 'mai ' . $GLOBALS['year2'];
            break;
        case '6':
            $getPeriod = 'juin ' . $GLOBALS['year2'];
            break;
        case '7':
            $getPeriod = 'juillet ' . $GLOBALS['year2'];
            break;
        case '8':
            $getPeriod = 'août ' . $GLOBALS['year2'];
            break;
        case '9':
            $getPeriod = 'septembre ' . $GLOBALS['year2'];
            break;
        case '10':
            $getPeriod = 'octobre ' . $GLOBALS['year1'];
            break;
        case '11':
            $getPeriod = 'novembre ' . $GLOBALS['year1'];
            break;
        case '12':
            $getPeriod = 'décembre ' . $GLOBALS['year1'];
            break;
        

    }

    return $getPeriod;
}