<?php function cprna_wp_head() { ?>
	<meta name="Description" content="The C&P Region of Narcotics Anonymous serves the recovering addicts of the Washington DC Metropolitan Area in Maryland, Northern Virginia, and the District of Columbia." />

	<meta name="keywords" content="addiction, recovery, drug problem, substance abuse, support groups, twelve steps, twelve step programs, twelve step meetings, 12-step, na, aa, narcotics anonymous, NA meetings, washington dc, district of columbia, northern virginia, maryland, alcohol, marijuana, heroin, crack, crystal meth" />

	<link rel="shortcut icon" href="<?php bloginfo('stylesheet_directory'); ?>/favicon.ico" />
	<?php if(is_page(450)) { ?>

	<style type="text/css">
	  .bmlt_simple_meeting_one_meeting_weekday_td {
		display:none;
	  }
	</style>
<?php } 
}

function cprna_wp_footer() { ?>
	<?php // This bit of php turns off google analytics for admin users.
	get_currentuserinfo();
	global $user_level;
	if ($user_level == 0) { ?>
	<script type="text/javascript">
		var _gaq = _gaq || [];
		_gaq.push(['_setAccount', 'UA-32957349-1']);
		_gaq.push(['_trackPageview']);

		(function() {
		var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
		ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
		var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
		})();
	</script>
<?php }}

function cprna_posted_on() {
	printf( __( '<span class="%1$s">Posted on</span> %2$s <span class="meta-sep">by</span> %3$s', 'twentyten' ),
		'meta-prep meta-prep-author',
		sprintf( '<a href="%1$s" title="%2$s" rel="bookmark"><span class="entry-date">%3$s</span></a>',
			get_permalink(),
			esc_attr( get_the_time() ),
			get_the_date()
		),
		sprintf( '<span class="author vcard">%1$s</span>',
			get_the_author_meta('user_firstname')
		)
	);
}

function cprna_strip_bmlt_class_names_filter($content) {
  return preg_replace('[class="bmlt_simple_meetings_table"]', 'class="table"', $content, 1);
}

add_filter( 'the_content', 'cprna_strip_bmlt_class_names_filter');


function cprna_get_meeting_format_codes_modal() {
  $meetingFormatCodeModal .= '<div class="modal hide" id="meetingFormatModal" tabindex="-1" role="dialog" aria-labelledby="meetingFormatModalLabel">';
  $meetingFormatCodeModal .= '<div class="modal-dialog">';
  $meetingFormatCodeModal .= '<div class="modal-content">';
  $meetingFormatCodeModal .= '<div class="modal-header">';
  $meetingFormatCodeModal .= '<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>';
  $meetingFormatCodeModal .= '<h4>Meeting Format Codes</h4>';
  $meetingFormatCodeModal .= '</div>';
  $meetingFormatCodeModal .= '<div class="modal-body">';
  $meetingFormatCodeModal .= '<p>[[BMLT_SIMPLE(switcher=GetFormats)]]</p>'; 
  $meetingFormatCodeModal .= '</div>';
  $meetingFormatCodeModal .= '<div class="modal-footer">';
  $meetingFormatCodeModal .= '<a href="#" class="btn" data-dismiss="modal">Close</a>';
  $meetingFormatCodeModal .= '</div>';
  $meetingFormatCodeModal .= '</div><!-- /.modal-content -->';
  $meetingFormatCodeModal .= '</div><!-- /.modal-dialog -->';
  $meetingFormatCodeModal .= '</div><!-- /.modal -->';
  return $meetingFormatCodeModal;
}

function cprna_regional_meetinglist_shortcode_filter($content) {
	 $meetingListShortcodeFormat .= '<div class="table-responsive">[[BMLT_SIMPLE(switcher=GetSearchResults'; 
	 $meetingListShortcodeFormat .= '&weekdays=%s&meeting_key[]=location_province&meeting_key_value=%s';
	 $meetingListShortcodeFormat .= '&services[]=37&services[]=38&services[]=39&services[]=40&services[]=41&services[]=42&services[]=43&services[]=44&services[]=45&services[]=46&services[]=47&services[]=48';
	 $meetingListShortcodeFormat .= '&sort_key=time';
   $meetingListShortcodeFormat .= ')]]</div>';
   $meetingListShortcodeFormat .= cprna_get_meeting_format_codes_modal();


	 $dayofweek = get_meetinglist_dayofweek();
	 $state = get_meetinglist_state();
	 return preg_replace('[\[regional-meeting-list\]]', sprintf($meetingListShortcodeFormat, $dayofweek, $state), $content, 1);
}

