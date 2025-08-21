<?php
get_header();
$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
$per_page = RADL::get( 'state.site' )['posts_per_page'];
$site = RADL::get( 'state.site' );
$posts = RADL::get( 'state.posts', array( 'page' => 1, 'per_page' => $per_page ) );
$demos = RADL::get( 'state.demo',   array( 'page' => 1, 'per_page' => $per_page ) );
?>
<main id="wrapper">
  <div class="container">
    <pre class="dbg">
      home.php
      $site = RADL::get( 'state.site' );
      <?php print_r($site);?>
    </pre>
    <!-- // posts -->
    $posts = RADL::get( 'state.posts', array( 'page' => 1, 'per_page' => $per_page ) );
    <section class="mb-8">
      <?php
      foreach ( $posts as $p ) {
        set_query_var( 'vw_post', $p );
        $p = get_query_var( 'vw_post' ); 
        ?>
        <article class="post dbg">
          <h2>
            <a 
              href="<?php echo $p['link']; ?>" 
              title="<?php echo $p['title']['rendered']; ?>"
              ><?php echo $p['title']['rendered']; ?></a>
          </h2>
          <p><?php echo $p['excerpt']['rendered']; ?></p>
        </article>
        <?
      } 
      ?>
    </section>
    <!-- // demos -->
    $demos = RADL::get( 'state.demo',   array( 'page' => 1, 'per_page' => $per_page ) );
    <section class="mb-8">
      <?php
      foreach ( $demos as $d ) {
        set_query_var( 'vw_post', $d );
        $d = get_query_var( 'vw_post' ); 
        ?>
        <article class="post">
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
      } 
      ?>
    </section>
  </div>
</main>

<?php
get_footer();