<?php
/* Theme Support */
function thb_theme_setup() {
	/* Text Domain */
	load_theme_textdomain('goodlife', THB_THEME_ROOT_ABS . '/inc/languages');
	
	/* Background Support */
	add_theme_support( 'custom-background', array( 'default-color' => 'ffffff') );
	
	/* Title Support */
	add_theme_support( 'title-tag' );

	/* Post Formats */
	add_theme_support('post-formats', array('video', 'gallery'));
	
	/* Editor Styling */
	$body_url = str_replace( ',', '%2C', '//fonts.googleapis.com/css?family=Droid+Serif:200,300,400,500,600,700&subset=latin,latin-ext' );
	$title_url = str_replace( ',', '%2C', '//fonts.googleapis.com/css?family=Poppins:200,300,400,500,600,700&subset=latin,latin-ext' );
	add_editor_style( array($body_url, $title_url, 'editor-style.css') );
	
	/* Required Settings */
	global $content_width;
	if(!isset($content_width)) $content_width = 1170;
	add_theme_support( 'automatic-feed-links' );
	
	/* Image Settings */
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 80, 75, true );
	add_image_size('goodlife-latest', 370, 260, true );
	add_image_size('goodlife-latest-short', 570, 300, true );
	add_image_size('goodlife-widget-photo', 280, 150, true );
	add_image_size('goodlife-widget-photo-vertical', 280, 375, true );
	add_image_size('goodlife-gallery', 1170, 550, true );
	add_image_size('goodlife-gallery-vertical', 670, 730, true );
	add_image_size('goodlife-video-others', 170, 100, true );
	add_image_size('goodlife-post-style1', 770, 9999, false );
	add_image_size('goodlife-grid-8x8', 780, 621, true );
	add_image_size('goodlife-grid-6x6', 584, 425, true );
	add_image_size('goodlife-grid-8x2', 780, 309, true );
	add_image_size('goodlife-grid-2x2', 388, 308, true );
	
	if (false === get_option("medium_crop")) {
	    add_option("medium_crop", "1");
	} else {
	    update_option("medium_crop", "1");
	}
	  
	/* HTML5 Galleries */
	add_theme_support( 'html5', array( 'gallery', 'caption' ) );
}
add_action( 'after_setup_theme', 'thb_theme_setup' );

/* Body Classes */
function thb_body_classes( $classes ) {
	$lazy_load = ot_get_option('lazy_load', 'on');
	
	if($lazy_load == 'off') { 
		$classes[] = 'lazy-load-off';
	}
	return $classes;
}
add_filter( 'body_class', 'thb_body_classes' );

/* Youtube & Vimeo Embeds */
function thb_remove_youtube_controls($code){
  if(strpos($code, 'youtu.be') !== false || strpos($code, 'youtube.com') !== false || strpos($code, 'player.vimeo.com') !== false){
  		if(strpos($code, 'youtu.be') !== false || strpos($code, 'youtube.com') !== false) {
      	$return = preg_replace("@src=(['\"])?([^'\">\s]*)@", "src=$1$2&showinfo=0&rel=0&modestbranding=1", $code);
  		} else {
      	$return = $code;
  		}
      $return = '<div class="flex-video widescreen'.(strpos($code, 'player.vimeo.com') !== false ? ' vimeo' : ' youtube').'">'.$return.'</div>';
  } else {
      $return = $code;
  }
  return $return;
}
 
add_filter('embed_handler_html', 'thb_remove_youtube_controls');
add_filter('embed_oembed_html', 'thb_remove_youtube_controls');

/* Category Rel Fix */
function thb_remove_category_list_rel( $output ) {
    return str_replace( ' rel="category tag"', '', $output );
}
add_filter( 'wp_list_categories', 'thb_remove_category_list_rel' );
add_filter( 'the_category', 'thb_remove_category_list_rel' );

/* Author FB, TW & G+ Links */
function thb_my_new_contactmethods( $contactmethods ) {
	// Add Position
	$contactmethods['position'] = 'Position';
	// Add Twitter
	$contactmethods['twitter'] = 'Twitter URL';
	// Add Facebook
	$contactmethods['facebook'] = 'Facebook URL';
	// Add Google+
	$contactmethods['googleplus'] = 'Google Plus URL';
	
	return $contactmethods;
}
add_filter('user_contactmethods','thb_my_new_contactmethods',10,1);

