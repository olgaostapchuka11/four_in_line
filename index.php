<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>

<link rel="stylesheet" href="style.css">

<?php
$content = file_get_contents('four_in_line.json'); 
$entries = json_decode($content, true);
if (!is_array($entries)){
    $entries=[];
}

$entries['table'] = array_key_exists('table', $entries) ? $entries['table']: []; 
$table = &$entries['table'];

if (array_key_exists('r', $_REQUEST) && array_key_exists('c', $_REQUEST)) {
    $r = $_REQUEST['r'];
    $c = $_REQUEST['c'];
    echo "<h3>r=" . $r . "; c= " . $c . "</h3>";
    
    if(!array_key_exists('count', $entries)) {
        $entries['count'] = 1;
    }   else {
        $entries['count']++;
    }
    
    
    $value = $entries['count'] % 2 === 0 ? 'x' : "o";
    $table[$r][$c] = $value;

    file_put_contents('four_in_line.json', json_encode($entries, JSON_PRETTY_PRINT));
}
 
?>

<div class="container">
    <?php 
    for($r = 0; $r <= 9; $r++){
       for($c = 0; $c <= 9; $c++) {
    
        $value = '';
        if ($r === 9 && $c === 2) {
            $value = 'x';
        } 
  
        
        echo "<a href='?r=$r&c=$c'>" . $value . "</a>";
       }
    }
?>
</div>



