<?php
/*
Plugin Name: eValor
Plugin URI: https://www.evalor.es/tienda/modulo/wordpress/
Description: El módulo WordPress facilita la integración del innovador sidebar de evalor en su web WordPress o tienda WooCommerce.  Para los usuarios del WooCommerce Plugin para WordPress el módulo se encarga de invitar de forma automática a los clientes para que compartan su experiencia. Esta funcion solo esta disponible para clientes PLUS.  Cuando el proceso del pedido ha finalizado se envia automaticamente una invitacion al cliente para que comparta su experiencia. Asi se genera confianza y aumenta la conversion de su tienda online. 
Version: 1.1.0
Author: Albert Peschar
Author URI: https://peschar.net/
*/

if(!function_exists('add_action')) {
	echo "Hi there!  I'm just a plugin, not much I can do when called directly.";
	exit;
}

register_activation_hook('webwinkelkeur/webwinkelkeur.php', 'webwinkelkeur_activate');

function webwinkelkeur_activate() {
    global $wpdb;

    require_once ABSPATH . 'wp-admin/includes/upgrade.php';

    dbDelta("
        CREATE TABLE `" . $wpdb->prefix . "webwinkelkeur_invite_error` (
            `id` int NOT NULL AUTO_INCREMENT,
            `url` varchar(255) NOT NULL,
            `response` text NOT NULL,
            `time` bigint NOT NULL,
            `reported` boolean NOT NULL DEFAULT 0,
            PRIMARY KEY (`id`),
            KEY `time` (`time`),
            KEY `reported` (`reported`)
        )
    ");
}

if(is_admin())
    require dirname(__FILE__) . '/admin.php';
else
    require dirname(__FILE__) . '/frontend.php';

require dirname(__FILE__) . '/woocommerce.php';
