<?php
$GRID_PATTERN = importComponent('grid-pattern.php');
$NAVBAR = importComponent('navbar.php');
$TOP_GRADIENT = importComponent('top-gradient-background.php');
$HERO_SECTION = importComponent('hero-section.php');
$MARQUEE = importComponent('marquee.php');
$WHY_AFMAX = importComponent('why-choose-afmax.php');
$HOW_IT_WORKS = importComponent('how-it-works.php');
$BOTTOM_GRADIENT = importComponent('bottom-gradient-background.php');
?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AFMAX</title>
    <link rel="stylesheet" href="css/tailwind.css">
</head>

<body>
    <?= $GRID_PATTERN ?>
    <?= $TOP_GRADIENT ?>

    <?= $NAVBAR ?>

    <main class="relative isolate px-6 pt-14 lg:px-8">
        <?= $HERO_SECTION ?>
        <?= $MARQUEE ?>
        <?= $WHY_AFMAX ?>
        <?= $HOW_IT_WORKS ?>
    </main>

    <?= $BOTTOM_GRADIENT ?>
</body>

</html>