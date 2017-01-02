(function ($, window) {
    if (window.jQuery === undefined) {
        console.error('Plugin "jQuery" required by "selectBox.js" is missing!');
        return;
    }

    $(document).ready(function () {

        function toggle(obj, up) {
            var toggle = obj.closest('.selectBox').data('toggle');

            switch (toggle) {
                default:
                    if (up === true) {
                        obj.hide();
                    } else {
                        obj.toggle();
                    }
                    break;
                case 'fade':
                    if (up === true) {
                        obj.fadeOut('fast');
                    } else {
                        obj.fadeToggle('fast');
                    }
                    break;
                case 'slide':
                    if (up === true) {
                        obj.slideUp();
                    } else {
                        obj.slideToggle();
                    }
                    break;
            }
        }

        $('.selectBox').each(function () {
            var value = $(this).closest('form').find('input[name="' + $(this).data('name') + '"]').val();
            if (value !== '') {
                var html = $(this).find('li[data-id="' + value + '"]').html();
                var obj = $(this).find('.selectBox-text');
                obj.html(html);
                obj.parent().attr('data-id', value);
            }
        });

        // select
        $(document).on('click', '.selectBox:not(.disabled)', function () {
            var obj = $(this);

            if (obj.find('ul').is(':visible')) {
                obj.clickOff();
            } else {
                obj.clickOut(function (o) {
                    toggle(o.find('ul'), true);
                    return true;
                });
            }
            toggle(obj.find('ul'));
        });

        $(document).on('click', '.selectBox li', function () {
            var sel = $(this).closest('.selectBox');
            $(this).closest('form').find('input[name="' + sel.data('name') + '"]').val($(this).data('id')).change();
            var el = sel.find('.selectBox-text');
            if ($(this).data('id') == '') {
                el.html(el.data('default'));
                el.parent().attr('data-id', null);
            } else {
                el.html($(this).html());
                el.parent().attr('data-id', $(this).data('id'));
            }
        });
    });

})(jQuery, window);