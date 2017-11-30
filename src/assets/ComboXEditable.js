(function ($) {
    "use strict";

    var Constructor = function (options) {
        this.init('combo', options, Constructor.defaults);

        options.combo = options.combo || {};

        //overriding objects in config (as by default jQuery extend() is not recursive)
        this.options.combo = $.extend({}, Constructor.defaults.combo, options.combo);
        this.options.source = [];

        this.hasId = this.options.combo.hasId;
        this.isRemote = ('ajax' in this.options.combo.select2Options);
        this.isMultiple = this.options.combo.select2Options.multiple;

        //store function that renders text in select2
        this.formatSelection = this.options.combo.select2Options.templateSelection;
        if (typeof(this.formatSelection) !== "function") {
            this.formatSelection = function (e) {
                return e.text;
            };
        }
    };

    $.fn.editableutils.inherit(Constructor, $.fn.editabletypes.select);

    $.extend(Constructor.prototype, {
        render: function () {
            if (!this.$input.data('select2')) {
                this.$input.closest('div').combo().register(this.$input, this.options.hash);
            }

            //store function returning ID of item
            //should be here as used inautotext for local source
            this.idFunc = this.options.combo.select2Options.id;
            if (typeof(this.idFunc) !== "function") {
                var idKey = this.idFunc || this.$input.data('field').getPk();
                this.idFunc = function (e) {
                    return e[idKey];
                };
            }

            return Constructor.superclass.render.call(this);
        },

        value2html: function (value, element) {
            Constructor.superclass.value2html.apply(this, arguments);
        },

        renderList: function() {
            var $options = this.$input.children();
            Constructor.superclass.renderList.apply(this, arguments);
            this.$input.prepend($options);

            //trigger resize of editableform to re-position container in multi-valued mode
            if (this.isMultiple) {
                this.$input.on('change', function() {
                    $(this).closest('form').parent().triggerHandler('resize');
                });
            }
        },

        html2value: function (html) {
          if (!this.isMultiple) {
              return html;
          }

          return html.split(this.options.viewseparator);
        },

        value2input: function (value) {

            // The value for a multiple select can be passed in as a single string
            // This will convert it from a string to an array of data values
            if (value && !$.isArray(value) && this.isMultiple) {
                value = this.str2value(value);

            }

            if (!value) {
                return;
            }

            // Branch off based on whether or not it's a multiple select
            // Either way, we are adding `<option>` tags for selected values that
            // don't already exist, so they can be selected correctly.
            if ($.isArray(value)) {
                var $options = this.$input.find('option');

                for (var v = 0; v < value.length; v++) {
                    var $filtered = $options.filter(function (i, elem) {
                        return elem.value == value[v].toString();
                    });

                    // Check if the option doesn't already exist
                    if ($filtered.length === 0) {
                        // Automatically create the option for the value
                        this.$input.append(new Option(value[v], value[v]));
                    }
                }
            } else {
                $filtered = this.$input.find('option').filter(function (i, elem) {
                    return elem.value == value.toString()
                });

                if ($filtered.length === 0) {
                    var $el = $(this.options.scope);
                    var text;
                    if (!$el.data('editable').isEmpty) {
                        text = $el.text();
                    } else {
                        text = value;
                    }
                    this.$input.append(new Option(text, value));
                }
            }

            // After setting the value we must trigger the change event for Select2
            this.$input.val(value).trigger('change');
        },

        str2value: function (str) {
            if ($.isArray(str)) {
                return str;
            }

            if (this.isMultiple) {
                return str.split(this.getSeparator());
            }

            return str;
        },

        /**
         * Used to convert the value to the text representation of it.
         *
         * Superclass doesn't support multiple selects, so we need to override this.
         */
        value2htmlFinal: function (value, element) {
            // The select input type can handle single selects fine
            // We have to special case multiple selects, which aren't supported
            // by default.
            var results = [], items;
            try {
                this.sourceData = this.$input.data('field').getData();
            } catch (exception) {
                this.sourceData = [];
            }

            if (!$.isArray(value)) {
                items = $.fn.editableutils.itemsByValue(value, this.sourceData, 'id');

                if (items.length) {
                    results = items[0].text;
                }
            } else {
                // Convert all of the values into their text
                for (var v = 0; v < value.length; v++) {
                    var val = value[v];
                    items = $.fn.editableutils.itemsByValue(val, this.sourceData, 'id');

                    // There are no items in cases like tagging
                    // So just assume that the tag value is also the text
                    if (items.length === 0) {
                        results.push(value[v]);
                    } else {
                        results.push(items[0].text);
                    }
                }

                // The output is the text joined by the viewseparator (comma by default)
                results = results.join(this.options.viewseparator);
            }

            $(element)[this.options.escape ? 'text' : 'html']($.trim(results));
        },

        getSeparator: function () {
            return this.options.combo.select2Options.separator || this.options.separator;
        },

        /*
         Converts source from x-editable format: {value: 1, text: "1"} to
         select2 format: {id: 1, text: "1"}
         */
        convertSource: function (source) {
            if ($.isArray(source)) {
                for (var i = 0; i < source.length; i++) {
                    if (source[i].value !== undefined) {
                        source[i].id = source[i].value;
                    }

                    source[i].id = "" + this.idFunc(source[i]);
                }
            }

            return source;
        },

        /**
         * Convert the Select2 data array into a x-editable compatible list of
         * selections.
         *
         * This will also automatically pull selected data from Select2 if
         * nothing was passed in and Select2 was already initialized.
         */
        makeArray: function (data) {
            if (!data && this.$input && this.$input.data('select2')) {
                data = this.$input.select2('data');
            }

            if ($.isArray(data)) {
                for (var i = 0; i < data.length; i++) {
                    if (data[i].id !== undefined) {
                        data[i].value = data[i].id;
                    }
                }
            }

            return Constructor.superclass.makeArray.call(this, data);
        },

        destroy: function () {
            if (this.$input.data('select2')) {
                this.$input.select2('destroy');
            }
        }
    });

    Constructor.defaults = $.extend({}, $.fn.editabletypes.select.defaults, {
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
