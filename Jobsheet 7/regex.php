<?php
$pattern = '/[a-z]/'; 
$text = 'This is a Sample Text.';
if (preg_match($pattern, $text)) {
    echo "Huruf kecil ditemukan!<br><br>";
} else {
    echo "Tidak ada huruf kecil.<br><br>";
}

$pattern = '/[0-9]+/'; 
$text = 'There are 123 apples';
if (preg_match($pattern, $text, $matches)) {
    echo "Cocokkan: " . $matches[0] . "<br><br>";
} else {
    echo "Tidak ada yang cocok!<br><br>";
}

$pattern = '/apple/'; 
$replacement = 'banana';
$text = 'I like apple pie';
$new_text = preg_replace($pattern, $replacement, $text);
echo $new_text . "<br><br>";

$pattern = '/go?d/'; 
$text = 'gd is god and good.';
if (preg_match_all($pattern, $text, $matches)) {
    echo "Cocokkan: " . implode(", ", $matches[0]) . "<br>";
} else {
    echo "Tidak ada yang cocok!<br>";
}

$pattern = '/go{1,2}d/'; 
$text = 'gd is god and good and gooood.';
if (preg_match_all($pattern, $text, $matches)) {
    echo "Cocokkan: " . implode(", ", $matches[0]) . "<br>";
} else {
    echo "Tidak ada yang cocok!<br>";
}
?>