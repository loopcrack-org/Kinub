<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prueba filtros</title>
    <link rel="stylesheet" href="/assets/public/css/testFilter.min.css">
</head>

<body>

    <div class="filter">

        <form class="filter-form" action="post">
            <input class="filter-form__search" id="autoComplete" type="search" dir="ltr" spellcheck=false autocorrect="off" autocomplete="off" autocapitalize="off" maxlength="2048" tabindex="1">

            <div class="filter-form__flex">
                <select id="categories" name="category">
                    <option value="">Selecciona una categoría</option>
                    <?php foreach ($categories as $category):?>
                    <option value="<?= $category['categoryId']?>"><?=$category['categoryName']?></option>
                    <?php endforeach ?>
                </select>
                <select id="tags" name="categoryTagId" multiple>
                    <option value="">Selecciona un tag</option>
                </select>
            </div>

        </form>
    </div>


    <script src="/assets/public/js/filters.min.js"></script>
</body>

</html>