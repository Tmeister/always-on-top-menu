<?php
/*
Section: Base Section (Pullquote)
Author: PageLines
Author URI: http://www.pagelines.com
Version: 1.2.0
Description: PageLines Starter Section (Includes "Pull Quote" Example)
Class Name: PageLinesPullQuote
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

/**
 *
 * Section Class Setup
 * 
 * Name your section class whatever you want, just make sure it matches the 
 * "Class Name" in the section meta (above)
 * 
 * File Naming Conventions
 * -------------------------------------
 *  section.php 		- The primary php loader for the section.
 *  style.css 			- Basic CSS styles contains all structural information, no color (autoloaded)
 *  images/				- Image folder. 
 *  thumb.png			- Primary branding graphic (300px by 225px - autoloaded)
 *  screenshot.png		- Primary Screenshot (300px by 225px)
 *  screenshot-1.png 	- Additional screenshots: (screenshot-1.png -2 -3 etc...optional).
 *  icon.png			- Portable icon format (16px by 16px)
 *	color.less			- Computed color control file (autoloaded)
 *
 */
class PageLinesPullQuote extends PageLinesSection {

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

	/**
	 *
	 * Section API - Methods & Functions
	 * 
	 * Below we'll give you a listing of all the available 
	 * Section 'methods' or functions, and other techniques.
	 * 
	 * Please reference other PageLines sections for ideas/tips on how
	 * to use more advanced functionality.
	 *
	 */

		/**
		 *
		 * Persistent Section Code 
		 * 
		 * Use the 'section_persistent()' function to add code that will run on every page in your site & admin
		 * Code here will run ALL the time, and is useful for adding post types, options etc.. 
		 *
		 */
		function section_persistent(){
		
		} 

		/**
		 *
		 * Site Head Section Code 
		 * 
		 * Code added in the 'section_head()' function will be run during the <head> element of your site's
		 * 'front-end' pages. You can use this to add custom Javascript, or manually add scripts & meta information
		 * It will *only* be loaded if the section is present on the page template.
		 *
		 */
		function section_head(){
			
			
		} 

		/**
		 *
		 * Section Template
		 * 
		 * The 'section_template()' function is the most important section function. 
		 * Use this function to output all the HTML for the section on pages/locations where it's placed.
		 * 
		 * Here we've included some example processing and output for a 'Pull Quote' section.
		 *
		 */
	 	function section_template( $clone_id = null ) { 
			
			// Setup Options Values
			$text = ( ploption('pullquote_text', $this->oset) ) ? ploption('pullquote_text', $this->oset) : false;
			$cite = ( ploption('pullquote_cite', $this->oset) ) ? ploption('pullquote_cite', $this->oset) : false;
			$cite_url = ( ploption('pullquote_cite_link', $this->oset) ) ? ploption('pullquote_cite_link', $this->oset) : false;

			
			// If no text is set, show the default sections screen to admins and stop process
			if( !$text ){
				echo setup_section_notify( $this, 'Add Pullquote Text To Activate' );
				return;
			}

			$citation = ($cite_url) ? sprintf('<a href="%s">%s</a>', $cite_url, $cite) : $cite;
			
			// Draw the HTML... 
		?>
	<div class="pullquote">
		<div class="thepullquote">
			<?php echo $text;?>
		</div>
		<?php if($cite): ?>
			<div class="thecitation"> 
				&mdash; <?php echo $citation;?>
			</div>
		<?php endif;?>
	</div>
<?php }
	
		/** 
		 * For template code that should show before the standard section markup
		 */
		function before_section_template( $clone_id = null ){}

		/** 
		 * For template code that should show after the standard section markup
		 */
		function after_section_template( $clone_id = null ){}
	
	/**
	 *
	 * Using PageLines Options
	 * -----------------------------------------------------------
	 * PageLines options revolve around the ploption function. 
	 * To use this function you provide two arguments as follows.
	 * 
	 * 	Usage: ploption( 'key', $args );
	 * 		'key' - The key for the PageLines option 
	 *  	$args - An array of variables for handling the option: 
	 * 
	 *			-  $args() list (optional): 
	 * 				- 	'post_id'	- The global post or page id (required for page by page meta control)
	 *				- 	'clone_id'	- The clone idea for the section (required to enable cloning)
	 * 				Advanced
	 *					- 	'setting'	- The WP setting field to pull the option from. 
	 * 					- 	'subkey'	- For nested options
	 * 
	 * 
	 */
		
		/**
		 *
		 * Section Page Options
		 * 
		 * Section optionator is designed to handle section options.
		 */
		function section_optionator( $settings ){
			
			// Compare w/ Optionator defaults. (Required, but doesn't change -- needed for cloning/special)
			$settings = wp_parse_args($settings, $this->optionator_default);
			
			/**
			 *
			 * Section Page Options
			 * 
			 * Section optionator is designed to handle section cloning.
			 */
			$opt_array = array(
				'pullquote_text' 	=> array(
					'type' 			=> 'text',
					'inputlabel'	=> 'Pullquote Text',
					'title' 		=> 'Pullquote Text',
					'shortexp'		=> 'The primary quote text for your pullquote',
				),
				'pullquote_cite' => array(
					'type' 			=> 'text',
					'inputlabel'	=> 'Pullquote Citation Text',
					'title' 		=> 'Pullquote Citation Text',
					'shortexp'		=> 'Enter the name or citation for quote accreditation.',
				), 
				'pullquote_cite_link' => array(
					'type' 			=> 'text',
					'inputlabel'	=> 'Pullquote Citation URL',
					'title' 		=> 'Pullquote Citation URL (optional)',
					'shortexp'		=> 'Should the citation link somewhere? If so add the url here.',
				)
			);

			$settings = array(
				'id' 		=> $this->id.'_meta',
				'name' 		=> $this->name,
				'icon' 		=> $this->icon, 
				'clone_id'	=> $settings['clone_id'], 
				'active'	=> $settings['active']
			);

			register_metatab($settings, $opt_array);
		}

	
	
	} /* End of section class - No closing php tag needed */