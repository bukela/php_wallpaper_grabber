<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<form action="" method="post">
<input type="text" name="term" id="">
<input type="submit" value="Search wallpaper">

</form>
<?php
$term = '';
$curl = curl_init();
if ( isset($_POST['term'])) {
    $term = $_POST['term'];
}

$url = "https://www.pexels.com/search/".$term."/";
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
$result = curl_exec($curl);
preg_match_all("!https://images.pexels.com/photos/[^\s]*?=tinysrgb!", $result, $matches);

$images = array_values(array_unique($matches[0]));
// print_r($matches);

for ($i=0; $i < count($images); $i++) {
    echo "<div style='text-align:center'>";
    echo "<img src='$images[$i]'><br />";
    echo "</div>";
}

curl_close($curl);
?>
</body>
</html>
