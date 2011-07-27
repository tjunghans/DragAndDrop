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
                <h2 tabindex="0" id="Produkte">Produkte</h2>
                <ul class="ul-items" id="SourceList" role="list">
                    <li><a role="listitem" class="a-draggable" href="#" data-value="milk">Milch</a></li>
                    <li><a role="listitem" class="a-draggable" href="#" data-value="bread">Brot</a></li>
                    <li><a role="listitem" class="a-draggable" href="#" data-value="eggs">Eier</a></li>
                    <li><a role="listitem" class="a-draggable" href="#" data-value="orange juice">O-Saft</a></li>
                    <li><a role="listitem" class="a-draggable" href="#" data-value="jam">Marmelade</a></li>
                    <li><a role="listitem" class="a-draggable" href="#" data-value="meat">Fleisch</a></li>
                    <li><a role="listitem" class="a-draggable" href="#" data-value="cheese">Käse</a></li>
                
                </ul>
            </div>
            <div class="col col-target" id="Target">
                <h2>Einkaufsliste</h2>
                <ul class="ul-items" id="TargetList" role="list" aria-dropeffect="move">
                  
          
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
            
            var effect = 'move';
            var draggable_items = SelectorUtil.getElementsByClass('a-draggable', null, 'a');
            var target_container = document.getElementById('Target');
            var target_list = document.getElementById('TargetList');
            var current_draggable_item_id = 'CurrentDraggable';
            var placeholder_id = 'ItemPlaceholder';
            var current_item = 0;

            EventUtil.addHandler(draggable_items[0], 'keydown', function (e) {
                EventUtil.preventDefault(e);
                current_item += 1;

                // keyCode 9 steht für Tab
                if (e.keyCode === 9) {
                    if (current_item === draggable_items.length) {
                        draggable_items[0].focus();
                        current_item = 0;
                    } else {
                        draggable_items[current_item].focus();
                    }
                   
                    return false;
                }
            });

            // Draggable Items vorbereiten
            for (var i = 0, len = draggable_items.length; i < len; i++) {

                // Mit Tab navigierbar machen
                if (i === 0) {
                    draggable_items[i].tabIndex = 0;
                } else {
                    draggable_items[i].tabIndex = -1;
                }



                
                draggable_items[i].setAttribute('draggable', 'true');
                draggable_items[i].setAttribute('aria-grabbed', 'false');

                // Eventhandler "dragstart" setzen
                EventUtil.addHandler(draggable_items[i], 'dragstart', function (e) {
                    var currentTarget = EventUtil.getCurrentTarget(e),
                        data = currentTarget.getAttribute('data-value');

                    e.dataTransfer.setData(format, data);
                    e.dataTransfer.effectAllowed = effect;

                    // Definiere temporäre ID zur späteren Identifikation
                    currentTarget.setAttribute('id', current_draggable_item_id);

                    SelectorUtil.addClass(currentTarget, 'dragging');
                    currentTarget.setAttribute('aria-grabbed', 'true');

                    var list_item = document.createElement('li');
                    list_item.setAttribute('id', placeholder_id);

                    target_list.appendChild(list_item);

                    return true;
                });

                // Eventhandler "dragend" setzen
                EventUtil.addHandler(draggable_items[i], 'dragend', function (e) {
                    var currentTarget = EventUtil.getCurrentTarget(e);
                    
                    SelectorUtil.removeClass(currentTarget, 'dragging');
                    currentTarget.setAttribute('aria-grabbed', 'false');

                    // Temporäre ID entfernen
                    currentTarget.removeAttribute('id');

                    var place_holder = document.getElementById(placeholder_id);
                    if (place_holder) {
                        place_holder.parentNode.removeChild(place_holder);
                    }


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

                SelectorUtil.removeClass(currentTarget, 'draggable-entered');

                // Platzhalter Referenz
                var place_holder = document.getElementById(placeholder_id);
                var draggable_item_container = draggable_item.parentNode;

                // Link hinzufügen
                place_holder.appendChild(draggable_item);

                // Platzhalter ID entfernen
                place_holder.removeAttribute('id');

                draggable_item_container.parentNode.removeChild(draggable_item_container);


                return false;
            });

        }());

        </script>
    </body>
</html>
