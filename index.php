<?php
session_start();
$quotes = json_decode(file_get_contents('quotes.json'), true);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Motivational Quotes</title>
    <link rel="stylesheet" href="assets/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
<div class="container">
    <h1><i class="fas fa-quote-left"></i> Motivational Quotes</h1>

    <?php
    if (!empty($quotes)) {
        $quote = $quotes[array_rand($quotes)];
        echo "<div class='quote animate'>";
        echo "<em>" . htmlspecialchars($quote['quote']) . "</em>";

        if (!empty($quote['category'])) {
            echo "<div class='category'>Category: <strong>" . htmlspecialchars($quote['category']) . "</strong></div>";
        }

        $liked = isset($_SESSION['liked'][$quote['id']]);
        echo "<div class='actions'>
                <form action='like_quote.php' method='post' style='display:inline-block;'>
                    <input type='hidden' name='id' value='" . $quote['id'] . "'>
                    <button type='submit'><i class='fas fa-thumbs-up'></i> " . $quote['likes'] . ($liked ? " (Liked)" : "") . "</button>
                </form>
                <form action='delete_quote.php' method='post' style='display:inline-block;'>
                    <input type='hidden' name='id' value='" . $quote['id'] . "'>
                    <button type='submit'><i class='fas fa-trash'></i></button>
                </form>
              </div>";
        echo "</div>";
    } else {
        echo "<p>No quotes available.</p>";
    }
    ?>

    <!-- Add new quote -->
    <form action="add_quote.php" method="post" class="add-form">
        <input type="text" name="quote" placeholder="Contribute your thoughts here.." required>
        <input type="text" name="category" placeholder="Category (optional e.g., life, love,happiness,health)">
        <button type="submit"><i class="fas fa-plus-circle"></i> Add</button>
    </form>

    <p><a href="all_quotes.php"><i class="fas fa-list"></i> View All Quotes</a></p>
</div>
</body>
</html>
