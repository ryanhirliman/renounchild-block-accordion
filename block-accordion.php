<?php

/**
 * Accordion Block Render Template
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


$block_class     = 'block-accordion';
$classes[]      = $block_class;
$classes[]      = isset($block['className']) ? $block['className'] : NULL;
$block_template = '';
$attributes     = '';
$styles            = [];
$allowed_blocks = array('renounchild/block-accordion-section');
$template       = array(array('renounchild/block-accordion-section'));
$rand           = rand(0, 100);
$x              = 1;

$attributes = get_block_wrapper_attributes(
    array_filter(array(
        'id'    => isset($block['anchor']) ? esc_attr($block['anchor']) : null,
        'class'    => esc_attr(implode(' ', array_filter($classes))),
        'style'    => esc_attr(implode(' ', array_filter($styles))),
    ))
);

if ($content && ! $is_preview) : // output everything

?>
    <div <?= $attributes ?? $attributes ?>>

        <ul id="<?= $block_class . '-' . $rand ?>" class="accordion" data-accordion data-allow-all-closed="true">
            <?= $content ?>
        </ul>

    </div>

<?php else : // output normal 
?>

    <div>
        <InnerBlocks allowedBlocks="<?= esc_attr(wp_json_encode($allowed_blocks)) ?>" template="<?= esc_attr(wp_json_encode($template)) ?>" />
    </div>

<?php endif; ?>