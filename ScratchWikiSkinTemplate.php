<?php
/**
 * BaseTemplate class for ScratchWikiSkin
 *
 * @file
 * @ingroup Skins
 */

class ScratchWikiSkinTemplate extends BaseTemplate {
	public function execute() {
		global $wgRequest, $wgStylePath, $wgUser, $wgLogo, $wgRightsPage, $wgRightsUrl, $wgRightsIcon, $wgRightsText, $wgLang;
		$skin = $this->data['skin'];
		wfSuppressWarnings();
		$this->html('headelement');
		?>
<style>
/* Styling generated by PHP file rather than main.css */
.wikilogo {
	background-image: url(<?=$wgLogo?>);
}
#navigation, .dropdown {
	background-color: <?=htmlspecialchars(str_replace([';', '}'], '', $wgUser->getOption( 'scratchwikiskin-header-color' )))?>;
}
</style>
<div id="navigation">
	<div class="inner">
		<ul>
			<li class="logo"><a aria-label="Scratch" href="https://scratch.mit.edu/"></a></li>
			<li class="link create">
				<a class="dropdown-toggle"><span><?=wfMessage('scratchwikiskin-create')->inLanguage( $wgLang )->escaped()?></span></a>
				<ul class="dropdown">
					<li><a href="https://scratch.mit.edu/projects/editor/"><span><?=wfMessage( 'scratchwikiskin-create-project' )->inLanguage( $wgLang )->escaped() ?></span></a></li>
					<li><a href="<?=Title::newFromText(wfMessage('scratchwikiskin-create-page-url')->inContentLanguage()->text())->getLocalURL()?>"><span><?=wfMessage('scratchwikiskin-create-page')->inLanguage( $wgLang )->escaped()?></span></a></li>
				</ul>
			</li>
			<li class="link explore">
				<a class="dropdown-toggle"><span><?=wfMessage('scratchwikiskin-explore')->inLanguage( $wgLang )->escaped()?></span></a>
				<ul class="dropdown">
					<li><a href="https://scratch.mit.edu/explore/projects/all"><span><?=wfMessage( 'scratchwikiskin-explore-projects' )->inLanguage( $wgLang )->escaped() ?></span></a></li>
					<li><a href="<?=Title::newFromText(wfMessage('randompage-url')->inContentLanguage()->text())->getLocalURL()?>"><span><?=wfMessage('randompage')->inLanguage( $wgLang )->escaped()?></span></a></li>
				</ul>
			</li>
			<li class="link discuss">
				<a class="dropdown-toggle"><span><?=wfMessage('scratchwikiskin-discuss')->inLanguage( $wgLang )->escaped()?></span></a>
				<ul class="dropdown">
					<li><a href="https://scratch.mit.edu/discuss"><span><?=wfMessage( 'scratchwikiskin-discuss-text' )->inLanguage( $wgLang )->escaped() ?></span></a></li>
					<li><a href="<?=wfMessage('scratchwikiskin-discuss-wiki')->inLanguage( $wgLang )->escaped()?>"><span><?=wfMessage('scratchwikiskin-discuss-wiki-text')->inLanguage( $wgLang )->escaped()?></span></a></li>
					<li><a href="<?=Title::newFromText(wfMessage('portal-url')->inContentLanguage()->text())->getLocalURL()?>"><span><?=wfMessage('portal')->inLanguage( $wgLang )->escaped()?></span></a></li>
				</ul>
			</li>
			<li class="link tips">
				<a class="dropdown-toggle"><span><?=wfMessage('scratchwikiskin-tips')->inLanguage( $wgLang )->escaped()?></span></a>
				<ul class="dropdown">
					<li><a href="https://scratch.mit.edu/tips"><span><?=wfMessage( 'scratchwikiskin-tips-text' )->inLanguage( $wgLang )->escaped() ?></span></a></li>
					<li><a href="<?=Title::newFromText(wfMessage('scratchwikiskin-faq-page-url')->inContentLanguage()->text())->getLocalURL()?>"><span><?=wfMessage('scratchwikiskin-faq-page')->inLanguage( $wgLang )->escaped()?></span></a></li>
				</ul>
			</li>
			<li class="link about">
				<a class="dropdown-toggle"><span><?=wfMessage('scratchwikiskin-about')->inLanguage( $wgLang )->escaped()?></span></a>
				<ul class="dropdown">
					<li><a href="https://scratch.mit.edu/about"><span><?=wfMessage( 'scratchwikiskin-about-text' )->inLanguage( $wgLang )->escaped() ?></span></a></li>
					<li><a href="<?=Title::newFromText(wfMessage('aboutpage')->inContentLanguage()->text())->getLocalURL()?>"><span><?=wfMessage('aboutsite')->inLanguage( $wgLang )->escaped()?></span></a></li>
				</ul>
			</li>
			<li class="search">
				<form class="form" action="<?php $this->text( 'wgScript' ) ?>">
					<button class="button btn-search"></button>
					<div class="form-group row no-label">
						<div class="col-sm-9">
							<input type="text" class="input" id="searchInput" accesskey="<?=wfMessage( 'accesskey-search' )->inLanguage( $wgLang )->text() ?>" title="Search Scratch Wiki [alt-shift-<?=wfMessage( 'accesskey-search' )->inLanguage( $wgLang )->text()?>]" name="search" autocomplete="off" placeholder="<?=wfMessage( 'scratchwikiskin-search' )->inLanguage( $wgLang )->escaped() ?>" />
							<input type="hidden" value="Special:Search" name="title" />
							<span class="help-block">Not Required</span>
						</div>
					</div>
				</form>
			</li>
			<li class="link right content-actions">
				<a class="dropdown-toggle"></a>
				<ul class="dropdown">
<?php foreach ($this->data['content_actions'] as $key => $tab) { ?>
					<?=$this->makeListItem($key, $tab)?>

<?php } ?>

