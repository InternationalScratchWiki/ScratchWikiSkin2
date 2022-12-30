<?php

use MediaWiki\Hook\OutputPageBodyAttributesHook;
use MediaWiki\Preferences\Hook\GetPreferencesHook;
use MediaWiki\MediaWikiServices;

require_once __DIR__ . '/consts.php';

class HTMLColorField extends HTMLFormField {

    public function getInputHTML($value) {

        $attribs = [
            'id' => $this->mID,
            'name' => $this->mName,
            'value' => $value,
            'dir' => $this->mDir,
            'pattern' => '#[0-9A-Fa-f]{6}',
        ];

        if ($this->mClass !== '') {
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

        $attribs += $this->getAttributes($allowedParams);
        return Html::input($this->mName, $value, 'color', $attribs);
    }

    public function validate($value, $alldata) {
        if (preg_match('%^#[a-fA-F0-9]{6}$%', $value) === 0) {
            return $this->msg('htmlform-invalid-input');
        }
        return parent::validate($value, $alldata);
    }
}

class ScratchWikiSkinHooks implements OutputPageBodyAttributesHook, GetPreferencesHook {
    public function onOutputPageBodyAttributes($out, $sk, &$bodyAttrs): void {
        global $wgSWS2ForceDarkTheme;
        $user = RequestContext::getMain()->getUser();
        $userOptionsLookup = MediaWikiServices::getInstance()->getUserOptionsLookup();
        if ($userOptionsLookup->getOption($user, DARK_THEME_PREF) || $wgSWS2ForceDarkTheme) {
            $bodyAttrs['class'] .= ' dark-theme';
        }
    }

    public function onGetPreferences($user, &$preferences) {
        HTMLForm::$typeMappings['color'] = HTMLColorField::class;
        $userOptionsLookup = MediaWikiServices::getInstance()->getUserOptionsLookup();
        $origpref = $userOptionsLookup->getOption($user, HEADER_COLOR_PREF);
        $preferences[HEADER_COLOR_PREF] = [
            'type' => 'color',
            'pattern' => '#[0-9A-Fa-f]{6}',
            'label-message' => 'scratchwikiskin-pref-color',
            'section' => 'rendering/skin',
            // Only expose background color preference when the skin is selected
            'default' => ($origpref ? $origpref : '#7953c4'),
            'hide-if' => ['!==', 'wpskin', 'scratchwikiskin2'],
        ];
        $preferences[DARK_THEME_PREF] = [
            'type' => 'check',
            'label-message' => 'scratchwikiskin-pref-dark',
            'section' => 'rendering/skin',
            'hide-if' => ['!==', 'wpskin', 'scratchwikiskin2'],
        ];
    }
}
