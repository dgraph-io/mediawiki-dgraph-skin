<?php
/**
 * Dgraph - Modern version of MonoBook with fresh look and many usability
 * improvements.
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License along
 * with this program; if not, write to the Free Software Foundation, Inc.,
 * 51 Franklin Street, Fifth Floor, Boston, MA 02110-1301, USA.
 * http://www.gnu.org/copyleft/gpl.html
 *
 * @file
 * @ingroup Skins
 */

/**
 * SkinTemplate class for Dgraph skin
 * @ingroup Skins
 */
class SkinDgraph extends SkinTemplate {
	public $skinname = 'dgraph';
	public $stylename = 'Dgraph';
	public $template = 'DgraphTemplate';
	/**
	 * @var Config
	 */
	private $vectorConfig;

	public function __construct() {
		$this->vectorConfig = ConfigFactory::getDefaultInstance()->makeConfig( 'vector' );
	}

	// Dgraph Stuff
	function addToBodyAttributes( $out, &$bodyAttrs ) {
		$bodyAttrs['class'] = 'page';
	}

	/**
	 * Initializes output page and sets up skin-specific parameters
	 * @param OutputPage $out Object to initialize
	 */
	public function initPage( OutputPage $out ) {
		parent::initPage( $out );

		if ( $this->vectorConfig->get( 'VectorResponsive' ) ) {
			$out->addMeta( 'viewport', 'width=device-width, initial-scale=1' );
			$out->addModuleStyles( 'skins.vector.styles.responsive' );
		}

		// Append CSS which includes IE only behavior fixes for hover support -
		// this is better than including this in a CSS file since it doesn't
		// wait for the CSS file to load before fetching the HTC file.
		$min = $this->getRequest()->getFuzzyBool( 'debug' ) ? '' : '.min';
		$out->addHeadItem( 'csshover',
			'<!--[if lt IE 7]><style type="text/css">body{behavior:url("' .
				htmlspecialchars( $this->getConfig()->get( 'LocalStylePath' ) ) .
				"/{$this->stylename}/csshover{$min}.htc\")}</style><![endif]-->"
		);

		$out->addHeadItem( 'dgraph','
			<link href="https://fonts.googleapis.com/css?family=Work+Sans:400,500,600,700" rel="stylesheet" type="text/css">
			<link href="https://fonts.googleapis.com/css?family=Inconsolata|Montserrat:400,700|Work+Sans" rel="stylesheet">
			<link href="' .
				htmlspecialchars( $this->getConfig()->get( 'LocalStylePath' ) ) .
				'/' . $this->stylename . '/assets/css/style.min.css" rel="stylesheet" type="text/css">
			<script type="text/javascript" src="' .
				htmlspecialchars( $this->getConfig()->get( 'LocalStylePath' ) ) .
				'/' . $this->stylename . '/assets/js/modernizr.min.js"></script>'
		);

		$out->addModules( array( 'skins.vector.js' ) );
	}

	/**
	 * Loads skin and user CSS files.
	 * @param OutputPage $out
	 */
	function setupSkinUserCss( OutputPage $out ) {
		parent::setupSkinUserCss( $out );

		$styles = array( 'mediawiki.skinning.interface', 'skins.vector.styles' );
		Hooks::run( 'SkinVectorStyleModules', array( $this, &$styles ) );
		$out->addModuleStyles( $styles );
	}

	/**
	 * Override to pass our Config instance to it
	 */
	public function setupTemplate( $classname, $repository = false, $cache_dir = false ) {
		return new $classname( $this->vectorConfig );
	}
}
