<?php
function print_link($url) {
    echo '<a href="' . $url . '">' . $url . '</a> ' . PHP_EOL;
}
?><!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>Start HTML5 Drag And Drop</title>
        <link href="stylesheets/site.css" rel="stylesheet" type="text/css" />
    </head>
    <body>
        <ul>
            <li><a href="dnd-ff5.php">Firefox 5</a></li>
            <li><a href="dnd-chrome.php">Chrome</a></li>
            <li><a href="dnd-safari.php">Safari</a></li>
            <li><a href="dnd-ie8">IE9</a></li>
            <li><a href="dnd-ie8.php">IE8</a></li>
            <li><a href="dnd-ie7.php">IE7</a></li>
        </ul>
        <hr/>
        <h2>Referenzen</h2>
        <ul>
             <li><a class="a-read" href="http://www.webmonkey.com/2009/09/the_html5_drag_and_drop_api_is_no_panacea_for_developers/">webmonkey</a>
             <li><a href="http://html5doctor.com/native-drag-and-drop/">html5doctor</a>
             <li><a href="http://www.useragentman.com/blog/2010/01/10/cross-browser-html5-drag-and-drop/">useragentman</a>
             <li><a href="http://html5demos.com/drag">html5demos</a>
             <li><a href="http://www.quirksmode.org/blog/archives/2009/09/the_html5_drag.html">quirksmode</a>
             <li><a href="http://ejohn.org/blog/flexible-javascript-events/">ejohn (events)</a>
            <li><a href="http://www.whatwg.org/specs/web-apps/current-work/multipage/dnd.html#dnd">Whatwg Living Standard</a></li>
            <li><?php print_link('https://developer.mozilla.org/En/DragDrop/Drag_Operations#Drag_Data');?></li>
         </ul>
            <h3>Difficulties</h3>
        <ul>
            <li><a href="http://www.webmonkey.com/2010/04/google-turns-to-html5-for-gmails-new-drag-and-drop-attachments/">webmonkey gmail</a>
            <li><?php print_link('http://stackoverflow.com/questions/6481094/html5-drag-and-drop-ondragover-not-firing-in-chrome');?></li>
            <li><?php print_link('http://help.dottoro.com/ljrkqflw.php');?></li>
            <li><?php print_link('http://www.html5rocks.com/en/tutorials/casestudies/box_dnd_download.html');?></li>
        </ul>

    </body>
</html>