/* Font Awesome Array */
function thb_getIconArray(){
	$icons = array(
			'' => '',
			'fa-adjust' => 'Adjust',
			'fa-adn' => 'Adn',
			'fa-align-center' => 'Align center',
			'fa-align-justify' => 'Align justify',
			'fa-align-left' => 'Align left',
			'fa-align-right' => 'Align right',
			'fa-ambulance' => 'Ambulance',
			'fa-anchor' => 'Anchor',
			'fa-android' => 'Android',
			'fa-angellist' => 'Angellist',
			'fa-angle-double-down' => 'Angle double down',
			'fa-angle-double-left' => 'Angle double left',
			'fa-angle-double-right' => 'Angle double right',
			'fa-angle-double-up' => 'Angle double up',
			'fa-angle-down' => 'Angle down',
			'fa-angle-left' => 'Angle left',
			'fa-angle-right' => 'Angle right',
			'fa-angle-up' => 'Angle up',
			'fa-apple' => 'Apple',
			'fa-archive' => 'Archive',
			'fa-area-chart' => 'Area chart',
			'fa-arrow-circle-down' => 'Arrow circle down',
			'fa-arrow-circle-left' => 'Arrow circle left',
			'fa-arrow-circle-o-down' => 'Arrow circle o down',
			'fa-arrow-circle-o-left' => 'Arrow circle o left',
			'fa-arrow-circle-o-right' => 'Arrow circle o right',
			'fa-arrow-circle-o-up' => 'Arrow circle o up',
			'fa-arrow-circle-right' => 'Arrow circle right',
			'fa-arrow-circle-up' => 'Arrow circle up',
			'fa-arrow-down' => 'Arrow down',
			'fa-arrow-left' => 'Arrow left',
			'fa-arrow-right' => 'Arrow right',
			'fa-arrow-up' => 'Arrow up',
			'fa-arrows' => 'Arrows',
			'fa-arrows-alt' => 'Arrows alt',
			'fa-arrows-h' => 'Arrows h',
			'fa-arrows-v' => 'Arrows v',
			'fa-asterisk' => 'Asterisk',
			'fa-at' => 'At',
			'fa-backward' => 'Backward',
			'fa-ban' => 'Ban',
			'fa-bar-chart' => 'Bar chart',
			'fa-barcode' => 'Barcode',
			'fa-bars' => 'Bars',
			'fa-bed' => 'Bed',
			'fa-beer' => 'Beer',
			'fa-behance' => 'Behance',
			'fa-behance-square' => 'Behance square',
			'fa-bell' => 'Bell',
			'fa-bell-o' => 'Bell o',
			'fa-bell-slash' => 'Bell slash',
			'fa-bell-slash-o' => 'Bell slash o',
			'fa-bicycle' => 'Bicycle',
			'fa-binoculars' => 'Binoculars',
			'fa-birthday-cake' => 'Birthday cake',
			'fa-bitbucket' => 'Bitbucket',
			'fa-bitbucket-square' => 'Bitbucket square',
			'fa-bold' => 'Bold',
			'fa-bolt' => 'Bolt',
			'fa-bomb' => 'Bomb',
			'fa-book' => 'Book',
			'fa-bookmark' => 'Bookmark',
			'fa-bookmark-o' => 'Bookmark o',
			'fa-briefcase' => 'Briefcase',
			'fa-btc' => 'Btc',
			'fa-bug' => 'Bug',
			'fa-building' => 'Building',
			'fa-building-o' => 'Building o',
			'fa-bullhorn' => 'Bullhorn',
			'fa-bullseye' => 'Bullseye',
			'fa-bus' => 'Bus',
			'fa-buysellads' => 'Buysellads',
			'fa-calculator' => 'Calculator',
			'fa-calendar' => 'Calendar',
			'fa-calendar-o' => 'Calendar o',
			'fa-camera' => 'Camera',
			'fa-camera-retro' => 'Camera retro',
			'fa-car' => 'Car',
			'fa-caret-down' => 'Caret down',
			'fa-caret-left' => 'Caret left',
			'fa-caret-right' => 'Caret right',
			'fa-caret-square-o-down' => 'Caret square o down',
			'fa-caret-square-o-left' => 'Caret square o left',
			'fa-caret-square-o-right' => 'Caret square o right',
			'fa-caret-square-o-up' => 'Caret square o up',
			'fa-caret-up' => 'Caret up',
			'fa-cart-arrow-down' => 'Cart arrow down',
			'fa-cart-plus' => 'Cart plus',
			'fa-cc' => 'Cc',
			'fa-cc-amex' => 'Cc amex',
			'fa-cc-discover' => 'Cc discover',
			'fa-cc-mastercard' => 'Cc mastercard',
			'fa-cc-paypal' => 'Cc paypal',
			'fa-cc-stripe' => 'Cc stripe',
			'fa-cc-visa' => 'Cc visa',
			'fa-certificate' => 'Certificate',
			'fa-chain-broken' => 'Chain broken',
			'fa-check' => 'Check',
			'fa-check-circle' => 'Check circle',
			'fa-check-circle-o' => 'Check circle o',
			'fa-check-square' => 'Check square',
			'fa-check-square-o' => 'Check square o',
			'fa-chevron-circle-down' => 'Chevron circle down',
			'fa-chevron-circle-left' => 'Chevron circle left',
			'fa-chevron-circle-right' => 'Chevron circle right',
			'fa-chevron-circle-up' => 'Chevron circle up',
			'fa-chevron-down' => 'Chevron down',
			'fa-chevron-left' => 'Chevron left',
			'fa-chevron-right' => 'Chevron right',
			'fa-chevron-up' => 'Chevron up',
			'fa-child' => 'Child',
			'fa-circle' => 'Circle',
			'fa-circle-o' => 'Circle o',
			'fa-circle-o-notch' => 'Circle o notch',
			'fa-circle-thin' => 'Circle thin',
			'fa-clipboard' => 'Clipboard',
			'fa-clock-o' => 'Clock o',
			'fa-cloud' => 'Cloud',
			'fa-cloud-download' => 'Cloud download',
			'fa-cloud-upload' => 'Cloud upload',
			'fa-code' => 'Code',
			'fa-code-fork' => 'Code fork',
			'fa-codepen' => 'Codepen',
			'fa-coffee' => 'Coffee',
			'fa-cog' => 'Cog',
			'fa-cogs' => 'Cogs',
			'fa-columns' => 'Columns',
			'fa-comment' => 'Comment',
			'fa-comment-o' => 'Comment o',
			'fa-comments' => 'Comments',
			'fa-comments-o' => 'Comments o',
			'fa-compass' => 'Compass',
			'fa-compress' => 'Compress',
			'fa-connectdevelop' => 'Connectdevelop',
			'fa-copyright' => 'Copyright',
			'fa-credit-card' => 'Credit card',
			'fa-crop' => 'Crop',
			'fa-crosshairs' => 'Crosshairs',
			'fa-css3' => 'Css3',
			'fa-cube' => 'Cube',
			'fa-cubes' => 'Cubes',
			'fa-cutlery' => 'Cutlery',
			'fa-dashcube' => 'Dashcube',
			'fa-database' => 'Database',
			'fa-delicious' => 'Delicious',
			'fa-desktop' => 'Desktop',
			'fa-deviantart' => 'Deviantart',
			'fa-diamond' => 'Diamond',
			'fa-digg' => 'Digg',
			'fa-dot-circle-o' => 'Dot circle o',
			'fa-download' => 'Download',
			'fa-dribbble' => 'Dribbble',
			'fa-dropbox' => 'Dropbox',
			'fa-drupal' => 'Drupal',
			'fa-eject' => 'Eject',
			'fa-ellipsis-h' => 'Ellipsis h',
			'fa-ellipsis-v' => 'Ellipsis v',
			'fa-empire' => 'Empire',
			'fa-envelope' => 'Envelope',
			'fa-envelope-o' => 'Envelope o',
			'fa-envelope-square' => 'Envelope square',
			'fa-eraser' => 'Eraser',
			'fa-eur' => 'Eur',
			'fa-exchange' => 'Exchange',
			'fa-exclamation' => 'Exclamation',
			'fa-exclamation-circle' => 'Exclamation circle',
			'fa-exclamation-triangle' => 'Exclamation triangle',
			'fa-expand' => 'Expand',
			'fa-external-link' => 'External link',
			'fa-external-link-square' => 'External link square',
			'fa-eye' => 'Eye',
			'fa-eye-slash' => 'Eye slash',
			'fa-eyedropper' => 'Eyedropper',
			'fa-facebook' => 'Facebook',
			'fa-facebook-official' => 'Facebook official',
			'fa-facebook-square' => 'Facebook square',
			'fa-fast-backward' => 'Fast backward',
			'fa-fast-forward' => 'Fast forward',
			'fa-fax' => 'Fax',
			'fa-female' => 'Female',
			'fa-fighter-jet' => 'Fighter jet',
			'fa-file' => 'File',
			'fa-file-archive-o' => 'File archive o',
			'fa-file-audio-o' => 'File audio o',
			'fa-file-code-o' => 'File code o',
			'fa-file-excel-o' => 'File excel o',
			'fa-file-image-o' => 'File image o',
			'fa-file-o' => 'File o',
			'fa-file-pdf-o' => 'File pdf o',
			'fa-file-powerpoint-o' => 'File powerpoint o',
			'fa-file-text' => 'File text',
			'fa-file-text-o' => 'File text o',
			'fa-file-video-o' => 'File video o',
			'fa-file-word-o' => 'File word o',
			'fa-files-o' => 'Files o',
			'fa-film' => 'Film',
			'fa-filter' => 'Filter',
			'fa-fire' => 'Fire',
			'fa-fire-extinguisher' => 'Fire extinguisher',
			'fa-flag' => 'Flag',
			'fa-flag-checkered' => 'Flag checkered',
			'fa-flag-o' => 'Flag o',
			'fa-flask' => 'Flask',
			'fa-flickr' => 'Flickr',
			'fa-floppy-o' => 'Floppy o',
			'fa-folder' => 'Folder',
			'fa-folder-o' => 'Folder o',
			'fa-folder-open' => 'Folder open',
			'fa-folder-open-o' => 'Folder open o',
			'fa-font' => 'Font',
			'fa-forumbee' => 'Forumbee',
			'fa-forward' => 'Forward',
			'fa-foursquare' => 'Foursquare',
			'fa-frown-o' => 'Frown o',
			'fa-futbol-o' => 'Futbol o',
			'fa-gamepad' => 'Gamepad',
			'fa-gavel' => 'Gavel',
			'fa-gbp' => 'Gbp',
			'fa-gift' => 'Gift',
			'fa-git' => 'Git',
			'fa-git-square' => 'Git square',
			'fa-github' => 'Github',
			'fa-github-alt' => 'Github alt',
			'fa-github-square' => 'Github square',
			'fa-glass' => 'Glass',
			'fa-globe' => 'Globe',
			'fa-google' => 'Google',
			'fa-google-plus' => 'Google plus',
			'fa-google-plus-square' => 'Google plus square',
			'fa-google-wallet' => 'Google wallet',
			'fa-graduation-cap' => 'Graduation cap',
			'fa-gratipay' => 'Gratipay',
			'fa-h-square' => 'H square',
			'fa-hacker-news' => 'Hacker news',
			'fa-hand-o-down' => 'Hand o down',
			'fa-hand-o-left' => 'Hand o left',
			'fa-hand-o-right' => 'Hand o right',
			'fa-hand-o-up' => 'Hand o up',
			'fa-hdd-o' => 'Hdd o',
			'fa-header' => 'Header',
			'fa-headphones' => 'Headphones',
			'fa-heart' => 'Heart',
			'fa-heart-o' => 'Heart o',
			'fa-heartbeat' => 'Heartbeat',
			'fa-history' => 'History',
			'fa-home' => 'Home',
			'fa-hospital-o' => 'Hospital o',
			'fa-html5' => 'Html5',
			'fa-ils' => 'Ils',
			'fa-inbox' => 'Inbox',
			'fa-indent' => 'Indent',
			'fa-info' => 'Info',
			'fa-info-circle' => 'Info circle',
			'fa-inr' => 'Inr',
			'fa-instagram' => 'Instagram',
			'fa-ioxhost' => 'Ioxhost',
			'fa-italic' => 'Italic',
			'fa-joomla' => 'Joomla',
			'fa-jpy' => 'Jpy',
			'fa-jsfiddle' => 'Jsfiddle',
			'fa-key' => 'Key',
			'fa-keyboard-o' => 'Keyboard o',
			'fa-krw' => 'Krw',
			'fa-language' => 'Language',
			'fa-laptop' => 'Laptop',
			'fa-lastfm' => 'Lastfm',
			'fa-lastfm-square' => 'Lastfm square',
			'fa-leaf' => 'Leaf',
			'fa-leanpub' => 'Leanpub',
			'fa-lemon-o' => 'Lemon o',
			'fa-level-down' => 'Level down',
			'fa-level-up' => 'Level up',
			'fa-life-ring' => 'Life ring',
			'fa-lightbulb-o' => 'Lightbulb o',
			'fa-line-chart' => 'Line chart',
			'fa-link' => 'Link',
			'fa-linkedin' => 'Linkedin',
			'fa-linkedin-square' => 'Linkedin square',
			'fa-linux' => 'Linux',
			'fa-list' => 'List',
			'fa-list-alt' => 'List alt',
			'fa-list-ol' => 'List ol',
			'fa-list-ul' => 'List ul',
			'fa-location-arrow' => 'Location arrow',
			'fa-lock' => 'Lock',
			'fa-long-arrow-down' => 'Long arrow down',
			'fa-long-arrow-left' => 'Long arrow left',
			'fa-long-arrow-right' => 'Long arrow right',
			'fa-long-arrow-up' => 'Long arrow up',
			'fa-magic' => 'Magic',
			'fa-magnet' => 'Magnet',
			'fa-male' => 'Male',
			'fa-map-marker' => 'Map marker',
			'fa-mars' => 'Mars',
			'fa-mars-double' => 'Mars double',
			'fa-mars-stroke' => 'Mars stroke',
			'fa-mars-stroke-h' => 'Mars stroke h',
			'fa-mars-stroke-v' => 'Mars stroke v',
			'fa-maxcdn' => 'Maxcdn',
			'fa-meanpath' => 'Meanpath',
			'fa-medium' => 'Medium',
			'fa-medkit' => 'Medkit',
			'fa-meh-o' => 'Meh o',
			'fa-mercury' => 'Mercury',
			'fa-microphone' => 'Microphone',
			'fa-microphone-slash' => 'Microphone slash',
			'fa-minus' => 'Minus',
			'fa-minus-circle' => 'Minus circle',
			'fa-minus-square' => 'Minus square',
			'fa-minus-square-o' => 'Minus square o',
			'fa-mobile' => 'Mobile',
			'fa-money' => 'Money',
			'fa-moon-o' => 'Moon o',
			'fa-motorcycle' => 'Motorcycle',
			'fa-music' => 'Music',
			'fa-neuter' => 'Neuter',
			'fa-newspaper-o' => 'Newspaper o',
			'fa-openid' => 'Openid',
			'fa-outdent' => 'Outdent',
			'fa-pagelines' => 'Pagelines',
			'fa-paint-brush' => 'Paint brush',
			'fa-paper-plane' => 'Paper plane',
			'fa-paper-plane-o' => 'Paper plane o',
			'fa-paperclip' => 'Paperclip',
			'fa-paragraph' => 'Paragraph',
			'fa-pause' => 'Pause',
			'fa-paw' => 'Paw',
			'fa-paypal' => 'Paypal',
			'fa-pencil' => 'Pencil',
			'fa-pencil-square' => 'Pencil square',
			'fa-pencil-square-o' => 'Pencil square o',
			'fa-phone' => 'Phone',
			'fa-phone-square' => 'Phone square',
			'fa-picture-o' => 'Picture o',
			'fa-pie-chart' => 'Pie chart',
			'fa-pied-piper' => 'Pied piper',
			'fa-pied-piper-alt' => 'Pied piper alt',
			'fa-pinterest' => 'Pinterest',
			'fa-pinterest-p' => 'Pinterest p',
			'fa-pinterest-square' => 'Pinterest square',
			'fa-plane' => 'Plane',
			'fa-play' => 'Play',
			'fa-play-circle' => 'Play circle',
			'fa-play-circle-o' => 'Play circle o',
			'fa-plug' => 'Plug',
			'fa-plus' => 'Plus',
			'fa-plus-circle' => 'Plus circle',
			'fa-plus-square' => 'Plus square',
			'fa-plus-square-o' => 'Plus square o',
			'fa-power-off' => 'Power off',
			'fa-print' => 'Print',
			'fa-puzzle-piece' => 'Puzzle piece',
			'fa-qq' => 'Qq',
			'fa-qrcode' => 'Qrcode',
			'fa-question' => 'Question',
			'fa-question-circle' => 'Question circle',
			'fa-quote-left' => 'Quote left',
			'fa-quote-right' => 'Quote right',
			'fa-random' => 'Random',
			'fa-rebel' => 'Rebel',
			'fa-recycle' => 'Recycle',
			'fa-reddit' => 'Reddit',
			'fa-reddit-square' => 'Reddit square',
			'fa-refresh' => 'Refresh',
			'fa-renren' => 'Renren',
			'fa-repeat' => 'Repeat',
			'fa-reply' => 'Reply',
			'fa-reply-all' => 'Reply all',
			'fa-retweet' => 'Retweet',
			'fa-road' => 'Road',
			'fa-rocket' => 'Rocket',
			'fa-rss' => 'Rss',
			'fa-rss-square' => 'Rss square',
			'fa-rub' => 'Rub',
			'fa-scissors' => 'Scissors',
			'fa-search' => 'Search',
			'fa-search-minus' => 'Search minus',
			'fa-search-plus' => 'Search plus',
			'fa-sellsy' => 'Sellsy',
			'fa-server' => 'Server',
			'fa-share' => 'Share',
			'fa-share-alt' => 'Share alt',
			'fa-share-alt-square' => 'Share alt square',
			'fa-share-square' => 'Share square',
			'fa-share-square-o' => 'Share square o',
			'fa-shield' => 'Shield',
			'fa-ship' => 'Ship',
			'fa-shirtsinbulk' => 'Shirtsinbulk',
			'fa-shopping-cart' => 'Shopping cart',
			'fa-sign-in' => 'Sign in',
			'fa-sign-out' => 'Sign out',
			'fa-signal' => 'Signal',
			'fa-simplybuilt' => 'Simplybuilt',
			'fa-sitemap' => 'Sitemap',
			'fa-skyatlas' => 'Skyatlas',
			'fa-skype' => 'Skype',
			'fa-slack' => 'Slack',
			'fa-sliders' => 'Sliders',
			'fa-slideshare' => 'Slideshare',
			'fa-smile-o' => 'Smile o',
			'fa-sort' => 'Sort',
			'fa-sort-alpha-asc' => 'Sort alpha asc',
			'fa-sort-alpha-desc' => 'Sort alpha desc',
			'fa-sort-amount-asc' => 'Sort amount asc',
			'fa-sort-amount-desc' => 'Sort amount desc',
			'fa-sort-asc' => 'Sort asc',
			'fa-sort-desc' => 'Sort desc',
			'fa-sort-numeric-asc' => 'Sort numeric asc',
			'fa-sort-numeric-desc' => 'Sort numeric desc',
			'fa-soundcloud' => 'Soundcloud',
			'fa-space-shuttle' => 'Space shuttle',
			'fa-spinner' => 'Spinner',
			'fa-spoon' => 'Spoon',
			'fa-spotify' => 'Spotify',
			'fa-square' => 'Square',
			'fa-square-o' => 'Square o',
			'fa-stack-exchange' => 'Stack exchange',
			'fa-stack-overflow' => 'Stack overflow',
			'fa-star' => 'Star',
			'fa-star-half' => 'Star half',
			'fa-star-half-o' => 'Star half o',
			'fa-star-o' => 'Star o',
			'fa-steam' => 'Steam',
			'fa-steam-square' => 'Steam square',
			'fa-step-backward' => 'Step backward',
			'fa-step-forward' => 'Step forward',
			'fa-stethoscope' => 'Stethoscope',
			'fa-stop' => 'Stop',
			'fa-street-view' => 'Street view',
			'fa-strikethrough' => 'Strikethrough',
			'fa-stumbleupon' => 'Stumbleupon',
			'fa-stumbleupon-circle' => 'Stumbleupon circle',
			'fa-subscript' => 'Subscript',
			'fa-subway' => 'Subway',
			'fa-suitcase' => 'Suitcase',
			'fa-sun-o' => 'Sun o',
			'fa-superscript' => 'Superscript',
			'fa-table' => 'Table',
			'fa-tablet' => 'Tablet',
			'fa-tachometer' => 'Tachometer',
			'fa-tag' => 'Tag',
			'fa-tags' => 'Tags',
			'fa-tasks' => 'Tasks',
			'fa-taxi' => 'Taxi',
			'fa-tencent-weibo' => 'Tencent weibo',
			'fa-terminal' => 'Terminal',
			'fa-text-height' => 'Text height',
			'fa-text-width' => 'Text width',
			'fa-th' => 'Th',
			'fa-th-large' => 'Th large',
			'fa-th-list' => 'Th list',
			'fa-thumb-tack' => 'Thumb tack',
			'fa-thumbs-down' => 'Thumbs down',
			'fa-thumbs-o-down' => 'Thumbs o down',
			'fa-thumbs-o-up' => 'Thumbs o up',
			'fa-thumbs-up' => 'Thumbs up',
			'fa-ticket' => 'Ticket',
			'fa-times' => 'Times',
			'fa-times-circle' => 'Times circle',
			'fa-times-circle-o' => 'Times circle o',
			'fa-tint' => 'Tint',
			'fa-toggle-off' => 'Toggle off',
			'fa-toggle-on' => 'Toggle on',
			'fa-train' => 'Train',
			'fa-transgender' => 'Transgender',
			'fa-transgender-alt' => 'Transgender alt',
			'fa-trash' => 'Trash',
			'fa-trash-o' => 'Trash o',
			'fa-tree' => 'Tree',
			'fa-trello' => 'Trello',
			'fa-trophy' => 'Trophy',
			'fa-truck' => 'Truck',
			'fa-try' => 'Try',
			'fa-tty' => 'Tty',
			'fa-tumblr' => 'Tumblr',
			'fa-tumblr-square' => 'Tumblr square',
			'fa-twitch' => 'Twitch',
			'fa-twitter' => 'Twitter',
			'fa-twitter-square' => 'Twitter square',
			'fa-umbrella' => 'Umbrella',
			'fa-underline' => 'Underline',
			'fa-undo' => 'Undo',
			'fa-university' => 'University',
			'fa-unlock' => 'Unlock',
			'fa-unlock-alt' => 'Unlock alt',
			'fa-upload' => 'Upload',
			'fa-usd' => 'Usd',
			'fa-user' => 'User',
			'fa-user-md' => 'User md',
			'fa-user-plus' => 'User plus',
			'fa-user-secret' => 'User secret',
			'fa-user-times' => 'User times',
			'fa-users' => 'Users',
			'fa-venus' => 'Venus',
			'fa-venus-double' => 'Venus double',
			'fa-venus-mars' => 'Venus mars',
			'fa-viacoin' => 'Viacoin',
			'fa-video-camera' => 'Video camera',
			'fa-vimeo-square' => 'Vimeo square',
			'fa-vine' => 'Vine',
			'fa-vk' => 'Vk',
			'fa-volume-down' => 'Volume down',
			'fa-volume-off' => 'Volume off',
			'fa-volume-up' => 'Volume up',
			'fa-weibo' => 'Weibo',
			'fa-weixin' => 'Weixin',
			'fa-whatsapp' => 'Whatsapp',
			'fa-wheelchair' => 'Wheelchair',
			'fa-wifi' => 'Wifi',
			'fa-windows' => 'Windows',
			'fa-wordpress' => 'Wordpress',
			'fa-wrench' => 'Wrench',
			'fa-xing' => 'Xing',
			'fa-xing-square' => 'Xing square',
			'fa-yahoo' => 'Yahoo',
			'fa-yelp' => 'Yelp',
			'fa-youtube' => 'Youtube',
			'fa-youtube-play' => 'Youtube play',
			'fa-youtube-square' => 'Youtube square'
		);
  return $icons;
}

