<?php

/**
 * On this page, you should display a form with two fields, one for the Name and one for the Age.
 * The server should respond to the form submission by displaying the same page with the name and age in a h1 "Toto is 20 years old".
 * If there is no submission or only one of the two fields, the h1 should display "Submit the form".
 * If the user have a name with more than 6 characters, the name must be displayed in red (only the name, not all h1).
 * If the user is more than 18 years old, you should display a list with one line per year of the age of the user.
 * The data submitted should remain displayed in the form after the submission.
 * (Your form should be semantically correct, use a label and name your fields)
 */

?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Form management</title>
</head>

<body>

    <!-- WRITE YOUR HTML AND PHP TEMPLATING HERE -->

    <?php
    $name = "";
    $age = "";
    $fullagecheck = "";


    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $name = $_POST["name_value"];
        $age = $_POST["age_value"];

        $color = (strlen($name) > 6) ? 'red' : 'black';
        $fullagecheck = "<ul>";
        for ($i = 1; $i <= $age; $i++) {
            // the .= appends instead of replacing the data.
            $fullagecheck .= "<li>" . $i . "</li>";
        }
        $fullagecheck .= "</ul>";
        if (empty($name) || empty($age)) {
            $headingText = "Submit the form";
        } else {
            $headingText = "<span style='color:$color;'>$name</span> is $age years old";

        }
    } else {
        $headingText = "Submit the form";
    }
    ?>



    <h1> <?php echo $headingText ?></h1>
    <?php echo $fullagecheck ?>
    <form method="POST">
        <label for="user_n">Name</label>
        <input type="text" id="user_n" name="name_value" value="<?php echo $_POST['name_value']; ?>">

        <label for="user_a">Age</label>
        <input type="text" id="user_a" name="age_value" value="<?php echo $_POST['age_value'] ?>">

        <button type="submit">Submit</button>
    </form>


</body>

</html>