				</ul>
			</li>
			<li class="link right account-nav">
				<a class="dropdown-toggle">
					<span class="profile-name"><?php if (!$wgUser->isLoggedIn()) { ?><?=wfMessage( 'scratchwikiskin-notloggedin' )->inLanguage( $wgLang )->escaped()?><?php } else { ?><?=htmlspecialchars($wgUser->mName)?><?php } ?></span>
				</a>
				<ul class="dropdown">
<?php foreach ($this->data['personal_urls'] as $key => $tab) { ?>
					<?=$this->makeListItem($key, $tab)?>

<?php } ?>

				</ul>
			</li>
		</ul>
	</div>
</div>
<div id="view">
	<div class="splash">
		<div class="inner mod-splash">
			<div class="left">
				<div class="wikilogo_space"><a class="wikilogo" href="<?=htmlspecialchars($this->data['nav_urls']['mainpage']['href'])?>" title="<?=wfMessage( 'mainpage' )->inLanguage( $wgLang )->escaped()?>"></a></div>
<?php foreach ($this->getSidebar() as $box) {
	if ($box['header'] != 'Toolbox' || $wgUser->isLoggedIn()) { ?>
				<div class="box">
					<div class="box-header">
						<h4><?=htmlspecialchars($box['header'])?></h4>
					</div>
					<div class="box-content">
<?php if (is_array($box['content'])) { ?>
						<ul>
<?php foreach ($box['content'] as $name => $item) { ?>
							<?=$this->makeListItem($name, $item)?>

<?php } ?>

						</ul>
<?php } else { ?>
						<?=$box['content']?>
<?php } ?>
					</div>
				</div>
<?php }
}
if (!$wgUser->isLoggedIn()) { ?>
				<div class="box">
					<div class="box-header">
						<h4><?=wfMessage( 'scratchwikiskin-helpthewiki' )->inLanguage( $wgLang )->escaped()?></h4>
					</div>
					<div class="box-content">
						<p><?=wfMessage( 'scratchwikiskin-madeforscratchers')->inLanguage( $wgLang )->parse()?></p>
						<p><a href="<?php echo Title::newFromText(wfMessage( 'scratchwikiskin-becomeacontributor-page' )->inContentLanguage()->text())->getLocalURL();?>"><?=wfMessage( 'scratchwikiskin-learnaboutjoining' )->inLanguage( $wgLang )->escaped()?></a></p>
						<p><a href="<?php echo Title::newFromText(wfMessage( 'portal-url' )->inContentLanguage()->text())->getLocalURL();?>"><?=wfMessage( 'scratchwikiskin-seeportal' )->inLanguage( $wgLang )->escaped()?></a></p>
					</div>
				</div>
<?php } ?>
			</div>
			<div class="right">
				<?php if ($this->data['newtalk']) { ?><div class="box"><div class="box-header"><h4><?php $this->html('newtalk') ?></h4></div></div><?php } ?>
				<?php if ($this->data['sitenotice']) { ?><div id="siteNotice"><?php $this->html('sitenotice'); ?></div><?php } ?>
				<div class="box">
					<div class="box-header">
						<h1 id="firstHeading" class="firstHeading"><?php $this->html('title')?><?=$this->getIndicators()?></h1>
					</div>
					<div class="box-content" id="content">
<p id="siteSub"><?=wfMessage( 'tagline' )->inLanguage( $wgLang )->escaped()?></p>
<?php if ($this->data['subtitle']) { ?><p id="contentSub"><?php $this->html('subtitle') ?></p><?php } ?>
<?php if ($this->data['undelete']) { ?><p><?php $this->html('undelete') ?></p><?php } ?>
<?php $this->html('bodytext') ?>
<?php $this->html('dataAfterContent'); ?>
<?php if ($this->data['catlinks']) {
	$this->html( 'catlinks' );
} ?>
					</div>
				</div>
				<ul id="feet">
<?php foreach ( $this->getFooterLinks('flat') as $key ) { ?>
					<li><?php $this->html( $key ) ?></li>
<?php } ?>
					<?php if (!empty( $wgRightsIcon )) { ?>
					<br/>
					<a href="<?php
					if (!empty( $wgRightsPage )) {
						echo Title::newFromText( $wgRightsPage )->getLocalURL();
					} else {
						echo $wgRightsUrl;
					}
					?>">
						<img style="float: right" alt="<?=$wgRightsText?>" src="<?=$wgRightsIcon?>">
					</a>
					<?php } ?>
				</ul>
			</div>
		</div>
	</div>
</div>
<div id="footer">
	<div class="inner">
		<div class="lists">
			<dl>
				<dt><span><?=wfMessage('scratchwikiskin-footer-about-title')->inLanguage( $wgLang )->escaped()?></span></dt>
<dd><span><a href="https://scratch.mit.edu/about/"><?=wfMessage('scratchwikiskin-footer-about')->inLanguage( $wgLang )->escaped()?></a></span></dd>
<dd><span><a href="https://scratch.mit.edu/parents/"><?=wfMessage('scratchwikiskin-footer-parents')->inLanguage( $wgLang )->escaped()?></a></span></dd>
<dd><span><a href="https://scratch.mit.edu/educators/"><?=wfMessage('scratchwikiskin-footer-educators')->inLanguage( $wgLang )->escaped()?></a></span></dd>
<dd><span><a href="https://scratch.mit.edu/developers/"><?=wfMessage('scratchwikiskin-footer-developers')->inLanguage( $wgLang )->escaped()?></a></span></dd>
<dd><span><a href="https://scratch.mit.edu/info/credits"><?=wfMessage('scratchwikiskin-footer-credits')->inLanguage( $wgLang )->escaped()?></a></span></dd>
<dd><span><a href="https://scratch.mit.edu/jobs"><?=wfMessage('scratchwikiskin-footer-jobs')->inLanguage( $wgLang )->escaped()?></a></span></dd>
<dd><span><a href="https://en.scratch-wiki.info/wiki/Scratch_Press"><?=wfMessage('scratchwikiskin-footer-press')->inLanguage( $wgLang )->escaped()?></a></span></dd>
			</dl>
			<dl>
				<dt><span><?=wfMessage('scratchwikiskin-footer-community-title')->inLanguage( $wgLang )->escaped()?></span></dt>
<dd><span><a href="https://scratch.mit.edu/community_guidelines"><?=wfMessage('scratchwikiskin-footer-cgs')->inLanguage( $wgLang )->escaped()?></a></span></dd>
<dd><span><a href="https://scratch.mit.edu/discuss/"><?=wfMessage('scratchwikiskin-footer-discuss')->inLanguage( $wgLang )->escaped()?></a></span></dd>
<dd><span><a href="https://en.scratch-wiki.info"><?=wfMessage('scratchwikiskin-footer-wiki')->inLanguage( $wgLang )->escaped()?></a></span></dd>
<dd><span><a href="https://scratch.mit.edu/statistics/"><?=wfMessage('scratchwikiskin-footer-stats')->inLanguage( $wgLang )->escaped()?></a></span></dd>
			</dl>
			<dl>
				<dt><span><?=wfMessage('scratchwikiskin-footer-support-title')->inLanguage( $wgLang )->escaped()?></span></dt>
<dd><span><a href="https://scratch.mit.edu/tips"><?=wfMessage('scratchwikiskin-footer-tips')->inLanguage( $wgLang )->escaped()?></a></span></dd>
<dd><span><a href="https://scratch.mit.edu/info/faq"><?=wfMessage('scratchwikiskin-footer-faq')->inLanguage( $wgLang )->escaped()?></a></span></dd>
<dd><span><a href="https://scratch.mit.edu/download"><?=wfMessage('scratchwikiskin-footer-offline')->inLanguage( $wgLang )->escaped()?></a></span></dd>
<dd><span><a href="https://scratch.mit.edu/contact-us"><?=wfMessage('scratchwikiskin-footer-contact')->inLanguage( $wgLang )->escaped()?></a></span></dd>
<dd><span><a href="https://scratch.mit.edu/store"><?=wfMessage('scratchwikiskin-footer-store')->inLanguage( $wgLang )->escaped()?></a></span></dd>
<dd><span><a href="https://secure.donationpay.org/scratchfoundation/"><?=wfMessage('scratchwikiskin-footer-donate')->inLanguage( $wgLang )->escaped()?></a></span></dd>
			</dl>
			<dl>
				<dt><span><?=wfMessage('scratchwikiskin-footer-legal-title')->inLanguage( $wgLang )->escaped()?></span></dt>
<dd><span><a href="https://scratch.mit.edu/terms_of_use"><?=wfMessage('scratchwikiskin-footer-tos')->inLanguage( $wgLang )->escaped()?></a></span></dd>
<dd><span><a href="https://scratch.mit.edu/privacy_policy"><?=wfMessage('scratchwikiskin-footer-privacy')->inLanguage( $wgLang )->escaped()?></a></span></dd>
<dd><span><a href="https://scratch.mit.edu/DMCA"><?=wfMessage('scratchwikiskin-footer-dmca')->inLanguage( $wgLang )->escaped()?></a></span></dd>
			</dl>
			<dl>
				<dt><span><?=wfMessage('scratchwikiskin-footer-family-title')->inLanguage( $wgLang )->escaped()?></span></dt>
<dd><span><a href="http://scratched.gse.harvard.edu"><?=wfMessage('scratchwikiskin-footer-scratched')->inLanguage( $wgLang )->escaped()?></a></span></dd>
<dd><span><a href="https://www.scratchjr.org"><?=wfMessage('scratchwikiskin-footer-scratchjr')->inLanguage( $wgLang )->escaped()?></a></span></dd>
<dd><span><a href="https://day.scratch.mit.edu"><?=wfMessage('scratchwikiskin-footer-scratchday')->inLanguage( $wgLang )->escaped()?></a></span></dd>
<dd><span><a href="https://scratch.mit.edu/conference"><?=wfMessage('scratchwikiskin-footer-conference')->inLanguage( $wgLang )->escaped()?></a></span></dd>
<dd><span><a href="https://www.scratchfoundation.org"><?=wfMessage('scratchwikiskin-footer-foundation')->inLanguage( $wgLang )->escaped()?></a></span></dd>
			</dl>
		</div>
		<div class="copyright">
			<p><span><?=wfMessage('scratchwikiskin-footer-llk')->inLanguage( $wgLang )->parse()?></span></p>
		</div>
	</div>
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
}

