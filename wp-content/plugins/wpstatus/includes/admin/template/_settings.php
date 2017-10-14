<div class="wrap">
    <h2>WPStatus Settings Page</h2><?php
    if ( isset( $_GET['settings-updated'] ) && $_GET['settings-updated'] ){
        $this->admin_notice();
    } ?>
    <form method="POST" action="options.php">
        <?php
        settings_fields( 'wpstatus_fields' );
        do_settings_sections( 'wpstatus_fields' );
        submit_button();
        ?>
    </form>
</div>

<!--<div class="wrap">-->
<!--    <h1>WPStatus Settings</h1>-->
<!--    <form method="post" action="options.php">-->
<!--    --><?php
//        // This prints out all hidden setting fields
//        settings_fields( 'wpstatus_settings_option_group' );
//        do_settings_sections( 'wpstatus-settings-admin' );
//        do_settings_sections( 'our_first_section' );
//        submit_button();
//    ?>
<!--    </form>-->
<!--</div>-->