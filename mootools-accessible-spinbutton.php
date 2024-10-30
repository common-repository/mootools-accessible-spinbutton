<?php
/*
Plugin Name: MooTools Accessible Spinbutton
Plugin URI: http://wordpress.org/extend/plugins/mootools-accessible-spinbutton/
Description: WAI-ARIA Enabled Spinbutton Plugin for Wordpress
Author: Kontotasiou Dionysia
Version: 1.0
Author URI: http://www.iti.gr/iti/people/Dionisia_Kontotasiou.html
*/


add_action("plugins_loaded", "MooToolsAccessibleSpinbutton_init");
function MooToolsAccessibleSpinbutton_init() {
    register_sidebar_widget(__('MooTools Accessible Spinbutton'), 'widget_MooToolsAccessibleSpinbutton');
    register_widget_control(   'MooTools Accessible Spinbutton', 'MooToolsAccessibleSpinbutton_control', 200, 200 );
    if ( !is_admin() && is_active_widget('widget_MooToolsAccessibleSpinbutton') ) {
        wp_deregister_script('jquery');

        // add your own script
        wp_register_script('mootools-core', ( get_bloginfo('wpurl') . '/wp-content/plugins/mootools-accessible-spinbutton/lib/mootools-core.js'));
        wp_enqueue_script('mootools-core');

        wp_register_script('mootools-more', ( get_bloginfo('wpurl') . '/wp-content/plugins/mootools-accessible-spinbutton/lib/mootools-more.js'));
        wp_enqueue_script('mootools-more');

        wp_register_style('MooToolsAccessibleSpinbutton_css', ( get_bloginfo('wpurl') . '/wp-content/plugins/mootools-accessible-spinbutton/lib/demo.css'));
        wp_enqueue_style('MooToolsAccessibleSpinbutton_css');

        wp_register_script('MooToolsAccessibleSpinbutton', ( get_bloginfo('wpurl') . '/wp-content/plugins/mootools-accessible-spinbutton/lib/demo.js'));
        wp_enqueue_script('MooToolsAccessibleSpinbutton');
		
		wp_register_script('spinbutton', ( get_bloginfo('wpurl') . '/wp-content/plugins/mootools-accessible-spinbutton/lib/spinbutton.js'));
        wp_enqueue_script('spinbutton');
    }
}

function widget_MooToolsAccessibleSpinbutton($args) {
    extract($args);

    $options = get_option("widget_MooToolsAccessibleSpinbutton");
    if (!is_array( $options )) {
        $options = array(
                'title' => 'MooTools Accessible Spinbutton',
        );
    }

    echo $before_widget;
    echo $before_title;
    echo $options['title'];
    echo $after_title;

    //Our Widget Content
    MooToolsAccessibleSpinbuttonContent();
    echo $after_widget;
}

function MooToolsAccessibleSpinbuttonContent() {

    $options = get_option("widget_MooToolsAccessibleSpinbutton");
    if (!is_array( $options )) {
        $options = array(
                'title' => 'MooTools Accessible Spinbutton',
        );
    }

    echo '
		<div class="spinbutton">
			<br/>
        <input id="spinbutton" type="text" value="100"/>
		';
}

function MooToolsAccessibleSpinbutton_control() {
    $options = get_option("widget_MooToolsAccessibleSpinbutton");
    if (!is_array( $options )) {
        $options = array(
                'title' => 'MooTools Accessible Spinbutton',
        );
    }

    if ($_POST['MooToolsAccessibleSpinbutton-SubmitTitle']) {
        $options['title'] = htmlspecialchars($_POST['MooToolsAccessibleSpinbutton-WidgetTitle']);
        update_option("widget_MooToolsAccessibleSpinbutton", $options);
    }
   
    ?>
    <p>
        <label for="MooToolsAccessibleSpinbutton-WidgetTitle">Widget Title: </label>
        <input type="text" id="MooToolsAccessibleSpinbutton-WidgetTitle" name="MooToolsAccessibleSpinbutton-WidgetTitle" value="<?php echo $options['title'];?>" />
        <input type="hidden" id="MooToolsAccessibleSpinbutton-SubmitTitle" name="MooToolsAccessibleSpinbutton-SubmitTitle" value="1" />
    </p>
   
    <?php
}

?>
