<?php
session_start();
$quoteText = $_POST['quote'];
$category = $_POST['category'] ?? "";

$quotes = json_decode(file_get_contents('quotes.json'), true);
$newId = !empty($quotes) ? max(array_column($quotes, 'id')) + 1 : 1;

$newQuote = [
    "id" => $newId,
    "quote" => $quoteText,
    "category" => $category,
    "likes" => 0
];

$quotes[] = $newQuote;
file_put_contents('quotes.json', json_encode($quotes, JSON_PRETTY_PRINT));
header("Location: index.php");
exit;
