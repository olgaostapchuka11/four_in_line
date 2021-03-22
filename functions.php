<?php

function getEntries() {
    $entries = json_decode(file_get_contents('four_in_line.json'), true);
    if (!is_array($entries)) {
        $entries = ['table' => [], 'count' => 0];
    }
    return $entries;
}

function &getTable(&$entries) {
    $entries['table'] = array_key_exists('table', $entries) ? $entries['table'] : [];

    return $entries['table'];
}


function saveEntries($entries) {
    file_put_contents('four_in_line.json', json_encode($entries, JSON_PRETTY_PRINT));
}

function resetEntries() {
    file_put_contents('four_in_line.json', '');
}

// @Return: 'x' || 'o' || ''

function getEntry($table, $r, $c) {
    if (
        array_key_exists($r, $table) &&
        array_key_exists($c, $table[$r])
    ) {
        return $table[$r][$c];
    }

    return '';
}

