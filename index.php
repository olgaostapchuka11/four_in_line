<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include 'functions.php';
?>

<link rel="stylesheet" href="style.css">

<?php
if (array_key_exists('reset', $_REQUEST)) {
    resetEntries();
}

$entries = getEntries();
$table = &getTable($entries);

if (array_key_exists('r', $_REQUEST) && 
    array_key_exists('c', $_REQUEST)) {
    $r = $_REQUEST['r'];
    $c = $_REQUEST['c'];

    $new_row = $r + 1;

    if ($r == 9 || array_key_exists($new_row, $table) &&
    array_key_exists($c, $table[$new_row]) &&
    $table[$r + 1] != '') {

        if (getEntry($table, $r, $c)  == 'O' || getEntry($table, $r, $c)  == 'x' ) {
            echo "<h3>Поле занято</h3>";
        } else {
            if (!array_key_exists('count', $entries)) {
                $entries['count'] = 1; 
            } else {
                $entries['count']++;
            }
            
            if ($entries['count'] % 2 != 0) {
                $table[$r][$c] = 'x';
             } else {
                $table[$r][$c] = '0';
            }
        }
        saveEntries($entries);

    }
}
/*
    // По Вертикали
    if ($table[$r][$c] == $table[($r + 1)][$c]) {
        if ($table[($r + 1)][($c)] == $table[($r + 2)][$c]) {
            if ($table[($r + 2)][$c] == $table[($r + 3)][$c]) {
                echo "<h3> Победил " . $table[$r][$c] . "</h3>";
            } 
        }
    }

/*
    // По горизонтали ->
    if ($table[$r][$c] == $table[$r][($c - 1)]) {
        if ($table[$r][($c - 1)] == $table[$r][($c - 2)]) {
            if ($table[$r][($c - 2)] == $table[$r][($c - 3)]) {
                echo "<h3> Победил " . $table[$r][$c] . "</h3>";
            }
        }
    }

    // По горизонтали <-
    if ($table[$r][$c] == $table[$r][($c + 1)]) {
        if ($table[$r][($c + 1)] == $table[$r][($c + 2)]) {
            if ($table[$r][($c + 2)] == $table[$r][($c + 3)]) {
                echo "<h3> Победил " . $table[$r][$c] . "</h3>";
            }
        }
    }
*/
?>

<div class="container">
    <?php 
    for($r = 0; $r <= 9; $r++){
       for($c = 0; $c <= 9; $c++) {
        echo "<a href='?r=$r&c=$c'>" . getEntry($table, $r, $c) . "</a>";
       }
    }

?>
</div>


<a href="?reset=Reset">RESET</a>

