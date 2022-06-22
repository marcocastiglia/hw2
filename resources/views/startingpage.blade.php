<html>
    <head>
        <title>Recipes - Hello!</title>
        <link rel="stylesheet" href="{{ url('css/startingpage.css') }}">
        <link href="https://fonts.googleapis.com/css2?family=Inspiration&family=Palette+Mosaic&display=swap" rel="stylesheet">
        <meta name="viewport" content="width=device-width, initial-scale=1">
    </head>
    <body>
        <nav>
            <div id="logo"> Recipes </div>
        </nav>
        <header>
            <div id='center'>
                <h1>Un mondo di ricette!</h1>
                <em>Entra in Recipes!</em>
                <div id='buttons'>
                    <a href="{{ url('signin') }}">Login</a>
                    <a href="{{ url('signup') }}">Registrati</a>                   
                </div>
            </div>
        </header>
    </body>
</html>