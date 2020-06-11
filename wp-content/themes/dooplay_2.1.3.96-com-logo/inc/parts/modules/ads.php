<?php
/* 
* -------------------------------------------------------------------------------------
* @author: Doothemes
* @author URI: https://doothemes.com/
* @aopyright: (c) 2017 Doothemes. All rights reserved
* -------------------------------------------------------------------------------------
*
* @since 2.1.3
*
*/

if($ads = get_option('ads_spot_home')) { echo '<div class="module_home_ads">'. stripslashes($ads). '</div>'; } ?>