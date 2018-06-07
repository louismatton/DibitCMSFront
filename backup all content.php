<!DOCTYPE html>
<html lang="en">
<?php

$json = file_get_contents("http://localhost:3000/website/website1/About");

$jsonIterator = new RecursiveIteratorIterator(new RecursiveArrayIterator(json_decode($json, TRUE)),RecursiveIteratorIterator::SELF_FIRST);

foreach($jsonIterator as $key => $val) {
    if ($key === "pageTitle") {
        // $title;
        $title=$val;

    }
}
?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>
    <?php 
    echo $title;
    ?> 
    </title>
</head>
<body>
    <?php
// $json = file_get_contents("http://localhost:3000/website/website1");

// $jsonIterator = new RecursiveIteratorIterator(new RecursiveArrayIterator(json_decode($json, TRUE)),RecursiveIteratorIterator::SELF_FIRST);


// foreach($jsonIterator as $key => $val) {
//     // echo $title;
//     if ($key === "title") {
//         print_r($val);

//     }    
//     if ($key === "pages") {
//         // print_r($val[0]);
//         foreach($val as $pageKey => $page) {
//             // if ($pageKey === "pageTitle") {
//             // print_r($page);
//             // echo "<br><br>";
//             foreach($page as $pageel => $valuekut) {

//                 // if (is_array($valuekut)) {
//                 //     echo "$pageel: ";
//                 // } else {
//                 //     echo "$pageel => $valuekut <br>";
//                 // }
//                 if ($pageel === "pageTitle" || $pageel === "pageOrder") {
//                     echo $pageel.": ".$valuekut."<br>";
//                 }

//                 if ($pageel === "posts") {
//                     echo "$pageel: ";

//                     echo '<div style="border: 2px solid green; padding:5px;">';

//                     foreach($valuekut as $postKey => $post) {
//                         echo '<div style="border: 2px solid blue; padding:5px;">';

//                         foreach($post as $postKey1 => $postval) {

//                             if ($postKey1 === "postTitle" || $postKey1 === "postText" || $postKey1 === "postOrder ") {
//                                 echo $postKey1.": ".$postval."<br>";
//                             }
                            
//                 }
//                 echo '</div>';
//             }echo '</div>';
//                 }
//             }
//             echo "<br><br>";
//         }
//     }
// }
foreach($jsonIterator as $key => $pages) {

    // if ($key == "pages") {
    //     foreach($pages as $key1 => $page) {
            if (is_array($pages)) {
                echo "$key: <br>";
            } else {
                echo "$key => $pages <br>";
            }
        // }
    // }
}

    ?>
</body>
</html>