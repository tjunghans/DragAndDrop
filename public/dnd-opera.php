<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>This is an example for the &lt;base&gt; element</title>
   


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
    </head>
    <body>
        <div draggable="false" id="source1">
            <div draggable="true" data-value="bar" id="dragme1" class="item"></div>
        </div>
        <hr/>
        <div dropzone="move s:text/html" id="target1">foo</div>

        <script type="text/javascript">
            if (Modernizr.draganddrop) {
              // Support Drag and drop
            } else {
                console.log('no native drag and drop support');
              // Fallback to a library solution.
            }



            // Ziel1

            var target1 = document.getElementById('target1');
            var effect = 'copy';
            var format = 'text/html';

            EventUtil.addHandler(target1, 'drop', function (e) {

                if (e.stopPropagation) {
                    e.stopPropagation();
                }

                var data = e.dataTransfer.getData(format);

                this.innerHTML = data;
                
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
                var data = e.target.getAttribute('data-value');
                console.log(data);
                e.dataTransfer.setData(format, data);
                e.dataTransfer.effectAllowed = effect;

                return true;
            });

        </script>
    </body>
</html>
