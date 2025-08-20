<?php
get_header();
$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
$per_page = RADL::get( 'state.site' )['posts_per_page'];
$state = RADL::get( 'state' );
$posts = RADL::get( 'state.demo', array( 'page' => $paged, 'per_page' => $per_page) ); ?>
<main>
    <header>
      <h1>Archive for DEMO</h1>
    </header>
            <!-- <pre class="dbg">
            $site = RADL::get( 'state' );
<?php //print_r($state);?>
        </pre> -->
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