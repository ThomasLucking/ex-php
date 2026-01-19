<?php

/**
 * Get the todos from the sqlite database, and display them in a list. done
 * You need to add a sort query parameter to the page to order by date or name. 
 * If the query parameter is not set, the todos should be displayed in the order they were added.
 * If the request to the database fails, display an error message.
 * If the user wants to delete a todo, a form that sends a POST request to the deleteTodoFromDatabase.php page should be displayed on each todo elements.
 * The sort option selected must be remembered after the form submission (use a query parameter).
 * The todo title and date should be displayed in a list (date in american format).
 */
require_once('db.php');
$all_todos = [];

try {
    $pdo = databaseconnection();

    $sort = filter_input(INPUT_GET, 'sort');
    if ($sort == 'name') {
        $stmt = $pdo->prepare("select * from todos order by title asc");

    } else if ($sort == "date") {
        $stmt = $pdo->prepare("select * from todos order by due_date asc");

    } else {
        $stmt = $pdo->prepare("select * from todos order by id asc");
    }
    $stmt->execute();
    $all_todos = $stmt->fetchAll(PDO::FETCH_ASSOC);


} catch (PDOException $e) {
    echo "" . $e->getMessage();
}

?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>List of todos</title>
</head>

<body>

    <h1>
        All todos
    </h1>

    <a href="writeTodoToDatabase.php">Ajouter une nouvelle todo</a>
    <div>
        Sort by:
        <a href="?sort=name">Name</a> |
        <a href="?sort=date">Date</a> |
        <a href="displayAllTodosFromDatabase.php">Default</a>
    </div>
    <!-- WRITE YOUR HTML AND PHP TEMPLATING HERE -->
    <ul>
        <?php foreach ($all_todos as $todo): ?>
            <li>
                <strong><?= htmlspecialchars($todo['title']) ?></strong>
                (Due: <?= date("m/d/Y", timestamp: strtotime(datetime: $todo['due_date'])) ?>)
                <form method="POST" action="writeTodoToDatabase.php" style="display:inline;">
                    <input type="hidden" name="action" value="delete">
                    <input type="hidden" name="id" value="<?= $todo['id'] ?>">
                    <button type="submit">Delete</button>
                </form>
            </li> <?php endforeach; ?>
    </ul>

</body>

</html>