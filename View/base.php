<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <base href="<?= $webRoot ?>" >
        <link rel="stylesheet" href="Public/css/bootstrap.min.css" />
        <link rel="stylesheet" href="Public/css/style.css" />
        <link rel="stylesheet" href="Public/css/font-awesome.min.css" />
        <title><?= $title ?></title>   <!-- Élément spécifique -->
        <script src="Public/js/jquery.min.js"></script>
        <script src="Public/js/bootstrap.min.js"></script>
    </head>
    <body>
        <div id="global">
            <header class="text-center">
                <a href="index.php" ><h1 id="titleWebSite">PHP MVC Chat App</h1></a>
                <p>un T’chat, construit sur un modèle MVC, sans framework.</p>
            </header>
            <div id="contenu">
                <?= $content ?>   <!-- Élément spécifique -->
            </div> <!-- #contenu -->
            <footer class="text-center" id="piedBlog">
                Chat réalisé avec PHP5, HTML5, CSS3, Bootstrap3 et Jquery
            </footer>
        </div> <!-- #global -->

    </body>
</html>