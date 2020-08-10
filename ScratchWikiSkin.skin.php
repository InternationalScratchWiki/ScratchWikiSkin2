<?php
/**
 * SkinTemplate class for ScratchWikiSkin
 *
 * @file
 * @ingroup Skins
 */

define('SKIN_CHOICE_PREF', 'skin');
define('DARK_THEME_PREF', 'scratchwikiskin-dark-theme');
define('DARK_THEME_HEADER', 'scratchwikiskin-dark-header');
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
    var $skinname = 'scratchwikiskin2',
        $stylename = 'ScratchWikiSkin',
        $template = 'ScratchWikiSkinTemplate',
        $useHeadElement = true;

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
        $time = false;
        switch ($wgUser->getOption( DARK_THEME_PREF )) {
            case 'on':
                $bodyAttrs['class'] .= ' dark-theme';
                break;
            case 'system':
                $bodyAttrs['class'] .= ' system-dark-theme';
                break;
            case 'time':
                $bodyAttrs['class'] .= !$time ?: ' dark-theme';
                break;
        }
	}

	public static function onGetPreferences( $user, &$preferences ) {
		HTMLForm::$typeMappings['color'] = HTMLColorField::class;
		if ($user->getOption( SKIN_CHOICE_PREF ) !== 'scratchwikiskin2') return true;

        /**
         * Header color setting
         */
		$preferences[HEADER_COLOR_PREF] = [
			'type' => 'color',
			'pattern' => '#[0-9A-Za-z]{6}',
			'label-message' => 'scratchwikiskin-pref-color',
			'section' => 'rendering/skin',
			'default' => $user->getOption( HEADER_COLOR_PREF ) ?: '#7953c4',
        ];
        
        /**
         * Dark mode enabled setting
         */
		$preferences[DARK_THEME_PREF] = [
			'type' => 'radio',
			'label-message' => 'scratchwikiskin-pref-dark',
            'section' => 'rendering/skin',
            'options' => [
                'Always On' => 'on',
                'Always Off' => 'off',
                'Automatic (Based on system preferences)' => 'system',
                //'Automatic (Based on time of the day)' => 'time', // disabled for now, can't get the user's local time
            ],
            'default' => $user->getOption( DARK_THEME_PREF ) ?: 'time',
        ];

        /**
         * Header color with dark mode setting
         */
        $preferences[DARK_THEME_HEADER] = [
			'type' => 'check',
			'label-message' => 'scratchwikiskin-pref-dark-header',
            'section' => 'rendering/skin',
            'default' => $user->getOption( DARK_THEME_HEADER ) ?: false,
		];
        
		return true;
	}
}
