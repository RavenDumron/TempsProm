<?php

// fonction pour remplir les champs textuels de période dans les onglets avec soit le mois plus l'année, soit l'année fiscale elle-même
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

// fonction pour calculer la différence en mois entre deux date arrondie au supérieur (afin que par exemple 2023-10-01 et 2023-10-31 renvoie 1 et non 0)
function calculateMonthsRoundedUp($startDate, $endDate) {

    $start = new DateTime($startDate);
    $end = new DateTime($endDate);
    $interval = $start->diff($end);

    $months = $interval->m + ($interval->d > 0 ? 1 : 0);

    return $months;
}

// fonction pour vérifier qu'une date se trouve entre deux dates
function check_in_range($start_date, $end_date, $date_to_check) {

    if ($start_date === null || $end_date === null) {

        return false;
    }

    else {
        $start_ts = strtotime($start_date);
        $end_ts = strtotime($end_date);
        $check_ts = strtotime($date_to_check);
        
        return (($check_ts >= $start_ts) && ($check_ts <= $end_ts));
    }
}