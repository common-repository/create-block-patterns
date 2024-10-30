<?php
// List latest block patterns
$api_url = 'https://wordpress.org/patterns/wp-json/wp/v2/wporg-pattern/?_locale=user&locale=en_US&page=1&_fields=id,title,link';

$request   = wp_remote_get( $api_url );
if ( !is_wp_error( $request ) ) {
    $all_patters = json_decode( wp_remote_retrieve_body( $request ), true );
    ?>
    <div class="patterns-list-main">
        <?php
        if( !empty( $all_patters ) && is_array( $all_patters ) ) {
            $i = 0;
            foreach( $all_patters as $pattern ) {
                ?>
                <div class="block-pattern">
                    <h5><?php esc_html_e( $pattern['title']['rendered'], 'block-pattern' ); ?></h5>
                    <div class="pattern-buttons">
                        <button class="button button-primary ssbp-insert-pattern" data-id="<?php echo esc_attr( $pattern['id'], 'block-pattern' ); ?>"><?php esc_html_e( 'Insert Pattern', 'block-pattern' ); ?></button>
                        <a href="<?php echo esc_url( $pattern['link'] ); ?>" target="_blank" class="button"><?php esc_html_e( 'Preview', 'block-pattern' ); ?></a>
                    </div>
                </div>
                <?php
                $i++;
            }
        }
        ?>
    </div>
    <div class="load-more-patterns">
        <button class="button button-primary"><?php esc_html_e( 'Load More', 'block-pattern' ); ?></button>
    </div>
    <?php
}