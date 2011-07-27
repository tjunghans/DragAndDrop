<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>Artikelbeispiel</title>

        <script type="text/javascript" src="javascripts/EventUtil.js"></script>

        <style type="text/css">
            *[draggable=true] {
                -moz-user-select:none;
                -khtml-user-drag: element;
                -webkit-user-drag: element;
                -khtml-user-select: none;
                -webkit-user-select: none;
                cursor: move;
            }

            #Dragme {
                background-color: #90ee90;
                border: solid 2px #006400;
                cursor: pointer;
                display: block;
                height: 70px;
                width: 70px;

            }

            #Dropzone {
                background-color: #add8e6;
                border: solid 2px darkblue;
                height: 200px;
                margin-bottom: 14px;
                padding: 7px;
                width: 300px;
            }
        </style>

        <script type="text/javascript">
            var EventUtil = {
                addHandler : function(element, type, handler){
                    if (element.addEventListener){
                          element.addEventListener(type, handler, false);
                    } else if (element.attachEvent){
                          element.attachEvent("on" + type, handler);
                    } else {
                          element["on" + type] = handler;
                    }
                },
                getCurrentTarget : function (e) {
                    if (e.toElement) {
                        return e.toElement;
                    } else if (e.currentTarget) {
                        return e.currentTarget;
                    } else if (e.srcElement) {
                        return e.srcElement;
                    } else {
                        return null;
                    }
                },
                preventDefault : function (e) {
                    e.preventDefault ? e.preventDefault() : e.returnValue = false;
                }
            };
        </script>

    </head>
    <body>

        <div id="Dropzone">Dropzone</div>
        <a draggable="true" href="#" id="Dragme">Drag Me</a>

        <script type="text/javascript">

            // 1. Ein paar Variablen definieren
            var dm = document.getElementById('Dragme'),
                effect = 'move',
                format = 'Text';

            // 2. Eventhandler DRAGSTART
            EventUtil.addHandler(dm, 'dragstart', function (e) {
                // So können Daten and die Dropzone transferiert werden, in diesem Fall der id-Wert.
                e.dataTransfer.setData(format, 'Dragme');

                // Der erlaubte Effekt muss festgelegt werden
                e.dataTransfer.effectAllowed = effect;

                // Beliebige Funktion steht hier.
                var target = EventUtil.getCurrentTarget(e);
                target.style.backgroundColor = 'blue';

                return true;
            });

            // 3. Eventhandler DRAG
            EventUtil.addHandler(dm, 'drag', function (e) {
                // Beliebige Funktion steht hier. Achtung 'drag' wird wiederholt ausgeführt, was ältere Browser überfordern kann.

                return true;
            });

            // 4. Eventhandler DRAGEND
            EventUtil.addHandler(dm, 'dragend', function (e) {
                // Beliebige Funktion steht hier.
                var target = EventUtil.getCurrentTarget(e);
                target.style.backgroundColor = '';

                return true;
            });

            // 5. Ein paar Variablen definieren
            var dz = document.getElementById('Dropzone');
        
            // 6. Eventhandler DRAGENTER
            EventUtil.addHandler(dz, 'dragenter', function (e) {
                // In Safari und Chrome ist data = undefined.
                // var data = e.dataTransfer.getData(format);

                // Beliebige Funktion steht hier.
                // Die Hintergrundfarbe der Dropzone könnte beispielsweise angepasst werden.
                var target = EventUtil.getCurrentTarget(e);
                target.style.backgroundColor = 'orange';

                return false;
            });

            // 7. Eventhandler DRAGOVER
            EventUtil.addHandler(dz, 'dragover', function (e) {
                // Das Standardverhalten unterbinden.
                EventUtil.preventDefault(e);

                // Der Dropeffekt muss mit dem effectAllowed im dragstart-Eventhandler übereinstimmen.
                e.dataTransfer.dropEffect = effect;

                return false;
            });

            // 8. Eventhandler DRAGLEAVE
            EventUtil.addHandler(dz, 'dragleave', function (e) {
                // Beliebige Funktion steht hier.
                // Die Hintergrundfarbe der Dropzone zurücksetzen.
                var target = EventUtil.getCurrentTarget(e);
                target.style.backgroundColor = '';

                return false;
            });

            // 9. Eventhandler DROP
            EventUtil.addHandler(dz, 'drop', function (e) {
                EventUtil.preventDefault(e);

                // Beliebige Funktion steht hier.
                var currentTarget = EventUtil.getCurrentTarget(e),
                // Die ID aus den dataTransfer-Objekt lesen.
                    DragMeId = e.dataTransfer.getData(format),
                // Den DragMe Node refenzieren...
                    DragMe = document.getElementById(DragMeId);

                // ...und anschliessend in die Dropzone verschieben.
                currentTarget.appendChild(DragMe);

                // Die Hintergrundfarbe der Dropzone zurücksetzen.
                var target = EventUtil.getCurrentTarget(e);
                target.style.backgroundColor = '';

                return false;
            });

        </script>
    </body>
</html>
