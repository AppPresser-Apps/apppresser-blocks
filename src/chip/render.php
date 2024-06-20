<?php
/**
 * @see https://github.com/WordPress/gutenberg/blob/trunk/docs/reference-guides/block-api/block-metadata.md#render
 */

?>
<div <?php echo get_block_wrapper_attributes(); ?>>
	<div class="chip-inner">

		<div>
			<?php if ( ! empty( $attributes['icon'] ) && $attributes['slot'] === 'start' ) : ?>
				<span class="chip-icon" style="mask: url('<?php echo get_site_url(); ?>/wp-content/plugins/apppresser-blocks/assets/ionicons/<?php echo $attributes['icon']; ?>.svg'); mask-size: cover; background-color: var(--wp--preset--color--<?php echo $attributes['textColor']; ?>, #ffffff)"}></span>
			<?php endif; ?>
		</div>

		<div class="chip-label"><?php esc_html_e( $attributes['label'], 'chip' ); ?></div>

		<div>
			<?php if ( ! empty( $attributes['icon'] ) && $attributes['slot'] === 'end' ) : ?>
				<span class="chip-icon" style="mask: url('<?php echo get_site_url(); ?>/wp-content/plugins/apppresser-blocks/assets/ionicons/<?php echo $attributes['icon']; ?>.svg'); mask-size: cover; background-color: var(--wp--preset--color--<?php echo $attributes['textColor']; ?>, #ffffff)"}></span>
			<?php endif; ?>
		</div>
	</div>
</div>
