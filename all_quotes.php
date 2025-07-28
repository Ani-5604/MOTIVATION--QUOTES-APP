<?php
$quotes = json_decode(file_get_contents("quotes.json"), true);
?>
<!DOCTYPE html>
<html>
<head>
    <title>All Quotes</title>
    <link rel="stylesheet" href="assets/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <div class="container">
        <h1><i class="fas fa-list-ul"></i> All Quotes</h1>
        <a href="index.php"><i class="fas fa-arrow-left"></i> Back</a>
        <ul>
            <?php foreach ($quotes as $q): ?>
                <ul class="quote-list">

                <li>
                    <blockquote><i class='fas fa-quote-left'></i> <?= htmlspecialchars($q['quote']) ?> <i class='fas fa-quote-right'></i></blockquote>
                    <small>Category: <?= htmlspecialchars($q['category']) ?></small><br>
                    <form action="delete_quote.php" method="POST" style="display:inline">
                        <input type="hidden" name="id" value="<?= $q['id'] ?>">
                        <button><i class="fas fa-trash-alt"></i> Delete</button>
                    </form>
                    <form action="like_quote.php" method="POST" style="display:inline">
                        <input type="hidden" name="id" value="<?= $q['id'] ?>">
                        <button><i class="fas fa-heart"></i> Like (<?= $q['likes'] ?>)</button>
                    </form>
                </li></ul>
            <?php endforeach; ?>
        </ul>
    </div>
</body>
</html>