/* Display Post Bottom Elements */
function thb_PostMeta($author = false, $time = false, $shares = false, $comment = false,  $views = false) {
	if (ot_get_option('thb_logo')) { $logo = ot_get_option('thb_logo'); } else { $logo = THB_THEME_ROOT. '/assets/img/logo.png'; }
	?>
	<aside class="post-bottom-meta">
		<?php if ($author) { ?>
			<strong rel="author" itemprop="author"><?php the_author_posts_link(); ?></strong>
		<?php } ?>
		<time class="time<?php if (!$time) { ?> hide<?php }?>" datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>" itemprop="datePublished" content="<?php echo esc_attr( get_the_date( 'c' ) ); ?>"><?php echo thb_human_time_diff_enhanced(); ?></time>
		<meta itemprop="dateModified" content="<?php the_modified_date('c'); ?>">
		<span class="hide" itemprop="publisher" itemscope itemtype="https://schema.org/Organization">
			<meta itemprop="name" content="<?php echo esc_attr(get_bloginfo('name')); ?>">
			<span itemprop="logo" itemscope itemtype="https://schema.org/ImageObject">
				<meta itemprop="url" content="<?php echo esc_url($logo); ?>">
			</span>
			
		</span>
		
		<?php if ($shares) { ?>
		<span class="shares"><svg version="1.1" class="share_icon" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
			 width="16.156px" height="9.113px" viewBox="0 0 16.156 9.113" enable-background="new 0 0 16.156 9.113" xml:space="preserve">
				<path d="M10.388,1.813c1.2,0.771,2.867,1.845,3.987,2.57c-1.113,0.777-2.785,1.938-3.984,2.761
					c-0.002-0.234-0.004-0.476-0.005-0.709l-0.005-0.827L9.568,5.458L9.293,5.407C8.837,5.318,8.351,5.272,7.85,5.272
					c-0.915,0-1.912,0.15-2.964,0.446C4.027,5.962,3.136,6.306,2.24,6.74c0.914-1.09,2.095-1.995,3.369-2.576
					c1.039-0.475,2.145-0.739,3.379-0.81l0.453-0.025l0.941-0.053l0.003-0.943C10.387,2.162,10.387,1.986,10.388,1.813 M9.402,0
					c-0.01,0-0.017,2.33-0.017,2.33L8.933,2.355C7.576,2.433,6.346,2.728,5.193,3.254C3.629,3.968,2.19,5.125,1.146,6.509
					C0.558,7.289-0.099,9.006,0.242,9.006c0.033,0,0.076-0.017,0.129-0.052c1.595-1.053,3.248-1.838,4.787-2.273
					C6.124,6.41,7.023,6.273,7.85,6.273c0.438,0,0.856,0.038,1.251,0.115l0.284,0.053c0,0,0.016,2.555,0.037,2.555
					c0.092,0,6.733-4.626,6.733-4.644C16.156,4.336,9.434,0,9.402,0L9.402,0z"/>
		</svg><?php echo thb_social_article_totalshares(get_the_ID()); ?></span>
		<?php } ?>
		<?php if ($comment) { ?>
		<span class="comment">
			<a href="<?php comments_link(); ?>" title="<?php the_title_attribute(); ?>">
				<svg version="1.1" class="comment_icon" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
			 width="12px" height="13px" viewBox="0 0 12 13" enable-background="new 0 0 12 13" xml:space="preserve">
					<path d="M11.531,0H0.424c-0.23,0-0.419,0.183-0.419,0.407L0.002,8.675c0,0.402-0.097,1.17,1,1.17H3.99v2.367
						c0,0.162,0.057,0.393,0.043,0.752c0.063,0.039,0.105,0.039,0.168,0.039c0.105,0,0.21-0.039,0.294-0.123L7.18,9.845h3.975
						c0.231,0,0.798-0.092,0.798-0.791l-0.002-8.647C11.951,0.183,11.761,0,11.531,0z M11.155,9.054H7.18
						c-0.104,0-0.315,0.119-0.399,0.199l-2.16,2.367V9.75c0-0.225,0.02-0.695-0.631-0.695H0.8l0.044-8.241h10.267L11.155,9.054z"/>
			</svg> <?php echo get_comments_number(); ?>
			</a>
		</span>
		<?php } ?>
		<?php if ($views && function_exists( 'stats_get_csv' )) { ?>
			<?php
				echo '<span class="views"><i class="fa fa-eye"></i> ';  
				do_action( 'thb_post_viewcount'); 
				echo ' <em>' . esc_html__('views', 'goodlife').'</em></span>';
			?>
		<?php } ?>
	</aside>
	<?php
}
add_action( 'thb_PostMeta', 'thb_PostMeta', 10, 5 );

