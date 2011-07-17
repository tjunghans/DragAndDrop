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
              -moz-user-select:none;
              -khtml-user-drag: element;
              -webkit-user-drag: element;
              -khtml-user-select: none;
              -webkit-user-select: none;
              cursor: move;
            }

        </style>
        <script type="text/javascript" src="javascripts/EventUtil.js"></script>
    </head>
    <body>
        <div class="source" draggable="false" id="source1">
            <div draggable="true" data-value="draggable-item-1" id="dragme1" class="item"></div>
        </div>
        <hr/>
        <div class="target" dropzone="move s:text/html" id="target1">foo</div>

        <script type="text/javascript">
            

            
            

            // Ziel1

            var target1 = document.getElementById('target1');
            var effect = 'copy';
            var format = 'text/html';

/*
            EventUtil.addHandler(target1, 'dragenter', function () {
                target1.style.backgroundColor = 'blue';
                target1.style.borderStyle = 'dashed';
                target1.style.borderWidth = '2';
                target1.style.borderColor = 'orange';
            });

            EventUtil.addHandler(target1, 'dragover', function (e) {
                 e.preventDefault();
            });
*/
            EventUtil.addHandler(target1, 'drop', function (e) {
                console.log('drop');

                if (e.stopPropagation) {
                    e.stopPropagation();
                }

                var data = e.dataTransfer.getData(format);
                console.log(data);
                
                return false;
            });

            EventUtil.addHandler(target1, 'dragover', function (e) {
                console.log('dragover');

                if (e.preventDefault) {
                    e.preventDefault();
                }

                e.dataTransfer.dropEffect = effect;

                var data = e.dataTransfer.getData(format);
                console.log(data);

                return false;
            });

            EventUtil.addHandler(target1, 'dragenter', function (e) {
                console.log('dragenter');

                e.dataTransfer.dropEffect = effect; // set as described on http://help.dottoro.com/ljffjemc.php
                console.log('dropEffect:', e.dataTransfer.dropEffect); // In Firefox 5 this is set automatically
                console.log(e.dataTransfer.effectAllowed);
                var data = e.dataTransfer.getData(format);
    

                      

                console.log('properties begin');
                for (var x in e.dataTransfer) {

                    console.log(e.dataTransfer[x]);

                }
                console.log('properties end');

                return false;

            });
            

            var d1 = document.getElementById('dragme1');

            EventUtil.addHandler(d1, 'dragstart', function (e) {
                console.log('dragstart'); // should print dragstart
                console.log(d1.draggable); // should print true

                console.log(e.target);

                var data = e.target.getAttribute('data-value');

                e.dataTransfer.setData(format, data);
                e.dataTransfer.effectAllowed = effect;
                e.dataTransfer.setData('foo', 'bar');

                return true;
            });

    


        </script>

        
    </body>
</html>
