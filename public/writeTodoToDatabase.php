<?php
/**
 * On this page, you will create a simple form that allows user to create todos (with a name and a date).
 * The form should be submitted to this PHP page.
 * Then get the inputs from the post request with `filter_input`.
 * Then, the PHP code should verify the user inputs (minimum length, valid date...)
 * If the user input is valid, insert the new todo information in the sqlite database
 * table `todos` columns `title` and `due_date`. Then redirect the user to the list of todos.
 * If the user input is invalid, display an error to the user
 */

?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Create a new todo</title>
</head>

<body>

    <h1>
        Create a new todo
    </h1>
    <!-- WRITE YOUR HTML AND PHP TEMPLATING HERE -->

    <!-- database functionalities. -->


    <?php
    require_once('db.php');
    
    session_start();
    
    $pdo = databaseconnection();
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $action = filter_input(INPUT_POST, 'action');

        if ($action == 'delete') {
            $idtodelete = filter_input(INPUT_POST, 'id', filter: FILTER_SANITIZE_NUMBER_INT);

            $deletetodoquery = $pdo->prepare("delete from todos where id = ?");
            $deletetodoquery->execute([$idtodelete]);

            header('location: ./displayAllTodosFromDatabase.php');
            exit();
        }
        $name = filter_input(INPUT_POST, "name");
        $date = filter_input(INPUT_POST, "date");
        if (strlen($name) <= 3) {
            echo "Too short";
        } elseif (empty($date)) {
            echo "I need a date!";
        } else {
            $pdo = databaseconnection();

            $stmt = $pdo->prepare("insert into todos (title, due_date) values (?, ?)");
            $test = $pdo->prepare("select * from todos");
            $_SESSION['message'] = "Added!";
            $stmt->execute([$name, $date]);

            header("Location: ./displayAllTodosFromDatabase.php");
            exit();

        }
    }
    ?>
    <form method="POST">
        <label for="todoName">Name</label>
        <input type="text" id="todoName" name="name">

        <label for="todoDate">Date</label>
        <input type="date" id="todoDate" name="date">

        <button type="submit">Submit</button>
    </form>
</body>

</html>