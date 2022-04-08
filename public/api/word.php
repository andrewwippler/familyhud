<?php

header("Content-Type: application/json; charset=UTF-8");

require __DIR__ . '/../../vendor/autoload.php';
require __DIR__ . '/../../config.php';
$database_file = __DIR__ . '/../../database.sqlite';
$initialize = false;


// create database if not exists
if (!file_exists($database_file)) {
    touch($database_file);
    $initialize = true;
}

// connect to db
$database = new Nette\Database\Connection("sqlite:{$database_file}");

// populate data if needed
if ($initialize) {
    Nette\Database\Helpers::loadFromFile($database, __DIR__ . "/../../database/db-structure.sql");
    Nette\Database\Helpers::loadFromFile($database, __DIR__ . "/../../database/fi-words.sql");
}

// get starting point
$iteration = $database->fetchField('SELECT `times_used` FROM iteration WHERE id=?',1);

// return $words_to_get
$result = $database->fetchAll('SELECT * FROM words WHERE `times_used` = ? LIMIT ?', $iteration, $words_to_get);

// restart loop
if (count($result) == 0) {
    $iteration += 1;
    $result = $database->fetchAll('SELECT * FROM words WHERE `times_used` = ? LIMIT ?', $iteration, $words_to_get);
    $database->query('UPDATE `iteration` SET', [
        'times_used' => $iteration,
    ]);
}

$echoing = [];
foreach ($result as $row) {
	$echoing[] = $row;

    // set the last time used to + 1
    $database->query('UPDATE `words` SET', [
        'times_used' => $iteration+1,
    ], 'WHERE id = ?', $row->id);

}

echo json_encode($echoing);
