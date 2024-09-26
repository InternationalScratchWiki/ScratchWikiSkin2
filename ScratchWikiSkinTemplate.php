<?php
/**
 * BaseTemplate class for ScratchWikiSkin
 *
 * @file
 * @ingroup Skins
 */

use MediaWiki\MediaWikiServices;

require_once __DIR__ . '/consts.php';

class ScratchWikiSkinTemplate extends BaseTemplate {
	public function execute() {
		global $wgRightsPage, $wgRightsUrl, $wgRightsIcon, $wgRightsText, $wgLang, $wgSWS2JoinBox;
		$user = RequestContext::getMain()->getUser();
		$pre139 = version_compare( MW_VERSION, '1.39', '<' );

		if ( $pre139 ) {
			$this->html('headelement');
		}
		$userOptionsLookup = MediaWikiServices::getInstance()->getUserOptionsLookup();
		$colorPref = $userOptionsLookup->getOption( $user, HEADER_COLOR_PREF );
		$darkPref = $userOptionsLookup->getOption( $user, DARK_THEME_PREF );
		?>
<style>
/* Styling generated by PHP file rather than main.css */
#navigation, .dropdown {
	background-color: <?=htmlspecialchars(str_replace([';', '}'], '', $colorPref))?>;
}
</style>
<?php
$logos = MediaWiki\ResourceLoader\SkinModule::getAvailableLogos( $this->getSkin()->getConfig() );
$wordmark = $logos['wordmark']['src'] ?? $this->get('stylepath') . '/' . $this->getSkin()->stylename . '/resources/Scratch-logo-sm.png';
$wordmarkW = $logos['wordmark']['width'] ?? 76;
$wordmarkH = $logos['wordmark']['height'] ?? 28;
?>
<div id="navigation" role="banner">
	<div class="inner">
		<ul>
			<li class="link"><a class="jump-to" href="#logo" tabindex="0"><span><?=wfMessage('scratchwikiskin-jump-to-sidebar')->escaped()?></span></a></li>
			<li class="link"><a class="jump-to" href="#firstHeading" tabindex="1"><span><?=wfMessage('scratchwikiskin-jump-to-content')->escaped()?></span></a></li>
			<li class="sidebar-toggle"><a></a></li>
			<li class="logo"><a aria-label="Scratch" href="https://scratch.mit.edu/">
				<img alt="<?=wfMessage('sitetitle')->inContentLanguage()->escaped()?>" src="<?=htmlspecialchars($wordmark) ?>" height="<?= $wordmarkH ?>" width="<?= $wordmarkW ?>">
			</a></li>
			<li class="link create">
				<a class="dropdown-toggle" href="https://scratch.mit.edu/projects/editor/"><span><?=wfMessage('scratchwikiskin-create')->inLanguage( $wgLang )->escaped()?></span></a>
				<ul class="dropdown">
					<li><a href="https://scratch.mit.edu/projects/editor/"><span><?=wfMessage( 'scratchwikiskin-create-project' )->inLanguage( $wgLang )->escaped() ?></span></a></li>
					<li><a href="<?=Title::newFromText(wfMessage('scratchwikiskin-create-page-url')->inContentLanguage()->text())->getLinkURL()?>"><span><?=wfMessage('scratchwikiskin-create-page')->inLanguage( $wgLang )->escaped()?></span></a></li>
				</ul>
			</li>
			<li class="link explore">
				<a class="dropdown-toggle" href="https://scratch.mit.edu/explore/projects/all"><span><?=wfMessage('scratchwikiskin-explore')->inLanguage( $wgLang )->escaped()?></span></a>
				<ul class="dropdown">
					<li><a href="https://scratch.mit.edu/explore/projects/all"><span><?=wfMessage( 'scratchwikiskin-explore-projects' )->inLanguage( $wgLang )->escaped() ?></span></a></li>
					<li><a href="<?=Title::newFromText(wfMessage('randompage-url')->inContentLanguage()->text())->getLinkURL()?>"><span><?=wfMessage('randompage')->inLanguage( $wgLang )->escaped()?></span></a></li>
				</ul>
			</li>
			<li class="link discuss">
				<a class="dropdown-toggle" href="https://scratch.mit.edu/discuss"><span><?=wfMessage('scratchwikiskin-discuss')->inLanguage( $wgLang )->escaped()?></span></a>
				<ul class="dropdown">
					<li><a href="https://scratch.mit.edu/discuss"><span><?=wfMessage( 'scratchwikiskin-discuss-text' )->inLanguage( $wgLang )->escaped() ?></span></a></li>
					<li><a href="<?=wfMessage('scratchwikiskin-discuss-wiki')->inLanguage( $wgLang )->escaped()?>"><span><?=wfMessage('scratchwikiskin-discuss-wiki-text')->inLanguage( $wgLang )->escaped()?></span></a></li>
					<li><a href="<?=Title::newFromText(wfMessage('portal-url')->inContentLanguage()->text())->getLinkURL()?>"><span><?=wfMessage('portal')->inLanguage( $wgLang )->escaped()?></span></a></li>
				</ul>
			</li>
			<li class="link tips">
				<a class="dropdown-toggle" href="https://scratch.mit.edu/ideas"><span><?=wfMessage('scratchwikiskin-ideas')->inLanguage( $wgLang )->escaped()?></span></a>
				<ul class="dropdown">
					<li><a href="https://scratch.mit.edu/ideas"><span><?=wfMessage( 'scratchwikiskin-ideas-text' )->inLanguage( $wgLang )->escaped() ?></span></a></li>
					<li><a href="<?=Title::newFromText(wfMessage('scratchwikiskin-faq-page-url')->inContentLanguage()->text())->getLinkURL()?>"><span><?=wfMessage('scratchwikiskin-faq-page')->inLanguage( $wgLang )->escaped()?></span></a></li>
				</ul>
			</li>
			<li class="link about">
				<a class="dropdown-toggle" href="https://scratch.mit.edu/about"><span><?=wfMessage('scratchwikiskin-about')->inLanguage( $wgLang )->escaped()?></span></a>
				<ul class="dropdown">
					<li><a href="https://scratch.mit.edu/about"><span><?=wfMessage( 'scratchwikiskin-about-text' )->inLanguage( $wgLang )->escaped() ?></span></a></li>
					<li><a href="<?=Title::newFromText(wfMessage('aboutpage')->inContentLanguage()->text())->getLinkURL()?>"><span><?=wfMessage('aboutsite')->inLanguage( $wgLang )->escaped()?></span></a></li>
				</ul>
			</li>
			<li class="search">
				<form class="form" action="<?php $this->text( 'wgScript' ) ?>" role="search" aria-label="<?=wfMessage( 'scratchwikiskin-search' )->inLanguage( $wgLang )->escaped()?>">
					<button class="button btn-search" tabindex="-1"></button>
					<div class="form-group row no-label">
						<div class="col-sm-9">
							<input
								type="text" class="input" id="searchInput"
								accesskey="<?=wfMessage( 'accesskey-search' )->inLanguage( $wgLang )->escaped() ?>"
								title="<?=wfMessage(
									'scratchwikiskin-search-title',
									wfMessage( 'accesskey-search' )->inLanguage( $wgLang )->text()
								)->inLanguage( $wgLang )->escaped()?>"
								name="search" autocomplete="off"
								placeholder="<?=wfMessage( 'scratchwikiskin-search' )->inLanguage( $wgLang )->escaped() ?>"
							/>
							<input type="hidden" value="<?=SpecialPage::getTitleFor( 'Search' )->getPrefixedDBkey()?>" name="title" />
						</div>
					</div>
				</form>
			</li>
