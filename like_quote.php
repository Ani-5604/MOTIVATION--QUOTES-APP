<?php
session_start();
$user_ip = $_SERVER['REMOTE_ADDR']; // or use session_id()

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['id'])) {
    $id = $_POST['id'];

    $file = 'quotes.json';
    $quotes = json_decode(file_get_contents($file), true);

    foreach ($quotes as &$quote) {
        if ($quote['id'] == $id) {
            // Ensure 'likes' and 'liked_by' exist
            if (!isset($quote['likes'])) $quote['likes'] = 0;
            if (!isset($quote['liked_by'])) $quote['liked_by'] = [];

            // Check if user already liked
            if (in_array($user_ip, $quote['liked_by'])) {
                // Remove like
                $quote['likes']--;
                $quote['liked_by'] = array_diff($quote['liked_by'], [$user_ip]);
            } else {
                // Add like
                $quote['likes']++;
                $quote['liked_by'][] = $user_ip;
            }
            break;
        }
    }

    file_put_contents($file, json_encode($quotes, JSON_PRETTY_PRINT));
    header("Location: index.php");
    exit;
} else {
    die("Invalid request.");
}
?>
