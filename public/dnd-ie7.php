<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>IE7 Drag and Drop</title>

        <link href="stylesheets/site.css" rel="stylesheet" type="text/css" />

        <script src="javascripts/modernizr.custom.68656.js" type="text/javascript"></script>
        <script type="text/javascript" src="javascripts/EventUtil.js"></script>
        <script type="text/javascript" src="javascripts/SimpleLogger.js"></script>
    </head>
    <body>
  
        <div draggable="false" id="source1">
            <a draggable="true" href="#" data-value="dragme1" id="dragme1" class="item"></a>
        </div>
        <hr/>
        <div id="target1">foo</div>

        <script type="text/javascript">
            var sl = new SimpleLogger();
            sl.init();

            if (Modernizr.draganddrop) {
              // Support Drag and drop
            } else {
              // Fallback to a library solution.
            }
                 
            var d1 = document.getElementById('dragme1'),
                target1 = document.getElementById('target1'),
                effect = 'copy',
                format = 'Text';

            EventUtil.addHandler(target1, 'drop', function (e) {

                EventUtil.preventDefault(e);

                var mouse_position = EventUtil.getMousePosition(e);
                
                sl.log('target1: drop' + ' ' + 'x: ' + mouse_position.x + ', y: ' + mouse_position.y);
                        
                var currentTarget = EventUtil.getCurrentTarget(e);
                //currentTarget.innerHTML = e.dataTransfer.getData(format);
                var item = document.getElementById(e.dataTransfer.getData(format));
                item.style.position = 'absolute';
                item.style.left = mouse_position.x + 'px';
                item.style.top = mouse_position.y + 'px';
                currentTarget.appendChild(item);

                return false;
            });

            EventUtil.addHandler(target1, 'dragover', function (e) {
                sl.log('target1: dragover');

                EventUtil.preventDefault(e);

                var currentTarget = EventUtil.getCurrentTarget(e);

                currentTarget.className = 'draggingover';
                e.dataTransfer.dropEffect = effect;

                return false;
            });

            EventUtil.addHandler(target1, 'dragleave', function (e) {
                sl.log('target1: dragleave');

                var currentTarget = EventUtil.getCurrentTarget(e);
                currentTarget.className = '';
            });

            EventUtil.addHandler(target1, 'dragenter', function (e) {
                sl.log('target1: dragenter');

                e.dataTransfer.dropEffect = effect; // set as described on http://help.dottoro.com/ljffjemc.php
                    var data = e.dataTransfer.getData(format);
                return false;
            });

            EventUtil.addHandler(d1, 'dragstart', function (e) {
                sl.log('item1: dragstart');

                var currentTarget = EventUtil.getCurrentTarget(e),
                    data = currentTarget.getAttribute('data-value');

                e.dataTransfer.setData(format, data);
                e.dataTransfer.effectAllowed = effect;

                return true;
            });

            EventUtil.addHandler(d1, 'drag', function (e) {
                sl.log('item1: drag');

                return true;
            });

            EventUtil.addHandler(d1, 'dragend', function (e) {
                sl.log('item1: dragend');

                return true;
            });

        </script>
    </body>
</html>