/* Add Lightbox Class */

function thb_image_rel($content) {	
	$pattern = "/<a(.*?)href=('|\")(.*?).(bmp|gif|jpeg|jpg|png)('|\")(.*?)>/i";
	$replacement = '<a$1rel="mfp" href=$2$3.$4$5$6>';
  $content = preg_replace($pattern, $replacement, $content);
  return $content;
}
add_filter('the_content', 'thb_image_rel');

/* Sibling Categories */
function thb_sibling_categories($current_category = false) {
    $output = '';

    if (!empty($current_category->cat_ID)) {

      if ($current_category->parent === 0) {
				// child categories
        $categories = get_categories( array(
	        'parent'     => $current_category->cat_ID
        ) );
      }

      
      if (empty($categories)) {
      	// siblings categories
        $categories = get_categories(array(
	        'parent'        => $current_category->parent
        ));
      }
    }

    if (!empty($categories)) {
	    $output .= '<ul class="thb-sibling-categories">';
				foreach ($categories as $category) {
					$output .= '<li><a href="' . get_category_link($category->cat_ID) . '" title="' . $category->name . '">' . $category->name . '</a></li>';
				}
	    $output .= '<li class="thb-pull-down"><a href="#">'.esc_html__('More','goodlife'). '<i class="fa fa-angle-down"></i></a><div class="sub-menu-holder"><ul class="sub-menu"></ul></div></li></ul>';
    }

    echo wp_kses_post($output);
}
add_action( 'thb_Sibling_Categories', 'thb_sibling_categories', 10, 1 );

