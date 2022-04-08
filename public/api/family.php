<?php

header("Content-Type: application/json; charset=UTF-8");

require __DIR__ . '/../../vendor/autoload.php';
require __DIR__ . '/../../config.php';
use ICanBoogie\DateTime; // https://packagist.org/packages/icanboogie/datetime
use HUD\ExtendedFamily;
use AliasProject\Google\Calendar as gcal;

$now = new DateTime('now', $my_timezone);

foreach ($all_family as $fam)
{
    $family_display[] = new ExtendedFamily($fam);
}

// $gcal = new gcal($google_config);
// $events = $gcal->listEvents($google_calendar_email, 'today', $my_timezone);


// $events_array = [];
// for ($i=0; $i < count($events); $i++) { 
//     // Revisions show up twice on the calendar and have _R<date> appended to the ID.
//     // This is to clear up duplicates by forcing in each event into one array of
//     // the same ID. This uses the latest revision of the event.
//     $array_id = explode("_", $events[$i]->id)[0];

//    if(!empty($events[$i]->start->dateTime)) 
//    {

//     $start = new DateTime($events[$i]->start->dateTime);
//     $end = new DateTime($events[$i]->end->dateTime);

//     $events_array[$array_id] = [
//         "summary" => $events[$i]->summary,
//         "start" => $start->as_time,
//         "end" => $end->as_time
//     ];
//    } 
//    elseif (!empty($events[$i]->start->date)) 
//    {
//     // all-day events
//     $events_array[$array_id] = [
//         "summary" => $events[$i]->summary,
//         "start" => $events[$i]->start->date,
//         "end" => null
//     ];
//    }

// }

// Calendar items:
// var_dump($events_array);

// 
// <!DOCTYPE html>
// <html lang="en">
// <head>
//     <meta charset="UTF-8">
//     <meta http-equiv="X-UA-Compatible" content="IE=edge">
//     <meta name="viewport" content="width=device-width, initial-scale=1.0">
//     <title>Family HUD</title>

// </head>
// <body>
//     <?php
//         foreach ($family_display as $member)
//         { 


//        }
//     
// </body>
// </html>

echo json_encode($family_display);