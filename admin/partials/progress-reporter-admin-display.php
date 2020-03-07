<?php

/**
 * Provide an admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       https://criticalhit.dev
 * @since      1.0.0
 *
 * @package    Progress_Reporter
 * @subpackage Progress_Reporter/admin/partials
 */
?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->
<div class="wrap">

    <?php
    $spin_up_the_report = new Progress_Reporter_Report();

    call_user_func(array($spin_up_the_report, 'pr_progress_report'), "");
    ?>


</div>