<?php
// Start processing dropdown here so we know its output before it saves to the page, and we can use it earlier.
$personalUrls = [];
$echoUnread = 0;
foreach ($this->data['personal_urls'] as $key => $tab) {
	// additional class for non-link items
	if (!array_key_exists('href', $tab)) {
		if (!array_key_exists('class', $tab)) $tab['class'] = [];
		if (is_array($tab['class'])) array_push($tab['class'], 'no-link');
		else $tab['class'] .= ' no-link';
	}
	// treat "You have a new Talk page message" as 1 notification...
	if (array_key_exists('class', $tab) && is_array($tab['class']) && in_array('mw-echo-alert', $tab['class'])) {
		// ...if not already counted
		if ($echoUnread === 0) $echoUnread = 1;
		continue; // don't include the item in personal URLs
	}
	// skip other Echo notices
	if (strpos($key, 'notifications') !== false) {
		// get number of Echo notifications
		if ($key === 'notifications-alert') $echoUnread = $tab['data']['counter-num'] ?? $echoUnread;
		continue; // don't include the item in personal URLs
	}
	array_push($personalUrls, $this->getSkin()->makeListItem($key, $tab));
}
// ONLY output this if Echo extension is turned on and user is logged in. Otherwise don't put it there.
if (ExtensionRegistry::getInstance()->isLoaded("Echo") && $user->isRegistered()) { ?>
			<li class="link right messages">
				<a href="<?=SpecialPage::getTitleFor( 'Notifications' )->getLinkURL()?>">
					<span class="<?=$echoUnread > 0 ? 'message-count show' : 'message-count'?>"><?=$echoUnread?></span>
				</a>
			</li>
<?php } ?>
			<li class="link right content-actions">
				<a class="dropdown-toggle" href="?action=edit"><div></div></a>
				<ul class="dropdown">
