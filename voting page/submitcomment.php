<?php
require 'db.php';

if (isset($_POST['name'], $_POST['comment'])) {
    $name = $conn->real_escape_string($_POST['name']);
    $comment = $conn->real_escape_string($_POST['comment']);

    $sql = "INSERT INTO comments (name, comment) VALUES ('$name', '$comment')";
    if ($conn->query($sql)) {
        echo "Comment added!";
    } else {
        echo "Error: " . $conn->error;
    }
}
?>
