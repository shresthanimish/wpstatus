// alert('inside script');
jQuery(document).ready(function () {
    jQuery('[data-cmp=wpstatusCronAddSchedule]').click(function(e){

        jQuery.post(
            ajaxurl,
            {
                'action': 'add_cronjob',
                'wps_schedule':{
                    'second'    :jQuery('[name=wps_schedule\\[second\\]]').val(),
                    'minute'    :jQuery('[name=wps_schedule\\[minute\\]]').val(),
                    'hour'      :jQuery('[name=wps_schedule\\[hour\\]]').val(),
                    'day'       :jQuery('[name=wps_schedule\\[day\\]]').val(),
                    'month'     :jQuery('[name=wps_schedule\\[month\\]]').val(),
                    'command'   :jQuery('[name=wps_schedule\\[command\\]]').val(),
                },
                'wps_schedule_submit':true
            },
            function(response){

                console.log(response)

                jQuery('<div class="notice notice-success is-dismissible"> ' +
                            '<p><strong>Schedule added.</strong></p> ' +
                        '</div>').insertAfter('.acf-settings-wrap h1').delay(2500).fadeOut(500);
            }
        );

    });
});