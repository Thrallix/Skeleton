<!doctype html>
<html lang="en">
    <head>

        <title>Hello, world!</title>

        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <?=Loader::getResources('head', 'css');?>

        <?=Loader::getResources('head', 'js');?>

    </head>
    <body module="<?=module?>" action="<?=action?>" url="<?=home?>">
        <div class="page-content">