/* Get Single Category ID */
function thb_getSingleCategory() {
	$selection = get_post_meta(get_the_id(), 'post-primary-category', true);
	
	if (!$selection || $selection === 'auto') { 
	  if ( empty($id)) {
	    $id = '';
	    $categories = get_the_category();
	
	    if ( empty( $categories ) ) return;
	    while ( empty($id) && ! empty($categories) ) {
	      $cat = array_shift($categories);
	      if ( $cat->parent == 0 ) $id = $cat->term_id;
	    }
	  }
	  // if no parent cat found, but a not-parent cat id passed to function use that
	  if ( ! (int) $id && isset($backup) ) $id = $backup;
	  if ( ! (int) $id ) return;
	} else {
		$id = $selection;
	}
  return $id;
}
function thb_fb_information() {
	$sharing_type =  ot_get_option('sharing_buttons') ? ot_get_option('sharing_buttons') : array();
	
	if (in_array('facebook',$sharing_type) && is_single()) {
			$image_id = get_post_thumbnail_id();
	    $image_link = wp_get_attachment_image_src($image_id, 'full');
		?>
		<?php if ($fb_app_id = ot_get_option('facebook_app_id')) { ?>
		<meta property="fb:app_id" content="<?php echo esc_attr($fb_app_id); ?>" /> 
		<?php } ?>
		<meta property="og:title" content="<?php the_title_attribute(); ?>" />
		<meta property="og:type" content="article" />
		<meta property="og:description" content="<?php echo esc_html(thb_excerpt(200, false, false)); ?>" />
		<meta property="og:image" content="<?php echo $image_link[0]; ?>" />
		<meta property="og:url" content="<?php the_permalink(); ?>" />
		<?php
	}
}
add_action( 'wp_head', 'thb_fb_information',3 );

