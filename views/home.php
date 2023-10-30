<?php
    include_once('../global/function.php');
    include_once ('../global/header.php');
    htmlHeader('Home');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="../assets/css/style-home.css">
</head>
<body>
    <sction>
        <div class ="circle"></div>
        <header>
            <a href="#" ><img src="../source/img/home/logo.png" class="logo"></a>
            <ul>
                <li><a href="login.php">login</a>
        </header>
        <div class="content">
            <div class="textBox">
                <h2>Coffee shop Management system<br>It's <span>SEED</span></h2>
                <p>It is a product management system for coffee shops, such as adding products. Delete product Edit product You can also record product sales information. Helps to know sales information and create excellent sales strategies.</p>
                <a href="login.php">Login</a>
            </div>
            <div class="imgBox">
                <img src="../source/img/home/img3.png" class="Amazon">
            </div>
        </div>
        <ul class="thumb">
            <li><img src="../source/img/home/thumb1.png" onclick="imgSlider('../source/img/home/img3.png');changeCircleColor('#017143');changeTextColor('#017143')"></li>
            <li><img src="../source/img/home/thumb2.png" onclick="imgSlider('../source/img/home/img2.png');changeCircleColor('#B15A2E');changeTextColor('#B15A2E')"></li>
            <li><img src="../source/img/home/thumb3.png" onclick="imgSlider('../source/img/home/img1.png');changeCircleColor('#665149');changeTextColor('#665149')"></li>
        </ul>
        <ul class="sci">
            <li><a href="#"><img src="../source/img/home/facebook.png"></a></li>
            <li><a href="#"><img src="../source/img/home/instagram.png"></a></li>
            <li><a href="#"><img src="../source/img/home/twitter.png"></a></li>
            
        </ul>
    </section>

    <script type="text/javascript">
        function imgSlider(anything){
            document.querySelector('.Amazon').src = anything;
        }

        function changeCircleColor(color){
            const circle = document.querySelector('.circle');
            circle.style.background = color;
        }
        function changeTextColor(color){
            const content = document.querySelector('.content .textBox a');
            circle.style.background = color;
        }
    </script>

    
    
</body>
</html>

<?php
    htmlFooter();
?>