<?php foreach ($this->data['content_actions'] as $key => $tab) { ?>
					<?=$this->getSkin()->makeListItem($key, $tab)?>
<?php } ?>
				</ul>
			</li>
			<li class="link right account-nav">
				<a class="dropdown-toggle" href="<?php if (!$user->isRegistered()) { ?><?=SpecialPage::getTitleFor( 'UserLogin' )->getLinkURL() ?><?php } else { ?><?=$user->getUserPage()->getLinkURL()?><?php } ?>">
					<span class="profile-name"><?php if (!$user->isRegistered()) { ?><?=wfMessage( 'scratchwikiskin-notloggedin' )->inLanguage( $wgLang )->escaped()?><?php } else { ?><?=htmlspecialchars($user->getName())?><?php } ?></span>
				</a>
				<ul class="dropdown">
				<?=implode($personalUrls)?>
				</ul>
			</li>
		</ul>
	</div>
</div>
<div id="not-nav">
<div id="view">
	<div class="splash">
		<div class="inner mod-splash">
			<div class="left">
				<div class="wikilogo_space"><a id="logo" class="mw-wiki-logo" href="<?=htmlspecialchars($this->data['nav_urls']['mainpage']['href'])?>" title="<?=wfMessage( 'mainpage' )->inLanguage( $wgLang )->escaped()?>"></a></div>
<?php foreach ($this->getSidebar() as $box) { ?>
				<div class="box" role="navigation" aria-label="<?=htmlspecialchars($box['header'])?>">
					<div class="box-header">
						<h4><?=htmlspecialchars($box['header'])?></h4>
					</div>
					<div class="box-content">
<?php if (is_array($box['content'])) { ?>
						<ul>
<?php foreach ($box['content'] as $name => $item) { ?>
							<?=$this->getSkin()->makeListItem($name, $item)?>

<?php } ?>

						</ul>
<?php } else { ?>
						<?=$box['content']?>
<?php } ?>
					</div>
				</div>
<?php }
if (!$user->isRegistered() && $wgSWS2JoinBox) { ?>
				<div class="box" role="complementary" aria-label="<?=wfMessage( 'scratchwikiskin-helpthewiki' )->inLanguage( $wgLang )->escaped()?>">
					<div class="box-header">
						<h4><?=wfMessage( 'scratchwikiskin-helpthewiki' )->inLanguage( $wgLang )->escaped()?></h4>
					</div>
					<div class="box-content">
						<p><?=wfMessage( 'scratchwikiskin-madeforscratchers')->inLanguage( $wgLang )->parse()?></p>
						<p><a href="<?=Title::newFromText(wfMessage( 'scratchwikiskin-becomeacontributor-page' )->inContentLanguage()->text())->getLinkURL()?>"><?=wfMessage( 'scratchwikiskin-learnaboutjoining' )->inLanguage( $wgLang )->escaped()?></a></p>
						<p><a href="<?=Title::newFromText(wfMessage( 'portal-url' )->inContentLanguage()->text())->getLinkURL()?>"><?=wfMessage( 'scratchwikiskin-seeportal' )->inLanguage( $wgLang )->escaped()?></a></p>
					</div>
				</div>
<?php } ?>
			</div>
			<div class="right">
				<?php if ($this->data['newtalk']) { ?><div class="box"><div class="box-header"><h4><?php $this->html('newtalk') ?></h4></div></div><?php } ?>
				<?php if ($this->data['sitenotice']) { ?><div id="siteNotice"><?php $this->html('sitenotice'); ?></div><?php } ?>
				<div class="box">
					<div class="box-header">
						<?=$this->getIndicators()?>
						<h1 id="firstHeading" class="firstHeading"><?php $this->html('title')?></h1>
					</div>
					<div class="box-content" id="content" role="main">
