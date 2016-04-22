(function ($) {
    "use strict";

    var Constructor = function (options) {
        this.init('combo', options, Constructor.defaults);

        options.combo = options.combo || {};

        //overriding objects in config (as by default jQuery extend() is not recursive)
        this.options.combo = $.extend({}, Constructor.defaults.combo, options.combo);

        this.hasId = this.options.combo.hasId;
        this.isRemote = ('ajax' in this.options.combo.select2Options);
        this.isMultiple = this.options.combo.select2Options.multiple;

        //store function that renders text in select2
        this.formatSelection = this.options.combo.select2Options.formatSelection;
        if (typeof(this.formatSelection) !== "function") {
            this.formatSelection = function (e) {
                return e.text;
            };
        }
    };

    $.fn.editableutils.inherit(Constructor, $.fn.editabletypes.abstractinput);

    $.extend(Constructor.prototype, {
        render: function () {
            this.setClass();

            //can not apply select2 here as it calls initSelection
            //over input that does not have correct value yet.
            //apply select2 only in value2input
            //this.$input.select2(this.options.select2);

            //when data is loaded via ajax, we need to know when it's done to populate listData
            if (this.isRemote) {
                //listen to loaded event to populate data
                this.$input.on('select2-loaded', $.proxy(function (e) {
                    this.sourceData = e.items.results;
                }, this));
            }

            //trigger resize of editableform to re-position container in multi-valued mode
            if (this.isMultiple) {
                this.$input.on('change', function () {
                    $(this).closest('form').parent().triggerHandler('resize');
                });
            }
        },

        value2html: function (value, element) {
            var text = '', data,
                that = this;

            if (this.isMultiple) {
                if ($.isArray(value)) {
                    data = value;
                } else {
                    data = [];
                    $.each(value, function (k, v) {
                        data.push({id: that.hasId ? k : v, text: v});
                    });
                }
            } else {
                data = value[Object.keys(value)[0]];
            }


            //data may be array (when multiple values allowed)
            if ($.isArray(data)) {
                //collect selected data and show with separator
                text = [];
                $.each(data, function (k, v) {
                    text.push(v && typeof v === 'object' ? that.formatSelection(v) : v);
                });
            } else if (typeof data === 'string') {
                text = data;
            } else {
                text = that.formatSelection(data);
            }

            text = $.isArray(text) ? text.join(this.options.viewseparator) : text;

            Constructor.superclass.value2html.call(this, text, element);
        },

        value2submit: function (value) {
            var result = [];
            var that = this;
            $.each(value, function (k, v) {
                result.push(that.hasId ? k : v);
            });

            if (!this.isMultiple) {
                result = result[Object.keys(result)[0]];
            }

            return result;
        },

        html2value: function (html) {
            return this.isMultiple ? this.str2value(html, this.options.viewseparator) : null;
        },

        value2input: function (value) {
            var that = this;
            if (typeof value !== 'string') {
                var newVal = [];
                $.each(value, function (k, v) {
                    if (typeof v !== 'string' && 'text' in v) {
                        k = v.id;
                        v = v.text;
                    }
                    newVal.push(that.hasId ? k : v);
                });
                value = newVal.join(this.getSeparator());
            }

            if (!this.$input.data('select2')) {
                this.$input.val(value);
                this.$input.closest('div').combo().register(this.$input, this.options.hash);
            } else {
                this.$input.val(value).trigger('change', true);
            }

            this.idFunc = this.options.combo.select2Options.id;
            if (typeof(this.idFunc) !== "function") {
                var idKey = this.idFunc || this.$input.data('field').getPk();
                this.idFunc = function (e) {
                    return e[idKey];
                };
            }

            if (this.isRemote && !this.isMultiple && !this.options.combo.select2Options.initSelection) {
                var customId = this.options.combo.select2Options.id,
                    customText = this.options.combo.select2Options.formatSelection;

                if (!customId && !customText) {
                    var $el = $(this.options.scope);
                    if (!$el.data('editable').isEmpty) {
                        var data = {id: value, text: $el.text()};
                        this.$input.select2('data', data);
                    }
                }
            }
        },

        input2value: function () {
            var that = this;
            var data = this.$input.data('field').getData();
            var result = that.hasId ? {} : [];
            if (data === null) { // if nothing is selected
                return result;
            }
            if (!this.isMultiple) {
                data = [data];
            }
            if (!$.isEmptyObject(data)) {
                $.each(data, function (k, v) {
                    if (that.hasId) {
                        result[v.id] = v;
                    } else {
                        result.push(v.text);
                    }
                });
            }
            return result;
        },

        str2value: function (str, separator) {
            if (typeof str !== 'string' || !this.isMultiple) {
                return str;
            }

            separator = separator || this.getSeparator();

            var val, i, l;

            if (str === null || str.length < 1) {
                return null;
            }
            val = str.split(separator);
            for (i = 0, l = val.length; i < l; i = i + 1) {
                val[i] = $.trim(val[i]);
            }

            return val;
        },

        getSeparator: function () {
            return this.options.combo.select2Options.separator || this.options.separator;
        },

        /*
         Converts source from x-editable format: {value: 1, text: "1"} to
         select2 format: {id: 1, text: "1"}
         */
        convertSource: function (source) {
            if ($.isArray(source) && source.length && source[0].value !== undefined) {
                for (var i = 0; i < source.length; i++) {
                    if (source[i].value !== undefined) {
                        source[i].id = source[i].value;
                        delete source[i].value;
                    }
                }
            }
            return source;
        },

        destroy: function () {
            if (this.$input.data('select2')) {
                this.$input.select2('destroy');
            }
        }
    });

    Constructor.defaults = $.extend({}, $.fn.editabletypes.abstractinput.defaults, {
        /**
         @property tpl
         @default <input type="hidden">
         **/
        tpl: '<input type="hidden">',
        /**
         Configuration of select2. [Full list of options](http://ivaynberg.github.com/select2).

         @property combo
         @type object
         @default null
         **/
        combo: null,
        /**
         Source data for select. It will be assigned to select2 `data` property and kept here just for convenience.
         Please note, that format is different from simple `select` input: use 'id' instead of 'value'.
         E.g. `[{id: 1, text: "text1"}, {id: 2, text: "text2"}, ...]`.

         @property source
         @type array|string|function
         @default null
         **/
        source: null,
        /**
         Separator used to display tags.

         @property separator
         @type string
         @default ', '
         **/
        viewseparator: ', ',
        hash: null
    });

    $.fn.editabletypes.combo = Constructor;

}(window.jQuery));
