<?php
function is_active_tab($slug_to_check)
{
  global $post; 
  $post_name = $post->post_name;
  $user_info = get_userdata($post->post_author);
  return $slug_to_check == $post_name || $slug_to_check == $user_info->user_login;
}
?>

<div class="well sidebar-nav">
  <ul class="nav nav-list">
    <li <?php echo (is_active_tab('our-areas')) ? 'class="nav-header active"' : 'class="nav-header"'; ?>><a href="/our-areas/info/our-areas">Our Areas</a></li>
    <li <?php if(is_active_tab('battlefield-area')) { echo 'class="active"'; } ?>><a href="/our-areas/info/battlefield/">Battlefield</a></li>
    <li <?php if(is_active_tab('central-maryland-area')) { echo 'class="active"'; } ?>><a href="/our-areas/info/central-maryland/">Central Maryland</a></li>
    <li <?php if(is_active_tab('district-of-columbia-area')) { echo 'class="active"'; } ?>><a href="/our-areas/info/district-of-columbia/">District of Columbia</a></li>
    <li <?php if(is_active_tab('dulles-corridor-area')) { echo 'class="active"'; } ?>><a href="/our-areas/info/dulles-corridor/">Dulles Corridor</a></li>
    <li <?php if(is_active_tab('east-of-the-river-area')) { echo 'class="active"'; } ?>><a href="/our-areas/info/east-of-the-river/">East Of The River</a></li>
    <li <?php if(is_active_tab('frederick-area')) { echo 'class="active"'; } ?>><a href="/our-areas/info/frederick/">Frederick</a></li>
    <li <?php if(is_active_tab('montgomery-area')) { echo 'class="active"'; } ?>><a href="/our-areas/info/montgomery/">Montgomery</a></li>
    <li <?php if(is_active_tab('northern-virginia-area')) { echo 'class="active"'; } ?>><a href="/our-areas/info/northern-virginia/">Northern Virginia</a></li>
    <li <?php if(is_active_tab('rock-creek-area')) { echo 'class="active"'; } ?>><a href="/our-areas/info/rock-creek/">Rock Creek</a></li>
    <li <?php if(is_active_tab('south-potomac-area')) { echo 'class="active"'; } ?>><a href="/our-areas/info/south-potomac/">South Potomac</a></li>
    <li <?php if(is_active_tab('tri-county-of-southern-maryland-area')) { echo 'class="active"'; } ?>><a href="/our-areas/info/tri-county-of-southern-maryland">Tri-County of Southern Maryland</a></li>
  </ul>
</div>

