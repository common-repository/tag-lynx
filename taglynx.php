<?php
/*
Plugin Name: Tag Lynx
Plugin URI: http://www.taglynx.com
Description: Generates interesting (and often random) links from the social networking sites based on your post tags.
Version: 1.0.2
Author: Steven K. Word
Author URI: http://www.stevenword.com
*/

/*
Copyright 2009  Steven K Word  (email : stevenword@gmail.com)

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation; either version 2 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

 You should have received a copy of the GNU General Public License
 along with this program; if not, write to the Free Software
 Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

function display_taglynx($title='<strong>Tag Lynx</strong>',$numLynx=3){

	$tags = get_the_tags();
	if(count($tags)>0 && $tags !=''){
		foreach($tags as $tag){
			$url = 'http://www.taglynx.com/api/?q='.$tag->name;
			$page = file_get_contents($url);
			$pageLinks = explode('<br/>',$page);
			foreach($pageLinks as $pageLink){
				if($pageLink!='')$links[] = $pageLink;
			}//foreach
		}//foreach
		shuffle($links);
		//echo count($links).", ";
		$uniqueLinks = array_unique($links);
		//echo count($uniquieLinks);
		//if(count($uniquieLinks)>0){
		if(count($links)>0){
			$outputLinks = array_slice($links, 0, $numLynx);
			//print_r($outputLinks);
			echo $title;
			foreach($outputLinks as $outputLink)echo $outputLink;
			//echo "<div class='taglynx_footer'>Powered by <a href='http://www.tagamos.com/'>Tagamos.com</a></div>";
		}//if
	}//if
}
?>