<p id="siteSub"><?=wfMessage( 'tagline' )->inLanguage( $wgLang )->escaped()?></p>
<?php if ($this->data['subtitle']) { ?><p id="contentSub"><?php $this->html('subtitle') ?></p><?php } ?>
<?php if ($this->data['undelete']) { ?><p><?php $this->html('undelete') ?></p><?php } ?>
<?php $this->html('bodytext') ?>
<?php $this->html('dataAfterContent'); ?>
<?php if ($this->data['catlinks']) {
	$this->html( 'catlinks' );
}
$url = wfMessage('scratchwikiskin-discuss-wiki')->inLanguage( $wgLang )->escaped();
$text = wfMessage('scratchwikiskin-discuss-wiki-text')->inLanguage( $wgLang )->escaped();
$link = "<a href=\"$url\" target=\"_blank\">$text</a>";
$line = wfMessage('scratchwikiskin-dark-theme-feedback')->rawParams( $link )->inLanguage( $wgLang )->escaped();
?>
					<div class="feet" style="margin: 0<?=$darkPref ? '' : '; display: none'?>"><?=$line?></div>
					</div>
				</div>
				<ul class="feet">
<?php foreach ( $this->getFooterLinks('flat') as $key ) { ?>
					<li><?php $this->html( $key ) ?></li>
<?php } ?>
					<?php if (!empty( $wgRightsIcon )) { ?>
					<br/>
					<a href="<?=empty( $wgRightsPage ) ? $wgRightsUrl : Title::newFromText( $wgRightsPage )->getLinkURL()?>">
						<img style="float: right" alt="<?=$wgRightsText?>" src="<?=$wgRightsIcon?>">
					</a>
					<?php } ?>
				</ul>
			</div>
		</div>
	</div>
</div>
<div id="footer" role="contentinfo">
	<div class="inner">
		<div class="lists">
			<dl class="about">
				<dt><span><?=wfMessage('scratchwikiskin-footer-about-title')->inLanguage( $wgLang )->escaped()?></span></dt>
<dd><span><a href="https://scratch.mit.edu/about/"><?=wfMessage('scratchwikiskin-footer-about')->inLanguage( $wgLang )->escaped()?></a></span></dd>
<dd><span><a href="<?=Title::newFromText(wfMessage('aboutpage')->inContentLanguage()->text())->getLinkURL()?>"><?=wfMessage('aboutsite')->inLanguage( $wgLang )->escaped()?></a></span></dd>
<dd><span><a href="https://scratch.mit.edu/parents/"><?=wfMessage('scratchwikiskin-footer-parents')->inLanguage( $wgLang )->escaped()?></a></span></dd>
<dd><span><a href="https://scratch.mit.edu/educators/"><?=wfMessage('scratchwikiskin-footer-educators')->inLanguage( $wgLang )->escaped()?></a></span></dd>
<dd><span><a href="https://scratch.mit.edu/developers/"><?=wfMessage('scratchwikiskin-footer-developers')->inLanguage( $wgLang )->escaped()?></a></span></dd>
<dd><span><a href="https://scratch.mit.edu/credits"><?=wfMessage('scratchwikiskin-footer-credits')->inLanguage( $wgLang )->escaped()?></a></span></dd>
<dd><span><a href="https://www.scratchfoundation.org/supporters"><?=wfMessage('scratchwikiskin-footer-donors')->inLanguage( $wgLang )->escaped()?></a></span></dd>
<dd><span><a href="https://www.scratchfoundation.org/careers"><?=wfMessage('scratchwikiskin-footer-jobs')->inLanguage( $wgLang )->escaped()?></a></span></dd>
<dd><span><a href="https://www.scratchfoundation.org/donate"><?=wfMessage('scratchwikiskin-footer-donate')->inLanguage( $wgLang )->escaped()?></a></span></dd>
			</dl>
			<dl class="community">
				<dt><span><?=wfMessage('scratchwikiskin-footer-community-title')->inLanguage( $wgLang )->escaped()?></span></dt>
