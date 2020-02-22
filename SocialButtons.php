<?php
defined('is_running') or die('Not an entry point...');

class SocialButtons{
	
	static $config;


	static function Gadget() {
		global $page, $addonRelativeCode, 
		$addonRelativeData, $addonPathData;
		$url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
		$title = $page->title;

		self::LoadConfig();
	    $page->css_user[] = $addonRelativeCode . '/SocialButtons.css';

		$size = self::$config['size'];
		$height = self::$config['height'];
		$solid = self::$config['solid'];
		$circle = self::$config['circle'];
		
		$sc_style = $solid != '1' && $circle != '1' ? ' resp-sharing-button__icon--normal' : '';
		$sc_style .= $solid == '1' && $circle != '1' ? ' resp-sharing-button__icon--solid' : '';
		$sc_style .= $solid != '1' && $circle == '1' ? ' resp-sharing-button__icon--circle' : '';
		$sc_style .= $solid == '1' && $circle == '1' ? ' resp-sharing-button__icon--solidcircle' : '';

		$HTML = '
		<style>
			.SocialButtons {
				text-align: center;
				display: table;
			}
			.SocialButtons .resp-sharing-button__icon svg {
				width: '.$height.';
				height: '.$height.';
			}	
			.SocialButtons .resp-sharing-button--small {
				line-height: normal;
				padding: calc( '.$height.' * 0.2);
			}
			.SocialButtons .resp-sharing-button--medium {
				padding: 0.5em;
				line-height: '.$height.';
				font-size: calc( '.$height.' * 0.7);
			}
			.SocialButtons .resp-sharing-button__link {
				margin: calc( '.$height.' * 0.1);
				color: #fff;
			}	
			.SocialButtons .resp-sharing-button__link:hover {
				text-decoration: none;
				color: #fff;
			}	
    		</style>
		<div class="SocialButtons">
		';

		foreach ( self::$config['networks'] as $network ) {
		switch ( $network ) {
		case 'Telegram' : 
		$HTML .= '
		<!-- Sharingbutton Telegram -->
		<a class="resp-sharing-button__link" href="https://telegram.me/share/url?text='.$title.'&amp;url='.$url.'" target="_blank" rel="noopener" aria-label="">
			<div class="resp-sharing-button resp-sharing-button--telegram resp-sharing-button--'.$size.'">
				<div aria-hidden="true" class="resp-sharing-button__icon'.$sc_style.'">
					<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
						'.($circle == '1' ? 
						($solid == '1' ? '
						<path d="M12 23.5c6.35 0 11.5-5.15 11.5-11.5S18.35.5 12 .5.5 5.65.5 12 5.65 23.5 12 23.5zM2.505 11.053c-.31.118-.505.738-.505.738s.203.62.513.737l3.636 1.355 1.417 4.557a.787.787 0 0 0 1.25.375l2.115-1.72a.29.29 0 0 1 .353-.01L15.1 19.85a.786.786 0 0 0 .746.095.786.786 0 0 0 .487-.573l2.793-13.426a.787.787 0 0 0-1.054-.893l-15.568 6z" fill-rule="evenodd"/>
						':'
						<circle cx="12" cy="12" r="11.5"/>
						<path d="M2.505 11.053c-.31.118-.505.738-.505.738s.203.62.513.737l3.636 1.355 1.417 4.557a.787.787 0 0 0 1.25.375l2.115-1.72a.29.29 0 0 1 .353-.01L15.1 19.85a.786.786 0 0 0 .746.095.786.786 0 0 0 .487-.573l2.793-13.426a.787.787 0 0 0-1.054-.893l-15.568 6z"/>
						') : '
						<path '.($solid == '1' ? '' : 'stroke-width="1.5px"' ).' d="M2.505 11.053c-.31.118-.505.738-.505.738s.203.62.513.737l3.636 1.355 1.417 4.557a.787.787 0 0 0 1.25.375l2.115-1.72a.29.29 0 0 1 .353-.01L15.1 19.85a.786.786 0 0 0 .746.095.786.786 0 0 0 .487-.573l2.793-13.426a.787.787 0 0 0-1.054-.893l-15.568 6z"/>
						').'
					</svg>
				</div>'.($size == 'small' ? '' : 'Telegram').'
			</div>
		</a>
		';
		break;

		case 'WhatsApp' : 
		$HTML .= '
		<!-- Sharingbutton WhatsApp -->
		<a class="resp-sharing-button__link" href="whatsapp://send?text='.$title.'%20'.$url.'" target="_blank" rel="noopener" aria-label="">
			<div class="resp-sharing-button resp-sharing-button--whatsapp resp-sharing-button--'.$size.'">
				<div aria-hidden="true" class="resp-sharing-button__icon'.$sc_style.'">
					<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
						'.($circle == '1' ? 
						($solid == '1' ? '
						<path d="m12 0c-6.6 0-12 5.4-12 12s5.4 12 12 12 12-5.4 12-12-5.4-12-12-12zm0 3.8c2.2 0 4.2 0.9 5.7 2.4 1.6 1.5 2.4 3.6 2.5 5.7 0 4.5-3.6 8.1-8.1 8.1-1.4 0-2.7-0.4-3.9-1l-4.4 1.1 1.2-4.2c-0.8-1.2-1.1-2.6-1.1-4 0-4.5 3.6-8.1 8.1-8.1zm0.1 1.5c-3.7 0-6.7 3-6.7 6.7 0 1.3 0.3 2.5 1 3.6l0.1 0.3-0.7 2.4 2.5-0.7 0.3 0.099c1 0.7 2.2 1 3.4 1 3.7 0 6.8-3 6.9-6.6 0-1.8-0.7-3.5-2-4.8s-3-2-4.8-2zm-3 2.9h0.4c0.2 0 0.4-0.099 0.5 0.3s0.5 1.5 0.6 1.7 0.1 0.2 0 0.3-0.1 0.2-0.2 0.3l-0.3 0.3c-0.1 0.1-0.2 0.2-0.1 0.4 0.2 0.2 0.6 0.9 1.2 1.4 0.7 0.7 1.4 0.9 1.6 1 0.2 0 0.3 0.001 0.4-0.099s0.5-0.6 0.6-0.8c0.2-0.2 0.3-0.2 0.5-0.1l1.4 0.7c0.2 0.1 0.3 0.2 0.5 0.3 0 0.1 0.1 0.5-0.099 1s-1 0.9-1.4 1c-0.3 0-0.8 0.001-1.3-0.099-0.3-0.1-0.7-0.2-1.2-0.4-2.1-0.9-3.4-3-3.5-3.1s-0.8-1.1-0.8-2.1c0-1 0.5-1.5 0.7-1.7s0.4-0.3 0.5-0.3z"/>
						':'
						<circle xmlns="http://www.w3.org/2000/svg" cx="12" cy="12" r="11.5"/><path stroke-width="1px" d="M17.6 6.2c-1.5-1.5-3.4-2.3-5.5-2.3-4.3 0-7.8 3.5-7.8 7.8 0 1.4.4 2.7 1 3.9l-1.1 4 4.1-1.1c1.1.6 2.4.9 3.7.9 4.3 0 7.8-3.5 7.8-7.8.1-2-.7-3.9-2.2-5.4zm-5.5 11.9c-1.2 0-2.3-.3-3.3-.9l-.2-.1-2.4.6.7-2.4-.2-.2c-.6-1-1-2.2-1-3.4 0-3.6 2.9-6.5 6.5-6.5 1.7 0 3.3.7 4.6 1.9 1.2 1.2 1.9 2.8 1.9 4.6-.1 3.5-3 6.4-6.6 6.4zm3.5-4.8c-.2-.1-1.1-.6-1.3-.6-.2-.1-.3-.1-.4.1-.1.2-.5.6-.6.8-.1.1-.2.1-.4 0s-.8-.3-1.6-1c-.6-.5-1-1.2-1.1-1.3-.1-.2 0-.3.1-.4l.3-.3s.1-.2.2-.3c.1-.1 0-.2 0-.3s-.4-1.1-.6-1.4c-.2-.4-.3-.3-.4-.3h-.4s-.3 0-.5.2-.7.7-.7 1.6c0 1 .7 1.9.8 2s1.4 2.1 3.3 2.9c.5.2.8.3 1.1.4.5.1.9.1 1.2.1.4-.1 1.1-.5 1.3-.9.2-.5.2-.8.1-.9 0-.2-.2-.3-.4-.4z"/>
						') : '
						<path '.($solid == '1' ? '' : 'stroke-width="1px"' ).' d="M20.1 3.9C17.9 1.7 15 .5 12 .5 5.8.5.7 5.6.7 11.9c0 2 .5 3.9 1.5 5.6L.6 23.4l6-1.6c1.6.9 3.5 1.3 5.4 1.3 6.3 0 11.4-5.1 11.4-11.4-.1-2.8-1.2-5.7-3.3-7.8zM12 21.4c-1.7 0-3.3-.5-4.8-1.3l-.4-.2-3.5 1 1-3.4L4 17c-1-1.5-1.4-3.2-1.4-5.1 0-5.2 4.2-9.4 9.4-9.4 2.5 0 4.9 1 6.7 2.8 1.8 1.8 2.8 4.2 2.8 6.7-.1 5.2-4.3 9.4-9.5 9.4zm5.1-7.1c-.3-.1-1.7-.9-1.9-1-.3-.1-.5-.1-.7.1-.2.3-.8 1-.9 1.1-.2.2-.3.2-.6.1s-1.2-.5-2.3-1.4c-.9-.8-1.4-1.7-1.6-2-.2-.3 0-.5.1-.6s.3-.3.4-.5c.2-.1.3-.3.4-.5.1-.2 0-.4 0-.5C10 9 9.3 7.6 9 7c-.1-.4-.4-.3-.5-.3h-.6s-.4.1-.7.3c-.3.3-1 1-1 2.4s1 2.8 1.1 3c.1.2 2 3.1 4.9 4.3.7.3 1.2.5 1.6.6.7.2 1.3.2 1.8.1.6-.1 1.7-.7 1.9-1.3.2-.7.2-1.2.2-1.3-.1-.3-.3-.4-.6-.5z"/>
						').'
					</svg>
				</div>'.($size == 'small' ? '' : 'WhatsApp').'
			</div>
		</a>
		';
		break;

		case 'Facebook' : 
		$HTML .= '
		<!-- Sharingbutton Facebook -->
		<a class="resp-sharing-button__link" href="https://facebook.com/sharer/sharer.php?u='.$url.'" target="_blank" rel="noopener" aria-label="">
			<div class="resp-sharing-button resp-sharing-button--facebook resp-sharing-button--'.$size.'">
				<div aria-hidden="true" class="resp-sharing-button__icon'.$sc_style.'">
					<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
						'.($circle == '1' ? 
						($solid == '1' ? '
						<path d="M12 0C5.38 0 0 5.38 0 12s5.38 12 12 12 12-5.38 12-12S18.62 0 12 0zm3.6 11.5h-2.1v7h-3v-7h-2v-2h2V8.34c0-1.1.35-2.82 2.65-2.82h2.35v2.3h-1.4c-.25 0-.6.13-.6.66V9.5h2.34l-.24 2z"/>
						':'
						<circle cx="12" cy="12" r="11.5"/><path d="M15.84 9.5H13.5V8.48c0-.53.35-.65.6-.65h1.4v-2.3h-2.35c-2.3 0-2.65 1.7-2.65 2.8V9.5h-2v2h2v7h3v-7h2.1l.24-2z"/>
						') : 
						($solid == '1' ? '
						<path d="M18.77 7.46H14.5v-1.9c0-.9.6-1.1 1-1.1h3V.5h-4.33C10.24.5 9.5 3.44 9.5 5.32v2.15h-3v4h3v12h5v-12h3.85l.42-4z"/>
						':'
						<path d="M18.77 7.5H14.5V5.6c0-.9.6-1.1 1-1.1h3V.54L14.17.53C10.24.54 9.5 3.48 9.5 5.37V7.5h-3v4h3v12h5v-12h3.85l.42-4z"/>
						')).'
					</svg>
				</div>'.($size == 'small' ? '' : 'Facebook').'
			</div>
		</a>
		';
		break;

		case 'Twitter' : 
		$HTML .= '
		<!-- Sharingbutton Twitter -->
		<a class="resp-sharing-button__link" href="https://twitter.com/intent/tweet/?text='.$title.'&amp;url='.$url.'" target="_blank" rel="noopener" aria-label="">
			<div class="resp-sharing-button resp-sharing-button--twitter resp-sharing-button--'.$size.'">
				<div aria-hidden="true" class="resp-sharing-button__icon'.$sc_style.'">
					<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
						'.($circle == '1' ? 
						($solid == '1' ? '
						<path d="M12 0C5.38 0 0 5.38 0 12s5.38 12 12 12 12-5.38 12-12S18.62 0 12 0zm5.26 9.38v.34c0 3.48-2.64 7.5-7.48 7.5-1.48 0-2.87-.44-4.03-1.2 1.37.17 2.77-.2 3.9-1.08-1.16-.02-2.13-.78-2.46-1.83.38.1.8.07 1.17-.03-1.2-.24-2.1-1.3-2.1-2.58v-.05c.35.2.75.32 1.18.33-.7-.47-1.17-1.28-1.17-2.2 0-.47.13-.92.36-1.3C7.94 8.85 9.88 9.9 12.06 10c-.04-.2-.06-.4-.06-.6 0-1.46 1.18-2.63 2.63-2.63.76 0 1.44.3 1.92.82.6-.12 1.95-.27 1.95-.27-.35.53-.72 1.66-1.24 2.04z"/>
						':'
						<path d="M18.5 7.4l-2 .2c-.4-.5-1-.8-2-.8C13.3 6.8 12 8 12 9.4v.6c-2 0-4-1-5.4-2.7-.2.4-.3.8-.3 1.3 0 1 .4 1.7 1.2 2.2-.5 0-1 0-1.2-.3 0 1.3 1 2.3 2 2.6-.3.4-.7.4-1 0 .2 1.4 1.2 2 2.3 2-1 1-2.5 1.4-4 1 1.3 1 2.7 1.4 4.2 1.4 4.8 0 7.5-4 7.5-7.5v-.4c.5-.4.8-1.5 1.2-2z"/><circle cx="12" cy="12" r="11.5"/>
						') : 
						($solid == '1' ? '
						<path d="M23.44 4.83c-.8.37-1.5.38-2.22.02.93-.56.98-.96 1.32-2.02-.88.52-1.86.9-2.9 1.1-.82-.88-2-1.43-3.3-1.43-2.5 0-4.55 2.04-4.55 4.54 0 .36.03.7.1 1.04-3.77-.2-7.12-2-9.36-4.75-.4.67-.6 1.45-.6 2.3 0 1.56.8 2.95 2 3.77-.74-.03-1.44-.23-2.05-.57v.06c0 2.2 1.56 4.03 3.64 4.44-.67.2-1.37.2-2.06.08.58 1.8 2.26 3.12 4.25 3.16C5.78 18.1 3.37 18.74 1 18.46c2 1.3 4.4 2.04 6.97 2.04 8.35 0 12.92-6.92 12.92-12.93 0-.2 0-.4-.02-.6.9-.63 1.96-1.22 2.56-2.14z"/>
						':'
						<path d="M23.4 4.83c-.8.37-1.5.38-2.22.02.94-.56.98-.96 1.32-2.02-.88.52-1.85.9-2.9 1.1-.8-.88-2-1.43-3.3-1.43-2.5 0-4.55 2.04-4.55 4.54 0 .36.04.7.12 1.04-3.78-.2-7.12-2-9.37-4.75-.4.67-.6 1.45-.6 2.3 0 1.56.8 2.95 2 3.77-.73-.03-1.43-.23-2.05-.57v.06c0 2.2 1.57 4.03 3.65 4.44-.67.18-1.37.2-2.05.08.57 1.8 2.25 3.12 4.24 3.16-1.95 1.52-4.36 2.16-6.74 1.88 2 1.3 4.4 2.04 6.97 2.04 8.36 0 12.93-6.92 12.93-12.93l-.02-.6c.9-.63 1.96-1.22 2.57-2.14z"/>
						')).'
					</svg>
				</div>'.($size == 'small' ? '' : 'Twitter').'
			</div>
		</a>
		';
		break;

		case 'Pinterest' : 
		$HTML .= '
		<!-- Sharingbutton Pinterest -->
		<a class="resp-sharing-button__link" href="https://pinterest.com/pin/create/button/?url='.$url.'&amp;media='.$url.'&amp;description='.$title.'" target="_blank" rel="noopener" aria-label="">
			<div class="resp-sharing-button resp-sharing-button--pinterest resp-sharing-button--'.$size.'">
				<div aria-hidden="true" class="resp-sharing-button__icon'.$sc_style.'">
					<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
						'.($circle == '1' ? 
						($solid == '1' ? '
						<path d="M12 0C5.38 0 0 5.38 0 12s5.38 12 12 12 12-5.38 12-12S18.62 0 12 0zm1.4 15.56c-1 0-1.94-.53-2.25-1.14l-.65 2.52c-.4 1.45-1.57 2.9-1.66 3-.06.1-.2.07-.22-.04-.02-.2-.32-2 .03-3.5l1.18-5s-.3-.6-.3-1.46c0-1.36.8-2.37 1.78-2.37.85 0 1.25.62 1.25 1.37 0 .85-.53 2.1-.8 3.27-.24.98.48 1.78 1.44 1.78 1.73 0 2.9-2.24 2.9-4.9 0-2-1.35-3.5-3.82-3.5-2.8 0-4.53 2.07-4.53 4.4 0 .5.1.9.25 1.23l-1.5.82c-.36-.64-.54-1.43-.54-2.28 0-2.6 2.2-5.74 6.57-5.74 3.5 0 5.82 2.54 5.82 5.27 0 3.6-2 6.3-4.96 6.3z"/>
						':'
						<circle cx="12" cy="12" r="11.5"/><path d="M8 11.2c-.15-.32-.25-.72-.25-1.22 0-2.32 1.74-4.4 4.53-4.4 2.47 0 3.82 1.5 3.82 3.52 0 2.64-1.17 4.88-2.9 4.88-.97 0-1.7-.8-1.46-1.77.28-1.14.8-2.4.8-3.23 0-.76-.4-1.38-1.23-1.38-.95 0-1.74 1-1.74 2.37 0 .86.3 1.45.3 1.45l-1.2 5c-.34 1.5-.04 3.33-.02 3.5.02.1.16.15.22.06.1-.12 1.26-1.56 1.66-3l.66-2.53c.32.6 1.25 1.14 2.24 1.14 2.95 0 4.95-2.7 4.95-6.3 0-2.73-2.3-5.27-5.82-5.27-4.36 0-6.57 3.14-6.57 5.75 0 .85.18 1.64.53 2.28l1.5-.8z"/>
						') : '
						<path d="M12.14.5C5.86.5 2.7 5 2.7 8.75c0 2.27.86 4.3 2.7 5.05.3.12.57 0 .66-.33l.27-1.06c.1-.32.06-.44-.2-.73-.52-.62-.86-1.44-.86-2.6 0-3.33 2.5-6.32 6.5-6.32 3.55 0 5.5 2.17 5.5 5.07 0 3.8-1.7 7.02-4.2 7.02-1.37 0-2.4-1.14-2.07-2.54.4-1.68 1.16-3.48 1.16-4.7 0-1.07-.58-1.98-1.78-1.98-1.4 0-2.55 1.47-2.55 3.42 0 1.25.43 2.1.43 2.1l-1.7 7.2c-.5 2.13-.08 4.75-.04 5 .02.17.22.2.3.1.14-.18 1.82-2.26 2.4-4.33.16-.58.93-3.63.93-3.63.45.88 1.8 1.65 3.22 1.65 4.25 0 7.13-3.87 7.13-9.05C20.5 4.15 17.18.5 12.14.5z"/>
						').'
					</svg>
				</div>'.($size == 'small' ? '' : 'Pinterest').'
			</div>
		</a>
		';
		break;

		case 'Tumblr' : 
		$HTML .= '
		<!-- Sharingbutton Tumblr -->
		<a class="resp-sharing-button__link" href="https://www.tumblr.com/widgets/share/tool?posttype=link&amp;title='.$title.'&amp;caption='.$title.'&amp;content='.$url.'&amp;canonicalUrl='.$url.'&amp;shareSource=tumblr_share_button" target="_blank" rel="noopener" aria-label="Tumblr">
			<div class="resp-sharing-button resp-sharing-button--tumblr resp-sharing-button--'.$size.'">
				<div aria-hidden="true" class="resp-sharing-button__icon'.$sc_style.'">
					<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
						'.($circle == '1' ? 
						($solid == '1' ? '
						<path d="M12,0C5.383,0,0,5.383,0,12s5.383,12,12,12s12-5.383,12-12S18.617,0,12,0z M15.492,17.616C11.401,19.544,9.5,17,9.5,14.031 V9.5h-2V8.142c0.549-0.178,1.236-0.435,1.627-0.768c0.393-0.334,0.707-0.733,0.943-1.2c0.238-0.467,0.401-0.954,0.49-1.675H12.5v3h2 v2h-2v3.719c0,2.468,1.484,2.692,2.992,1.701V17.616z"/>
						':'
						<circle cx="12" cy="12" r="11.5"/><path d="M12.5 4.5v3h2v2h-2v3.72c0 2.47 1.48 2.7 3 1.7v2.7c-4.1 1.92-6-.62-6-3.6V9.5h-2V8.14c.55-.18 1.24-.43 1.63-.77.4-.33.7-.73.94-1.2.24-.46.4-.95.5-1.67h1.93z"/>
						') : 
						($solid == '1' ? '
						<path d="M13.5.5v5h5v4h-5V15c0 5 3.5 4.4 6 2.8v4.4c-6.7 3.2-12 0-12-4.2V9.5h-3V6.7c1-.3 2.2-.7 3-1.3.5-.5 1-1.2 1.4-2 .3-.7.6-1.7.7-3h3.8z"/>
						':'
						<path d="M13.5.5v5h5v4h-5V15c0 5 3.5 4.4 6 2.8v4.4c-6.7 3.2-12 0-12-4.2V9.5h-3V6.7c1-.3 2.2-.7 3-1.3.5-.5 1-1.2 1.4-2 .3-.7.6-1.7.7-3h3.8z"/>
						')).'
					</svg>
				</div>'.($size == 'small' ? '' : 'Tumblr').'
			</div>
		</a>
		';
		break;

		case 'LinkedIn' : 
		$HTML .= '
		<!-- Sharingbutton LinkedIn -->
		<a class="resp-sharing-button__link" href="https://www.linkedin.com/shareArticle?mini=true&amp;url='.$url.'&amp;title='.$title.'&amp;summary='.$title.'&amp;source='.$url.'" target="_blank" rel="noopener" aria-label="LinkedIn">
			<div class="resp-sharing-button resp-sharing-button--linkedin resp-sharing-button--'.$size.'">
				<div aria-hidden="true" class="resp-sharing-button__icon'.$sc_style.'">
					<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
						'.($circle == '1' ? 
						($solid == '1' ? '
						<path d="M12,0C5.383,0,0,5.383,0,12s5.383,12,12,12s12-5.383,12-12S18.617,0,12,0z M9.5,16.5h-2v-7h2V16.5z M8.5,7.5 c-0.553,0-1-0.448-1-1c0-0.552,0.447-1,1-1s1,0.448,1,1C9.5,7.052,9.053,7.5,8.5,7.5z M18.5,16.5h-3V13c0-0.277-0.225-0.5-0.5-0.5 c-0.276,0-0.5,0.223-0.5,0.5v3.5h-3c0,0,0.031-6.478,0-7h3v0.835c0,0,0.457-0.753,1.707-0.753c1.55,0,2.293,1.12,2.293,3.296V16.5z" />
						':'
						<circle cx="12" cy="12" r="11.5"/><path d="M15 12.5c-.28 0-.5.22-.5.5v3.5h-3s.03-6.48 0-7h3v.83s.46-.75 1.7-.75c1.56 0 2.3 1.12 2.3 3.3v3.62h-3V13c0-.28-.23-.5-.5-.5zm-7.5-3h2v7h-2z"/><circle cx="8.5" cy="6.5" r="1"/>
						') : 
						($solid == '1' ? '
						<path d="M6.5 21.5h-5v-13h5v13zM4 6.5C2.5 6.5 1.5 5.3 1.5 4s1-2.4 2.5-2.4c1.6 0 2.5 1 2.6 2.5 0 1.4-1 2.5-2.6 2.5zm11.5 6c-1 0-2 1-2 2v7h-5v-13h5V10s1.6-1.5 4-1.5c3 0 5 2.2 5 6.3v6.7h-5v-7c0-1-1-2-2-2z"/>
						':'
						<path d="M6.5 21.5h-5v-13h5v13zM4 6.5h-.04c-1.5 0-2.5-1.18-2.5-2.48 0-1.33 1.02-2.4 2.56-2.4s2.5 1.1 2.52 2.43c0 1.3-.98 2.45-2.55 2.45zm11.5 6c-1.1 0-2 .9-2 2v7h-5s.06-12 0-13h5V10s1.55-1.46 3.94-1.46c2.96 0 5.06 2.15 5.06 6.3v6.66h-5v-7c0-1.1-.9-2-2-2z"/>
						')).'
					</svg>
				</div>'.($size == 'small' ? '' : 'LinkedIn').'
			</div>
		</a>
		';
		break;

		case 'Reddit' : 
		$HTML .= '
		<!-- Sharingbutton Reddit -->
		<a class="resp-sharing-button__link" href="https://reddit.com/submit/?url='.$url.'&amp;resubmit=true&amp;title='.$title.'" target="_blank" rel="noopener" aria-label="Reddit">
			<div class="resp-sharing-button resp-sharing-button--reddit resp-sharing-button--'.$size.'">
				<div aria-hidden="true" class="resp-sharing-button__icon'.$sc_style.'">
					<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
						'.($circle == '1' ? 
						($solid == '1' ? '
						<circle cx="9.391" cy="13.392" r=".978"/><path d="M14.057 15.814c-1.14.66-2.987.655-4.122-.004-.238-.138-.545-.058-.684.182-.13.24-.05.545.19.685.72.417 1.63.646 2.568.646.93 0 1.84-.228 2.558-.642.24-.13.32-.44.185-.68-.14-.24-.445-.32-.683-.18zM5 12.086c0 .41.23.78.568.978.27-.662.735-1.264 1.353-1.774-.2-.207-.48-.334-.79-.334-.62 0-1.13.507-1.13 1.13z"/><path d="M12 0C5.383 0 0 5.383 0 12s5.383 12 12 12 12-5.383 12-12S18.617 0 12 0zm6.673 14.055c.01.104.022.208.022.314 0 2.61-3.004 4.73-6.695 4.73s-6.695-2.126-6.695-4.74c0-.105.013-.21.022-.313C4.537 13.73 4 12.97 4 12.08c0-1.173.956-2.13 2.13-2.13.63 0 1.218.29 1.618.757 1.04-.607 2.345-.99 3.77-1.063.057-.803.308-2.33 1.388-2.95.633-.366 1.417-.323 2.322.085.302-.81 1.076-1.397 1.99-1.397 1.174 0 2.13.96 2.13 2.13 0 1.177-.956 2.133-2.13 2.133-1.065 0-1.942-.79-2.098-1.81-.734-.4-1.315-.506-1.716-.276-.6.346-.818 1.395-.88 2.087 1.407.08 2.697.46 3.728 1.065.4-.468.987-.756 1.617-.756 1.17 0 2.13.953 2.13 2.13 0 .89-.54 1.65-1.33 1.97z"/><circle cx="14.609" cy="13.391" r=".978"/><path d="M17.87 10.956c-.302 0-.583.128-.79.334.616.51 1.082 1.112 1.352 1.774.34-.197.568-.566.568-.978 0-.623-.507-1.13-1.13-1.13z"/>
						':'
						<circle cx="12" cy="12" r="11.5"/><ellipse cx="12" cy="14.37" rx="6.2" ry="4.24"/><path d="M14.3 16.25c-.62.36-1.42.57-2.3.57-.88 0-1.7-.2-2.32-.58"/><circle cx="14.61" cy="13.39" r=".98"/><circle cx="9.39" cy="13.39" r=".98"/><path d="M16.4 11.38c.26-.55.82-.92 1.47-.92.9 0 1.63.73 1.63 1.63 0 .8-.6 1.47-1.38 1.6"/><circle cx="17.22" cy="7.52" r="1.63"/><path d="M7.6 11.38c-.26-.54-.82-.92-1.47-.92-.9 0-1.63.73-1.63 1.63 0 .8.6 1.47 1.38 1.6M12 10.12s-.08-4.82 3.6-2.6"/>
						') : 
						($solid == '1' ? '
						<path d="M24 11.5c0-1.65-1.35-3-3-3-.96 0-1.86.48-2.42 1.24-1.64-1-3.75-1.64-6.07-1.72.08-1.1.4-3.05 1.52-3.7.72-.4 1.73-.24 3 .5C17.2 6.3 18.46 7.5 20 7.5c1.65 0 3-1.35 3-3s-1.35-3-3-3c-1.38 0-2.54.94-2.88 2.22-1.43-.72-2.64-.8-3.6-.25-1.64.94-1.95 3.47-2 4.55-2.33.08-4.45.7-6.1 1.72C4.86 8.98 3.96 8.5 3 8.5c-1.65 0-3 1.35-3 3 0 1.32.84 2.44 2.05 2.84-.03.22-.05.44-.05.66 0 3.86 4.5 7 10 7s10-3.14 10-7c0-.22-.02-.44-.05-.66 1.2-.4 2.05-1.54 2.05-2.84zM2.3 13.37C1.5 13.07 1 12.35 1 11.5c0-1.1.9-2 2-2 .64 0 1.22.32 1.6.82-1.1.85-1.92 1.9-2.3 3.05zm3.7.13c0-1.1.9-2 2-2s2 .9 2 2-.9 2-2 2-2-.9-2-2zm9.8 4.8c-1.08.63-2.42.96-3.8.96-1.4 0-2.74-.34-3.8-.95-.24-.13-.32-.44-.2-.68.15-.24.46-.32.7-.18 1.83 1.06 4.76 1.06 6.6 0 .23-.13.53-.05.67.2.14.23.06.54-.18.67zm.2-2.8c-1.1 0-2-.9-2-2s.9-2 2-2 2 .9 2 2-.9 2-2 2zm5.7-2.13c-.38-1.16-1.2-2.2-2.3-3.05.38-.5.97-.82 1.6-.82 1.1 0 2 .9 2 2 0 .84-.53 1.57-1.3 1.87z"/>
						':'
						<ellipse cx="12" cy="15" rx="9.5" ry="6.5"/><path d="M15.54 17.88c-.96.55-2.2.88-3.54.88-1.35 0-2.6-.33-3.55-.9"/><circle cx="16" cy="13.5" r="1.5"/><circle cx="8" cy="13.5" r="1.5"/><path d="M18.74 10.42C19.14 9.58 20 9 21 9c1.38 0 2.5 1.12 2.5 2.5 0 1.25-.92 2.3-2.12 2.47"/><circle cx="20" cy="4.5" r="2.5"/><path d="M5.26 10.42C4.86 9.58 4 9 3 9 1.62 9 .5 10.12.5 11.5c0 1.25.92 2.3 2.12 2.47M12 8.5s-.13-7.4 5.5-4"/>
						')).'
					</svg>
				</div>'.($size == 'small' ? '' : 'Reddit').'
			</div>
		</a>
		';
		break;

		case 'XING' : 
		$HTML .= '
		<!-- Sharingbutton XING -->
		<a class="resp-sharing-button__link" href="https://www.xing.com/app/user?op=share;url='.$url.';title='.$title.'" target="_blank" rel="noopener" aria-label="XING">
			<div class="resp-sharing-button resp-sharing-button--xing resp-sharing-button--'.$size.'">
				<div aria-hidden="true" class="resp-sharing-button__icon'.$sc_style.'">
					<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
						'.($circle == '1' ? 
						($solid == '1' ? '
						<path d="M12 0C5.4 0 0 5.4 0 12s5.4 12 12 12 12-5.4 12-12S18.6 0 12 0zM7.8 14.5h-3L7 11.3 5.3 8.5h3l1.8 2.8L8 14.5zm9 5h-3.4l-3-5.5L15 5.5h3.2L13.6 14l3 5.5z"/>
						':'
						<circle cx="12" cy="12" r="11.5"/><path d="M8.4 8.5h-3L7 11.3l-2.2 3.2h3l2.3-3.2zm10-3h-3.2l-5 8.5 3.2 5.5h3.3l-3-5.5z"/>
						') : 
						($solid == '1' ? '
						<path d="M10.2 9.7l-3-5.4C7.2 4 7 4 6.8 4h-5c-.3 0-.4 0-.5.2v.5L4 10 .4 16v.5c0 .2.2.3.4.3h5c.3 0 .4 0 .5-.2l4-6.6v-.5zM24 .2l-.5-.2H18s-.2 0-.3.3l-8 14v.4l5.2 9c0 .2 0 .3.3.3h5.4s.3 0 .4-.2c.2-.2.2-.4 0-.5l-5-8.8L24 .7V.2z"/>
						':'
						<path d="M6.8 4.5h-5l3 5.5-4 6.5h5l4-6.5zm16.7-4H18l-8 14 5.3 9h5.4l-5.2-9z"/>
						')).'
					</svg>
				</div>'.($size == 'small' ? '' : 'XING').'
			</div>
		</a>
		';
		break;

		case 'E-Mail' : 
		$HTML .= '
		<!-- Sharingbutton E-Mail -->
		<a class="resp-sharing-button__link" href="mailto:?subject='.$title.'&amp;body='.$url.'" target="_self" rel="noopener" aria-label="">
			<div class="resp-sharing-button resp-sharing-button--email resp-sharing-button--'.$size.'">
				<div aria-hidden="true" class="resp-sharing-button__icon'.$sc_style.'">
					<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
						'.($circle == '1' ? 
						($solid == '1' ? '
						<path d="M12 0C5.38 0 0 5.38 0 12s5.38 12 12 12 12-5.38 12-12S18.62 0 12 0zm8 16c0 1.1-.9 2-2 2H6c-1.1 0-2-.9-2-2V8c0-1.1.9-2 2-2h12c1.1 0 2 .9 2 2v8z"/><path d="M17.9 8.18c-.2-.2-.5-.24-.72-.07L12 12.38 6.82 8.1c-.22-.16-.53-.13-.7.08s-.15.53.06.7l3.62 2.97-3.57 2.23c-.23.14-.3.45-.15.7.1.14.25.22.42.22.1 0 .18-.02.27-.08l3.85-2.4 1.06.87c.1.04.2.1.32.1s.23-.06.32-.1l1.06-.9 3.86 2.4c.08.06.17.1.26.1.17 0 .33-.1.42-.25.15-.24.08-.55-.15-.7l-3.57-2.22 3.62-2.96c.2-.2.24-.5.07-.72z"/>
						':'
						<path d="M19.5 16c0 .8-.7 1.5-1.5 1.5H6c-.8 0-1.5-.7-1.5-1.5V8c0-.8.7-1.5 1.5-1.5h12c.8 0 1.5.7 1.5 1.5v8zm-2-7.5L12 13 6.5 8.5m11 6l-4-2.5m-7 2.5l4-2.5"/><circle cx="12" cy="12" r="11.5"/>
						') : 
						($solid == '1' ? '
						<path d="M22 4H2C.9 4 0 4.9 0 6v12c0 1.1.9 2 2 2h20c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zM7.25 14.43l-3.5 2c-.08.05-.17.07-.25.07-.17 0-.34-.1-.43-.25-.14-.24-.06-.55.18-.68l3.5-2c.24-.14.55-.06.68.18.14.24.06.55-.18.68zm4.75.07c-.1 0-.2-.03-.27-.08l-8.5-5.5c-.23-.15-.3-.46-.15-.7.15-.22.46-.3.7-.14L12 13.4l8.23-5.32c.23-.15.54-.08.7.15.14.23.07.54-.16.7l-8.5 5.5c-.08.04-.17.07-.27.07zm8.93 1.75c-.1.16-.26.25-.43.25-.08 0-.17-.02-.25-.07l-3.5-2c-.24-.13-.32-.44-.18-.68s.44-.32.68-.18l3.5 2c.24.13.32.44.18.68z"/>
						':'
						<path d="M23.5 18c0 .8-.7 1.5-1.5 1.5H2c-.8 0-1.5-.7-1.5-1.5V6c0-.8.7-1.5 1.5-1.5h20c.8 0 1.5.7 1.5 1.5v12zm-3-9.5L12 14 3.5 8.5m0 7.5L7 14m13.5 2L17 14"/>
						')).'
					</svg>
				</div>'.($size == 'small' ? '' : 'E-Mail').'
			</div>
		</a>
		';
		}
		}
	
		$HTML .= '
		</div>
		';
		
		echo $HTML;
	}


	
	public static function LoadConfig(){
		global $addonPathCode, $addonPathData;
		$config_file = $addonPathData . '/config.php';
		if( file_exists($config_file) ){
		  include $config_file ;
		  $config['networks'] = explode(',',$config['networks']);
		  $config['available'] = explode(',',$config['available']);
		}else{
			$config = array (
				'networks' => array( 'Facebook','Twitter','Telegram','WhatsApp','Pinterest','Tumblr','LinkedIn','Reddit','XING','E-Mail' ),
				'available' => array(),
				'size' => 'small',
				'solid' => '1',
				'circle' => '1',
				'height' => '2.5rem',
			);
		}
		self::$config = $config;
	}

}
