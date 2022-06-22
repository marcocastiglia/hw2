<html>
    <head>
        <title>Recipes - Signup</title>
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
            <section id='center' class='signup'>

            <h1>Sarai presto dei nostri!</h1>

            <p class='errore'>
                @if(strlen($error) > 0)
                    {{$error}}
                @endif
            </p>
      
            <form name='signup_form' method='post' class='signup'>
                @csrf
                <div class='div_name'>
                    <label>Nome:</label>
                    <input type="text" name="name" value="{{ old('name') }}" class="input_field">
                </div>
                <div class='div_surname'>
                    <label>Cognome:</label>
                    <input type="text" name="surname" value="{{ old('surname') }}" class="input_field">
                </div>
                <div class='div_email'>                    
                    <label>Email:</label>
                    <input type="text" name="email" value="{{ old('email') }}" class="input_field">
                </div>
                <div class='div_username'>                   
                    <label>Username:</label>                                        
                    <input type="text" name="username" value="{{ old('username') }}" class="input_field">
                </div>
                <div class='div_password'>
                    <label>Password:</label>
                    <input type="password" name="password" value="" class="input_field">
                </div>
                <div class='access_div'>
                    <input type='submit' value="Registrati" class="access">
                </div>
            </form>
            </section>

        </header>
        
    </body>
</html>