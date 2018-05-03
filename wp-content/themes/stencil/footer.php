<?php
echo Stencil_Render()->footer();
?>
</main>

<?php wp_footer(); ?>
<?php do_action('stencil_end_body'); ?>
<?php do_action('stencil_test_action'); ?>
</body>
<?php do_action('stencil_after_body'); ?>
</html>