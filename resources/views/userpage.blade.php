<html>
    <head>
        <title>Your Account - Recipes</title>
        <link rel="stylesheet" href="{{ url('css/startingpage.css') }}">
        <link rel="stylesheet" href="{{ url('css/userpage.css') }}">

        <link href="https://fonts.googleapis.com/css2?family=Inspiration&family=Palette+Mosaic&display=swap" rel="stylesheet">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script src="{{url('js/userpage.js') }}" defer></script>
        <script> const BASE_URL = "{{url('/')}}/" </script>
    </head>
    <body>
        <nav>
            <div id="logo"> Recipes </div>
        </nav>
        
        <div id="base">
            <main>

                <div class='profilo'>
                    <div class='nav_2'>
                        <div class='menu'>
                            <div></div>
                            <div></div>
                            <div></div>    
                        </div>
                        <div class='links'>
                            <a href="{{url('/homepage') }}" class="home">Home</a>
                            <a href="{{url('/logout') }}" class='logout'>Logout</a>
                        </div>
                    </div>
                    <img src="{{ url('images/profile_default.jpg') }}">
                    <span>
                        {{$username}}
                    </span>
                </div>

                <section id="options">
                    <a class="profilo">
                        <img src="{{ url('images/profile_default.jpg') }}">
                        <h4 class='hidden'>Profilo</h4>
                    </a>
                    <a href=" {{ url('homepage') }}" class="preferiti">
                        <img src="{{ url('images/not_favorite.png') }}">
                        <h4 class='hidden'>Preferiti</h4>
                    </a>
                    <a class="scrivi">
                        <img src="{{ url('images/writing.png') }}">
                        <h4 class='hidden'>Scrivi</h4>
                    </a>
                    <a class="modifica">
                        <img src="{{ url('images/pen_icon.png') }}">
                        <h4 class='hidden'>Modifica</h4>
                    </a>
                    <a class="pro_gif">
                        <img src="{{ url('images/giphy_logo.png') }}">
                        <h4 class='hidden'>GIF profilo</h4>
                    </a>
                </section>
                <section id="mainspace">

                    <article class='profilo show_flex'>
                        <h4>Ecco le ricette che hai pubblicato.</h4>
                        <section class='post_section'>
                                       
                        </section>
                        <section class='modal_view hidden'>
                            <div class='container'>
                                <h4 class='error'>Sei sicuro di voler eliminare questa ricetta?</h4>
                                <div></div>
                                <div class='buttons'>
                                    <button class='confirm'>Conferma</button>
                                    <button class='cancel'>Annulla</button>
                                </div>
                            </div>
                        </section>
                    </article>

                    


                    <article class='scrivi hidden'>
                        <p class='alarms hidden'></p>
                        <form name='scrivi_form' method='post'>
                            @csrf
                            <div class='title'>
                                <label>Titolo:</label>
                                <input type="text" name="title">
                            </div>                
                            <div class='ingredients'>
                                <label>Ingredienti:</label>
                                <div class='add_ingr'>
                                    <input type="text" name="ingredient[]"> 
                                    <img src="{{ url('images/add_icon.png') }}">
                                </div> 
                                <div class='more_ingr'></div>             
                            </div>
                            <div class='text_descr'>
                                <label>Testo:</label>
                                <textarea name="textarea"></textarea>
                            </div>
                            <div class='search_image_to_insert'>
                                <label>Cerca un'immagine inserendo una parola-chiave:</label>
                                <div class='search'>
                                    <input type='text' name='image_keyword'>
                                    <button>Cerca</button>
                                </div>
                                <div id='image_results'>                   
                                </div>
                            </div>
                            <div class='submit'>
                                <input type='submit' value='Pubblica'>
                            </div>
                            <div class='reset'>
                                <input type='reset' value='Ripristina'>
                            </div>
                        </form>
                    </article>

                    <article class='modifica hidden'>
                        <h4 class='error'>Stai apportando delle modifiche al tuo profilo.</h4>
                        <div class='confirm_pw'>
                            <span> 
                                <strong><em>{{$username}}</em></strong> conferma la password per procedere:
                            </span>
                            <form name='confirm_pw' method='post'>
                                @csrf
                                <input type='password' name='password'>
                                <input type='submit' name='submit' value='Invia'>
                            </form>
                            <p class='error hidden'></p>
                            <a href='modify_account.php' class='hidden'>Modifica</a>
                        </div>
                    </article>


                    <article class='pro_gif hidden'>
                        <h4>Cerca una GIF da inserire come GIF profilo:</h4>
                        <div class='container_gifs'>
                            <form name='form_giphy' method='post' class='up_form'>
                            @csrf
                                <input type='text' name='keyword' class='text'>
                                <input type='submit' value='Cerca'>
                            </form>
                            <div id='gif_results'></div>
                            <form name='upload_gif' method='post' class='down_form hidden'>
                            @csrf
                                <input type='submit' value='Carica'>
                            </form>
                        </div>
                    </article>
                

                    
                </section>
                
            </main>
            <footer>
                Unict - Marco Castiglia - 1000003997
            </footer>

        </div>
    </body>
</html>