add_filter( 'the_content', 'cprna_regional_meetinglist_shortcode_filter', 1);

function cprna_area_meetinglist_shortcode_filter($content) {
  $meetingListContent .= '<p>Please inform us of any additions or corrections to this meeting list at <a href="mailto:meetings@cprna.org">meetings@cprna.org</a>.</p>';
  $meetingListContent .= '<div class="row-fluid">';
  $meetingListContent .= '<h3 style="float:left">Meetings</h3>';
  $meetingListContent .= '</div>';
  $meetingListContent .= '<div class="table-responsive">[[BMLT_SIMPLE(switcher=GetSearchResults&services[]=%s&sort_key=time)]]</div>';
  $meetingListContent .= cprna_get_meeting_format_codes_modal();
  $serviceBodyId = get_service_body_id();

  if ($serviceBodyId != '') {
    return preg_replace('[\[area-meeting-list\]]', sprintf($meetingListContent, $serviceBodyId), $content, 1);
  }
  else
  {
    return $content;
  }
}

add_filter( 'the_content', 'cprna_area_meetinglist_shortcode_filter', 1);

function get_service_body_id()
{
  global $post;
  $slug = $post->post_name;

  switch($slug) {
    case 'battlefield-area':
      return '38';
    case 'central-maryland-area':
      return '39';
    case 'district-of-columbia-area':
      return '40';
    case 'dulles-corridor-area':
      return '41';
    case 'east-of-the-river-area':
      return '42';
    case 'frederick-area':
      return '43';
    case 'montgomery-area':
      return '44';
    case 'northern-virginia-area';
      return '45';
    case 'rock-creek-area':
      return '46';
    case 'south-potomac-area':
      return '47';
    case 'tri-county-of-southern-maryland-area':
      return '48';
  }

  return '';
}

function get_meetinglist_dayofweek(){
	$dayofweek = $_GET['dayofweek'];
	
	if (preg_match('/[1-7]$/', $dayofweek) == 0)
	{
    date_default_timezone_set('EST');
    $dayofweek = date("w")+1;
	}
	
	return $dayofweek;
}


function get_meetinglist_state(){
 $state = strtolower($_GET['state']);
 if (preg_match('/dc$|md$|va$/', $state) == 0){
  $state = 'dc';
 }
 return $state;
}

function get_listtag($isActive, $displayName, $url) {
 $listTag = '<li class="';

 if ($isActive) {
  $listTag .= 'active';
 }

 $listTag .= '"><a href="'.$url.'">'.$displayName.'</a></li>';

 return $listTag;
}

function get_meetinglist_statemenu_listitems($atts) {
 $urlFormat = '/find-a-meeting/meeting-list/?dayofweek='.get_meetinglist_dayofweek().'&state=%s';
 $selectedState = get_meetinglist_state();

 $stateListTags = get_listtag($selectedState=='dc', 'Washington, DC', sprintf($urlFormat, 'dc'));
 $stateListTags .= get_listtag($selectedState=='md', 'Maryland', sprintf($urlFormat, 'md'));
 $stateListTags .= get_listtag($selectedState=='va', 'Virginia', sprintf($urlFormat, 'va'));
 $stateListTags .= '<li class="pull-right"><div><a class="btn pull-right" data-toggle="modal" href="#meetingFormatModal" >Meeting Format Code Legend</a></div></li>';
 return $stateListTags;
}


