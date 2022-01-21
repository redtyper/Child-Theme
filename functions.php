<?php
add_theme_support('post-thumbnails');

function arphabet_widgets_init()
{

    register_sidebar(array(
        'name' => 'header',
        'id' => 'header',
        'before_widget' => '',
        'after_widget' => '',
        'before_title' => '',
        'after_title' => '',
    ));

    register_sidebar(array(
        'name' => 'left',
        'id' => 'left',
        'before_widget' => '',
        'after_widget' => '',
        'before_title' => '',
        'after_title' => '',
    ));

    register_sidebar(array(
        'name' => 'bottom',
        'id' => 'bottom',
        'before_widget' => '',
        'after_widget' => '',
        'before_title' => '',
        'after_title' => '',
    ));
}

add_action('widgets_init', 'arphabet_widgets_init');
/*
function add_slug_class_to_menu_item($output){
	$ps = get_option('permalink_structure');
	if(!empty($ps)){
		$idstr = preg_match_all('/<li id="menu-item-(\d+)/', $output, $matches);
		foreach($matches[1] as $mid){
			$id = get_post_meta($mid, '_menu_item_object_id', true);
			$slug = basename(get_permalink($id));
			$output = preg_replace('/menu-item-'.$mid.'">/', 'menu-item-'.$mid.' menu-item-'.$slug.'">', $output, 1);
		}
	}
	return $output;
}
add_filter('wp_nav_menu', 'add_slug_class_to_menu_item');
*/

/**
 * Tests if any of a post's assigned categories are descendants of target categories
 *
 * @param int|array $cats The target categories. Integer ID or array of integer IDs
 * @param int|object $_post The post. Omit to test the current post in the Loop or main query
 * @return bool True if at least 1 of the post's categories is a descendant of any of the target categories
 * @see  get_term_by() You can get a category by name or slug, then pass ID to this function
 * @uses get_term_children() Passes $cats
 * @uses in_category() Passes $_post (can be empty)
 * @version 2.7
 * @link http://codex.wordpress.org/Function_Reference/in_category#Testing_if_a_post_is_in_a_descendant_category
 */
if (!function_exists('post_is_in_descendant_category')) {
    function post_is_in_descendant_category($cats, $_post = null)
    {
        foreach ((array)$cats as $cat) {
            // get_term_children() accepts integer ID only
            $descendants = get_term_children((int)$cat, 'category');
            if ($descendants && in_category($descendants, $_post))
                return true;
        }
        return false;
    }
}


function pw_show_gallery_image_urls($content)
{

    global $post;

    // Only do this on singular items
    if (!is_singular())
        return $content;

    // Make sure the post has a gallery in it
    if (!has_shortcode($post->post_content, 'gallery'))
        return $content;

    // Retrieve the first gallery in the post
    $gallery = get_post_gallery_images($post);

    $image_list = '<ul>';

    // Loop through each image in each gallery
    foreach ($gallery as $image_url) {

        $image_list .= '<li>' . '<img src="' . $image_url . '">' . '</li>';

    }

    $image_list .= '</ul>';

    // Append our image list to the content of our post
    $content .= $image_list;

    return $content;

}

add_filter('the_content', 'pw_show_gallery_image_urls');

function wp_get_attachment($attachment_id)
{

    $attachment = get_post($attachment_id);
    return array(
        'alt' => get_post_meta($attachment->ID, '_wp_attachment_image_alt', true),
        'caption' => $attachment->post_excerpt,
        'description' => $attachment->post_content,
        'href' => get_permalink($attachment->ID),
        'src' => $attachment->guid,
        'title' => $attachment->post_title
    );
}

?>