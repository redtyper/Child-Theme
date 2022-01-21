<?php get_header(); ?>

    <main>
        <div class="c-2 leftbox">
            <img src="<?php echo bloginfo('template_url') ?>/img/wystawy.jpg" alt="Wystawy" class="full">
            <h3>Wystawy</h3>
            <?php
            $args = array('child_of' => 3);
            $categories = get_categories($args);
            foreach ($categories as $category) {
                echo '<a href="' . get_category_link($category->term_id) . '" title="' . $category->description . '"' . '>' . $category->name . ' <span>(' . $category->count . ')</span></a>';
            }
            ?>
        </div>
        <div class="c-8 centerbox">

            <nav>
                <?php if (dynamic_sidebar('header')) : else : endif; ?>
                <div class="cb"></div>
            </nav>

            <div class="cb"></div>
            <?php
            $category = get_queried_object();
            $parid = $category->parent;
            $catid = $category->term_id;
            $catname = $category->name; // cat_name
            $catdesc = $category->description; //category_description

            ?>

            <?php
            if (is_front_page()) {
                echo 'Strona glowna';
            } else if ($parid == 3 || $parid == 4) {
                //if($parid==3){echo 'Wystawy';}
                //if($parid==4){echo 'Artysci';}
                //echo '<h2>'.$catname.'</h2>';

                if ($catdesc != '') {
                    echo '<div class="catdesc"><p>' . $catdesc . '</p></div>';
                }

                $lista = new WP_Query("cat=" . $catid);
                if ($lista->have_posts()) {

                    $wynik = '';
                    $wyniktm = '';

                    while ($lista->have_posts()) {
                        $lista->the_post();
                        global $post;
                        //echo '<li><a href='.get_permalink().'>'.get_the_title().'</a></li>';

                        if (get_post_gallery($post)) {
                            $gallery = get_post_gallery($post, false);
                            $galleryids = explode(",", $gallery['ids']);


                            foreach ($galleryids as $id) {
                                $attachment_meta = wp_get_attachment($id);
                                //$wynik.='<div class="bigimg"><a href="'.$attachment_meta['src'].'"><img src="'.$attachment_meta['src'].'" alt="'.$attachment_meta['caption'].'" /></a></div>';
                                //$wyniktm.='<div class="tmbimg"><a href="'.$attachment_meta['src'].'"><img style="width:50px" src="'.$attachment_meta['src'].'" /></a></div>';
                                $wynik .= '<li data-thumb="' . $attachment_meta['src'] . '" data-src="' . $attachment_meta['src'] . '"><img src="' . $attachment_meta['src'] . '" /><div class="caption"><p>' . $attachment_meta['caption'] . '</p></div></li>';
                            }
                        }

                    }

                    echo '<div id="carousel"><ul id="imageGallery">';
                    echo $wynik;
                    echo '</ul></div>';


                }
            } else {

                if (have_posts()) : while (have_posts()) : the_post();
                    if (!is_front_page()) {
                        the_title();
                    }
                    the_content(__('(więcej...)'));
                endwhile;
                else:
                    _e('Brak wyników.');
                endif;

            }
            ?>


        </div>
        <div class="c-2 rightbox">
            <img src="<?php echo bloginfo('template_url') ?>/img/artysci.jpg" alt="Artyści" class="full">
            <h3>Artyści</h3>
            <?php
            $args2 = array('child_of' => 4);
            $categories2 = get_categories($args2); /*wp_list_categories*/
            foreach ($categories2 as $category) {
                echo '<a href="' . get_category_link($category->term_id) . '" title="' . $category->description . '"' . '>' . $category->name . ' <span>(' . $category->count . ')</span></a>';
            }
            ?>
        </div>
    </main>
    <div class="cb"></div>

<?php //get_sidebar(); ?>

<?php get_footer(); ?>