/* Display Single Category */
function thb_DisplaySingleCategory($boxed = true, $id = false) {
	$selection = get_post_meta(get_the_id(), 'post-primary-category', true);
	
	if (!$selection || $selection === 'auto') { 
	  if ( (int) $id ) {
	    $cat = get_category($id);
	    if ( ! empty($cat) ) {
	       $backup = $cat->term_id;
	       if ( $cat->parent == 0 ) $id = $cat->term_id;
	    }
	  }
	  if ( empty($id)) {
	    $id = '';
	    $categories = get_the_category();
	
	    if ( empty( $categories ) ) return;
	    while ( empty($id) && ! empty($categories) ) {
	      $cat = array_shift($categories);
	      if ( $cat->parent == 0 ) $id = $cat->term_id;
	    }
	  }
	  // if no parent cat found, but a not-parent cat id passed to function use that
	  if ( ! (int) $id && isset($backup) ) $id = $backup;
	  if ( ! (int) $id ) return;
	} else {
		$id = $selection;
	}
  $name = get_cat_name($id);
  $url = esc_url( get_category_link($id) );
  $class = $boxed ? ' class="single_category_title boxed-link category-boxed-link-'.$id.'"' : ' class="single_category_title category-link-'.$id.'"';
  $frmt = '<a href="%s"%s title="%s">%s</a>';
  echo sprintf( $frmt, $url, $class, esc_attr($name), esc_html($name) );
}
add_action( 'thb_DisplaySingleCategory', 'thb_DisplaySingleCategory',3 );

/* Get Category Color */
function thb_GetCategoryColor($id) {
	$color = ot_get_option('category_colors_'. $id, '#666');
	return $color;
}
/* Blockquote Shortcode */
function thb_blockquote( $atts, $content = null ) {
    extract(shortcode_atts(array(
       	'pull'      => '',
       	'author'    => ''
    ), $atts));
	$authorhtml = '';
	if ($author) {
		$authorhtml = '<cite>'. $author. '</cite>';
	}
	$out = '<blockquote class="styled '.$pull.'"><p>' .$content. $authorhtml. '</p></blockquote>';
    return $out;
}
add_shortcode('blockquote', 'thb_blockquote');

/* Thb Header Search */
function thb_quick_search() {
 ?>
	<div class="quick_search">
		<a href="#" class="quick_toggle"></a>
		<svg version="1.1" class="quick_search_icon" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="20px" height="20px" viewBox="0 -1 20 18" xml:space="preserve">
			<path d="M18.96,16.896l-4.973-4.926c1.02-1.255,1.633-2.846,1.633-4.578c0-4.035-3.312-7.317-7.385-7.317S0.849,3.358,0.849,7.393
				c0,4.033,3.313,7.316,7.386,7.316c1.66,0,3.188-0.552,4.422-1.471l4.998,4.95c0.181,0.179,0.416,0.268,0.652,0.268
				c0.235,0,0.472-0.089,0.652-0.268C19.32,17.832,19.32,17.253,18.96,16.896z M2.693,7.393c0-3.027,2.485-5.489,5.542-5.489
				c3.054,0,5.541,2.462,5.541,5.489c0,3.026-2.486,5.489-5.541,5.489C5.179,12.882,2.693,10.419,2.693,7.393z"/>
		</svg>
		<?php get_search_form(); ?>
	</div>
	
<?php
}
add_action( 'thb_quick_search', 'thb_quick_search',3 );

/* Author */
function thb_author($id) {
	$id = $id ? $id : get_the_author_meta( 'ID' );
	if (is_author()) {
		$count = count_user_posts($id);
		$comments = get_comments(array('author__in' => array($id), 'count' => 1));
	}
	?>
	<?php echo get_avatar( $id , '164'); ?>
	<div class="author-content">
		<h5><a href="<?php echo esc_url(get_author_posts_url( $id )); ?>"><?php the_author_meta('display_name', $id ); ?></a></h5>
		<?php if (is_author()) { ?>
			<?php if(get_the_author_meta('position', $id) != '') { ?>
				<h4><?php echo get_the_author_meta('position', $id ); ?></h4>
			<?php } ?>
			<span><?php echo esc_attr($count); ?> <?php _e('Articles', 'goodlife'); ?></span><span><?php echo esc_attr($comments); ?> <?php _e('Comments', 'goodlife'); ?></span>
		<?php } ?>
		<p><?php the_author_meta('description', $id ); ?></p>
		<?php if(get_the_author_meta('url', $id ) != '') { ?>
			<a href="<?php echo esc_url(get_the_author_meta('url', $id )); ?>"><i class="fa fa-link"></i></a>
		<?php } ?>
		<?php if(get_the_author_meta('twitter', $id ) != '') { ?>
			<a href="<?php echo esc_url(get_the_author_meta('twitter', $id )); ?>" class="twitter"><i class="fa fa-twitter"></i></a>
		<?php } ?>
		<?php if(get_the_author_meta('facebook', $id ) != '') { ?>
			<a href="<?php echo esc_url(get_the_author_meta('facebook', $id )); ?>" class="facebook"><i class="fa fa-facebook"></i></a>
		<?php } ?>
		<?php if(get_the_author_meta('googleplus', $id ) != '') { ?>
			<a href="<?php echo esc_url(get_the_author_meta('googleplus', $id )); ?>" class="google-plus"><i class="fa fa-google-plus"></i></a>
		<?php } ?>
	</div>
	<?php
}
add_action( 'thb_author', 'thb_author',3 );

