<?php
/**
 * Orange Management
 *
 * PHP Version 7.0
 *
 * @category   TBD
 * @package    TBD
 * @author     OMS Development Team <dev@oms.com>
 * @author     Dennis Eichhorn <d.eichhorn@oms.com>
 * @copyright  2013 Dennis Eichhorn
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       http://orange-management.com
 */
/*
 * UI Logic
 */

$group = $this->getData('group');

echo $this->getData('nav')->render(); ?>

<section class="box w-33 floatLeft">
    <header><h1><?= $this->getText('Group') ?></h1></header>
    <div class="inner">
        <form action="<?= \phpOMS\Uri\UriFactory::build('/{/lang}/api/admin/group'); ?>" method="post">
            <table class="layout wf-100">
                <tbody>
                <tr><td><label for="iGid"><?= $this->getText('ID') ?></label>
                <tr><td><input id="iGid" name="gid" type="text" value="<?= $group->getId(); ?>" disabled>
                <tr><td><label for="iGname"><?= $this->getText('Name') ?></label>
                <tr><td><input id="iGname" name="gname" type="text" placeholder="&#xf0c0; Guest" value="<?= $group->getName(); ?>">
                <tr><td><label for="iGroupDescription"><?= $this->getText('Description') ?></label>
                <tr><td><textarea id="iGroupDescription" name="description" placeholder="&#xf040;"><?= $group->getDescription(); ?></textarea>
                <tr><td><input type="submit" value="<?= $this->getText('Create') ?>">
            </table>
        </form>
    </div>
</section>

<section class="box w-33 floatLeft">
    <header><h1><?= $this->getText('Parent') ?></h1></header>
    <div class="inner">
        <form action="<?= \phpOMS\Uri\UriFactory::build('/{/lang}/api/admin/group'); ?>" method="post">
            <table class="layout wf-100">
                <tbody>
                <tr><td><label for="iGParentName"><?= $this->getText('Name') ?></label>
                <tr><td><input id="iGParentName" name="parentname" type="text" placeholder="&#xf0c0; Guest">
                <tr><td><input type="submit" value="<?= $this->getText('Add') ?>">
            </table>
        </form>
    </div>
</section>

<section class="box w-33 floatLeft">
    <header><h1><?= $this->getText('Permissions') ?></h1></header>
    <div class="inner">
        <form action="<?= \phpOMS\Uri\UriFactory::build('/{/lang}/api/admin/group'); ?>" method="post">
            <table class="layout wf-100">
                <tbody>
                <tr><td><label for="iPermissionName"><?= $this->getText('Name') ?></label>
                <tr><td><input id="iPermissionName" name="permissionname" type="text" placeholder="&#xf084; Admin">
                <tr><td><input type="submit" value="<?= $this->getText('Add') ?>">
            </table>
        </form>
    </div>
</section>

<section class="box w-33 floatLeft">
    <header><h1><?= $this->getText('Accounts') ?></h1></header>
    <div class="inner">
        <form action="<?= \phpOMS\Uri\UriFactory::build('/{/lang}/api/admin/group'); ?>" method="post">
            <table class="layout wf-100">
                <tbody>
                <tr><td><label for="iGParentName"><?= $this->getText('Name') ?></label>
                <tr><td><input id="iGParentName" name="parentname" type="text" placeholder="&#xf234; Donald Duck">
                <tr><td><input type="submit" value="<?= $this->getText('Add') ?>">
            </table>
        </form>
    </div>
</section>


