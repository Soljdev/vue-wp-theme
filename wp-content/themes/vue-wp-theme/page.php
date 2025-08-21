<?php
get_header();
$page = RADL::get( 'state.pages', get_the_ID() ); 
?>
<main id="wrapper">
  <article class="container">
    <h1><?php echo $page['title']['rendered'];?></h1>
    <div><?php echo $page['content']['rendered'];?></div>
    <pre class="dbg">
      page.php
      $page = RADL::get( 'state.pages', get_the_ID() ); 
      <?php print_r($page);?>
    </pre>
  </article>
</main>
<?php get_footer(); ?>