var SelectorUtil = {
    // Source: http://www.dustindiaz.com/getelementsbyclass
    getElementsByClass : function (searchClass, node, tag) {

        var classElements = new Array();

        if (node == null)

            node = document;

        if (tag == null)

            tag = '*';

        var els = node.getElementsByTagName(tag);

        var elsLen = els.length;

        var pattern = new RegExp("(^|\\s)" + searchClass + "(\\s|$)");

        for (i = 0,j = 0; i < elsLen; i++) {

            if (pattern.test(els[i].className)) {

                classElements[j] = els[i];

                j++;

            }

        }

        return classElements;

    },

    hasClass : function (ele, cls) {
	    return ele.className.match(new RegExp('(\\s|^)' + cls + '(\\s|$)'));
    },

    addClass : function (ele, cls) {
	    if (!this.hasClass(ele, cls)) {
            ele.className += ' ' + cls;
        }
    },

    removeClass : function (ele, cls) {
        if (this.hasClass(ele, cls)) {
            var reg = new RegExp('(\\s|^)' + cls + '(\\s|$)');
            ele.className = ele.className.replace(reg, ' ');
        }
    }
};