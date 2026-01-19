<?php

/**
 * Get the values from the GET parameters with filter_input function
 */

$valuename = filter_input(INPUT_GET, "name", FILTER_SANITIZE_STRING);
$value = filter_input(INPUT_GET, "age", FILTER_VALIDATE_INT);

?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>URL query parameters</title>
</head>

<body>

    <!-- Display parameters here in a h1 tag -->
    <?php if (isset($valuename) && isset($value)): ?>
        <h1><?= $valuename ?> is <?= $value ?> years old</h1>
    <?php elseif (empty($valuename) && empty($value)): ?>
        <h1>No query parameters found</h1>
        <ul>
            <li>Missing name</li>
            <li>Missing age</li>
        </ul>
    <?php elseif (empty($value)): ?>
        <h1>No query parameters found</h1>
        <ul>
            <li>Missing age</li>
        </ul>
    <?php elseif (empty($valuename)): ?>
        <h1>No query parameters found</h1>
        <ul>
            <li>Missing name</li>
        </ul>

    <?php endif ?>


    <!-- Display message in list element in case of missing parameters -->

</body>

</html>