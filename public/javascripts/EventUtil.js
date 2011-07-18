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
    removeHandler : function(element, type, handler){
        if (element.removeEventListener){
              element.removeEventListener(type, handler, false);
        } else if (element.detachEvent){
              element.detachEvent("on" + type, handler);
        } else {
              element["on" + type] = null;
        }
    },
    getCurrentTarget : function (e) {
        // first, IE method for mouse events(also supported by Safari and Opera)
        if (e.toElement) {
            return e.toElement;
            // W3C
        } else if (e.currentTarget) {
            return e.currentTarget;

            // MS way
        } else if (e.srcElement) {
            return e.srcElement;
        } else {
            return null;
        }
    }

};
