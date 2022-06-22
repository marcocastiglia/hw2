<html>
    <head>
        <title>HomePage - Recipes</title>
        <link rel="stylesheet" href="{{ url('css/startingpage.css') }}">
        <link rel="stylesheet" href="{{ url('css/homepage.css') }}">

        <link href="https://fonts.googleapis.com/css2?family=Inspiration&family=Palette+Mosaic&display=swap" rel="stylesheet">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script src="{{ url('js/homepage.js') }}" defer></script>
        <script> const BASE_URL = "{{url('/')}}/" </script>
    </head>
    <body>
        <nav>
            <div id="logo"> Recipes </div>
        </nav>
        
        <div id="base">
              
            <div class='nav_2'>
                <div class='search_by_ingredient'>
                    <form name='search_by_ingredient'>
                        @csrf
                        <label>Cerca un ingrediente:</label>
                        <input type='text' name='ingredient' class='inputstyle'>
                        <input type='submit' name='submit' value='Cerca' class='inputstyle submit'>
                    </form>
                </div>
                <div class='links'>
                    <a href="{{ url('userpage')}}" class="userpage">Profile</a>
                    <a href="{{ url('logout')}}" class='logout'>Logout</a>
                </div>
            </div>
            <main>
                <section class='by_ingr'>
                    <div class='search_by_ingredient'>
                        <form name='search_by_ingredient_mobile'>
                            @csrf
                            <label>Cerca un ingrediente:</label>
                            <input type='text' name='ingredient' class='inputstyle'>
                            <input type='submit' name='submit' value='Cerca' class='inputstyle submit'>
                        </form>
                    </div>
                </section>


                <section class='info'>
                    <div class='profile_info'>
                        <div class='div_username'>
                            {{ $username }}
                        </div>
                        <div class='profile_img'>
                            <img src='./images/profile_default.jpg'>
                        </div>
                        <div id='statistics'>
                            <div class='like'>
                                <h4>Like:</h4>
                                <h4 class='number'></h4>
                            </div>
                            <div class='fav'>
                                <h4>Preferiti:</h4>
                                <h4 class='number'></h4>
                            </div>
                            <div class='comment'>
                                <h4>Commenti:</h4>
                                <h4 class='number'></h4>
                            </div>
                        </div>
                    </div>
                    <img src='./images/up_arrow.png' id='go_up'>
                    
                </section>

                <section class='post_section'>

                </section>

                <section class='comment'>
                    <div class='div_comments comments_disabled'>
                        <div id='published_comments' data-post_id='null'>
                                                        
                        </div>
                        <div class='write_comment'> 
                            <form name='publish_comment' method='post'>
                                @csrf
                                <div class='div_username'>
                                    {{ $username }}
                                </div>
                                <label>Commenta:</label>
                                <textarea name="textarea" disabled></textarea>
                                <input type='submit' name='submit' value='Pubblica' disabled>
                            </form>
                        </div>
                    </div>
                </section>

                
            </main>
            <footer>
                Unict - Marco Castiglia - 1000003997
            </footer>

        </div>
    </body>
</html>