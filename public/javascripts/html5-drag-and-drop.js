"use strict";
// Namespace
var DND = function () {

    return {
        make_draggable : function (elem) {
            // Status
            elem.dragging = false;

            // Eventhandler: ondragstart
            elem.ondragstart = function (e) {
                e.dataTransfer.setData('itemid', elem.id);
                e.dataTransfer.setData('item', elem);

                elem.draggin = true;
            };

            elem.ondragend = function (e) {
                elem.dragging = false;
            };

            elem.ondrop = function (e) {

            };
        }

    };
};


