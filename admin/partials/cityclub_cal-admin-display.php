<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       pospisk.me
 * @since      1.0.0
 *
 * @package    Cityclub_cal
 * @subpackage Cityclub_cal/admin/partials
 */
?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->
<div class="wrap">
    <h1><?php echo esc_html( get_admin_page_title() ); ?></h1>
    <p> add forms and settings here</p>
    <br>
    <form method="post" name="calendar_options" action="options.php">

        <?php
        //Grab all options
        $options = get_option($this->plugin_name);
        // Cleanup
        $cleanup = $options['cleanup'];
        ?>
        <?php
        settings_fields( $this->plugin_name );
        do_settings_sections( $this->plugin_name );
        ?>

        <fieldset>
            <?php settings_fields($this->plugin_name); ?>
            <label for="<?php echo $this->plugin_name; ?>-cleanup">
                <span class="form-pd-l"><strong>Calendar Title</strong></span><br>
                <input type="text" id="<?php echo $this->plugin_name; ?>-title" name="<?php echo $this->plugin_name; ?>[title]" value="Calendar Title" class="form-pd-l regular-text" /><br>
                <span class="form-pd-l"><?php esc_attr_e('Here you can change calendar title.', $this->plugin_name); ?></span>

            </label>
        </fieldset>
        <!-- remove some meta and generators from the <head> -->
        <fieldset>
            <legend class="screen-reader-text"><span>Clean WordPress head section</span></legend>
            <label for="<?php echo $this->plugin_name;?>-cleanup">
                <input type="checkbox" id="<?php echo $this->plugin_name;?>-cleanup" name="<?php echo $this->plugin_name;?>[cleanup]" value="1" <?php checked( $cleanup, 1 ); ?> />
                <span><?php esc_attr_e( 'Clean up the head section', $this->plugin_name ); ?></span>
            </label>
        </fieldset>
        <?php submit_button('Save all changes', 'primary','submit', TRUE); ?>
    </form>
<!--    <form name="calendar_display" action="display-calendar.php">-->
<!--        <select name="" id="">-->
<!--            <option selected="selected" value="">current month</option>-->
<!--            <option value="">previous</option>-->
<!--            <option value="">pre-previous</option>-->
<!--            <option value="">pre-pre-previous</option>-->
<!--        </select>-->
<!--    </form>-->
        <div class="cal-admin">
            <?php
            $calendar = new Calendar();

            echo $calendar->show();
            ?>
        </div>
</div>