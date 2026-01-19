<?php

/**
 * On this page, you need to remove a todo from the sqlite database.
 * The id of the todo to delete will be passed as a POST parameter.
 * You need to handle the deletion of the todo from the database.
 * If there is an error, display an error message.
 * If the deletion is successful, redirect the user to the list of todos.
 */

?>


<?php

$pdo = databaseconnection();

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $action = filter_input(INPUT_POST, 'action');
    try {
        if ($action == 'delete') {
            $idtodelete = filter_input(INPUT_POST, 'id', filter: FILTER_SANITIZE_NUMBER_INT);

            $deletetodoquery = $pdo->prepare("delete from todos where id = ?");
            $deletetodoquery->execute([$idtodelete]);

            header('location: ./displayAllTodosFromDatabase.php');
            exit();
        }
    } catch (PDOException $e) {
        echo '' . $e->getMessage();
    }

}

?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Todo deletion</title>
</head>

<body>

    <h1>Delete a todo error</h1>

    <!-- WRITE YOUR HTML AND PHP TEMPLATING HERE -->

    <a href="displayAllTodosFromDatabase.php">Return to todo list</a>

</body>

</html>