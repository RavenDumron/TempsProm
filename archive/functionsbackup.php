<?php

function fillPeriod(string $tabCounter) : string
{

    switch ($tabCounter) {
        case '0':
            $getPeriod = $GLOBALS['year1'] . '-' . $GLOBALS['year2'];
            break;
        case '10':
            $getPeriod = 'octobre ' . $year1;
            break;
        

    }

    return $getPeriod;
}

function fillTotalSumIn(string $tabCounter) : string
{

    switch ($tabCounter) {
        case '0':
            $getTotalSumIn = $GLOBALS['yearlyTotalSumIn'];
            break;
        case '1':
            $getTotalSumIn = $GLOBALS['octoberTotalSumIn'];
            break;


    }

    return $getTotalSumIn;
}

function fillTotalSumHM(string $tabCounter) : string
{

    switch ($tabCounter) {
        case '0':
            $getTotalSumHM = $GLOBALS['yearlyTotalSumHM'];
            break;
        case '1':
            $getTotalSumHM = $GLOBALS['octoberTotalSumHM'];
            break;


    }

    return $getTotalSumHM;
}

function fill_sum(string $tabCounter) : array
{
    $get_sum = [];

    switch ($tabCounter) {
        case '0':
            $get_sum = $GLOBALS['year_sum'];
            break;
        case '1':
            $get_sum = $GLOBALS['oct_sum'];
            break;


    }

    return $get_sum;
}