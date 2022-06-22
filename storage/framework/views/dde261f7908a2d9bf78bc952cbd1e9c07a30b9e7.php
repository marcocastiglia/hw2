<html>
    <head>
        <title>Recipes - Signup</title>
        <link rel="stylesheet" href="<?php echo e(url('css/startingpage.css')); ?>">
        <link rel="stylesheet" href="<?php echo e(url('css/login.css')); ?>">
        <link href="https://fonts.googleapis.com/css2?family=Inspiration&family=Palette+Mosaic&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Roboto+Mono:wght@200&display=swap" rel="stylesheet">

        <script src="<?php echo e(url('js/login.js')); ?>" defer></script>

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
                <?php if(strlen($error) > 0): ?>
                    <?php echo e($error); ?>

                <?php endif; ?>
            </p>
      
            <form name='signup_form' method='post' class='signup'>
                <?php echo csrf_field(); ?>
                <div class='div_name'>
                    <label>Nome:</label>
                    <input type="text" name="name" value="<?php echo e(old('name')); ?>" class="input_field">
                </div>
                <div class='div_surname'>
                    <label>Cognome:</label>
                    <input type="text" name="surname" value="<?php echo e(old('surname')); ?>" class="input_field">
                </div>
                <div class='div_email'>                    
                    <label>Email:</label>
                    <input type="text" name="email" value="<?php echo e(old('email')); ?>" class="input_field">
                </div>
                <div class='div_username'>                   
                    <label>Username:</label>                                        
                    <input type="text" name="username" value="<?php echo e(old('username')); ?>" class="input_field">
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
</html><?php /**PATH C:\Users\marcu\Desktop\HW1_Laravel\resources\views/signup.blade.php ENDPATH**/ ?>