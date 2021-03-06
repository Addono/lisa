<?php
/**
 * @author Adriaan Knapen <a.d.knapen@protonmail.com>
 * @date 1-3-2017
 */
?>
<div class="col-md-12 vmargin col-md-offset-0">
    <div class="container">
        <!-- Tabs with icons on Card -->
        <div class="card card-nav-tabs">
            <div class="header header-primary">
                <div class="text-center">
                    <h4><?=lang('transactions_title')?></h4>
                </div>
                <div class="nav-tabs-navigation">
                    <div class="nav-tabs-wrapper">
                        <ul class="nav nav-tabs" data-tabs="tabs"><li class="active">
                                <a href="#ordered-first-name" data-toggle="tab">
                                    <?=lang('transactions_subtitle_subject')?>
                                </a>
                            </li><li class="">
                                <a href="#ordered-last-name" data-toggle="tab">
                                    <?=lang('transactions_subtitle_author')?>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="content">
                <div class="content">
                    <div class="tab-content text-center"><div class="tab-pane active" id="ordered-first-name">
                        <div id="chart" style="width: 100%"></div>

                        <?php if ($limit) { ?>
                            <p>
                                <?=str_replace('[limit]', $limit, lang('transactions_table_limit_description'))?>
                                <a class="btn btn-primary btn-sm" href="<?=site_url($group.'/'.$page.'/'.($limit+100))?>">+100</a>
                                <a class="btn btn-primary btn-sm" href="<?=site_url($group.'/'.$page.'/all')?>"><?=lang('transactions_table_limit_show_all')?></a>
                            </p>
                        <?php } ?>
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th><?=lang('transactions_table_header_author')?></th>
                                    <th><?=lang('transactions_table_header_subject')?></th>
                                    <th><?=lang('transactions_table_header_amount')?></th>
                                    <th><?=lang('transactions_table_header_delta')?></th>
                                    <th><?=lang('transactions_table_header_time')?></th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($transactions['subject'] as $t) {?>
                                <tr>
                                    <td><?=$t[$fields['author']]?></td>
                                    <td><?=$t[$fields['subject']]?></td>
                                    <td><?=$t[$fields['amount']]?></td>
                                    <td><?=($d=$t[$fields['delta']])>0?'<i class="text-success fa fa-caret-up"></i>'.$d:'<i class="text-danger fa fa-caret-down"></i>'.abs($d)?></td>
                                    <td class="moment_relative_time" data-time="<?=$t[$fields['time_unix']]?>"><?=$t[$fields['time']]?></td>
                                </tr>
                            <?php } ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="tab-pane" id="ordered-last-name">
                        <?php if ($limit) { ?>
                            <p>
                                <?=str_replace('[limit]', $limit, lang('transactions_table_limit_description'))?>
                                <a class="btn btn-primary btn-sm" href="<?=site_url($group.'/'.$page.'/'.($limit+100))?>">+100</a>
                                <a class="btn btn-primary btn-sm" href="<?=site_url($group.'/'.$page.'/all')?>"><?=lang('transactions_table_limit_show_all')?></a>
                            </p>
                        <?php } ?>
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th><?=lang('transactions_table_header_author')?></th>
                                <th><?=lang('transactions_table_header_subject')?></th>
                                <th><?=lang('transactions_table_header_amount')?></th>
                                <th><?=lang('transactions_table_header_delta')?></th>
                                <th><?=lang('transactions_table_header_time')?></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($transactions['author'] as $t) { ?>
                                <tr>
                                    <td><?=$t[$fields['author']]?></td>
                                    <td><?=$t[$fields['subject']]?></td>
                                    <td><?=$t[$fields['amount']]?></td>
                                    <td><?=($d=$t[$fields['delta']])>0?'+'.$d:$d?></td>
                                    <td class="moment_relative_time" data-time="<?=$t[$fields['time_unix']]?>"><?=$t[$fields['time']]?></td>
                                </tr>
                            <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
