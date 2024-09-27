<?php
//Incude db connection
include_once('includes/db.php');

//Prepare and execute stmt to fetch active APIs
$query = "SELECT * FROM apis WHERE status = :status";
$stmt = $pdo->prepare($query);
$stmt->bindValue(':status', 'enabled', PDO::PARAM_STR);
$stmt->execute();

$activeApis = $stmt->fetchAll(PDO::FETCH_ASSOC);

$activeApiUrls = [];

foreach($activeApis as $api){
    $activeApiUrls[$api['name']] = $api["api_url"];
}

//Determine the redirect URLS
$redirectUrl = "";
if(isset($activeApiUrls['GladTidingsData'])){
    $redirectUrl = 'gladtiding_page.php';
}
else if(isset($activeApiUrls['BofiaSub'])){
    $redirectUrl = 'bofiasub_page.php';
}else{
   $redirectUrl  = 'no_product_available.php'; 
}
//Redirect to the determined URL
header("Location: $redirectUrl");
exit;
?>