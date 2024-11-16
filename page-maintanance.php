<?php


/*
Template Name: Maintenance
*/ 
?>

<style>
    
    * {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: 'outfit', sans-serif;
    background-color: #f4f4f4;
    color: #333;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    text-align: center;
}

.maintenance-container {
    max-width: 600px;
    padding: 20px;
    background-color: #fff;
    /*box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);*/
    border-radius: 8px;
}

.maintenance-content .logo {
    max-width: 200px;
    margin-bottom: 20px;
}

.maintenance-content h1 {
    font-size: 2.5em;
    margin-bottom: 20px;
    color: #0391c5;
}

.maintenance-content p {
    font-size: 1.2em;
    margin-bottom: 20px;
        color: #4f5966;
}

.maintenance-content a {
    color: #3498db;
    text-decoration: none;
}

.maintenance-content a:hover {
    text-decoration: underline;
}

</style>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@100..900&display=swap" rel="stylesheet">

<?php
$logo = get_template_directory_uri()."/img/logo-1.svg"; 
?>
 <div class="maintenance-container">
        <div class="maintenance-content">
            <img src="<?php  echo $logo ?>" alt="Site Logo" class="logo">
            <h1>We'll be back soon!</h1>
            <p>Sorry for the inconvenience but we’re performing some maintenance at the moment.</p>
            <p>— The Team</p>
        </div>
    </div>


