<?php
/**
 * Footer section for our theme
 *
 * @package WordPress
 * @subpackage Integral
 * @since Integral 1.0
 */
?>
<?php global $integral; ?>

        <section class="copyright">

            <div class="container">

                <div class="row">

                    <div class="col-md-12">

                        <div class="copyrightinfo">

                            <p>
                                <?php if ( $integral['copyright-text'] ) : ?>

                                <?php echo $integral['copyright-text']; ?>

                                <?php else : ?>

                                <?php esc_html_e('2020 - Guillaume Rozier - Tous droits réservés'); ?>


                                <?php endif; ?>
                            </p>

                        </div>

                    </div>

                </div>

            </div>

        </section>

        <?php get_template_part('sections/custom'); ?>

        <?php wp_footer(); ?>
    
    </body>

</html>