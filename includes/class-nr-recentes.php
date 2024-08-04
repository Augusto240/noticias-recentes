<?php
// Evita o acesso direto ao arquivo
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Define a classe principal do plugin
class NR_Recentes {

    // Inicializa o plugin
    public function init() {
        add_shortcode( 'noticias_recentes', array( $this, 'render_shortcode' ) );
    }

    // Renderiza o shortcode
    public function render_shortcode( $atts ) {
        $atts = shortcode_atts(
            array(
                'num' => 5, // Número de posts a exibir
            ),
            $atts,
            'noticias_recentes'
        );

        $query = new WP_Query( array(
            'post_type'      => 'post',
            'posts_per_page' => intval( $atts['num'] ),
            'order'          => 'DESC',
            'orderby'        => 'date',
        ) );

        if ( $query->have_posts() ) {
            $output = '<ul class="noticias-recentes">';
            while ( $query->have_posts() ) {
                $query->the_post();
                $output .= '<li><a href="' . get_permalink() . '">' . get_the_title() . '</a></li>';
            }
            $output .= '</ul>';
            wp_reset_postdata();
        } else {
            $output = '<p>' . __( 'Nenhuma notícia recente disponível.', 'noticias-recentes' ) . '</p>';
        }

        return $output;
    }
}
