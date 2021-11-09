(function($) {
    $(function() {
        var $button = $('#lig_reset_cdn_cache_clear');
        $button.on('click', function(){
            "use strict";
            $button.attr('disabled','disabled');
            $button.css({opacity:0.7});
            $button.text('キャッシュクリア中……');
            $.ajax({
                type: "POST",
                url: localize_lig_reset_cdn_cache_clear.ajax_url,
                dataType: 'text',
                data: {
                    action: localize_lig_reset_cdn_cache_clear.action
                }
            }).done(function(data, textStatus, jqXHR) {
                location.reload();
            });
        });
    })
})(jQuery)