<dd><span><a href="https://scratch.mit.edu/community_guidelines"><?=wfMessage('scratchwikiskin-footer-cgs')->inLanguage( $wgLang )->escaped()?></a></span></dd>
<dd><span><a href="https://scratch.mit.edu/discuss/"><?=wfMessage('scratchwikiskin-footer-discuss')->inLanguage( $wgLang )->escaped()?></a></span></dd>
<dd><span><a href="https://en.scratch-wiki.info"><?=wfMessage('scratchwikiskin-footer-wiki')->inLanguage( $wgLang )->escaped()?></a></span></dd>
<dd><span><a href="https://scratch.mit.edu/statistics/"><?=wfMessage('scratchwikiskin-footer-stats')->inLanguage( $wgLang )->escaped()?></a></span></dd>
<dd><span><a href="<?=Title::newFromText(wfMessage('portal-url')->inContentLanguage()->text())->getLinkURL()?>"><?=wfMessage('portal')->inLanguage( $wgLang )->escaped()?></a></span></dd>
			</dl>
			<dl class="support">
				<dt><span><?=wfMessage('scratchwikiskin-footer-resources-title')->inLanguage( $wgLang )->escaped()?></span></dt>
<dd><span><a href="<?=Title::newFromText(wfMessage('scratchwikiskin-footer-help-page-url')->inContentLanguage()->text())->getLinkURL()?>"><?=wfMessage('scratchwikiskin-footer-help')->inLanguage( $wgLang )->escaped()?></a></span></dd>
<dd><span><a href="https://scratch.mit.edu/ideas"><?=wfMessage('scratchwikiskin-footer-ideas')->inLanguage( $wgLang )->escaped()?></a></span></dd>
<dd><span><a href="<?=Title::newFromText(wfMessage('scratchwikiskin-faq-page-url')->inContentLanguage()->text())->getLinkURL()?>"><?=wfMessage('scratchwikiskin-faq-page')->inLanguage( $wgLang )->escaped()?></a></span></dd>
<dd><span><a href="https://scratch.mit.edu/download"><?=wfMessage('scratchwikiskin-footer-offline')->inLanguage( $wgLang )->escaped()?></a></span></dd>
			</dl>
			<dl class="legal">
				<dt><span><?=wfMessage('scratchwikiskin-footer-legal-title')->inLanguage( $wgLang )->escaped()?></span></dt>
<dd><span><a href="<?=Title::newFromText(wfMessage('privacypage')->inContentLanguage()->text())->getLinkURL()?>"><?=wfMessage('privacy')->inLanguage( $wgLang )->escaped()?></a></span></dd>
<dd><span><a href="<?=Title::newFromText(wfMessage('disclaimerpage')->inContentLanguage()->text())->getLinkURL()?>"><?=wfMessage('disclaimers')->inLanguage( $wgLang )->escaped()?></a></span></dd>
			</dl>
			<dl class="family">
				<dt><span><?=wfMessage('scratchwikiskin-footer-family-title')->inLanguage( $wgLang )->escaped()?></span></dt>
<dd><span><a href="https://scratch.mit.edu"><?=wfMessage('scratchwikiskin-footer-scratchsite')->inLanguage( $wgLang )->escaped()?></a></span></dd>
<dd><span><a href="https://scratched.gse.harvard.edu"><?=wfMessage('scratchwikiskin-footer-scratched')->inLanguage( $wgLang )->escaped()?></a></span></dd>
<dd><span><a href="https://www.scratchjr.org"><?=wfMessage('scratchwikiskin-footer-scratchjr')->inLanguage( $wgLang )->escaped()?></a></span></dd>
<dd><span><a href="https://day.scratch.mit.edu"><?=wfMessage('scratchwikiskin-footer-scratchday')->inLanguage( $wgLang )->escaped()?></a></span></dd>
<dd><span><a href="https://scratch.mit.edu/conference"><?=wfMessage('scratchwikiskin-footer-conference')->inLanguage( $wgLang )->escaped()?></a></span></dd>
<dd><span><a href="https://www.scratchfoundation.org"><?=wfMessage('scratchwikiskin-footer-foundation')->inLanguage( $wgLang )->escaped()?></a></span></dd>
<dd><span><a href="https://scratch.mit.edu/store"><?=wfMessage('scratchwikiskin-footer-store')->inLanguage( $wgLang )->escaped()?></a></span></dd>
			</dl>
		</div>
	</div>