window.addEventListener('load', function(){
	(function(){
		var nameColon = decodeURIComponent(document.URL);
		if (document.domain != "en.scratch-wiki.info" || mw.config.get("wgPageName") != "Special:Search") return;
		if (nameColon.toLowerCase().indexOf("%3a") > -1) {
			nameColon = nameColon.replace("%3A", ":").replace("%3a", ":");
			window.location.href = nameColon;
		}
	})()
        for (let btn of document.querySelectorAll('#navigation a.dropdown-toggle')) {
                let dropdown = btn.nextElementSibling;
                mod(btn);
                mod(dropdown);
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
                        if (!btn.parentElement.contains(e.toElement)) {
                                if (btn.hasclass('open')) {
                                        if (e.toElement.matches('#navigation .link, #navigation .link>a, #navigation .link>a *')) {
                                                e.toElement.click();
                                        }
                                }
                                btn.delclass('open');
                                dropdown.delclass('open');
                        }
                };
        };
        if (document.querySelector(':target') !== null) {
                window.scrollBy(0, -50);
        };
        document.querySelector('#searchInput').onfocus = function () {
                for (let link of document.querySelectorAll('#navigation .link')) {
                        if (!link.classList.contains('right')) {
                                link.style.display = 'none';
                        }
                }
        };
        document.querySelector('#searchInput').onblur = function () {
                for (let link of document.querySelectorAll('#navigation .link')) {
                        if (!link.classList.contains('right')) {
                                link.style.display = '';
                        }
                }
        };
});
window.addEventListener('hashchange', function(){
        window.scrollBy(0, -50);
});
</script>
<?php $this->printTrail();
	}
}
