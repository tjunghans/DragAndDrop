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
            <div class="col col-source" id="Source">
                <h2>Quelle</h2>
                <ul class="ul-items" id="SourceList">
                    <li><a class="a-draggable" href="#" draggable="true" data-value="milk">Milch</a></li>
                    <li><a class="a-draggable" href="#" draggable="true" data-value="bread">Brot</a></li>
                    <li><a class="a-draggable" href="#" draggable="true" data-value="eggs">Eier</a></li>
                    <li><a class="a-draggable" href="#" draggable="true" data-value="orange juice">O-Saft</a></li>
                    <li><a class="a-draggable" href="#" draggable="true" data-value="jam">Marmelade</a></li>
                    <li><a class="a-draggable" href="#" draggable="true" data-value="meat">Fleisch</a></li>
                    <li><a class="a-draggable" href="#" draggable="true" data-value="cheese ">Käse</a></li>
                </ul>
            </div>
            <div class="col col-target" id="Target">
                <h2>Ziel</h2>
                <ul class="ul-items" id="TargetList">
                  
          
                </ul>
            </div>
        </div>
        <script src="javascripts/modernizr.custom.68656.js" type="text/javascript"></script>
        <script type="text/javascript" src="javascripts/EventUtil.js"></script>
        <script type="text/javascript" src="javascripts/SelectorUtil.js"></script>
        <script type="text/javascript">
        (function () {
            // The name of the data field has to be either "Text" or "Url"
            var format = 'Text';
            
            var effect = 'copy';
            var draggable_items = SelectorUtil.getElementsByClass('a-draggable', null,'a');
            var target_container = document.getElementById('Target');
            var target_list = document.getElementById('TargetList');
            var current_draggable_item_id = 'CurrentDraggable';

            // Draggable Items
            for (var i = 0, len = draggable_items.length; i < len; i++) {
                EventUtil.addHandler(draggable_items[i], 'dragstart', function (e) {
                    var currentTarget = EventUtil.getCurrentTarget(e),
                        data = currentTarget.getAttribute('data-value');

                    e.dataTransfer.setData(format, data);
                    e.dataTransfer.effectAllowed = effect;

                    // Definiere temporäre ID zur späteren Identifikation
                    currentTarget.setAttribute('id', current_draggable_item_id);

                    SelectorUtil.addClass(currentTarget, 'dragging');

                    return true;
                });

                EventUtil.addHandler(draggable_items[i], 'dragend', function (e) {
                    var currentTarget = EventUtil.getCurrentTarget(e);
                    
                    SelectorUtil.removeClass(currentTarget, 'dragging');

                    // Temporäre ID entfernen
                    currentTarget.setAttribute('id', null);
                    return true;
                });
            }

            // Target
            EventUtil.addHandler(target_container, 'dragenter', function (e) {
                var currentTarget = EventUtil.getCurrentTarget(e);

                // Chrome and Safari do not recognize data (=undefined)
                var data = e.dataTransfer.getData(format);

                SelectorUtil.addClass(currentTarget, 'draggable-entered');

                return false;
            });

            EventUtil.addHandler(target_container, 'dragleave', function (e) {
                var currentTarget = EventUtil.getCurrentTarget(e);

                SelectorUtil.removeClass(currentTarget, 'draggable-entered');

                return false;
            });

            EventUtil.addHandler(target_container, 'dragover', function (e) {
                EventUtil.preventDefault(e);

                var currentTarget = EventUtil.getCurrentTarget(e);

                SelectorUtil.addClass(currentTarget, 'draggingover');
                
                e.dataTransfer.dropEffect = effect; // set as described on http://help.dottoro.com/ljffjemc.php

                return false;
            });

            EventUtil.addHandler(target_container, 'drop', function (e) {

                EventUtil.preventDefault(e);

                var mouse_position = EventUtil.getMousePosition(e);

                var currentTarget = EventUtil.getCurrentTarget(e);
                
                var data = e.dataTransfer.getData(format);

                var draggable_item = document.getElementById(current_draggable_item_id);

                /*item.style.position = 'absolute';
                item.style.left = (mouse_position.x - target1.offsetLeft) + 'px';
                item.style.top = (mouse_position.y - target1.offsetTop) + 'px';*/

                console.log('x', draggable_item);

                //currentTarget.appendChild(item);
                var list_item = document.createElement('li');
                list_item.appendChild(draggable_item);
                target_list.appendChild(list_item);

                return false;
            });



        }());

        </script>
    </body>
</html>