/* Social Icons */
function thb_social_header() {
	?>
	<li class="menu-item-has-children">
		<a href="#"><?php _e('Follow Us', 'goodlife'); ?></a>
		<ul class="sub-menu">
			<?php if ($fb = ot_get_option('fb_link_header')) { ?>
			<li><a href="<?php echo esc_url($fb); ?>" class="facebook icon-1x" target="_blank"><i class="fa fa-facebook"></i> <?php _e('Facebook', 'goodlife'); ?></a></li>
			<?php } ?>
			<?php if ($pi = ot_get_option('pinterest_link_header')) { ?>
			<li><a href="<?php echo esc_url($pi); ?>" class="pinterest icon-1x" target="_blank"><i class="fa fa-pinterest"></i> <?php _e('Pinterest', 'goodlife'); ?></a></li>
			<?php } ?>
			<?php if ($tw = ot_get_option('twitter_link_header')) { ?>
			<li><a href="<?php echo esc_url($tw); ?>" class="twitter icon-1x" target="_blank"><i class="fa fa-twitter"></i> <?php _e('Twitter', 'goodlife'); ?></a></li>
			<?php } ?>
			<?php if ($li = ot_get_option('linkedin_link_header')) { ?>
			<li><a href="<?php echo esc_url($li); ?>" class="linkedin icon-1x" target="_blank"><i class="fa fa-linkedin"></i> <?php _e('Linkedin', 'goodlife'); ?></a></li>
			<?php } ?>
			<?php if ($in = ot_get_option('instragram_link_header')) { ?>
			<li><a href="<?php echo esc_url($in); ?>" class="instagram icon-1x" target="_blank"><i class="fa fa-instagram"></i> <?php _e('Instagram', 'goodlife'); ?></a></li>
			<?php } ?>
			<?php if ($xi = ot_get_option('xing_link_header')) { ?>
			<li><a href="<?php echo esc_url($xi); ?>" class="xing icon-1x" target="_blank"><i class="fa fa-xing"></i> <?php _e('Xing', 'goodlife'); ?></a></li>
			<?php } ?>
			<?php if ($tu = ot_get_option('tumblr_link_header')) { ?>
			<li><a href="<?php echo esc_url($tu); ?>" class="tumblr icon-1x" target="_blank"><i class="fa fa-tumblr"></i> <?php _e('Tumblr', 'goodlife'); ?></a></li>
			<?php } ?>
			<?php if ($vk = ot_get_option('vk_link_header')) { ?>
			<li><a href="<?php echo esc_url($vk); ?>" class="vk icon-1x" target="_blank"><i class="fa fa-vk"></i> <?php _e('VKontakte', 'goodlife'); ?></a></li>
			<?php } ?>
			<?php if ($gp = ot_get_option('googleplus_link_header')) { ?>
			<li><a href="<?php echo esc_url($gp); ?>" class="google-plus icon-1x" target="_blank"><i class="fa fa-google-plus"></i> <?php _e('Google Plus', 'goodlife'); ?></a></li>
			<?php } ?>
			<?php if ($sc = ot_get_option('soundcloud_link_header')) { ?>
			<li><a href="<?php echo esc_url($sc); ?>" class="soundcloud icon-1x" target="_blank"><i class="fa fa-soundcloud"></i> <?php _e('Soundcloud', 'goodlife'); ?></a></li>
			<?php } ?>
			<?php if ($dr = ot_get_option('dribbble_link_header')) { ?>
			<li><a href="<?php echo esc_url($dr); ?>" class="dribbble icon-1x" target="_blank"><i class="fa fa-dribbble"></i> <?php _e('Dribbble', 'goodlife'); ?></a></li>
			<?php } ?>
			<?php if ($yt = ot_get_option('youtube_link_header')) { ?>
			<li><a href="<?php echo esc_url($yt); ?>" class="youtube icon-1x" target="_blank"><i class="fa fa-youtube"></i> <?php _e('Youtube', 'goodlife'); ?></a></li>
			<?php } ?>
			<?php if ($sp = ot_get_option('spotify_link_header')) { ?>
			<li><a href="<?php echo esc_url($sp); ?>" class="spotify icon-1x" target="_blank"><i class="fa fa-spotify"></i> <?php _e('Spotify', 'goodlife'); ?></a></li>
			<?php } ?>
			<?php if ($be = ot_get_option('behance_link_header')) { ?>
			<li><a href="<?php echo esc_url($be); ?>" class="behance icon-1x" target="_blank"><i class="fa fa-behance"></i> <?php _e('Behance', 'goodlife'); ?></a></li>
			<?php } ?>
			<?php if ($da = ot_get_option('deviantart_link_header')) { ?>
			<li><a href="<?php echo esc_url($da); ?>" class="deviantart icon-1x" target="_blank"><i class="fa fa-deviantart"></i> <?php _e('Deviantart', 'goodlife'); ?></a></li>
			<?php } ?>
			<?php if ($rss = ot_get_option('rss_link_header')) { ?>
			<li><a href="<?php echo esc_url($rss); ?>" class="rss icon-1x" target="_blank"><i class="fa fa-rss"></i> <?php _e('RSS', 'goodlife'); ?></a></li>
			<?php } ?>
		</ul>
	</li>
	<?php
}
add_action( 'thb_social_header', 'thb_social_header',3 );

/* Social Icons */
function thb_social_header_mobile() {
	?>
	<?php if ($fb = ot_get_option('fb_link_header')) { ?>
	<a href="<?php echo esc_url($fb); ?>" class="facebook icon-1x" target="_blank"><i class="fa fa-facebook"></i></a>
	<?php } ?>
	<?php if ($pi = ot_get_option('pinterest_link_header')) { ?>
	<a href="<?php echo esc_url($pi); ?>" class="pinterest icon-1x" target="_blank"><i class="fa fa-pinterest"></i></a>
	<?php } ?>
	<?php if ($tw = ot_get_option('twitter_link_header')) { ?>
	<a href="<?php echo esc_url($tw); ?>" class="twitter icon-1x" target="_blank"><i class="fa fa-twitter"></i></a>
	<?php } ?>
	<?php if ($li = ot_get_option('linkedin_link_header')) { ?>
	<a href="<?php echo esc_url($li); ?>" class="linkedin icon-1x" target="_blank"><i class="fa fa-linkedin"></i></a>
	<?php } ?>
	<?php if ($in = ot_get_option('instragram_link_header')) { ?>
	<a href="<?php echo esc_url($in); ?>" class="instagram icon-1x" target="_blank"><i class="fa fa-instagram"></i></a>
	<?php } ?>
	<?php if ($xi = ot_get_option('xing_link_header')) { ?>
	<a href="<?php echo esc_url($xi); ?>" class="xing icon-1x" target="_blank"><i class="fa fa-xing"></i></a>
	<?php } ?>
	<?php if ($tu = ot_get_option('tumblr_link_header')) { ?>
	<a href="<?php echo esc_url($tu); ?>" class="tumblr icon-1x" target="_blank"><i class="fa fa-tumblr"></i></a>
	<?php } ?>
	<?php if ($vk = ot_get_option('vk_link_header')) { ?>
	<a href="<?php echo esc_url($vk); ?>" class="vk icon-1x" target="_blank"><i class="fa fa-vk"></i></a>
	<?php } ?>
	<?php if ($gp = ot_get_option('googleplus_link_header')) { ?>
	<a href="<?php echo esc_url($gp); ?>" class="google-plus icon-1x" target="_blank"><i class="fa fa-google-plus"></i></a>
	<?php } ?>
	<?php if ($sc = ot_get_option('soundcloud_link_header')) { ?>
	<a href="<?php echo esc_url($sc); ?>" class="soundcloud icon-1x" target="_blank"><i class="fa fa-soundcloud"></i></a>
	<?php } ?>
	<?php if ($dr = ot_get_option('dribbble_link_header')) { ?>
	<a href="<?php echo esc_url($dr); ?>" class="dribbble icon-1x" target="_blank"><i class="fa fa-dribbble"></i></a>
	<?php } ?>
	<?php if ($yt = ot_get_option('youtube_link_header')) { ?>
	<a href="<?php echo esc_url($yt); ?>" class="youtube icon-1x" target="_blank"><i class="fa fa-youtube"></i></a>
	<?php } ?>
	<?php if ($sp = ot_get_option('spotify_link_header')) { ?>
	<a href="<?php echo esc_url($sp); ?>" class="spotify icon-1x" target="_blank"><i class="fa fa-spotify"></i></a>
	<?php } ?>
	<?php if ($be = ot_get_option('behance_link_header')) { ?>
	<a href="<?php echo esc_url($be); ?>" class="behance icon-1x" target="_blank"><i class="fa fa-behance"></i></a>
	<?php } ?>
	<?php if ($da = ot_get_option('deviantart_link_header')) { ?>
	<a href="<?php echo esc_url($da); ?>" class="deviantart icon-1x" target="_blank"><i class="fa fa-deviantart"></i></a>
	<?php } ?>
	<?php if ($rss = ot_get_option('rss_link_header')) { ?>
	<a href="<?php echo esc_url($rss); ?>" class="rss icon-1x" target="_blank"><i class="fa fa-rss"></i></a>
	<?php } ?>
	<?php
}
add_action( 'thb_social_header_mobile', 'thb_social_header_mobile',3 );

