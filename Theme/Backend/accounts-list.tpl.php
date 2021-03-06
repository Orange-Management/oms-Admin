<?php
/**
 * Orange Management
 *
 * PHP Version 8.0
 *
 * @package   Modules\Admin\Template\Backend
 * @copyright Dennis Eichhorn
 * @license   OMS License 1.0
 * @version   1.0.0
 * @link      https://orange-management.org
 */
declare(strict_types=1);

use phpOMS\Account\AccountStatus;
use phpOMS\Uri\UriFactory;

/**
 * @var \phpOMS\Views\View              $this
 * @var \Modules\Admin\Models\Account[] $accounts
 */
$accounts = $this->getData('accounts') ?? [];

$previous = empty($accounts) ? '{/prefix}admin/account/list' : '{/prefix}admin/account/list?{?}&id=' . \reset($accounts)->getId() . '&ptype=p';
$next     = empty($accounts) ? '{/prefix}admin/account/list' : '{/prefix}admin/account/list?{?}&id=' . \end($accounts)->getId() . '&ptype=n';

echo $this->getData('nav')->render(); ?>

<div class="row">
    <div class="col-xs-12">
        <div class="portlet">
            <div class="portlet-head">
                <?= $this->getHtml('Accounts'); ?>
                <?php include __DIR__ . '/../../../../Web/Backend/Themes/popup-export-data.tpl.php'; ?>
            </div>
            <table id="accountList" class="default sticky">
                <thead>
                <template>

                </template>
                <tr>
                    <td><?= $this->getHtml('ID', '0', '0'); ?>
                        <label for="accountList-r1-asc">
                            <input id="accountList-r1-asc" name="accountList-sort" type="radio">
                            <i class="sort-asc fa fa-chevron-up"></i>
                        </label>
                        <label for="accountList-r1-desc">
                            <input id="accountList-r1-desc" name="accountList-sort" type="radio">
                            <i class="sort-desc fa fa-chevron-down"></i>
                        </label>
                        <?php include __DIR__ . '/../../../../Web/Backend/Themes/popup-filter-table.tpl.php'; ?>
                    <td><?= $this->getHtml('Status'); ?>
                        <label for="accountList-r2-asc">
                            <input id="accountList-r2-asc" name="accountList-sort" type="radio">
                            <i class="sort-asc fa fa-chevron-up"></i>
                        </label>
                        <label for="accountList-r2-desc">
                            <input id="accountList-r2-desc" name="accountList-sort" type="radio">
                            <i class="sort-desc fa fa-chevron-down"></i>
                        </label>
                        <label>
                            <i class="filter fa fa-filter"></i>
                        </label>
                    <td class="wf-100"><?= $this->getHtml('Name'); ?>
                        <label for="accountList-r3-asc">
                            <input id="accountList-r3-asc" name="accountList-sort" type="radio">
                            <i class="sort-asc fa fa-chevron-up"></i>
                        </label>
                        <label for="accountList-r3-desc">
                            <input id="accountList-r3-desc" name="accountList-sort" type="radio">
                            <i class="sort-desc fa fa-chevron-down"></i>
                        </label>
                        <label>
                            <i class="filter fa fa-filter"></i>
                        </label>
                    <td><?= $this->getHtml('Activity'); ?>
                        <label for="accountList-r4-asc">
                            <input id="accountList-r4-asc" name="accountList-sort" type="radio">
                            <i class="sort-asc fa fa-chevron-up"></i>
                        </label>
                        <label for="accountList-r4-desc">
                            <input id="accountList-r4-desc" name="accountList-sort" type="radio">
                            <i class="sort-desc fa fa-chevron-down"></i>
                        </label>
                        <label>
                            <i class="filter fa fa-filter"></i>
                        </label>
                    <td><?= $this->getHtml('Created'); ?>
                        <label for="accountList-r5-asc">
                            <input id="accountList-r5-asc" name="accountList-sort" type="radio">
                            <i class="sort-asc fa fa-chevron-up"></i>
                        </label>
                        <label for="accountList-r5-desc">
                            <input id="accountList-r5-desc" name="accountList-sort" type="radio">
                            <i class="sort-desc fa fa-chevron-down"></i>
                        </label>
                        <label>
                            <i class="filter fa fa-filter"></i>
                        </label>
                    <tbody>
                        <?php $c                                                          = 0; foreach ($accounts as $key => $value) : ++$c;
                        $url                                                              = UriFactory::build('{/prefix}admin/account/settings?{?}&id=' . $value->getId());
                        $color                                                            = 'darkred';
                        if ($value->getStatus() === AccountStatus::ACTIVE) { $color       = 'green'; }
                        elseif ($value->getStatus() === AccountStatus::INACTIVE) { $color = 'darkblue'; }
                        elseif ($value->getStatus() === AccountStatus::TIMEOUT) { $color  = 'purple'; }
                        elseif ($value->getStatus() === AccountStatus::BANNED) { $color   = 'red'; } ?>
                <tr tabindex="0" data-href="<?= $url; ?>">
                    <td data-label="<?= $this->getHtml('ID', '0', '0'); ?>"><a href="<?= $url; ?>"><?= $value->getId(); ?></a>
                    <td data-label="<?= $this->getHtml('Status'); ?>"><a href="<?= $url; ?>"><span class="tag <?= $color; ?>"><?= $this->getHtml('Status'. $value->getStatus()); ?></span></a>
                    <td data-label="<?= $this->getHtml('Name'); ?>"><a href="<?= $url; ?>"><?= $this->printHtml(
                                \sprintf('%3$s %2$s %1$s', $value->name1, $value->name2, $value->name3)
                            ); ?></a>
                    <td data-label="<?= $this->getHtml('Activity'); ?>"><a href="<?= $url; ?>"><?= $this->printHtml($value->getLastActive()->format('Y-m-d H:i:s')); ?></a>
                    <td data-label="<?= $this->getHtml('Created'); ?>"><a href="<?= $url; ?>"><?= $this->printHtml($value->createdAt->format('Y-m-d H:i:s')); ?></a>
                        <?php endforeach; ?>
                        <?php if ($c === 0) : ?>
                            <tr><td colspan="5" class="empty"><?= $this->getHtml('Empty', '0', '0'); ?>
                        <?php endif; ?>
            </table>
            <div class="portlet-foot">
                <a tabindex="0" class="button" href="<?= UriFactory::build($previous); ?>"><?= $this->getHtml('Previous', '0', '0'); ?></a>
                <a tabindex="0" class="button" href="<?= UriFactory::build($next); ?>"><?= $this->getHtml('Next', '0', '0'); ?></a>
            </div>
        </div>
    </div>
</div>
