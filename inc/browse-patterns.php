<?php
$nonce = wp_create_nonce( 'ssbp_insert_pattern_nonce' );
$current_tab = filter_input( INPUT_GET, 'tab', FILTER_DEFAULT );
$active_latest_tab = '';
$active_author_tab = '';
if( isset( $current_tab ) && 'latest-patterns' === $current_tab ) {
    $active_latest_tab = 'current';
} elseif( isset( $current_tab ) && 'author-patterns' === $current_tab ) {
    $active_author_tab = 'current';
} else {
    $active_latest_tab = 'current';
}
?>
<input type="hidden" name="ssbp_insert_pattern" id="ssbp_insert_pattern" value="<?php echo esc_attr( $nonce ) ; ?>" />
<div class="wrap plugin-install-php" id="ssbp-block-patterns-directory-wrap">
	<h1 class="wp-heading-inline"><?php esc_html_e( 'Browse Patterns', 'block-pattern' ); ?></h1>
    <ul class="filter-links">
        <li><a href="<?php echo esc_url( admin_url( 'edit.php?post_type=ssbp-block-pattern&page=ssbp-browse-patterns&tab=latest-patterns' ) ); ?>" class="<?php echo esc_attr( $active_latest_tab ); ?>"><?php esc_html_e( 'Latest', 'block-pattern' ) ?></a></li>
        <li><a href="<?php echo esc_url( admin_url( 'edit.php?post_type=ssbp-block-pattern&page=ssbp-browse-patterns&tab=author-patterns' ) ); ?>" class="<?php echo esc_attr( $active_author_tab ); ?>"><?php esc_html_e( 'By Author', 'block-pattern' ) ?></a></li>
    </ul>
    <div id="message" class="updated notice is-dismissible" style="display: none;">
        <p>
        <?php echo sprintf( wp_kses( __( 'Your block pattern has been inserted successfully. <a href="%1$s">Click here</a> to review all your block patterns.', 'block-pattern' ), array(
                'a' => array(
                    'href' => array()
                ),
            ) ), esc_url( admin_url( 'edit.php?post_type=ssbp-block-pattern' ) ) );?>
        </p>
        <button type="button" class="notice-dismiss"><span class="screen-reader-text"></span></button>
    </div>
    <?php 
    if( isset( $current_tab ) && 'latest-patterns' === $current_tab ) {
        require_once SSBP_PLUGIN_DIR_PATH . 'inc/filter-tabs/latest-patterns.php';
    } elseif( isset( $current_tab ) && 'author-patterns' === $current_tab ) {
        require_once SSBP_PLUGIN_DIR_PATH . 'inc/filter-tabs/author-patterns.php';
    } else {
        require_once SSBP_PLUGIN_DIR_PATH . 'inc/filter-tabs/latest-patterns.php';
    }
    ?>
</div>
<?php
