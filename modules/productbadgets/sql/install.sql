<?php
/**
 * sql/install.php
 * Se carga desde ProductBadges::installSql().
 * La variable $sql debe quedar definida al terminar este archivo.
 */

if (!defined('_PS_VERSION_')) {
    exit;
}

$sql = [];

// Tabla principal de badges
$sql[] = 'CREATE TABLE IF NOT EXISTS `' . _DB_PREFIX_ . 'productbadge` (
    `id_badge`   INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
    `bg_color`   VARCHAR(7)       NOT NULL DEFAULT \'#FF0000\',
    `text_color` VARCHAR(7)       NOT NULL DEFAULT \'#FFFFFF\',
    `position`   ENUM(\'top-left\',\'top-right\') NOT NULL DEFAULT \'top-left\',
    `active`     TINYINT(1)       NOT NULL DEFAULT 1,
    `date_add`   DATETIME         NOT NULL,
    `date_upd`   DATETIME         NOT NULL,
    PRIMARY KEY (`id_badge`)
) ENGINE=' . _MYSQL_ENGINE_ . ' DEFAULT CHARSET=utf8mb4;';

// Tabla de traducciones (multilenguaje)
$sql[] = 'CREATE TABLE IF NOT EXISTS `' . _DB_PREFIX_ . 'productbadge_lang` (
    `id_badge`   INT(10) UNSIGNED NOT NULL,
    `id_lang`    INT(10) UNSIGNED NOT NULL,
    `badge_text` VARCHAR(255)     NOT NULL DEFAULT \'\',
    PRIMARY KEY (`id_badge`, `id_lang`)
) ENGINE=' . _MYSQL_ENGINE_ . ' DEFAULT CHARSET=utf8mb4;';

// Tabla de relación badge ↔ producto (muchos a muchos)
$sql[] = 'CREATE TABLE IF NOT EXISTS `' . _DB_PREFIX_ . 'productbadge_product` (
    `id_badge`   INT(10) UNSIGNED NOT NULL,
    `id_product` INT(10) UNSIGNED NOT NULL,
    PRIMARY KEY (`id_badge`, `id_product`)
) ENGINE=' . _MYSQL_ENGINE_ . ' DEFAULT CHARSET=utf8mb4;';
