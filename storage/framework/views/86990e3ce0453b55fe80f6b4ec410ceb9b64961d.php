<html>
    <head>
        <title>Recipes - Modify_Account</title>
        <link rel="stylesheet" href="<?php echo e(url('css/startingpage.css')); ?>">
        <link rel="stylesheet" href="<?php echo e(url('css/login.css')); ?>">
        <link href="https://fonts.googleapis.com/css2?family=Inspiration&family=Palette+Mosaic&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Roboto+Mono:wght@200&display=swap" rel="stylesheet">

        <script src="<?php echo e(url('js/modify_account.js')); ?>" defer></script>
        <script> const BASE_URL = "<?php echo e(url('/')); ?>/" </script>

        <meta name="viewport" content="width=device-width, initial-scale=1">
    </head>
    <body>
        <nav>
            <div id="logo"> Recipes </div>
        </nav>
        <header> 
            <a href="<?php echo e(url('userpage')); ?>" id='go_back'><img src='./images/left_arrow.png'></a>      
            <section id='center' class='signup'>

            <h1>Modifica il tuo account!</h1>

            <p class='errore'>
                <?php if(strlen($error) > 0): ?>
                    <?php echo e($error); ?>

                <?php endif; ?>
            </p>          
            
            <form name='signup_form' method='post' class='signup' id='mod_form'>
                <?php echo csrf_field(); ?>
                <div class='div_name'>
                    <label>Nome:</label>
                    <input type="text" name="name" value='<?php echo e($user->name); ?>' class="input_field">
                </div>
                <div class='div_surname'>
                    <label>Cognome:</label>
                    <input type="text" name="surname" value="<?php echo e($user->surname); ?>" class="input_field">
                </div>
                <div class='div_email'>                    
                    <label>Email:</label>
                    <input type="text" name="email" value="<?php echo e($user->email); ?>" class="input_field">
                </div>
                <div class='div_username'>                   
                    <label>Username:</label>                                        
                    <input type="text" name="username" value="<?php echo e($user->username); ?>" class="input_field">
                </div>
                <div class='div_password'>
                    <label>Password:</label>
                    <input type="password" name="password" value="<?php echo e(old('password')); ?>" class="input_field">
                </div>
                <div class='access_div'>
                    <input type='submit' value="Conferma modifiche" class="access">
                </div>
            </form>
            </section>

        </header>
        
    </body>
</html><?php /**PATH C:\Users\marcu\Desktop\HW1_Laravel\resources\views/modify_account.blade.php ENDPATH**/ ?>