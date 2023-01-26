<?php

$codesCaptchas = [
    175940 => "f71d3",
    528358 => "ba8d7",
    403375 => "951d2",
    102955 => "679a6",
    227336 => "0d7e1",
    297287 => "512b8",
    280405 => "f625b",
    215904 => "6d1a7",
    532323 => "f0273",
    469102 => "0d26c",
    526112 => "0c2c0",
    122627 => "a91e5",
    726208 => "328ce",
    643286 => "7d430",
    359850 => "5cb9f",
    655994 => "24d49",
    574618 => "604a5",
    569152 => "7111d",
    301059 => "787f0",
    626640 => "c4df2",
    118828 => "a8c43",
    231983 => "9d56c",
    191150 => "8b6c5",
    102787 => "8977b",
    575731 => "4b337",
    335208 => "919cb",
    313483 => "c3d1f",
    644873 => "c32c5",
    236806 => "5c461",
    354908 => "8d8f8",
    240376 => "da898",
    464686 => "7256b",
    206891 => "26c0d",
    461905 => "7ef47",
    296908 => "d4c49",
    637154 => "1d90a",
    127340 => "4af2f",
    282446 => "1b439",
    155067 => "cdc3c",
    303504 => "5772f",
    324346 => "3acf2",
    498749 => "4fa94",
    471265 => "77a04",
    433431 => "e33af",
    239912 => "bbca4",
    285580 => "45843",
    744571 => "a22e2",
    324303 => "924cb",
    215853 => "a25c2",
    143907 => "87529",
    108376 => "efe96",
    681968 => "5ac5b",
    640343 => "1e1fc",
    209231 => "c71a1",
    246688 => "57df1",
    187926 => "1b8ba",
    731192 => "3ddca",
    475930 => "6ee76",
    699210 => "95225",
    193428 => "97bbb",
    185616 => "e200f",
    133167 => "b230f",
    763105 => "75af9",
    421544 => "50371",
    217600 => "2f516",
    302063 => "77c57",
    135102 => "4f655",
    502583 => "0250a",
    568166 => "15b96",
    387409 => "bfb00",
    645948 => "bf302",
    170116 => "fcac3",
    442703 => "e706d",
    726874 => "a98f7",
    626379 => "5685e",
    734964 => "77ca6",
    421178 => "560b4",
    364261 => "d4e78",
    242332 => "31dbd",
    252949 => "46c7b",
    775607 => "dde5a",
    209695 => "49452",
    232434 => "ec1cb",
    764331 => "81ab7",
    742871 => "a139e",
    791308 => "8c71f",
    627025 => "c3880",
    732370 => "7f523",
    675533 => "75560",
    266083 => "93361",
    147209 => "405fb",
    649883 => "e4cb1",
    116794 => "c809d",
    621469 => "bf106",
    732085 => "3851e",
    591213 => "d6439",
    151666 => "148e4",
    311002 => "0e298",
    264156 => "be8de",
    230936 => "84ed7"
];

/* start session */
session_start();

if (isset($_SESSION["codeCaptcha"])) {
   
    if (isset($_POST["captcha"]) && !empty($_POST["captcha"])) {
      
        if ($_POST["captcha"] == $codesCaptchas[$_SESSION["codeCaptcha"]]) {
            /**
             * 
             * YOUR LOGIC FOR OTHER ELEMENT OF FORM
             * 
            */
            session_destroy();
        } else {
            generateCaptcha();
        }
    } else {
        generateCaptcha();
    }
} else {
    generateCaptcha();
}

function generateCaptcha(): void
{
    /* Get All files names in captcha folder and organize in descending*/
    $captchaNames = scandir('captcha', SCANDIR_SORT_DESCENDING);

    /* Saved adress in array contain the key, to remove after */
    $keyRemove1 = array_search('.', $captchaNames);
    $keyRemove2 = array_search('..', $captchaNames);

    /* Remove from array */
    unset($captchaNames[$keyRemove1]);
    unset($captchaNames[$keyRemove2]);

    /* Generete a number random */
    $keyRandom = rand(0, count($captchaNames) - 1);
    
    /* Get name from captchaNames with use keyRandom, then remove .jpg into string name */
    $_SESSION["codeCaptcha"] =  trim($captchaNames[$keyRandom], '.jpg');
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contatct us</title>
</head>

<body>
    <form action="/contact.php" method="POST">
        <label for="fname">First name:</label>
        <input type="text" id="fname" name="fname"><br><br>
        <img src="<?PHP ECHO "/captcha/" . $_SESSION["codeCaptcha"] . ".jpg"; ?>" alt="captcha"> <!--Include in your form-->
        <input type="text" name="captcha"> <!--Include in your form, dont remove name="captcha"-->
        <input type="submit" value="Enviar"> 
    </form>
</body>

</html>