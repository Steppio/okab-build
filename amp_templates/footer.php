<?php
$dima_copyright = dima_helper::dima_get_option( 'dima_amp_footer_content_text' );
$dima_class     = "float-start";
$allowed_tags   = array(
	'strong' => array(),
	'br'     => array(),
	'em'     => array(),
	'p'      => array( 'a' => true ),
	'a'      => array(
		'href'   => true,
		'target' => true,
		'title'  => true,
	)
);
$dima_class     = "text-center";
$footer_logo    = dima_helper::dima_get_option( 'dima_amp_footer_logo' );
$footer_gotop   = dima_helper::dima_am_i_true( dima_helper::dima_get_option( 'dima_amp_back_to_top' ) );

?>
<footer class="footer-container">
	<?php if ( $footer_logo != '' ) { ?>
        <div class="top-footer">
            <a class="footer-logo" href="/demo/" title="<?php echo get_bloginfo( 'name' ); ?>"></a>
			<?php
			# Footer Menu ----------
			if ( dima_helper::dima_get_option( 'dima_amp_footer_menu' ) ) {

				$menu = dima_helper::dima_get_option( 'dima_amp_footer_menu' );
				$args = wp_nav_menu( array(
					'container'  => false,
					'menu_class' => 'dima-menu',
					'menu'       => $menu,
					'depth'      => 1
				) );
			}
			?>
        </div>

	<?php } ?>

    <div class="dima-footer text-center" itemscope="itemscope" itemtype="https://schema.org/WPFooter">

		<?php if ( $footer_gotop ) { ?>
            <div class="top scroll-to-top">
                <a href="#top">
                    <svg fill="#ffffff" xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 48 48">
                        <path d="M14.83 30.83L24 21.66l9.17 9.17L36 28 24 16 12 28z"></path>
                    </svg>
                </a>
            </div>
		<?php } ?>

        <div class="container">

			<?php if ( dima_helper::dima_get_option( 'dima_footer_content_display' ) == '1' ) : ?>
                <div class="copyright <?php echo esc_attr( $dima_class ) ?>">
					<?php
					echo wp_kses( $dima_copyright, $allowed_tags );
					?>
                </div>
			<?php endif; ?>

        </div>
    </div>
</footer>