<!DOCTYPE html>
<html lang="en">
<?php
//pag title invullen
$paginaTitle="about us";
$paginaTitleQuery=str_replace(" ","%20",$paginaTitle);

$json = file_get_contents("http://localhost:3000/website/website1");
$jsonDecoded=json_decode($json);

$orderedPages=$jsonDecoded->pages;

usort($orderedPages, function($a, $b) { //Sort the array using a user defined function
    return $a->pageOrder > $b->pageOrder ? 1 : -1; //Compare the scores
});

?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../css/style.css" >
    <link rel="icon" type="image/x-icon" href="../assets/logodibit.png">

    <title><?php echo $jsonDecoded->title." | ".$paginaTitle;?></title>
</head>
<body>
<header>
    <div>
        <a href="./index">
        <img src="../assets/Tekengebied 1dibitwhite.svg" class="logo" alt="dibit">        </a>
        <div>
            <div id="menu" onclick="menuFunction()">
                <i class="fas fa-bars fa-3x"></i>
            </div>
            <ul>
                <?php
                foreach($orderedPages as $page){
                    if($page->pageVisible){
                        if (strtolower($page->pageTitle) == "home"&& strtolower($page->pageTitle)==strtolower($paginaTitle)) {
                            echo '<li class="selected"><a href="./index">'.$page->pageTitle.'</a></li>';
                        } else if(strtolower($page->pageTitle) == "home"&& strtolower($page->pageTitle)!=strtolower($paginaTitle)){
                            echo '<li ><a href="./index">'.$page->pageTitle.'</a></li>';

                        } else if(strtolower($page->pageTitle)==strtolower($paginaTitle)){
                            echo '<li class="selected"><a href="./'.$page->pageTitle.'">'.$page->pageTitle.
                            '</a></li>';
                        }else{
                            echo '<li ><a href="./'.$page->pageTitle.'">'.$page->pageTitle.
                            '</a></li>';

                        }
                    }
                }
                ?>
            </ul>
        </div>
    </div>
</header>
<div id="body">

<?php
$jsonContent = file_get_contents("http://localhost:3000/website/website1/".$paginaTitleQuery);
$data = json_decode($jsonContent); // decode the JSON feed

echo '<div id="posts" >';


// echo $characters;
// echo serialize($characters->posts);
$orderedPosts=$data->posts;
usort($orderedPosts, function($a, $b) { //Sort the array using a user defined function
    return $a->postOrder > $b->postOrder ? 1 : -1; //Compare the scores
});
foreach($orderedPosts as $post){
    if($post->postVisible){
        echo '<section class="post">';
        echo '<h2 class="postTitle">'.$post->postTitle.'</h2>';
        echo '<p class="postText">'.nl2br($post->postText).'</p>';

        foreach($post->postPhotos as $photo){
            echo '<img src="'.$photo.'" class="image" >';
        }
        echo '<hr>';
        echo '</section>';
    }
}
echo '</div>';
?>

</div>
</body>
</html>