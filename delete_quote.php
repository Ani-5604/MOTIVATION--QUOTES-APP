<?php
session_start();
$id = $_POST['id'];

$quotes = json_decode(file_get_contents('quotes.json'), true);
$quotes = array_filter($quotes, fn($quote) => $quote['id'] != $id);

file_put_contents('quotes.json', json_encode(array_values($quotes), JSON_PRETTY_PRINT));
header("Location: index.php");
exit;
