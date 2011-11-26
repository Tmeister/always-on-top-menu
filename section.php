<?php
/*
Section: Menu always On Top
Author: Enrique Chavez
Author URI: http://tmeister.net
Version: 0.1
Description: always On Top 
Class Name: TmalwaysOnTop
Cloning: true
*/

/*
 * PageLines Headers API
 * 
 *  Sections support standard WP file headers (http://codex.wordpress.org/File_Header) with these additions:
 *  -----------------------------------
 * 	 - Section: The name of your section.
 *	 - Class Name: Name of the section class goes here, has to match the class extending PageLinesSection.
 *	 - Cloning: (bool) Enable cloning features.
 *	 - Depends: If your section needs another section loaded first set its classname here.
 *	 - Workswith: Comma seperated list of template areas the section is allowed in.
 *	 - Failswith: Comma seperated list of template areas the section is NOT allowed in.
 *	 - Demo: Use this to point to a demo for this product.
 *	 - External: Use this to point to an external overview of the product
 *	 - Long: Add a full description, used on the actual store page on http://www.pagelines.com/store/
 *
 */

class TmalwaysOnTop extends PageLinesSection {

	/**
	 *
	 * Section Variable Glossary (Auto Generated)
	 * ------------------------------------------------
	 *  $this->id			- The unique section slug & folder name
	 *  $this->base_url 	- The root section URL
	 *  $this->base_dir 	- The root section directory path
	 *  $this->name 		- The section UI name
	 *  $this->description	- The section description
	 *  $this->images		- The root section images URL
	 *  $this->icon 		- The section icon url
	 *  $this->screen		- The section screenshot url 
	 *  $this->oset			- Option settings array... needed for 'ploption' (contains clone_id, post_id)
	 * 
	 * 	Advanced Variables
	 * 		$this->view				- If the section is viewed on a page, archive, or single post
	 * 		$this->template_type	- The PageLines template type
	 */

	function section_persistent(){
		add_filter('pagelines_options_array', array($this, 'got_options'));
	} 
	function section_head(){
		$back = (ploption('tm_always_on_top_main_bg', $this->oset) ) ? ploption('tm_always_on_top_main_bg', $this->oset) : '#ffffff';
		
		$border = (ploption('tm_always_on_top_menu_border', $this->oset) ) ? ploption('tm_always_on_top_menu_border', $this->oset) : '#e0e0e0';
		
		$sub_bg = (ploption('tm_always_on_top_submenu_bg', $this->oset) ) ? ploption('tm_always_on_top_submenu_bg', $this->oset) : '#f4f4f4';
		
		$target = (ploption('tm_always_on_top_layout', $this->oset) == 'on') ? '.texture' : '.content';
		
		$shadow = (ploption('tm_always_on_top_shadow_bg', $this->oset) ) ? ploption('tm_always_on_top_shadow_bg', $this->oset) : '#909090';
		
		$link = (ploption('tm_always_on_top_link', $this->oset) ) ? ploption('tm_always_on_top_link', $this->oset) : '#707070';
		
		$link_hover = (ploption('tm_always_on_top_link_hover', $this->oset) ) ? ploption('tm_always_on_top_link_hover', $this->oset) : '#000000';

		$font_size = (ploption('tm_always_on_top_font_size', $this->oset) ) ? ploption('tm_always_on_top_font_size', $this->oset) : '14';

		$submenu_font_size = (ploption('tm_always_on_top_font_size_submenu', $this->oset) ) ? ploption('tm_always_on_top_font_size_submenu', $this->oset) : '12';
		

		echo load_custom_font( ploption('tm_always_on_top_font', $this->oset), '.menu-always-on-top' );


	?>
		<style type="text/css" media="screen">
			#<?=$this->id?> <?=$target?> {
				border-top: 1px solid <?=$border?>;
				border-bottom: 1px solid <?=$border?>;
				background: <?=$back?>;
			}

