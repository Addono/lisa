<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * @author Adriaan Knapen <a.d.knapen@protonmail.com>
 * @date 26-02-2017
 */
?>

<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header"><?=lang('application_dashboard_title')?></h1>
    </div><!-- /.col-lg-12 -->
</div><!-- /.row -->

<div class="row">
    <div class="col-lg-6">
        <h2><?=lang('application_dashboard_total_amount')?></h2>
        <p><?=$totalScore?></p>
    </div>
    <div class="col-lg-6">
        <h2><?=lang('application_dashboard_negative_users')?></h2>
        <p><?=implode('<p>', $negativeUsers)?></p>
    </div>
</div>