/* Mobile Menu */
function thb_mobile_menu() {
	?>
		<nav id="mobile-menu">
			<div class="custom_scroll" id="menu-scroll">
				<div>
					<?php if(has_nav_menu('mobile-menu')) { ?>
					  <?php wp_nav_menu( array( 'theme_location' => 'mobile-menu', 'depth' => 3, 'container' => false, 'menu_class' => 'mobile-menu', 'walker' => new thb_mobileDropdown ) ); ?>
					<?php } else { ?>
						<ul class="mobile-menu">
							<li><a href="<?php echo get_admin_url().'nav-menus.php'; ?>"><?php esc_html_e( 'Please assign a menu', 'goodlife' ); ?></a></a></li>
						</ul>
					<?php } ?>
					<div class="social-links">
						<?php do_action( 'thb_social_header_mobile' ); ?>
					</div>
					<div class="menu-footer">
						<?php echo do_shortcode(ot_get_option('menu_footer')); ?>
					</div>
				</div>
			</div>
		</nav>
	<?php
}
add_action( 'thb_mobile_menu', 'thb_mobile_menu',3 );

/* Post Categories Array */
function thb_blogCategories(){
	$blog_categories = get_categories();
	$out = array();
	foreach($blog_categories as $category) {
		$out[$category->name] = $category->cat_ID;
	}
	return $out;
}

function thb_post_nav() {
		$prev_post = get_adjacent_post(false, '', true);
		
		?>
			<div class="row post-navi hide-on-print no-padding" data-equal=">.columns">
				<div class="small-12 medium-6 columns">
					<?php
					if(!empty($prev_post)) {
						$excerpt = $prev_post->post_content;
						$previd = $prev_post->ID;
						
						echo '<span>'.esc_html__('Previous Article', 'goodlife').'</span><a href="' . get_permalink($previd) . '" title="' . $prev_post->post_title . '">' . $prev_post->post_title. '</a>'; 
					} else {
						echo '<span>'.esc_html__('No Older Articles', 'goodlife').'</span>';
					}
				?>
				</div>
				<div class="small-12 medium-6 columns">
					<?php
						$next_post = get_adjacent_post(false, '', false);
						
						if(!empty($next_post)) {
							$excerptnext = $next_post->post_content;
							$nextid = $next_post->ID;
							
							echo '<span>'.esc_html__('Next Article', 'goodlife').'</span><a href="' . get_permalink($nextid) . '" title="' . $next_post->post_title . '">' . $next_post->post_title . '</a>'; 
						} else {
							echo '<span>'.esc_html__('No Newer Articles', 'goodlife').'</span>';
						}
					?>
				</div>
			</div>
		<?php
}
add_action( 'thb_post_nav', 'thb_post_nav',3 );

/* Human time */
function thb_human_time_diff_enhanced( $duration = 60 ) {

	$post_time = get_the_time('U');
	$human_time = '';

	$time_now = date('U');

	// use human time if less that $duration days ago (60 days by default)
	// 60 seconds * 60 minutes * 24 hours * $duration days
	if ( $post_time > $time_now - ( 60 * 60 * 24 * $duration ) ) {
		$human_time = sprintf( esc_html__( '%s ago', 'goodlife'), human_time_diff( $post_time, current_time( 'timestamp' ) ) );
	} else {
		$human_time = get_the_date();
	}

	if (ot_get_option('relative_dates', 'on') == 'off') {
		return get_the_date();
	} else {
		return $human_time;
	}

}
// Do Shortcodes inside widgets
add_filter('widget_text', 'do_shortcode');

/**
 * Shorten large numbers into abbreviations (i.e. 1,500 = 1.5k)
 *
 * @param int    $number  Number to shorten
 * @return String   A number with a symbol
 */ 
function thb_numberAbbreviation($number) {
    $abbrevs = array(12 => "T", 9 => "B", 6 => "M", 3 => "K", 0 => "");

	if ($number > 999) {
	    foreach($abbrevs as $exponent => $abbrev) {
	        if($number >= pow(10, $exponent)) {
	        	$display_num = $number / pow(10, $exponent);
	        	$decimals = ($exponent >= 3 && round($display_num) < 100) ? 1 : 0;
	            return number_format($display_num,$decimals) . $abbrev;
	        }
	    }
	} else {
		return $number;	
	}
}

// thb Tag Cloud Size
function thb_tag_cloud_filter($args = array()) {
   $args['smallest'] = 10;
   $args['largest'] = 10;
   $args['unit'] = 'px';
   $args['format']= 'list';
   return $args;
}

add_filter('widget_tag_cloud_args', 'thb_tag_cloud_filter', 90);

function thb_dns_prefetch() {
	echo '
	<meta http-equiv="x-dns-prefetch-control" content="on">
	<link rel="dns-prefetch" href="//fonts.googleapis.com" />
	<link rel="dns-prefetch" href="//fonts.gstatic.com" />
	<link rel="dns-prefetch" href="//0.gravatar.com/" />
	<link rel="dns-prefetch" href="//2.gravatar.com/" />
	<link rel="dns-prefetch" href="//1.gravatar.com/" />
	';
}
add_action('wp_head', 'thb_dns_prefetch', 0);

// Get Term Meta
if(!function_exists('get_term_meta')) {
	function get_term_meta( $term_id, $key = '', $single = false ) {
		// Bail if term meta table is not installed.
		if ( get_option( 'db_version' ) < 34370 ) {
			return false;
		}
		return get_metadata( 'term', $term_id, $key, $single );
	}
}
if(!function_exists('get_term_meta')) {
	function update_term_meta( $term_id, $meta_key, $meta_value, $prev_value = '' ) {
		// Bail if term meta table is not installed.
		if ( get_option( 'db_version' ) < 34370 ) {
			return false;
		}
		if ( wp_term_is_shared( $term_id ) ) {
			return new WP_Error( 'ambiguous_term_id', __( 'Term meta cannot be added to terms that are shared between taxonomies.'), $term_id );
		}
		$updated = update_metadata( 'term', $term_id, $meta_key, $meta_value, $prev_value );
		// Bust term query cache.
		if ( $updated ) {
			wp_cache_set( 'last_changed', microtime(), 'terms' );
		}
		return $updated;
	}
}

// Remove src= attribute

function thb_src_attribute( $html, $post_id, $post_image_id ) {
	if (ot_get_option('lazy_load', 'on') == 'on') {
		if (!strpos($html, 'no-lazy-load')) {
	    $html = preg_replace( '/src=/', 'data-original=', $html );
	    $html = preg_replace( '/srcset=/', 'data-original-set=', $html );
		}
	}
  return $html; 
}
add_filter( 'post_thumbnail_html', 'thb_src_attribute', 10, 3 );

// Redirect
function thb_disable_redirect_canonical($redirect_url) {
	if (is_singular() && is_page()) { $redirect_url = false; }
	return $redirect_url;
}
add_filter('redirect_canonical','thb_disable_redirect_canonical');


function thb_hide_wp_update_nag() {
    remove_action( 'admin_notices', 'wp_rankie_admin_notice' );
    remove_action( 'admin_notices', 'wpvq_notice_addons_1' );
}
add_action('admin_menu','thb_hide_wp_update_nag');

/*--------------------------------------------------------------------*/                							
/*  ADD DASHBOARD LINK			                							
/*--------------------------------------------------------------------*/
function thb_admin_menu_new_items() {
    global $submenu;
    $submenu['index.php'][500] = array( 'Fuelthemes.net', 'manage_options' , 'http://fuelthemes.net/?ref=wp_sidebar' ); 
}
add_action( 'admin_menu' , 'thb_admin_menu_new_items' );


/*--------------------------------------------------------------------*/         							
/*  FOOTER TYPE EDIT									 					
/*--------------------------------------------------------------------*/
function thb_footer_admin () {  
  return 'Thank you for choosing <a href="http://fuelthemes.net/?ref=wp_footer" target="blank">Fuel Themes</a>.';  
}
add_filter('admin_footer_text', 'thb_footer_admin'); 
?>