<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Correo</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Rubik:wght@400;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Rubik', sans-serif;
            max-width: 120rem;
            margin: 0 auto;
            width: 95%;
        }

        .header__heading{
            margin: 0;
            color: #21618C;
            font-family: Georgia, "Times New Roman", Times, serif;
            font-size: 70px;
        }

        .header__heading span{
            color: #5F6A6A;
        }

        .mail{
            width: 250px;
            margin-top: 10px;
            padding: 20px;
            border: #5F6A6A solid 1px;
        }

        @media (min-width: 480px) {
            .mail{
                width: 500px;
            }
        }

        .mail__description svg, .mail_user svg{
            font-size: 40px;
            fill: #1A5276;
        }

        .mail__description svg{
            margin-top: -5px;
        }

        @media (min-width: 480px) {
            .mail__description svg, .mail_user svg{
                font-size: 30px;
            }

            .mail__description svg{
                margin-top: 0;
            }
        }

        .mail__description, .mail_user{
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .mail__text span{
            font-weight: bold;
        }

    </style>
</head>
<body>


    <section class="mail">
        <h1 class="header__heading">K<span>inub</span></h1>
        <div class="mail__description">
            <p class="mail__description-info">Se ha generado el siguiente mensaje</p>
            <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M48 64C21.5 64 0 85.5 0 112c0 15.1 7.1 29.3 19.2 38.4L236.8 313.6c11.4 8.5 27 8.5 38.4 0L492.8 150.4c12.1-9.1 19.2-23.3 19.2-38.4c0-26.5-21.5-48-48-48H48zM0 176V384c0 35.3 28.7 64 64 64H448c35.3 0 64-28.7 64-64V176L294.4 339.2c-22.8 17.1-54 17.1-76.8 0L0 176z"/></svg>
        </div>
        <div class="mail__content">
            <?php foreach($formData as $data){ ?>
                <p class="mail__text"><span><?php echo $data['label']?>:</span> <?php echo $data['output']?></p>
            <?php }?>
            <hr>
            <div class="mail_user">
                <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M399 384.2C376.9 345.8 335.4 320 288 320H224c-47.4 0-88.9 25.8-111 64.2c35.2 39.2 86.2 63.8 143 63.8s107.8-24.7 143-63.8zM0 256a256 256 0 1 1 512 0A256 256 0 1 1 0 256zm256 16a72 72 0 1 0 0-144 72 72 0 1 0 0 144z"/></svg>
                <p class="mail__text"><span><?php echo $senderName['label']?>:</span> <?php echo $senderName['output']?></p>
            </div>
        </div>
    </section>
</body>
</html>