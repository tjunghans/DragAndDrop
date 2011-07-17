<!DOCTYPE html>
<html>
    <head>
        <title>This is an example for the &lt;base&gt; element</title>

        <link href="stylesheets/site.css" rel="stylesheet" type="text/css" />

        <style type="text/css">
            .item {
                cursor: pointer;
                position: relative;
            }

            *[draggable=true] {
              -moz-user-select:none;
              -khtml-user-drag: element;
              -webkit-user-drag: element;
              -khtml-user-select: none;
              -webkit-user-select: none;
              cursor: move;
            }

        </style>
    </head>
    <body>
        <div class="source" draggable="false" id="source1">
            <div draggable="true" id="dragme1" class="item"></div>
            <div draggable="true" id="dragme2" class="item"></div>
        </div>
        <hr/>
        <div class="target" draggable="false" id="target1"></div>
        <script type="text/javascript" src="javascripts/html5-drag-and-drop.js"></script>
        <script type="text/javascript">
      
            var dnd = new DND;
            
            /**
             * sources:
             * http://www.webmonkey.com/2009/09/the_html5_drag_and_drop_api_is_no_panacea_for_developers/
             * http://html5doctor.com/native-drag-and-drop/
             * http://www.useragentman.com/blog/2010/01/10/cross-browser-html5-drag-and-drop/
             * http://html5demos.com/drag
             * http://www.quirksmode.org/blog/archives/2009/09/the_html5_drag.html
             * http://ejohn.org/blog/flexible-javascript-events/
             */

            // Ziel1
            var target1 = document.getElementById('target1');

            /*
                target1.ondragenter = function () {
                    target1.style.backgroundColor = 'blue';
                };
            */

            target1.addEventListener('dragenter', function () {
                alert('target1');
                target1.style.backgroundColor = 'blue';
            }, false);

          
            target1.ondragleave = function () {
                target1.style.borderStyle = '';
                target1.style.borderWidth = '';
                target1.style.borderColor = '';
                target1.style.backgroundColor = '';
            };

            // cancel event for drop
            target1.addEventListener('dragover', function (e) {
                return false;
            }, false);

            // cancel event for drop for ie
            target1.ondragenter = function (e) {
                target1.style.borderStyle = 'dashed';
                target1.style.borderWidth = '2';
                target1.style.borderColor = 'orange';
                return false;
            };

            target1.ondrop = function (e) {

                var item = document.getElementById(e.dataTransfer.getData('itemid'));

                target1.appendChild(item);

                return false;
            };

            var d1 = document.getElementById('dragme1');

            var dragging = false;

            /*
            d1.ondragstart = function (e) {
                e.dataTransfer.setData('itemid', this.id);
                e.dataTransfer.setData('item', d1);
    
                e.dataTransfer.effectAllowed = 'copy';
                dragging = true;
            };*/

            d1.addEventListener('dragstart', function (e) {

                //e.dataTransfer.setData('itemid', this.id);
                e.dataTransfer.setData('item', d1);

                e.dataTransfer.effectAllowed = 'copy';
     
                dragging = true;
            }, false);

            d1.ondragend = function (e) {
                dragging = false;
            };

            d1.ondrop = function (e) {

            };

            var d2 = document.getElementById('dragme2');
            dnd.make_draggable(d2);


            var makeDroppable = function (node, dragenterClass) {

                node.ondragleave = function () {
                    var className = node.getAttribute('class');

                    var pattern = new RegExp(dragenterClass, 'g');

                    node.setAttribute('class', className.replace(pattern, ""));
                    
                };

                node.ondragover = function (e) {
                    return false;
                };

                // cancel event for drop for ie
                node.ondragenter = function (e) {
                    var className = node.getAttribute('class');
                    node.setAttribute('class', className + ' ' + dragenterClass);
                    return false;
                };

                node.ondrop = function (e) {
                    var item = document.getElementById(e.dataTransfer.getData('itemid'));
                    node.appendChild(item);
                    return false;
                };
            };

            makeDroppable(document.getElementById('source1'), 'source-dragenter');

        </script>

        
    </body>
</html>
