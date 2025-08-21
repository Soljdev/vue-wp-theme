<?php
get_header();
$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
$per_page = RADL::get( 'state.site' )['posts_per_page'];
$category_id = get_query_var('cat');
$category = RADL::get( 'state.categories', $category_id );
$posts = RADL::get( 'state.posts', array( 'page' => $paged, 'per_page' => $per_page, 'categories' => $category_id ) ); 
?>
<main id="wrapper">
  <div class="container">
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
            <h2>
              <a href="<?php echo $p['link']; ?>" title="<?php echo $p['title']['rendered']; ?>">
                <?php echo $p['title']['rendered']; ?>
              </a>
            </h2>
            <div><?php echo $p['excerpt']['rendered']; ?></div>
          </article>
        <?php 
      } 
      ?>
    </section>
  </div>
</main>
<?php
get_footer();