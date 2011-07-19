var SimpleLogger = function () {
    var initialized = false,
        output = null;


    return {
        init : function () {
            
            var body = document.getElementsByTagName('body')[0];
            output = document.createElement('textarea');
            output.setAttribute('id', 'SimpleLogger');
            output.setAttribute('cols', 80);
            output.setAttribute('rows', 7);
            output.innerHTML = 'foo';

            body.appendChild(output);
            
            initialized = true;
        },

        log : function (text) {
            output.innerHTML = text + "\r" + output.innerHTML;
        },

        clear : function () {
            output.innerHTML = '';
        }
        
    };

};




