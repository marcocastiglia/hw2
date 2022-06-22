<html>
    <head>
        <title>HomePage - Recipes</title>
        <link rel="stylesheet" href="<?php echo e(url('css/startingpage.css')); ?>">
        <link rel="stylesheet" href="<?php echo e(url('css/homepage.css')); ?>">

        <link href="https://fonts.googleapis.com/css2?family=Inspiration&family=Palette+Mosaic&display=swap" rel="stylesheet">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script src="<?php echo e(url('js/homepage.js')); ?>" defer></script>
        <script> const BASE_URL = "<?php echo e(url('/')); ?>/" </script>
    </head>
    <body>
        <nav>
            <div id="logo"> Recipes </div>
        </nav>
        
        <div id="base">
              
            <div class='nav_2'>
                <div class='search_by_ingredient'>
                    <form name='search_by_ingredient'>
                        <?php echo csrf_field(); ?>
                        <label>Cerca un ingrediente:</label>
                        <input type='text' name='ingredient' class='inputstyle'>
                        <input type='submit' name='submit' value='Cerca' class='inputstyle submit'>
                    </form>
                </div>
                <div class='links'>
                    <a href="<?php echo e(url('userpage')); ?>" class="userpage">Profile</a>
                    <a href="<?php echo e(url('logout')); ?>" class='logout'>Logout</a>
                </div>
            </div>
            <main>
                <section class='by_ingr'>
                    <div class='search_by_ingredient'>
                        <form name='search_by_ingredient_mobile'>
                            <?php echo csrf_field(); ?>
                            <label>Cerca un ingrediente:</label>
                            <input type='text' name='ingredient' class='inputstyle'>
                            <input type='submit' name='submit' value='Cerca' class='inputstyle submit'>
                        </form>
                    </div>
                </section>


                <section class='info'>
                    <div class='profile_info'>
                        <div class='div_username'>
                            <?php echo e($username); ?>

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

                    <!-- Struttura

                    <h2 class='error'></h2>
                    <a href="homepage" id='backHome'></a>
                     -->

                    <!-- Struttura POST 

                    <div class='post_div' data-post_id=''>
                        <div class='div_username'></div>
                        <span class='rec_title'></span>
                        <div class='ingr_list'>
                            <div>/div><div></div>
                        </div>
                        <p class='descr'></p>
                        <img src=''>
                        <div class='nlike_ncomment'>
                            <div class='nlikes'>
                                <img src='./images/dislike.png' class='like_dislike' data-like_post='false'>
                                <span></span>
                            </div>
                            <div class='favorite'>
                                <img src='./images/not_favorite.png' class='fav_notfav' data-fav_post='false'>
                            </div>
                            <div class='ncomments'>
                                <img src='./images/disable_comment.png' class='enable_read_comments' data-enable_comm='false'>
                                <span></span>
                            </div>
                        </div>
                    
                        <section class='comment_of_post' data-post_id=''></section>
                    </div>
                    -->
                </section>

                <section class='comment'>
                    <div class='div_comments comments_disabled'>
                        <div id='published_comments' data-post_id='null'>
                            <!-- Struttura commento

                            <div class='single_comment' data-comm_id=''>
                                <div class='head'>
                                    <div class='div_username'></div>
                                    <img src='./images/delete_comment.png' class='delete'>
                                </div> 
                                <p class='descr'></p>
                            </div> -->                            
                        </div>
                        <div class='write_comment'> 
                            <form name='publish_comment' method='post'>
                                <?php echo csrf_field(); ?>
                                <div class='div_username'>
                                    <?php echo e($username); ?>

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
</html><?php /**PATH C:\Users\marcu\Desktop\HW1_Laravel\resources\views/homepage.blade.php ENDPATH**/ ?>