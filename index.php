<meta charset="utf-8">
<link href="classes.css" rel="stylesheet">
<?
ini_set('display_errors', '1');
ini_set('error_reporting', E_ALL);
error_reporting('E_ALL');

ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
include_once 'c.php';
include_once 'Figures.php';
include_once 'Board.php';

$Figures = new Figures; 
$Board = new Board; 



$Board->create();
$Figures->makeMove();

