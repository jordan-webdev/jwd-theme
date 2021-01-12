<?php
// Remove <p> tags wrapping <img> in the_content()
// http://micahjon.com/2016/removing-wrapping-p-paragraph-tags-around-images-wordpress/

//add_filter( 'the_content', 'gc_remove_p_tags_around_images' ,20);
//add_filter ('acf_the_content', 'gc_remove_p_tags_around_images', 20);

function gc_remove_p_tags_around_images($content)
{
	$contentWithFixedPTags =  preg_replace_callback('/<p>((?:.(?!p>))*?)(<a[^>]*>)?\s*(<img[^>]+>)(<\/a>)?(.*?)<\/p>/is', function($matches)
	{

		// image and (optional) link: <a ...><img ...></a>
		$image = $matches[2] . $matches[3] . $matches[4];
		// content before and after image. wrap in <p> unless it's empty
		$content = trim( $matches[1] . $matches[5] );
		if ($content) {
			$content = '<p>'. $content .'</p>';
		}
		return $image . $content;
	}, $content);

	// On large strings, this regular expression fails to execute, returning NULL
	return is_null($contentWithFixedPTags) ? $content : $contentWithFixedPTags;
}
