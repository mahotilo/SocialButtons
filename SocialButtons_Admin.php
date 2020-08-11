<?php
defined('is_running') or die('Not an entry point...');

class SocialButtons_Admin {
	
	public static $config;
	
	public static function Settings() {
		global $page, $addonRelativeCode, $langmessage;

		if( isset($_POST['save']) ){
		  msg(self::SaveConfig()); 
		}
		self::LoadConfig();


		\gp\tool::LoadComponents('droppable, selectable');
		$admin_url = \gp\tool::GetUrl('Admin_SocialButtons');
		
		$page->jQueryCode .= '
			$(document).ready(function() {
				$( "#sortableN" ).sortable({
					connectWith: ".connectedSortable",
					placeholder: "placeholder"
				})
				.bind("sortreceive",function(event,ui){
					$(ui.item).addClass( "ui-state-highlight" );
					$(ui.item).removeClass( "ui-state-default" );
				})
				.bind("sortupdate",function(event,ui){
					$(this).children("input").attr("value",$(this).sortable("toArray",{attribute: "item"}).filter(function(v){return v!==""}).join());
				})
				.disableSelection();
				
				$( "#sortableA" ).sortable({
					placeholder: "placeholder",
					connectWith: ".connectedSortable"
				})
				.bind("sortreceive",function(event,ui){
					$(ui.item).addClass( "ui-state-default" );
					$(ui.item).removeClass( "ui-state-highlight" );
				})
				.bind("sortupdate",function(event,ui){
					$(this).children("input").attr("value",$(this).sortable("toArray",{attribute: "item"}).filter(function(v){return v!==""}).join());
				})
				.disableSelection();
			});';

		

		$html = '
	<style>
	#SocialButtons_form {
	}
	#SocialButtons_form .ui-sortable {
		border: 1px solid #eee;
		width: 140px;
		min-height: calc( ( 1em + 20px ) * 10 + 7px); /* 10 - total number of elements*/
		list-style-type: none;
		margin: 0;
		padding: 5px 0 0 0;
		margin-right: 10px;
	}
	#SocialButtons_form .ui-sortable li { 
		margin: 0 5px 5px 5px;
		padding: 5px;
	}	
	#SocialButtons_form .placeholder { 
		height: calc( 1em + 15px );
	 }
	</style>



	<h2 class="hqmargin">Social Buttons &raquo; Settings</h2>
    <form id="SocialButtons_form" data-values-changed="0" action="' . $admin_url . '" method="post">
		<table class="bordered">
			<tr>
				<th>' . $langmessage['Settings'] . '</th>
				<th>' . $langmessage['Current_Value'] . '</th>
			</tr>
			<tr>
				<td>
					Networks Icons
				</td>
				<td>
					<div style="float: left">
					<div style="text-align: center">Show</div>
					<ul id="sortableN" class="connectedSortable">';
		foreach ( self::$config['networks'] as $key => $item ) {
		$html .= '
						<li class="ui-state-highlight" item="'.$item.'">'.$item.'</li>';
		};
		$html .= '
						<input name="sb_config[networks]" value="'.implode(self::$config['networks'],',').'" type="hidden">
					</ul>
					</div>
					<div style="float: left">
					<div style="text-align: center">Available</div>					
					<ul id="sortableA" class="connectedSortable">';
		foreach ( self::$config['available'] as $key => $item ) {
		$html .= '
						<li  class="ui-state-default" item="'.$item.'">'.$item.'</li>';
		};
		$html .= '
						<input name="sb_config[available]" value="'.implode(self::$config['available'],',').'" type="hidden">
					</ul>
					</div>
				</td>
			</tr>			
			<tr>
				<td>Size</td>
				<td>
					<input type="radio" name="sb_config[size]" value="small"'.(self::$config['size'] == 'small' ? ' checked="checked"' : '').'>small</input><br>
					<input type="radio" name="sb_config[size]" value="medium"'.(self::$config['size'] == 'medium' ? ' checked="checked"' : '').'>medium</input>
				</td>
			</tr>			
			<tr>
				<td>Solid Icon</td>
				<td>
					<input type="checkbox" name="sb_config[solid]" value="1"'.(self::$config['solid'] == '1' ? ' checked="checked"' : '').'/>
				</td>
			</tr>
			<tr>
				<td>Circle Icon</td>
				<td>
					<input type="checkbox" name="sb_config[circle]" value="1"'.(self::$config['circle'] == '1' ? ' checked="checked"' : '').'/>
				</td>
			</tr>
			<tr>
				<td>Icon height</td>
				<td>
					<input type="text" name="sb_config[height]" value="'.self::$config['height'].'">
				</td>
			</tr>
		</table>		
		<br/>
		<input type="submit" id="SocialButtons_submit" name="save" value="' . $langmessage['save'] . '" class="gpsubmit" />
		<input type="button" onClick="location.href=\'' .$admin_url . '\'" value="' . $langmessage['cancel'] . '" class="gpcancel" />
	</form>
		';
		echo $html;
	}


	public static function LoadConfig(){
		global $addonPathCode, $addonPathData;
		$config_file = $addonPathData . '/config.php';
		if( file_exists($config_file)){
		  include $config_file ;
		  $config['networks'] = array_filter(explode(',',$config['networks']));
		  $config['available'] = array_filter(explode(',',$config['available']));
		}else{
			$config = array (
				'networks' => array( 'Facebook','Twitter','Telegram','WhatsApp','Pinterest','Tumblr','LinkedIn','Reddit','XING','E-Mail' ),
				'available' => array(),
				'size' => 'small', //small, medium
				'solid' => '1',
				'circle' => '1',
				'height' => '2.5rem',
			);
		}
		self::$config = $config;
	}


	public static function SaveConfig(){
		global $addonPathData, $langmessage;
		$config = array (
			'networks' => array('Facebook','Twitter','Telegram','WhatsApp','Pinterest','Tumblr','LinkedIn','Reddit','XING','E-Mail'),
			'available' => array(),
			'size' => 'small', //small, medium
			'solid' => '0',
			'circle' => '0',
			'height' => '2.5rem',
		);
		foreach ($_POST['sb_config'] as $key => $value) {
		  switch($key){
			case 'networks':
			  $config['networks'] = $value; 
			  break;
			case 'available':
			  $config['available'] = $value; 
			  break;
			case 'size':
			  $config['size'] = $value; 
			  break;
			case 'solid':
			  $config['solid'] = '1'; 
			  break;
			case 'circle':
			  $config['circle'] = '1'; 
			  break;
			case 'height':
			  $config['height'] = strip_tags(trim($value));
			  break;
			default:
		  }
		}
		$config_file = $addonPathData . '/config.php';
		if( \gp\tool\Files::SaveData($config_file, 'config', $config) ){
		  msg($langmessage['SAVED']);
		}else{
		  msg($langmessage['OOPS']);
		}
	}
	
}
