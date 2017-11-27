define(['jquery'],
    function($) {
        'use strict';

        console.log('inside tools.js');
        var clsActive = 'active';

        function CmpCsvImport(el) {
            console.log('inside cmpscvimport');
            this.$el = $(el);

            this.$items = this.$el.find('.filter-item');
            this.$items.each(function() {
                var $item = $(this);
                var $title = $item.find('.f-title');
                if ($title.length) {
                    $title.on('click', function() {
                        $item.toggleClass(clsActive);
                    });
                }
            });

            return this;
        }

        $('[data-cmp="csvimport"]').each(function() {
            new CmpCsvImport(this);
        });
    }
);