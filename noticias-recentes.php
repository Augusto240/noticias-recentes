<?php
/*
 Plugin Name: Notícias Recentes
 Plugin URI: http://meusite.com
 Description: Um plugin que adiciona um shortcode para exibir uma lista de posts recentes.
 Version: 1.0
 Author: Seu Nome
 Author URI: http://seusite.com
 Text Domain: noticias-recentes
 Domain Path: /languages
*/

// Evita o acesso direto ao arquivo
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Carrega as traduções
function nr_load_textdomain() {
    load_plugin_textdomain( 'noticias-recentes', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );
}
add_action( 'plugins_loaded', 'nr_load_textdomain' );

// Inclui a classe principal do plugin
require_once plugin_dir_path( __FILE__ ) . 'includes/class-nr-recentes.php';

// Inicializa o plugin
function nr_initialize_plugin() {
    $plugin = new NR_Recentes();
    $plugin->init();
}
add_action( 'plugins_loaded', 'nr_initialize_plugin' );
