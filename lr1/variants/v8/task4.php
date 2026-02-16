<?php
$char = 'д';

$char = mb_strtolower($char, 'UTF-8');

switch ($char) {
    case 'а':
    case 'е':
    case 'є':
    case 'и':
    case 'і':
    case 'ї':
    case 'о':
    case 'у':
    case 'ю':
    case 'я':
        $type = "голосна";
        break;
    default:
        $type = "приголосна";
        break;
}

 
echo $type;
?>
