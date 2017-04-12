(function ($) {
    "use strict";

    var Constructor = function (options) {
        this.init('remoteformat', options, Constructor.defaults);
    };

    $.fn.editableutils.inherit(Constructor, $.fn.editabletypes.text);

    $.extend(Constructor.prototype, {
        value2html: function (value, element) {
            var options;
            var self = this;

            var callback = function (text, element) {
                Constructor.superclass.value2html.call(self, text, element);
            };

            if (typeof value !== 'string') {
                return callback('', element);
            }

            options = $.extend(true, {}, this.options.ajaxOptions);
            options['data'] = typeof options['data'] === 'function' ? options.data.call(this, value, element) : options['data'];
            options['url'] = options['url'] || this.options.ajaxUrl;
            options['error'] = options['error'] || function () { callback(value, element); };
            options['success'] = options['success'] || function (text) { callback(text, element); };

            $.ajax(options);
        }
        //html2value: function (html) {
        //    console.log('html2value');
        //    return html;
        //},
        //
        //value2input: function (value) {
        //    console.log('value2input');
        //    this.$input.val(value);
        //},
        //
        //input2value: function () {
        //    console.log('input2value');
        //    var result = this.$input.val();
        //    return result;
        //}
    });

    Constructor.defaults = $.extend({}, $.fn.editabletypes.text.defaults, {
        'ajaxOptions': {
            'method': 'GET',
            'data': function (value, element) {
                var options = {'value': value};
                $.each(this.options.ajaxDataOptions, function (k, name) {
                    options[k] = $(element).data(name);
                });
                return options;
            }
        },

        'ajaxUrl': '',
        'ajaxDataOptions': {}
    });

    $.fn.editabletypes.remoteformat = Constructor;

}(window.jQuery));
