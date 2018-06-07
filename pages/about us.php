<!DOCTYPE html>
<html lang="en">
<?php
//pag title invullen
$paginaTitle="about us";
$paginaTitleQuery=str_replace(" ","%20",$paginaTitle);

$json = file_get_contents("http://localhost:3000/website/website1");

$jsonIterator = new RecursiveIteratorIterator(new RecursiveArrayIterator(json_decode($json, TRUE)),RecursiveIteratorIterator::SELF_FIRST);
$arrpages=array();
$arrpagesVis=array();

foreach($jsonIterator as $key => $val) {
    if ($key === "title") {
        // $title;
        $title=$val;
    }
    if ($key === "pages") {
        // print_r($val[0]);
        foreach($val as $pageKey => $page) {
            // if ($pageKey === "pageTitle") {
            // print_r($page);
            // echo "<br><br>";
            foreach($page as $pageel => $valueP) {
                if($pageel === "pageVisible"){
                    // echo $valueP;
                    if($valueP==true){

                        array_push($arrpagesVis, "true");
                    }else{
                        array_push($arrpagesVis, "false");                        
                    }

                }
                if ($pageel === "pageTitle") {
                    // echo $valueP;
                    array_push($arrpages, $valueP);
                }
            }
        }
    }

}
?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="icon" type="image/x-icon" href="../assets/logodibit.png">

    <title><?php echo $title." | ".$paginaTitle;?></title>
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
                for ($i = 0; $i < count($arrpages); $i++) {
                    // echo $arrpagesVis[$i];
                    if ($arrpagesVis[$i] != "false"){
                        if (strtolower($arrpages[$i]) == "home") {
                            echo '<li><a href="./index">'.$arrpages[$i].'</a></li>';
                        } else {
                            echo '<li><a href="./'.$arrpages[$i].'">'.$arrpages[$i].
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

$jsonIteratorContent = new RecursiveIteratorIterator(new RecursiveArrayIterator(json_decode($jsonContent, TRUE)),RecursiveIteratorIterator::SELF_FIRST);
echo '<div id="posts" >';

foreach($jsonIteratorContent as $key => $val) {

    if ($key === "posts") {
        // echo "$key: ";
        // echo '<div style="border: 2px solid green; padding:5px;">';
        $tel = 0;
        $arrVis = array();
        foreach($val as $postKey => $post) {
            // echo '<div style="border: 2px solid blue; padding:5px;">';
            // echo '<div class="post">';
            foreach($post as $postKey1 => $postval) {
                if ($postKey1 === "postVisible") {
                    // echo "*".$postval;
                    if ($postval == 1) {
                        array_push($arrVis, "true");

                    } else {
                        array_push($arrVis, "false");
                    }
                }
            }

            if (isset($arrVis[$tel]) && $arrVis[$tel] == "true") {
                echo '<section class="post">';

                foreach($post as $postKey1 => $postval) {
                    if ($postKey1 === "postTitle") {
                        echo '<h2 class="postTitle">'.$postval.'</h2>';
                    }
                    if ($postKey1 === "postText") {
                        $postval = str_replace("\n", "<br>", $postval);
                        echo '<p class="postText">'.$postval.'</p>';
                    }

                }
                echo '<hr>';
                echo '</section>';
            }
            // }
            $tel++;
        }
        // echo '</div>';
    }

}
echo '</div>';
?>
</div>
</body>
</html>