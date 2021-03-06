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
use phpOMS\Account\AccountType;
use phpOMS\Uri\UriFactory;

/** @var \phpOMS\Views\View $this */
echo $this->getData('nav')->render(); ?>

<div class="row">
    <div class="col-xs-12 col-md-6">
        <div class="portlet">
            <form id="fAccount" action="<?= UriFactory::build('{/api}admin/account'); ?>" method="put">
                <div class="portlet-head"><?= $this->getHtml('Account'); ?></div>
                <div class="portlet-body">
                    <table class="layout wf-100">
                        <tbody>
                        <tr><td><label for="iType"><?= $this->getHtml('Type'); ?></label>
                        <tr><td><select id="Type" name="type">
                                    <option value="<?= $this->printHtml((string) AccountType::USER); ?>"><?= $this->getHtml('Person'); ?>
                                    <option value="<?= $this->printHtml((string) AccountType::GROUP); ?>"><?= $this->getHtml('Organization'); ?>
                                </select>
                        <tr><td><label for="iStatus"><?= $this->getHtml('Status'); ?></label>
                        <tr><td><select id="iStatus" name="status">
                                    <option value="<?= $this->printHtml((string) AccountStatus::ACTIVE); ?>"><?= $this->getHtml('Active'); ?>
                                    <option value="<?= $this->printHtml((string) AccountStatus::INACTIVE); ?>"><?= $this->getHtml('Inactive'); ?>
                                    <option value="<?= $this->printHtml((string) AccountStatus::TIMEOUT); ?>"><?= $this->getHtml('Timeout'); ?>
                                    <option value="<?= $this->printHtml((string) AccountStatus::BANNED); ?>"><?= $this->getHtml('Banned'); ?>
                                </select>
                        <tr><td><label for="iUsername"><?= $this->getHtml('Username'); ?></label>
                        <tr><td><input id="iUsername" name="login" type="text" autocomplete="off" spellcheck="false" placeholder="&#xf007; Fred">
                        <tr><td><label for="iName1"><?= $this->getHtml('Name1'); ?></label>
                        <tr><td><input id="iName1" name="name1" type="text" autocomplete="off" spellcheck="false" placeholder="&#xf007; Donald" required>
                        <tr><td><label for="iName2"><?= $this->getHtml('Name2'); ?></label>
                        <tr><td><input id="iName2" name="name2" type="text" autocomplete="off" spellcheck="false" placeholder="&#xf007; Fauntleroy">
                        <tr><td><label for="iName3"><?= $this->getHtml('Name3'); ?></label>
                        <tr><td><input id="iName3" name="name3" type="text" autocomplete="off" spellcheck="false" placeholder="&#xf007; Duck">
                        <tr><td><label for="iEmail"><?= $this->getHtml('Email'); ?></label>
                        <tr><td><input id="iEmail" name="email" type="email" autocomplete="off" spellcheck="false" placeholder="&#xf0e0; d.duck@duckburg.com">
                        <tr><td><label for="iPassword"><?= $this->getHtml('Name3'); ?></label>
                        <tr><td><input id="iPassword" name="password" type="password" placeholder="&#xf023; Pa55ssw0rd?">
                    </table>
                </div>
                <div class="portlet-foot">
                    <input id="account-create-submit" name="createSubmit" type="submit" value="<?= $this->getHtml('Create', '0', '0'); ?>">
                </div>
            </form>
        </div>
    </div>
</div>
