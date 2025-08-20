<?php
get_header();
$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
$per_page = RADL::get( 'state.site' )['posts_per_page'];
$site = RADL::get( 'state.site' );
$posts = RADL::get( 'state.posts', array( 'page' => 1, 'per_page' => $per_page ) );
$demos = RADL::get( 'state.demo',   array( 'page' => 1, 'per_page' => $per_page ) );
?>

<main id="wrapper">
    <pre class="dbg">
        $site = RADL::get( 'state.site' );
<?php print_r($site);?>
    </pre>
    <!-- // posts -->
    <section>
        <?php
        foreach ( $posts as $p ) {
            set_query_var( 'vw_post', $p );
            $p = get_query_var( 'vw_post' ); 
            ?>
            <article class="post dbg">
                <div class="post__content">
                    <h2>
                        <a 
                            href="<?php echo $p['link']; ?>" 
                            title="<?php echo $p['title']['rendered']; ?>"
                            ><?php echo $p['title']['rendered']; ?>
                        </a>
                    </h2>
                    <p><?php echo $p['excerpt']['rendered']; ?></p>
            </article>
            <?
        } ?>
    </section>
    <!-- // demos -->
    <section>
        <?php
        foreach ( $demos as $d ) {
            set_query_var( 'vw_post', $d );
            $d = get_query_var( 'vw_post' ); 
            ?>
            <article class="post">
                <div class="post__content">
                    <h2>
                        <a 
                            href="<?php echo $d['link']; ?>" 
                            title="<?php echo $d['title']['rendered']; ?>"
                            ><?php echo $d['title']['rendered']; ?>
                        </a>
                    </h2>
                    <p><?php echo $d['excerpt']['rendered']; ?></p>
            </article>
            <?
        } ?>
    </section>
</main>

<?php
get_footer();