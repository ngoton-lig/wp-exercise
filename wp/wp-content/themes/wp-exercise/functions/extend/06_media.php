<?php
function align_img_caption( $output, $attr, $content ) {
    $attr['align'] = 'alignleft';

    $attr = shortcode_atts(array(
        'id'      => '',
        'align'   => 'alignnone',
        'width'   => '',
        'caption' => ''
    ), $attr);

    if ( 1 > (int) $attr['width'] || empty( $attr['caption'] ) ) {
        return '';
    }

    if ( $attr['id'] ) {
        $attr['id'] = 'id="' . esc_attr( $attr['id'] ) . '" ';
    }

    return '<div ' . $attr['id']
        . 'class="wp-caption ' . esc_attr( $attr['align'] ) . '" '
        . 'style="max-width: ' . ( 10 + (int) $attr['width'] ) . 'px;">'
        . do_shortcode( $content )
        . '<p class="wp-caption-text">' . $attr['caption'] . '</p>'
        . '</div>';

}
add_filter( 'img_caption_shortcode', 'align_img_caption', 10, 3 );