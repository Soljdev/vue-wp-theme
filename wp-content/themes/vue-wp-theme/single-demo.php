<?php
get_header();
$single = RADL::get( 'state.demo', get_the_ID() ); ?>
<main>
    <article>
        <header>
            <h1><?php echo $single['title']['rendered']; ?></h1>
            <?php set_query_var('vw_post', $single); ?>
            <pre class="dbg">
            $single = RADL::get( 'state.demo', get_the_ID() );
<?php print_r($single);?>
        </pre>
        </header>
        <div><?php echo $single['content']['rendered']; ?></div>
    </article>
</main>

<?php
get_footer();