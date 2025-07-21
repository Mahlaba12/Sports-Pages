<?php
require 'db.php';

$sql = "SELECT * FROM comments ORDER BY created_at DESC";
$result = $conn->query($sql);

while ($row = $result->fetch_assoc()) {
    echo "<div class='comment'>
            <strong>" . htmlspecialchars($row['name']) . ":</strong>
            <p>" . htmlspecialchars($row['comment']) . "</p>
            <span class='comment-time'>" . $row['created_at'] . "</span>
          </div>";
}
?>
