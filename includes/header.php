<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($page_title) ? $page_title : 'Hello Vietnam - Discover the Beauty'; ?></title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/asset_styles.css">
</head>
<body>
    <div class="container">
        <header>
            <div class="icon icon-vietnam-flag icon-center icon-lg"></div>
            <h1><?php echo isset($header_title) ? $header_title : 'Xin chào Việt Nam!'; ?></h1>
            <p class="subtitle"><?php echo isset($header_subtitle) ? $header_subtitle : 'Discover the Land of Rising Dragon'; ?></p>
        </header>