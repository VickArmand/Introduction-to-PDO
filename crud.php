<?php
include 'dbconn.php';
// Insert data
$title='Post Five';
$body='This is Post Five';
$author='Kevin Main';
$sql= 'INSERT INTO posts(title,body,author) VALUES (:title,:body,:author)';
$stmt=$conn->prepare($sql);
$stmt->execute([
    'title'=>$title,
    'body'=>$body,
    'author'=>$author
]);
echo "Post Inserted Successfully";
// Update data
$id=2;
$body='Updated Post Five Alert';
$author='Kevin Main';
$sql= 'UPDATE posts  SET body=:body WHERE id=:id';
$stmt=$conn->prepare($sql);
$stmt->execute([
    'body'=>$body,
    'id'=>$id
]);
echo "Post Updated Successfully";
// Delete data
$id=5;
$sql= 'DELETE FROM posts WHERE id=:id';
$stmt=$conn->prepare($sql);
$stmt->execute([
    'id'=>$id
]);
echo "Post Deleted Successfully";
// Search data 
$search='%post%';
$sql="SELECT *  FROM posts WHERE title  LIKE ?";
$stmt=$conn->prepare($sql);
$stmt->execute([$search]);

$posts=$stmt->fetchAll();
foreach ($posts as $post){
    echo $post->title.'<br>';
}
// Using limits 
$author='Jack';
$is_published=true;
$sql="SELECT *  FROM posts WHERE author =? && is_published=? LIMIT 1";
$stmt=$conn->prepare($sql);
// Here the order of the parameters must be similar to the order of the inputs in the query
$stmt->execute([$author,$is_published]);

$posts=$stmt->fetchAll();
// var_dump($posts);
foreach($posts as $post){
    echo $post->title;
}
// Using limits as named parameters
$author='Jack';
$is_published=true;
$limit=1;
$sql="SELECT *  FROM posts WHERE author =? && is_published=? LIMIT ?";
$stmt=$conn->prepare($sql);
// Here the order of the parameters must be similar to the order of the inputs in the query
$stmt->execute([$author,$is_published,$limit]);
// this will bring an error hence we need to add another attribute PDO::ATTR_EMULATE_PREPARES and set it to false in the dbconn file
$posts=$stmt->fetchAll();
// var_dump($posts);
foreach($posts as $post){
    echo $post->title;
}
?>