function get_meetinglist_dayofweekmenu_listitems($atts) {
 $urlFormat = '/find-a-meeting/meeting-list/?dayofweek=%s&state='.get_meetinglist_state(); $dayofweek = get_meetinglist_dayofweek();
 $selecteddayofweek = get_meetinglist_dayofweek();

 $dayOfWeekListTags = get_listtag($selecteddayofweek=='1', 'Sunday', sprintf($urlFormat, '1'));
 $dayOfWeekListTags .= get_listtag($selecteddayofweek=='2', 'Monday', sprintf($urlFormat, '2'));
 $dayOfWeekListTags .= get_listtag($selecteddayofweek=='3', 'Tuesday', sprintf($urlFormat, '3'));
 $dayOfWeekListTags .= get_listtag($selecteddayofweek=='4', 'Wednesday', sprintf($urlFormat, '4'));
 $dayOfWeekListTags .= get_listtag($selecteddayofweek=='5', 'Thursday', sprintf($urlFormat, '5'));
 $dayOfWeekListTags .= get_listtag($selecteddayofweek=='6', 'Friday', sprintf($urlFormat, '6'));
 $dayOfWeekListTags .= get_listtag($selecteddayofweek=='7', 'Saturday', sprintf($urlFormat, '7'));
 return $dayOfWeekListTags;
}

function create_custom_post_types() {
	register_post_type( 'cprna_area_info',
		array(
			'labels' => array(
				'name' => __( 'Area Info Pages' ),
				'singular_name' => __( 'Area Info Page' )
			),
			'public' => true,
			'has_archive' => false,
			'rewrite' => array('slug' => 'our-areas/info'),
			'menu_position' => 5,
			'supports' => array( 'title', 'editor', 'author'),
		)
  );

	register_post_type( 'cprna_area_meetings',
		array(
			'labels' => array(
				'name' => __( 'Area Meeting Pages' ),
				'singular_name' => __( 'Area Meeting Page' )
			),
			'public' => true,
			'has_archive' => false,
			'rewrite' => array('slug' => 'our-areas/meetings'),
			'menu_position' => 6,
			'supports' => array( 'title', 'editor', 'author'),
		)
	);
}

function cprna_has_flyer_event_output_condition($replacement, $condition, $match, $EM_Event){
	if( is_object($EM_Event) && $condition == 'has_flyer' && is_array($EM_Event->event_attributes) ){
		if( !empty($EM_Event->event_attributes['FlyerUrl'])){
			$replacement = preg_replace("/\{\/?$condition\}/", '', $match);
		}else{
			$replacement = '';
		}
	}
	return $replacement;
}
/*
function cprna_add_query_vars() {
	add_rewrite_tag('%area%','([^&]+)');
}

function cprna_add_rewrite_rules() {
    add_rewrite_rule('^our-areas/announcements/([^/]*)/?', 'index.php?name=area-announcements&area=$matches[1]', 'top');
}
*/

function cprna_change_author_base() {
    global $wp_rewrite;
    $author_slug = 'our-areas/news';
    $wp_rewrite->author_base = $author_slug;
}

function cprna_widgets_init() {
	// Area 1, located at the top of the sidebar.
	register_sidebar( array(
		'name' => __( 'Primary Widget Area', 'cprna' ),
		'id' => 'primary-widget-area',
		'description' => __( 'The primary widget area', 'cprna' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h4 class="widget-title">',
		'after_title' => '</h4>',
	) );

	// Area 2, located below the Primary Widget Area in the sidebar. Empty by default.
	register_sidebar( array(
		'name' => __( 'Secondary Widget Area', 'cprna' ),
		'id' => 'secondary-widget-area',
		'description' => __( 'The secondary widget area', 'cprna' ),
		'before_widget' => '<li id="%1$s" class="widget %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h4 class="widget-title">',
		'after_title' => '</h4>',
  ) );
}
add_action( 'widgets_init', 'cprna_widgets_init', 11 );

require_once('wp_bootstrap_navwalker.php');
add_action('init', 'cprna_change_author_base');
add_action( 'init', 'create_custom_post_types' );
add_shortcode('meetinglist-dayofweekmenu-listitems', 'get_meetinglist_dayofweekmenu_listitems');
add_shortcode('meetinglist-statemenu-listitems', 'get_meetinglist_statemenu_listitems');
add_action('wp_head', 'cprna_wp_head');
add_action('wp_footer', 'cprna_wp_footer');
add_action('em_event_output_condition', 'cprna_has_flyer_event_output_condition', 1, 4);
//add_action('init','cprna_add_query_vars');
//add_action('init','cprna_add_rewrite_rules');

?>
