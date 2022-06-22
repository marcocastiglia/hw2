<html>
    <head>
        <title>Recipes - Login</title>
        <link rel="stylesheet" href="{{ url('css/startingpage.css') }}">
        <link rel="stylesheet" href="{{ url('css/login.css') }}">
        <link href="https://fonts.googleapis.com/css2?family=Inspiration&family=Palette+Mosaic&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Roboto+Mono:wght@200&display=swap" rel="stylesheet">

        <script src="{{ url('js/login.js') }}" defer></script>

        <meta name="viewport" content="width=device-width, initial-scale=1">
    </head>
    <body>
        <nav>
            <div id="logo"> Recipes </div>
        </nav>
        <header>
            <section id='center'>
            <h1>Bentornato!</h1>

            <p class='errore'>
                @if(strlen($error) > 0)
                    {{$error}}
                @endif
            </p>
   
            <form name='login_form' method='post'>
                @csrf
                <label>Username:</label>
                @if(strcmp($error, 'Password errata') == 0)
                    <input type="text" name="username" value="{{old('username')}}" class="input_field fullBlack">
                @else
                    <input type="text" name="username" value="username" class="input_field">
                @endif
                <label>Password:</label>
                <input type="password" name="password" value="password" class="input_field">
                <div class='access_div'>
                    <input type='submit' value="Accedi" class="access">
                </div>
            </form>
            </section>

        </header>
    </body>
</html>