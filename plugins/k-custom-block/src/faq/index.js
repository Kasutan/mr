
//  Import CSS.
import './style.scss';
import './editor.scss';

const { __ } = wp.i18n; // Import __() from wp.i18n
const { registerBlockType, query } = wp.blocks; // Import registerBlockType() from wp.blocks
var withAPIData = wp.components.withAPIData;
var el = wp.element.createElement;

/**
 * Register: K Gutenberg Block FAQ.
 *
 * Registers a new block provided a unique name and an object defining its
 * behavior. Once registered, the block is made editor as an option to any
 * editor interface where blocks are implemented.
 *
 * @link https://wordpress.org/gutenberg/handbook/block-api/
 * @param  {string}   name     Block name.
 * @param  {Object}   settings Block settings.
 * @return {?WPBlock}          The block, if it has been successfully
 *                             registered; otherwise `undefined`.
 */
registerBlockType( 'cgb/block-faq', {
	// Block name. Block names must be string that contains a namespace prefix. Example: my-plugin/my-custom-block.
	title: __( 'Block faq' ), // Block title.
	icon: 'editor-help', // Block icon from Dashicons → https://developer.wordpress.org/resource/dashicons/.
	category: 'common', // Block id — Group blocks together based on common traits E.g. common, formatting, layout widgets, embed.
	keywords: [
		__( 'faq' ),
		__( 'question' ),
	],

	attributes: {
		fragId: {
			type: 'string',
			default: 'default'
		},
		fragTitle : {
			type: 'string',
			default: 'Pas de titre'
		}
	},

	/**
	 * The edit function describes the structure of your block in the context of the editor.
	 * This represents what the editor will render when the block is used.
	 *
	 * The "edit" property must be a valid function.
	 *
	 * @link https://wordpress.org/gutenberg/handbook/block-api/block-edit-save/
	 */
	edit: withAPIData( function() {
		return {
			posts: '/wp/v2/faq?per_page=100'
		};
	} )(function( props ) {
		if ( ! props.posts.data ) {
			return "Chargement en cours !";
		}
		if ( props.posts.data.length === 0 ) {
			return "Aucune FAQ";
		}
		const { attributes: { fragId, fragTitle }, setAttributes } = props;
		function setFragId( event ) {
			const selected = event.target.querySelector( 'option:checked' );
			setAttributes( { fragId: selected.value } );
			event.preventDefault();
		}
		return (
			<div className={ props.className }>
				FAQ à afficher :
				<form onSubmit={ setFragId }>			
					<select id="fragOptions" value={ fragId } onChange={ setFragId }>
						<option value="default" >Choisir une FAQ</option>
						{props.posts.data.map(function(item, i){
							return <option value={item.id}>{item.title.rendered}</option>;
						})}
                	</select>
				</form>

			</div>
		);
	}),

	/**
	 * The save function defines the way in which the different attributes should be combined
	 * into the final markup, which is then serialized by Gutenberg into post_content.
	 *
	 * The "save" property must be specified and must be a valid function.
	 *
	 * @link https://wordpress.org/gutenberg/handbook/block-api/block-edit-save/
	 */
	save: function( props ) {
		/*const { attributes: { fragId } } = props;
        return (
            <div>
               <p> Fragment choisi : {fragId}</p>
            </div>
		);*/
		// Rendering in PHP
		return null;
	},
} );
