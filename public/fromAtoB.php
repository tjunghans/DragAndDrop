<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>Example 1: From A to B</title>

        <link href="stylesheets/fromAtoB.css" rel="stylesheet" type="text/css" />
        
    </head>
    <body>
        <div class="page">
            <div class="col col-source">
                <h2>Quelle</h2>
                <ul class="ul-items">
                    <li><a class="a-draggable" href="#" draggable="true">Milch</a></li>
                    <li><a class="a-draggable" href="#" draggable="true">Brot</a></li>
                    <li><a class="a-draggable" href="#" draggable="true">Eier</a></li>
                    <li><a class="a-draggable" href="#" draggable="true">O-Saft</a></li>
                    <li><a class="a-draggable" href="#" draggable="true">Marmelade</a></li>
                    <li><a class="a-draggable" href="#" draggable="true">Fleisch</a></li>
                    <li><a class="a-draggable" href="#" draggable="true">Käse</a></li>
                </ul>
            </div>
            <div class="col col-target">
                <h2>Ziel</h2>
                <ul class="ul-items">
                    <li class="li-dragover"><a class="a-draggable" href="#" draggable="true">Milch</a></li>
                    <li><a class="a-draggable" href="#" draggable="true" data-value="bread">Brot</a></li>
                    <li><a class="a-draggable" href="#" draggable="true" data-value="eggs">Eier</a></li>
                    <li><a class="a-draggable" href="#" draggable="true" data-value="orange juice">O-Saft</a></li>
                    <li><a class="a-draggable" href="#" draggable="true" data-value="jam">Marmelade</a></li>
                    <li><a class="a-draggable" href="#" draggable="true" data-value="meat">Fleisch</a></li>
                    <li><a class="a-draggable" href="#" draggable="true" data-value="cheese">Käse</a></li>
                </ul>
            </div>
        </div>
        <script src="javascripts/modernizr.custom.68656.js" type="text/javascript"></script>
        <script type="text/javascript" src="javascripts/EventUtil.js"></script>
        <script type="text/javascript" src="javascripts/SelectorUtil.js"></script>
        <script type="text/javascript">
            var format = 'Text';
            var effect = 'copy';
            var draggable_items = SelectorUtil.getElementsByClass('a-draggable', null,'a');

            for (var i = 0, len = draggable_items.length; i < len; i++) {
                EventUtil.addHandler(draggable_items[i], 'dragstart', function (e) {
                    var currentTarget = EventUtil.getCurrentTarget(e),
                        data = currentTarget.getAttribute('data-value');

                    e.dataTransfer.setData(format, data);
                    e.dataTransfer.effectAllowed = effect;

                    SelectorUtil.addClass(currentTarget, 'dragging');

                    return true;
                });

                EventUtil.addHandler(draggable_items[i], 'dragend', function (e) {
                    var currentTarget = EventUtil.getCurrentTarget(e);
                    SelectorUtil.removeClass(currentTarget, 'dragging');
                    return true;
                });
            }



        </script>
    </body>
</html>
