<?php
/**
 * Tab Section Block Render Template
 * 
 * @version 1.0.0
 * @package renoun
 * @subpackage blocks
 * 
 * @param   array  $block		The block settings and attributes.
 * @param   string $content		The block inner HTML (empty).
 * @param   bool   $is_preview	True during backend preview render.
 * @param   int    $post_id		The post ID the block is rendering content against.
 *          					This is either the post ID currently being displayed inside a query loop,
 *          					or the post ID of the post hosting this block.
 * @param   array  $context		The context provided to the block by the post or it's parent block.
 */

$block_class	= 'accordion-section';
$classes[]		= $block_class;
$classes[]		= 'accordion-item';
$classes[]		= $block['align'] ? 'align-' . $block['align'] : null;
$classes[]      = isset( $block['style']['dimensions']['minHeight'] ) ? 'has-min-height' : NULL;
$allowed_blocks = array('renoun/column');
$styles		    = [];
$attributes     = '';


if ( ! is_admin() ) {
    $attributes = get_block_wrapper_attributes( 
        array_filter( array(
            'id'	=> isset( $block['anchor'] ) ? esc_attr( $block['anchor'] ) : null,
            'class'	=> esc_attr( implode( ' ', array_filter( $classes ) ) ),
            'style'	=> esc_attr( implode( ' ', array_filter( $styles ) ) ),
        ))
    );
} else {
    $attributes = get_block_wrapper_attributes( 
        array_filter( array(
            'id'	=> isset( $block['anchor'] ) ? esc_attr( $block['anchor'] ) : null,
            'style'	=> esc_attr( implode( ' ', array_filter( $styles ) ) ),
        ))
    );
}
?>
<?php if ( is_admin() ) : ?>

    <div class="<?= $block_class ?>" data-section-name="<?= esc_attr( get_field('accordion_title') ) ?>">
        <InnerBlocks allowedBlocks="<?= esc_attr( wp_json_encode( $allowed_blocks ) ) ?>"  class="<?= $block_class ?>-innerblocks" />
    </div>

<?php else : ?>

    <li <?= $attributes ?? null ?> data-accordion-item>

        <a href="#" class="accordion-title"><?= get_field('accordion_title') ?></a>

        <div class="accordion-content" data-tab-content>
            <div class="row">
                <?= $content ?>
            </div>
        </div>
    </li>

<?php endif; ?>