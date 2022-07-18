<?php
include 'dbconn.php';
// Prepared statements

// FETCH MULTIPLE POSTS
// One can use positional parameters or named parameters

// using positional parameters
$author='Jack';
$is_published=true;
$sql="SELECT *  FROM posts WHERE author =?";
$stmt=$conn->prepare($sql);
// Here the order of the parameters must be similar to the order of the inputs in the query
$stmt->execute([$author]);

$posts=$stmt->fetchAll();
// var_dump($posts);
foreach($posts as $post){
    echo $post->title;
}
// using named parameters
$sql="SELECT *  FROM posts WHERE author =:author AND is_published=:ispublished";
$stmt=$conn->prepare($sql);
$stmt->execute(['author'=>$author, 'ispublished'=>$is_published]);

$posts=$stmt->fetchAll();
// var_dump($posts);
foreach($posts as $post){
    echo $post->title;
}

// Fetch single post
$id=1;
$sql="SELECT *  FROM posts WHERE id=:id";
$stmt=$conn->prepare($sql);
$stmt->execute(['id'=>$id]);

$post=$stmt->fetch();
echo $post->body;

// Get Row Count
$author='Jack';
$is_published=true;
$sql="SELECT *  FROM posts WHERE author =?";
$stmt=$conn->prepare($sql);
$stmt->execute([$author]);

$postscount=$stmt->rowCount();
echo $postscount;
?>