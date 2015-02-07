<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package tm2
 */
?>

	</div><!-- #content -->
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<footer id="colophon" class="site-footer" role="contentinfo">
				<div class="site-info">
					<a href="<?php echo esc_url( __( 'http://wordpress.org/', 'tm2' ) ); ?>"><?php printf( __( 'Proudly powered by %s', 'tm2' ), 'WordPress' ); ?></a>
					<span class="sep"> | </span>
					<?php printf( __( 'Theme: %1$s by %2$s.', 'tm2' ), 'tm2', '<a href="http://underscores.me/" rel="designer">Underscores.me</a>' ); ?>
				</div><!-- .site-info -->
			</footer><!-- #colophon -->
		</div>
	</div>
</div>

</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
