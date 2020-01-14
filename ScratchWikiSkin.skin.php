<?php
/**
 * SkinTemplate class for ScratchWikiSkin
 *
 * @file
 * @ingroup Skins
 */

define('SKIN_CHOICE_PREF', 'skin');
define('DARK_THEME_PREF', 'scratchwikiskin-dark-theme');
define('HEADER_COLOR_PREF', 'scratchwikiskin-header-color');

class HTMLColorField extends HTMLFormField {

	public function getInputHTML( $value ) {

		$attribs = [
			'id' => $this->mID,
			'name' => $this->mName,
			'value' => $value,
			'dir' => $this->mDir,
			'pattern' => '#[0-9A-Za-z]{6}',
		];

		if ( $this->mClass !== '' ) {
			$attribs['class'] = $this->mClass;
		}

		$allowedParams = [
			'type',
			'pattern',
			'title',
			'disabled',
			'required',
			'autofocus',
			'readonly',
		];

		$attribs += $this->getAttributes( $allowedParams );
		return Html::input( $this->mName, $value, 'color', $attribs );
	}

	public function validate( $value, $alldata ) {
		if (preg_match('%#[a-zA-Z0-9]{6}%', $value) === 0) {
			return $this->msg( 'htmlform-invalid-input' );
		}
		return parent::validate($value, $alldata);
	}
}

class SkinScratchWikiSkin extends SkinTemplate {
	var $skinname = 'scratchwikiskin2', $stylename = 'ScratchWikiSkin',
		$template = 'ScratchWikiSkinTemplate', $useHeadElement = true;

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
		// make Chrome mobile testing work
		$out->addMeta('viewport', 'user-scalable=no, initial-scale=1, maximum-scale=1, minimum-scale=1, width=device-width, height=device-height');
	}

	public static function onOutputPageBodyAttributes( $out, $skin, &$bodyAttrs ) {
		global $wgUser;
		if ($wgUser->getOption( DARK_THEME_PREF )) {
			$bodyAttrs['class'] .= ' dark-theme';
		}
	}

	public static function onGetPreferences( $user, &$preferences ) {
		HTMLForm::$typeMappings['color'] = HTMLColorField::class;
		if ($user->getOption( SKIN_CHOICE_PREF ) !== 'scratchwikiskin2') return true;
		$origpref = $user->getOption( HEADER_COLOR_PREF );
		$preferences[HEADER_COLOR_PREF] = [
			'type' => 'color',
			'pattern' => '#[0-9A-Za-z]{6}',
			'label-message' => 'scratchwikiskin-pref-color',
			'section' => 'rendering/skin',
			'default' => ($origpref ?: '#7953c4'),
		];
		$preferences[DARK_THEME_PREF] = [
			'type' => 'check',
			'label-message' => 'scratchwikiskin-pref-dark',
			'section' => 'rendering/skin',
		];
		return true;
	}
}

