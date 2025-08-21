<?php
get_header();
$single = RADL::get( 'state.posts', get_the_ID() ); 
set_query_var('vw_post', $single); 
?>
<main id="wrapper">
  <article class="container">
    <h1><?php echo $single['title']['rendered']; ?></h1>
    <div><?php echo $single['content']['rendered']; ?></div>
    <pre class="dbg">
      single.php
      $single = RADL::get( 'state.posts', get_the_ID() );
      <?php print_r($single);?>
    </pre>
  </article>
</main>
<?php
get_footer();