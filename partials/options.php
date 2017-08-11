<?php

// create custom plugin settings page
// ----------------------------------
add_action('admin_menu', 'tiny_events_menu');


// create the menu item
// --------------------
function tiny_events_menu() {

    // Create new submenu page
    add_submenu_page( 'edit.php?post_type=event', 'Tiny Events Options', 'Options', 'manage_options', 'tiny-events-options', 'tiny_events_options_page' );

    //call register settings function
    add_action( 'admin_init', 'tiny_events_settings' );
}


// register our settings
// ---------------------
function tiny_events_settings() {
    register_setting( 'tiny-events-settings-group', 'tiny_events_list_max_width' );
    register_setting( 'tiny-events-settings-group', 'tiny_events_show_filters' );
}


// build the options page
// ----------------------
function tiny_events_options_page() {
?>
<div class="wrap">

    <h1>Tiny Events Options</h1>
    <hr>

    <?php settings_errors(); ?>
    <form method="post" action="options.php">
        <?php settings_fields( 'tiny-events-settings-group' ); ?>
        <?php do_settings_sections( 'tiny-events-settings-group' ); ?>

        <!-- shortcode -->
        <div class="card">
            <h2>Events Shortcode</h2>
            <hr>
            <p>You code display a list of Tiny Events on any page with the shortcode <code>[tiny-events]</code></p>
        </div>

        <!-- Events List -->
        <div class="card">
            <h2>Events List</h2>
            <hr>
            <table class="form-table">
                
                <tr valign="top">
                    <th scope="row">Events list maximum width</th>
                    <td>
                        <input type="text" name="tiny_events_list_max_width" value="<?php echo esc_attr( get_option('tiny_events_list_max_width') ); ?>" />
                        <p class="description">Enter as % or px, default is 100%.</p>
                    </td>
                </tr>

                <tr valign="top">
                    <th scope="row">Events filters</th>
                    <td>
                        <label for="tiny_events_show_filters">
                            <input name="tiny_events_show_filters" type="checkbox" id="tiny_events_show_filters" value="1" <?php checked( '1', get_option( 'tiny_events_show_filters' ) ); ?>>
                            Show events filters
                        </label>
                    </td>
                </tr>
                 
            </table>
        </div>
        
        <?php submit_button(); ?>

    </form>
</div>
<?php }