</div><?php if (date('m j') == '04 1') { ?><div style="background-color:white;color:black">;</div><?php } ?>
</div>
<script>
/*
ScratchWikiSkin script
*/

//get an element from a query selector, with functions to write, add, show, hide, addclass, delclass
function mod(el) {
	if (!el) return el;
	el.addclass = function(c) {this.classList.add(c);};
	el.delclass = function(c) {this.classList.remove(c);};
	el.hasclass = function(c) {return this.classList.contains(c);};
	return el;
}
var body = mod(document.body);
/* if (
	window.matchMedia
	&& window.matchMedia('(prefers-color-scheme: dark)').matches
	&& !body.hasclass('dark-theme')
) {
	body.addclass('dark-theme');
	document.querySelector('div.feet').style.display = '';
} */
(function () {
	let selected = document.querySelectorAll('#navigation a.dropdown-toggle');
	for (var i = 0; i < selected.length; i++) {
		let btn = selected[i];
		let dropdown = btn.nextElementSibling;
		mod(btn);
		mod(dropdown);
		btn.removeAttribute('href');
		btn.onclick = function(){
			if (!dropdown.classList.contains('open')) {
				btn.addclass('open');
				dropdown.addclass('open');
			} else {
				btn.delclass('open');
				dropdown.delclass('open');
			}
		};
		btn.parentElement.onmouseout = function(e) {
			if (!e) e = window.event;
			if (!e.toElement) e.toElement = e.relatedTarget;
			if (!e.toElement) return;
			if (
				!btn.parentElement.contains(e.toElement)
				&& !document.querySelector('.suggestions')?.contains(e.toElement)
			) {
				if (btn.hasclass('open')) {
					if (e.toElement.matches('#navigation .link:not([class~=messages]), #navigation .link>a.dropdown-toggle, #navigation .link>a.dropdown-toggle *')) {
						e.toElement.click();
					}
				}
				btn.delclass('open');
				dropdown.delclass('open');
			}
		};
	};
})();
var searchExpanded = false;
document.querySelector('#searchInput').onfocus = function () {
	let selected = document.querySelectorAll('#navigation .link');
	for (var i = 0; i < selected.length; i++) {
		let link = selected[i];
		if (!link.classList.contains('right')) {
			link.style.display = 'none';
		}
	}
	searchExpanded = true;
};
window.addEventListener('click', function (e) {
	if (!searchExpanded) return;
	if (document.querySelector('#navigation .search').contains(e.target)) return;
	let selected = document.querySelectorAll('#navigation .link');
	for (var i = 0; i < selected.length; i++) {
		let link = selected[i];
		if (!link.classList.contains('right')) {
			link.style.display = '';
		}
	}
	searchExpanded = false;
});

var sidebarShown = false;
var sidebarToggle = document.querySelector('#navigation .sidebar-toggle')

function toggleSidebar(e) {
	e.stopPropagation();

	if (getComputedStyle(sidebarToggle).display === 'none') return;

	const left = document.querySelector('#view .inner .left');
	const notNav = document.querySelector('#not-nav');

	if (!sidebarShown) {
		// show sidebar and enable non-nav close listener
		left.style.left = '0';
		notNav.addEventListener('click', toggleSidebar);
	} else {
		// ignore clicks in the sidebar itself
		if (left.contains(e.target)) return;
		// hide sidebar and disable non-nav close listener
		e.preventDefault();
		left.style.left = null;
		notNav.removeEventListener('click', toggleSidebar);
	}
	sidebarShown = !sidebarShown;
}

sidebarToggle.addEventListener('click', toggleSidebar);

</script>

<?php
		if ( $pre139 ) {
			$this->printTrail();
		}
	}
}
