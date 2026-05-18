<?php
/**
 * sql/uninstall.php
 * Elimina todas las tablas del módulo de forma limpia.
 */

if (!defined('_PS_VERSION_')) {
    exit;
}

$sql = [];

$sql[] = 'DROP TABLE IF EXISTS `' . _DB_PREFIX_ . 'productbadge_product`;';
$sql[] = 'DROP TABLE IF EXISTS `' . _DB_PREFIX_ . 'productbadge_lang`;';
$sql[] = 'DROP TABLE IF EXISTS `' . _DB_PREFIX_ . 'productbadge`;';