			#<?=$this->id?> .content-pad {
				padding: 0;
			}

			#<?=$this->id?>.fixed <?=$target?> {
				border-bottom: 0;
			}

			#<?=$this->id?>.fixed {
				position: fixed;
				top: -5px;
				left: 0;
				width: 100%;

				-webkit-box-shadow: 0 0 10px <?=$shadow?>;
				-moz-box-shadow: 0 0 10px <?=$shadow?>;
				box-shadow: 0 0 10px <?=$shadow?>;
				background: <?=$back?>;
				z-index: 9999;
			}
			ul.menu-always-on-top li ul{
				border: 1px solid <?=$border?>;
				background: <?=$sub_bg?>;
			}
			ul.menu-always-on-top li ul li{
				background: <?=$sub_bg?>;
			}
			ul.menu-always-on-top li a{
				color: <?=$link?>;
				font-size: <?=$font_size?>px;
			}
			ul.menu-always-on-top li a:hover{
				color: <?=$link_hover?>;	
			}
			ul.menu-always-on-top li ul li a{
				font-size: <?=$submenu_font_size?>px;	
			}
			#<?=$this->id?> .righty{
				float: right;	
			}
			#<?=$this->id?> .searchform {
			    margin: 10px 5px 0px 0;
			    width: 190px;
			}
			#<?=$this->id?> .searchform .searchfield{
				padding:10px 30px 10px 7px;
				color:#707070;
				-webkit-border-radius:5px;
				-moz-border-radius:5px;
				border-radius:5px;
				background-color:#f7f7f7;
				border:1px solid #d5d5d5;
			}
			#<?=$this->id?> .searchform input.submit {
			    top: 8px;
			}
		</style>
		<script type="text/javascript">
			jQuery(function($) {
				var menu = $('#<?=$this->id?>'),
				pos = menu.offset();
				menu.addClass('default')
				$(window).scroll(function(){
					if($(this).scrollTop() > pos.top+menu.height() && menu.hasClass('default')){
						menu.fadeOut('fast', function(){
							$(this).removeClass('default').addClass('fixed').fadeIn('fast');
						});
					} else if($(this).scrollTop() <= pos.top && menu.hasClass('fixed')){
						menu.fadeOut('fast', function(){
							$(this).removeClass('fixed').addClass('default').fadeIn('fast');
						});
					}
				});
				$(window).scroll();
			});
		</script>
	<?
	}
 	function section_template( $clone_id = null ) {
 		$search = ploption('tm_always_on_top_search', $this->oset);
 		wp_nav_menu( array('menu_class'  => "menu-always-on-top default".pagelines_nav_classes(), 'container' => null, 'container_class' => '', 'depth' => 2, 'theme_location'=>'primary') );
 		if( ! $search ){return;}
	?>
		<div class="righty">
			<?get_search_form()?>	
		</div>
	<?
 	}
 	function got_options($options){
		$options['always_on_top_menu'] = array(
			'tm_always_on_top_layout' => array(
				'version' 		=> 'pro',
				'type'			=> 'check',
				'title'			=> __('Layout', $this->domain),
				'inputlabel'	=> __('Enable Full-Width', $this->domain),
				'shortexp'		=> __('Select whether you want the menu background use the entire width of the page or just the content width.', $this->domain),
				'exp'			=> __('If you select the content width, it will take the width selected according to the overall layout.', $this->domain)
			),
			'tm_always_on_top_search' => array(
				'version'    	=> 'pro',
				'type'       	=> 'check',
				'inputlabel' 	=> 'Show search box',
				'title'      	=> 'Search Box',
				'exp'			=> 'Expppp',
				'shortexp'   	=> 'Check to show a search box on the right of the menu'
			),
			'tm_always_on_top_font' => array(
				'version' 	=> 'pro',
				'type'		=> 'fonts',
				'title'		=> 'Font Menu',
				'shortexp'	=> 'Short',
				'exp'		=> 'Expppp'
			),
			'tm_always_on_top_font_size' => array(
				'version' 		=> 'pro',
				'type'			=> 'count_select',
				'title'			=> 'Font Menu Size',
				'shortexp'		=> 'Short',
				'exp'			=> 'Expppp',
				'count_start'	=> 10, 
 				'count_number'	=> 20,
			),
			'tm_always_on_top_font_size_submenu' => array(
				'version' 		=> 'pro',
				'type'			=> 'count_select',
				'title'			=> 'Font Sub Menu Size',
				'shortexp'		=> 'Short',
				'exp'			=> 'Expppp',
				'count_start'	=> 10, 
 				'count_number'	=> 20,
			),
			'tm_always_on_top_background' =>	array(
				'version' 		=> 'pro',
				'type'			=> 'color_multi',
				'layout'		=> 'full',
				'title'			=> __('Menu Colors', $this->domain),
				'shortexp'		=> __('Configure the colors to use.', $this->domain),
				'selectvalues'	=> array(
					'tm_always_on_top_main_bg'	=> array(				
						'default' 		=> '#FFF',
						'flag'			=> 'set_default',
						'inputlabel' 	=> __( 'Menu Background', $this->domain ),
						
					),
					'tm_always_on_top_menu_border'	=> array(				
						'default' 		=> '#E0E0E0',
						'flag'			=> 'set_default',
						'inputlabel' 	=> __( 'Menu Border', $this->domain ),
					),
					'tm_always_on_top_submenu_bg'	=> array(				
						'default' 		=> '#f4f4f4',
						'flag'			=> 'set_default',
						'inputlabel' 	=> __( 'Submenu Background', $this->domain ),
					),
					'tm_always_on_top_shadow_bg'	=> array(				
						'default' 		=> '#909090',
						'flag'			=> 'set_default',
						'inputlabel' 	=> __( 'Menu Shadow', $this->domain ),
					)
				),
			),
			'tm_always_on_top_type' =>	array(
				'version' 		=> 'pro',
				'type'			=> 'color_multi',
				'layout'		=> 'full',
				'exp'			=> __('Exp', $this->domain),
				'title'			=> __('Menu Typography Color', $this->domain),
				'shortexp'		=> __('Configure the colors to use.', $this->domain),
				'selectvalues'	=> array(
					'tm_always_on_top_link'	=> array(				
						'default' 		=> '#707070',
						'flag'			=> 'set_default',
						'inputlabel' 	=> __( 'Link Color', $this->domain ),
						
					),
					'tm_always_on_top_link_hover'	=> array(				
						'default' 		=> '#000000',
						'flag'			=> 'set_default',
						'inputlabel' 	=> __( 'Link Hover Color', $this->domain ),
					)
				),
			)
		);
		return $options;
	}
}