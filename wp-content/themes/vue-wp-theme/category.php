<?php
get_header();
$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
$per_page = RADL::get( 'state.site' )['posts_per_page'];
$category_id = get_query_var('cat');
$category = RADL::get( 'state.categories', $category_id );
$posts = RADL::get( 'state.posts', array( 'page' => $paged, 'per_page' => $per_page, 'categories' => $category_id ) ); ?>
<main id="wrapper">
    <header>
      <h1>Category for <?php echo $category['name']; ?></h1>
    </header>
    <section>
        <?php
        foreach ( $posts as $p ) {
            set_query_var( 'vw_post', $p );          
            $p = get_query_var( 'vw_post' ); 
            ?>
                <article class="post">
                    <div class="post--inner">
                        <div class="post--content">
                            <h2 class="mb-4">
                                <a class="text-t-2xl md:text-t-3xl text-flamingo-500 hover:text-flamingo-700" 
                                    href="<?php echo $p['link']; ?>" 
                                    title="<?php echo $p['title']['rendered']; ?>">
                                    <?php echo $p['title']['rendered']; ?>
                                </a>
                            </h2>
                            <div class="text-base mb-4 text-gray-100"><?php echo $p['excerpt']['rendered']; ?></div>
                        </div>
                    </div>
                </article>
            <?php 
        } 
        ?>
    </section>
</main>
<?php
get_footer();