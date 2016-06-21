(function ($, window) {
    if (window.jQuery === undefined) {
        console.error('Plugin "jQuery" required by "selectBox.js" is missing!');
        return;
    }

    $(document).ready(function () {

        $('.selectBox-input .selectBox-select').each(function () {
            var value = $(this).closest('form').find('input[name="' + $(this).data('name') + '"]').val();
            if (value !== '') {
                var html = $(this).find('li[data-id="' + value + '"]').html();
                $(this).find('.selectBox-text').html(html);
            }
        });

        // select
        $(document).on('click', '.selectBox-input:not(.disabled) .selectBox-select', function () {
            var obj = $(this);

            if (obj.find('ul').is(':visible')) {
                obj.clickOff();
            } else {
                obj.clickOut(function (o) {
                    o.find('ul').slideUp();
                    return true;
                });
            }
            obj.find('ul').slideToggle();
        });
        $(document).on('click', '.selectBox-input .selectBox-select li', function () {
            var sel = $(this).closest('.selectBox-select');
            $(this).closest('form').find('input[name="' + sel.data('name') + '"]').val($(this).data('id')).change();
            var el = sel.find('.selectBox-text');
            if ($(this).data('id') == '') {
                el.html(el.data('default'));
                el.attr('data-id', null);
            } else {
                el.html($(this).html());
                el.attr('data-id', $(this).data('id'));
            }
        });

    });

})(jQuery, window);