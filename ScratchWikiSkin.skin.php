<?php
/**
 * SkinTemplate class for ScratchWikiSkin
 *
 * @file
 * @ingroup Skins
 */

class SkinScratchWikiSkin extends SkinTemplate {
	var $skinname = 'scratchwikiskin2', $stylename = 'ScratchWikiSkin',
		$template = 'ScratchWikiSkinTemplate', $useHeadElement = true;

	/**
	 * This function adds JavaScript via ResourceLoader
	 *
	 * @param OutputPage $out
	 */

	public function initPage( OutputPage $out ) {
		parent::initPage( $out );
		$out->addModules( 'skins.scratchwikiskin2.js' );
	}

	/**
	 * Add CSS via ResourceLoader
	 *
	 * @param $out OutputPage
	 */
	public function setupSkinUserCss( OutputPage $out ) {
		parent::setupSkinUserCss( $out );
		$out->addModuleStyles( [
			'mediawiki.skinning.interface', 'skins.scratchwikiskin2'
		] );
	}
	static function onGetPreferences( $user, &$preferences ) {
		$origpref = $user->getOption( 'scratchwikiskin-header-color' );
		$preferences['scratchwikiskin-header-color'] = [
			'type' => 'text',
			'label-message' => 'scratchwikiskin-pref-color',
			'section' => 'rendering/skin',
			'default' => ((!$origpref) ? '#7953c4' : $origpref),
		];
		return true;
	}
}
