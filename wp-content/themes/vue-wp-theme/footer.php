<?php
$site = RADL::get( 'state.site' );
?>
<footer>
    <div class="container">
        <?php 
            echo isset($site['blocks']['footer']['copyright']) 
                ? $site['blocks']['footer']['copyright'] 
                : ''; 
        ?>
    </div>
</footer>
</div><!-- #vue-wordpress-app -->
<?php wp_footer();?>
</body>
</html>