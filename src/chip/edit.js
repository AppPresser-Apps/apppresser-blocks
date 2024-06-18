/**
 * Retrieves the translation of text.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/packages/packages-i18n/
 */
import { __ } from '@wordpress/i18n';

/**
 * React hook that is used to mark the block wrapper element.
 * It provides all the necessary props like the class name.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/packages/packages-block-editor/#useblockprops
 */
import { InnerBlocks, useBlockProps, MediaPlaceholder, MediaUploadCheck, MediaUpload, InspectorControls } from '@wordpress/block-editor';
import { PanelBody, PanelRow, Button, RangeControl, ColorPicker, TextControl, SelectControl, Icon } from '@wordpress/components';
import { useEffect } from '@wordpress/element';
import { useSelect } from '@wordpress/data';


/**
 * Lets webpack process CSS, SASS or SCSS files referenced in JavaScript files.
 * Those files can contain any CSS code that gets applied to the editor.
 *
 * @see https://www.npmjs.com/package/@wordpress/scripts#using-css
 */
import './editor.scss';

/**
 * The edit function describes the structure of your block in the context of the
 * editor. This represents what the editor will render when the block is used.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/block-api/block-edit-save/#edit
 *
 * @return {Element} Element to render.
 */
export default function Edit({ attributes, setAttributes }) {

	const data = useSelect(
        ( select ) => {
            return select( 'core' ).getSite();
        },
        []
    );

	console.log(attributes);

	return (
		<div { ...useBlockProps() }>
			<InspectorControls>
				<PanelBody
					title={__('Settings', 'apppresser-blocks')}
					initialOpen={ true }
				>
					<PanelRow>
						<TextControl
							label={__('Chip Label', 'apppresser-blocks')}
							value={attributes.label}
							onChange={(label) => setAttributes({ label })}
						></TextControl>
					</PanelRow>
					<SelectControl
						label={__('Chip Icon', 'apppresser-blocks')}
						value={attributes.icon}
						options={appp_icons.icons}
						onChange={(icon) => setAttributes({ icon })}
						help={__('Select the chip icon.', 'apppresser-blocks')}
					></SelectControl>
					<label class="label-uppercase">{__('Avatar', 'apppresser-blocks')}</label>
					<PanelRow>
						<div>
							<MediaUpload
								onSelect={(media) => setAttributes({ avatar: media.url })}
								allowedTypes={['image']}
								value={attributes.avatar}
								multiple={false}
								render={({ open }) => (
									<>
									<img src={attributes.avatar}></img>
									<button class="components-button is-primary is-small" onClick={open}>
										{attributes.avatar === null
										? 'Upload'
										: 'Replace Image'}
									</button>
									<p class="label-description">Uploaded image will be used before chip label</p>
									</>
								)}
							>
								
							</MediaUpload>
						</div>
					</PanelRow>
				</PanelBody>
			</InspectorControls>
			{ attributes.avatar && <img src={attributes.avatar}></img> }
			{ attributes.label !== '' && <div class="chip-label">{attributes.label}</div> }
			{ data && attributes.icon !== 'none' &&  <span class={`chip-icon`} style={{mask: `url(${data.url}/wp-content/plugins/apppresser-blocks/assets/ionicons/${attributes.icon}.svg)`, maskSize: 'cover', backgroundColor: `var(--wp--preset--color--${attributes.textColor}, #ffffff)` }}></span> }
		</div>
	);
}
