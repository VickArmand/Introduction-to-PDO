<?php
include 'dbconn.php';
// PDO query method
$stmt=$conn->query('SELECT * FROM posts');
while($row=$stmt->fetch(PDO::FETCH_ASSOC)){
    echo $row['title'] .'<br>';
}
while($row=$stmt->fetch(PDO::FETCH_OBJ)){
    echo $row->title.'<br>';
}


?>