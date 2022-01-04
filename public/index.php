<?php

require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../config.php';
use ICanBoogie\DateTime; // https://packagist.org/packages/icanboogie/datetime
use HUD\ExtendedFamily;

$now = new DateTime('now', $my_timezone);

foreach ($all_family as $fam)
{
    $family_display[] = new ExtendedFamily($fam);
}

// var_dump($family_display);

// $family_display[0]->can_call();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Family HUD</title>
    <style>
    .dot {
    height: 25px;
    width: 25px;
    border-radius: 50%;
    display: inline-block;
    }

    .green {
        background-color: #3dff3d;
    }

    .red {
        background-color: #ff3d3d;
    }
    </style>
</head>
<body>
    <?php
        foreach ($family_display as $member)
        { ?>

<div class="family"><span class="dot <?php echo $member->can_call() ? 'green' : 'red' ?> "></span> <span class="family-name"><?php echo $member->name(); ?></span></div>

        <?php }
    ?>
</body>
</html>