/**
 * Visit Site from Customizer
 *
 * @package Visit_Site_from_Customizer
 * @since  1.0.0
 */

( function( $ ) {

    /**
     * Visit Site from Customizer
     */
    jQuery(document).ready(function($) {

        var container = jQuery( '#customize-header-actions' ),
            button = jQuery( '<a>' )
            .attr( 'href', visitSiteCustomizer.customizer.siteUrl )
            .attr( 'target', '_blank' )
            .attr( 'rel', 'noopener' )
            .css( {
                'float': 'right',
                'text-decoration': 'none',
                'padding': '0 5px 0',
            } );
            button.text( visitSiteCustomizer.customizer.visitSite );

        container.append( button );
    });

})(jQuery);
