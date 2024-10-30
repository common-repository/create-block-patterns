<?php
// List block patterns by authers
?>
<div class="auther-specific-patterns">
    <p class="install-help"><?php esc_html_e( 'If you want to search for block patterns from a specific author, you can browse them here.', 'block-pattern' ) ?></p>
    <p>
        <label for="wporg-username-input"><?php esc_html_e( 'Enter author WordPress.org username:' , 'block-pattern' ); ?></label>
        <input type="search" id="wporg-username-input" placeholder="wordpressdotorg">
        <input type="button" class="button" id="wporg-auther-patterns" value="<?php esc_attr_e( 'Get Patterns', 'block-pattern' ); ?>">
    </p>
</div>
<div class="patterns-list-outer">
    <span class="spinner"></span>
    <p class="first-notice"><?php esc_html_e( 'Enter any author\'s user name and browser author specific block patterns.', 'block-pattern' ); ?></p>
    <div class="patterns-list-main">
    </div>
</div>
<?php
