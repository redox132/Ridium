<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>



    <h1><?php echo $title ?></h1>
    <p>This is a simple PHP application demonstrating routing and request handling.</p>

    <form action="/user/store" method="POST">
        <input type="text" name="name" placeholder="Enter your name" value="<?php echo isset($_SESSION['old']['name']) ? htmlspecialchars($_SESSION['old']['name']) : ''; ?>">
        <input type="email" name="email" placeholder="Enter your email" value="<?php echo isset($_SESSION['old']['email']) ? htmlspecialchars($_SESSION['old']['email']) : ''; ?>">
        <input type="password" name="password" placeholder="Enter your password">
        <button type="submit">Submit</button>
    </form>

    <?php
    if (isset($_SESSION['errors'])) {
        echo '<div class="errors">';
        foreach ($_SESSION['errors'] as $error) {
            echo "<p>{$error}</p>";
        }
        unset($_SESSION['errors']);
        unset($_SESSION['old']);
        echo '</div>';
    }


    ?>




</body>
</html>