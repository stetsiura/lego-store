<?php

$imageUrl = '/content/banners/';

switch($type) {
    case 'bestsellers':
        $imageUrl .= 'bestsellers.png';
        break;
    case 'shares':
        $imageUrl .= 'shares.png';
        break;
}

?>

<div class="large-banner">
    <img src="<?= $imageUrl ?>" alt="Баннер">
</div>
