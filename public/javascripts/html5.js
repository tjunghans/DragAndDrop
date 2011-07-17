(function() {

    var Html5Elements = function() {
        var self = this;
        this.html5elements = [];
        this.addElement = function (html5element) {
            self.html5elements.push(html5element);
        };
        this.createElements = function () {
            for (var i = 0, len = self.html5elements.length; i < len; i++) {
                document.createElement(self.html5elements[i]);
            }
        }
    };

    var html5ie = new Html5Elements();

    html5ie.addElement('address');
    html5ie.addElement('article');
    html5ie.addElement('aside');
    html5ie.addElement('audio');
    html5ie.addElement('canvas');
    html5ie.addElement('command');
    html5ie.addElement('datalist');
    html5ie.addElement('details');
    html5ie.addElement('dialog');
    html5ie.addElement('figure');
    html5ie.addElement('figcaption');
    html5ie.addElement('footer');
    html5ie.addElement('header');
    html5ie.addElement('hgroup');
    html5ie.addElement('keygen');
    html5ie.addElement('mark');
    html5ie.addElement('meter');
    html5ie.addElement('menu');
    html5ie.addElement('nav');
    html5ie.addElement('progress');
    html5ie.addElement('ruby');
    html5ie.addElement('section');
    html5ie.addElement('time');
    html5ie.addElement('video');
    
    html5ie.createElements();
}());