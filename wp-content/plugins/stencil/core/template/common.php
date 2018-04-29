<?php get_header(); ?>
<?php
$manager = \Stencil\Core\Element::instance();
$layout = $manager->get_element('single-layout', 'single_2column');
$json = json_encode($layout->structure());

$html = $manager->toHtml($json);

echo $html;
?>

<?php get_footer();
