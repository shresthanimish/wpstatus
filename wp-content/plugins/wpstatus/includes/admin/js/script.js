// alert('inside script');
jQuery(document).ready(function () {
    jQuery('div[data-cmp=passwordGenerator]').click(function(e){

        var data_target = jQuery('#wpstatus_password');

        jQuery.post(
            ajaxurl,
            {
                'action': 'generate_password',
            },
            function(response){
                // alert('The server responded: ' + response + data_target);
                data_target.val(response);

            }
        );

    });
});