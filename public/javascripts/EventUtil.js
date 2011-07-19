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
    },
    preventDefault : function (e) {
        e.preventDefault ? e.preventDefault() : e.returnValue = false;
    },

    /**
     * @author http://www.quirksmode.org/js/events_properties.html
     * @method getMousePosition
     * @param e
     */
    getMousePosition : function (e) {
        var posx = 0,
            posy = 0;
        if (!e) {
            e = window.event;
        }

        if (e.pageX || e.pageY) 	{
            posx = e.pageX;
            posy = e.pageY;
        }
        else if (e.clientX || e.clientY) 	{
            posx = e.clientX + document.body.scrollLeft
                + document.documentElement.scrollLeft;
            posy = e.clientY + document.body.scrollTop
                + document.documentElement.scrollTop;
        }

        return {
            x : posx,
            y : posy
        };
    }

};
