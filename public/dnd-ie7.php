<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>IE7 Drag and Drop</title>



        <link href="stylesheets/site.css" rel="stylesheet" type="text/css" />

        <style type="text/css">
            .item {
                cursor: pointer;
                position: relative;
            }

            *[draggable=true] {
              cursor: move;
            }

        </style>
        <script src="javascripts/modernizr.custom.68656.js" type="text/javascript"></script>
        <script type="text/javascript" src="javascripts/EventUtil.js"></script>
        <script type="text/javascript" src="javascripts/SimpleLogger.js"></script>
    </head>
    <body>
    http://www.useragentman.com/tests/dragAndDrop/02-dragObjectWithEvents.html
        <div draggable="false" id="source1">
            <a draggable="true" href="#" data-value="bar" id="dragme1" class="item"></a>
        </div>
        <hr/>
        <div dropzone="move s:text/html" id="target1">foo</div>

        <script type="text/javascript">
            var sl = new SimpleLogger();
            sl.init();

            if (Modernizr.draganddrop) {
              // Support Drag and drop

            } else {
            
              // Fallback to a library solution.
            }
            
            // Ziel1

            var target1 = document.getElementById('target1');
            var effect = 'copy';
            var format = 'Text';

            EventUtil.addHandler(target1, 'drop', function (e) {

                if (e.stopPropagation) {
                    e.stopPropagation();
                }

                var currentTarget = EventUtil.getCurrentTarget(e);
                currentTarget.innerHTML = e.dataTransfer.getData(format);

                return false;
            });

            EventUtil.addHandler(target1, 'dragover', function (e) {

                if (e.preventDefault) {
                    e.preventDefault();
                }

                this.className = 'draggingover';
                e.dataTransfer.dropEffect = effect;

                return false;
            });

            EventUtil.addHandler(target1, 'dragleave', function (e) {
                this.className = '';
            });

            EventUtil.addHandler(target1, 'dragenter', function (e) {
                
                e.dataTransfer.dropEffect = effect; // set as described on http://help.dottoro.com/ljffjemc.php
                var data = e.dataTransfer.getData(format);

                return false;

            });


            var d1 = document.getElementById('dragme1');

            EventUtil.addHandler(d1, 'dragstart', function (e) {
                var currentTarget = EventUtil.getCurrentTarget(e);


                var data = currentTarget.getAttribute('data-value');

                e.dataTransfer.setData(format, data);
                e.dataTransfer.effectAllowed = effect;

                return true;
            });

        </script>
    </body>
</html>
