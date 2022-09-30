<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>toto page</title>
</head>
<body>
    <h1>toto page avec utilisation de controller</h1>

    <h2><a href="{{ route('coco.page') }}">lien vers coco par route</a></h2>
    <br>
    <h2><a href="{{ url('/coco') }}">lien vers coco par URL</a></h2>
    <!--
        -à toi de choisir le mieux c'est 'utiliser les routes car dés fois tu peux changer d'url en plein projet ou bien l'url est trop longue donc ce n'ai pas tres pratique alors le mieux c'est dutiliser les routes.

        -n'oublie pas d'ajouter le nom de ta route dans ta route  Route::get('/coco', 'CocoClasse')"->name('coco.page');" !!
    -->
</body>
</html>