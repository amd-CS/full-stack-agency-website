<?php
// Output comments to HTML
function the_comments() {
  global $comments;

    echo "<div><h2>Comments</h2>";
    if(!empty($comments)) {
        foreach ($comments as $comment) {
            echo "<div class='comment'>";
            echo '<div>';
            echo 'Post ID: ' . $comment["ID"];
            echo '</div>';
            echo '<div>Posted on: ' . $comment["date"] . '</div>';
            echo '<h3>New comment by: ' . $comment["name"] . '</h3>';
            echo '<div>';
            echo '<p>' . $comment["commentText"] . '</p>';
            echo '</div>';
            echo '</div>';
        }
    }
    echo '</div>';

}

