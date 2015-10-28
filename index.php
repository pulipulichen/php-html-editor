<?php

// ------------------------------
// Configuration 設定

$LANG = array(
    "save" => "SAVE",
    "apply" => "APPLY",
);

// --------------------------------

// 要更改的檔案名稱
$script_file = basename($_SERVER["SCRIPT_NAME"]);
$title = substr($script_file, 0, strrpos($script_file, "."));
$file = $script_file . ".html";
$return = $script_file;

$html = "";

if (isset($_POST["html"])) {
    file_put_contents($file, $_POST["html"]);
}

$type = "read";
if (isset($_GET["type"])) {
    $type = $_GET["type"];
}

if (is_file($file) === FALSE || $type !== "read") {

    if (is_file($file)) {
        $html = file_get_contents($file);
    }

    ?>
<html>
    <head>
        <title><?php echo $title ?></title>
    </head>
    <body>
<form action="<?php echo $script_file; ?>" method="post" id="form">
    
<button type="submit" style="width: 49%;font-size:large;margin-bottom: 0.5rem;"><?php echo $LANG["save"] ?></button>
<button type="submit" style="width: 49%;font-size:large;margin-bottom: 0.5rem;" onclick="document.getElementById('form').action='?type=apply';">
        <?php echo $LANG["apply"] ?>
</button>

<input type="hidden" name="submit" value="submit" id="submit" />
<textarea name="html" style="width: 100%;height:90%"><?php echo $html; ?></textarea>
</form>
    </body>
</html>
    <?php

}
else {
    echo file_get_contents($file);
}


