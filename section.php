<?php
/*
Section: Menu always On Top
Author: Enrique Chavez
Author URI: http://tmeister.net
Version: 1.1.3
Description: Main menu, when the menu comes out of the visible area of the page automatically is fixed to the top of the screen, so it will be always present.
Class Name: TmalwaysOnTop
Cloning: false
Workswith: header
External: http://tmeister.net/themes-and-sections/menu-always-on-top/
Demo: http://pagelines.tmeister.net/menu-always-on-top/
Long: Main menu, when the menu comes out of the visible area of the page automatically is fixed to the top of the screen, so it will be always present.
*/

class TmalwaysOnTop extends PageLinesSection {

	var $domain = 'tm_always_on_top';

	function section_persistent(){
		add_filter('pagelines_options_array', array($this, 'got_options'));
	} 
	
	function section_head($clone_id = null){

		global $pagelines_ID;
		$oset              = array('post_id' => $pagelines_ID, 'clone_id' => $clone_id);
		
		$back              = (ploption('tm_always_on_top_main_bg', $this->oset) ) ? ploption('tm_always_on_top_main_bg', $this->oset) : '#ffffff';
		$border            = (ploption('tm_always_on_top_menu_border', $this->oset) ) ? ploption('tm_always_on_top_menu_border', $this->oset) : '#e0e0e0';
		$sub_bg            = (ploption('tm_always_on_top_submenu_bg', $this->oset) ) ? ploption('tm_always_on_top_submenu_bg', $this->oset) : '#f4f4f4';
		$target            = (ploption('tm_always_on_top_layout', $this->oset) == 'on') ? '.texture' : '.content';
		$shadow            = (ploption('tm_always_on_top_shadow_bg', $this->oset) ) ? ploption('tm_always_on_top_shadow_bg', $this->oset) : '#909090';
		$link              = (ploption('tm_always_on_top_link', $this->oset) ) ? ploption('tm_always_on_top_link', $this->oset) : '#707070';
		$link_hover        = (ploption('tm_always_on_top_link_hover', $this->oset) ) ? ploption('tm_always_on_top_link_hover', $this->oset) : '#000000';
		$font_size         = (ploption('tm_always_on_top_font_size', $this->oset) ) ? ploption('tm_always_on_top_font_size', $this->oset) : '14';
		$submenu_font_size = (ploption('tm_always_on_top_font_size_submenu', $this->oset) ) ? ploption('tm_always_on_top_font_size_submenu', $this->oset) : '12';
		echo load_custom_font( ploption('tm_always_on_top_font', $this->oset), '.menu-always-on-top' );
	?>
		<style type="text/css" media="screen">
			#<?php echo $this->id?> <?php echo $target?> {
				border-top: 1px solid <?php echo $border?>;
				border-bottom: 1px solid <?php echo $border?>;
				background: <?php echo $back?>;
			}

			#<?php echo $this->id?> .content-pad {
				padding: 0;
			}

			#<?php echo $this->id?>.fixed <?php echo $target?> {
				border-bottom: 0;
			}

			#<?php echo $this->id?>.fixed {
				position: fixed;
				<?php if ( !is_admin_bar_showing() ):?>
				top: -5px;
				<?php else: ?>
				top: 25px;
				<?php endif; ?>
				left: 0;
				width: 100%;

				-webkit-box-shadow: 0 0 10px <?php echo $shadow?>;
				-moz-box-shadow: 0 0 10px <?php echo $shadow?>;
				box-shadow: 0 0 10px <?php echo $shadow?>;
				background: <?php echo $back?>;
				z-index: 9999;
			}
			ul.menu-always-on-top li ul{
				border: 1px solid <?php echo $border?>;
				background: <?php echo $sub_bg?>;
			}
			ul.menu-always-on-top li ul li{
				background: <?php echo $sub_bg?>;
			}
			ul.menu-always-on-top li a{
				color: <?php echo $link?>;
				font-size: <?php echo $font_size?>px;
			}
			ul.menu-always-on-top li a:hover{
				color: <?php echo $link_hover?>;	
			}
			ul.menu-always-on-top li ul li a{
				font-size: <?php echo $submenu_font_size?>px;	
			}
			#<?php echo $this->id?> .righty{
				float: right;	
			}
			#<?php echo $this->id?> .searchform {
			    margin: 10px 25px 0px 0;
			    width: 190px;
			}
			#<?php echo $this->id?> .searchform .searchfield{
				padding:10px 30px 10px 25px;
				color:#707070;
				-webkit-border-radius:5px;
				-moz-border-radius:5px;
				border-radius:5px;
				background-color:#f7f7f7;
				border:1px solid #d5d5d5;
			}
			#<?php echo $this->id?> .searchform input.submit {
			    top: 8px;
			    box-shadow:0px 0px 0px transparent;
			    border:0px;

			}
		</style>
		<script type="text/javascript">
			jQuery(function($) {
				var menu = $('#<?php echo $this->id?>'),
				pos = menu.offset();
				menu.addClass('default')
				$(window).scroll(function(){
					if($(this).scrollTop() > pos.top+menu.height() && menu.hasClass('default')){
						menu.fadeOut('slow', function(){
							$(this).removeClass('default').addClass('fixed').fadeIn('slow');
						});
					} else if($(this).scrollTop() <= pos.top && menu.hasClass('fixed')){
						menu.fadeOut('slow', function(){
							$(this).removeClass('fixed').addClass('default').fadeIn('slow');
						});
					}
				});
				$(window).scroll();
			});
		</script>
	<?
	}

 	function section_template( $clone_id = null ) {
 		if( has_nav_menu('primary') ){
 			$search = ploption('tm_always_on_top_search', $this->oset);
 			wp_nav_menu( array('menu_class'  => "menu-always-on-top default".pagelines_nav_classes(), 'container' => null, 'container_class' => '', 'depth' => 2, 'theme_location'=>'primary') );
	 	}else{
	 		echo setup_section_notify($this, 'Please, set up the "Primary Website Navigation" to show it in this section.', get_admin_url(). 'nav-menus.php', 'Configure Menu');
	 		return;
	 	}
 		
 		if( ! $search ){
 		?>
 			<div class="clear"></div>
 		<?php
 			return;
 		}
		?>
			<div class="righty">
				<?get_search_form()?>	
			</div>
			<div class="clear"></div>
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
				'exp'			=> '',
				'shortexp'   	=> 'Check to show a search box on the right of the menu.'
			),
			'tm_always_on_top_font' => array(
				'version' 	=> 'pro',
				'type'		=> 'fonts',
				'title'		=> 'Font Menu',
				'shortexp'	=> 'Select the font menu.',
				'exp'		=> ''
			),
			'tm_always_on_top_font_size' => array(
				'version' 		=> 'pro',
				'type'			=> 'count_select',
				'title'			=> 'Menu Font Size',
				'shortexp'		=> 'Select the font size of the main menu items.',
				'exp'			=> '',
				'count_start'	=> 10, 
 				'count_number'	=> 20,
			),
			'tm_always_on_top_font_size_submenu' => array(
				'version' 		=> 'pro',
				'type'			=> 'count_select',
				'title'			=> 'Submenu Font Size',
				'shortexp'		=> 'Select the font size of the submenu items.',
				'exp'			=> '',
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