(function($) {
    $(function() {
        var $button = $('#lig-yoast-clear-cache');
        $button.on('click', function(e){
            "use strict";
            $button.attr('disabled','disabled');
            $button.css({opacity:0.7});
            $button.text('キャッシュクリア中……');
            $.ajax({
                type: "POST",
                url: localize_lig_yoast_cache_clear.ajax_url,
                dataType: 'text',
                data: {
                    action: localize_lig_yoast_cache_clear.action
                }
            }).done(function(data, textStatus, jqXHR) {
                location.reload();
            });
            e.preventDefault();
        });
    })
})(jQuery)