<?php do_action('stencil_before_footer'); ?>
<?php get_template_part( 'layouts/footer'); ?>
<?php do_action('stencil_after_footer'); ?>
</main>
<?php do_action('stencil_before_rightside'); ?>
<?php get_template_part( 'layouts/rightside'); ?>
<?php do_action('stencil_after_rightside'); ?>

<?php get_template_part( 'layouts/modal'); ?>
<?php wp_footer(); ?>
<?php do_action('stencil_end_body'); ?>

</body>
<?php do_action('stencil_after_body'); ?>
</html>