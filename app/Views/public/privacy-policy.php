<?php $this->extend('public/templates/layout'); ?>

<!-- CSS -->
<?php $this->section('css'); ?>
<link rel="stylesheet" href="assets/public/css/privacy-policy.min.css" type="text/css">
<?php $this->endSection(); ?>


<?php $this->section('content'); ?>
<?php $errors = session()->get('errors'); ?>

<main class="privacy-policy">
    <div class="wrapper--medium privacy-policy__wrapper">
        <h1 class="title--level-4 privacy-policy__heading">Aviso de Privacidad</h1>

        <p class="privacy-policy__text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras vulputate scelerisque mi in eleifend. Proin sit amet ligula a nulla hendrerit congue. Fusce egestas congue ex, non sollicitudin nibh egestas eget. Vivamus nunc purus, consequat in massa sit amet, luctus aliquam risus. Vivamus eros odio, faucibus eu pulvinar sagittis, vulputate id velit. Mauris bibendum dui eu porta feugiat. Duis et egestas ex. Integer malesuada et tortor at convallis. Vestibulum lacinia a mi et venenatis. Morbi ac dui a ante venenatis egestas.</p>
        <p class="privacy-policy__text">Fusce non massa lobortis, faucibus augue in, mattis ante. Pellentesque mollis est ac tempus pharetra. Quisque nisi ante, hendrerit at leo in, feugiat molestie felis. Cras congue a turpis a cursus. Nunc pharetra elit turpis. Nulla eget ex vulputate, porttitor quam vel, ornare sem. Morbi ipsum dui, tempus et augue nec, viverra vulputate justo. Praesent vitae nibh gravida, ultrices dolor quis, mollis odio.</p>
        <p class="privacy-policy__text">Proin pretium et nibh vitae efficitur. Fusce arcu mi, iaculis sit amet convallis in, pulvinar eget purus. Cras rhoncus lacinia erat sit amet consectetur. Sed libero turpis, aliquet in ultrices ac, convallis ac massa. Donec consequat quam et odio vestibulum ultricies. Duis dapibus pretium est, at lacinia purus pharetra at. Aenean lacinia erat at egestas eleifend. Nulla et purus id sem porta ultrices eu at orci.</p>
        <p class="privacy-policy__text">Aliquam at suscipit diam. Fusce nec elementum purus. Integer et justo placerat, lacinia lorem vel, feugiat diam. Donec rhoncus neque quis mauris eleifend tincidunt sed et turpis. Ut neque urna, pulvinar et cursus id, eleifend at nunc. Aliquam eget commodo purus. Vestibulum a imperdiet orci. Morbi pellentesque ex sollicitudin posuere malesuada.</p>
        <p class="privacy-policy__text">Mauris sagittis sit amet magna eget posuere. Suspendisse in felis interdum tortor luctus mollis. Nulla cursus placerat accumsan. Maecenas non feugiat sem, non pellentesque nulla. Duis vitae finibus velit. Etiam elementum diam sed sollicitudin venenatis. Praesent in quam et massa fermentum bibendum vitae et leo.</p>
    </div>
</main>
<?php $this->endSection('content'); ?>