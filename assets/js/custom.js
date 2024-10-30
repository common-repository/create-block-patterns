jQuery(function($) {
    $(document).ready(function () {
        $(document).on( 'click', '#wporg-auther-patterns', function() {
            var userName = $('#wporg-username-input').val();

            if( '' === userName ) {
                alert( ssbpApiSettings.empty_username );
            } else {
                $('.patterns-list-outer .spinner').css('display', 'inline-block');
                $('.patterns-list-outer .first-notice').css('display', 'none');
                // Load Block Patterns
                loadAutherSpecificBlockPatterns( userName );
            }
        });

        var loadMoreButtonClick = 2;
        $(document).on( 'click', '.load-more-patterns button', function() {
            $(this).addClass('updating-message');
            // Load More Block Patterns
            loadMoreBlockPatterns( loadMoreButtonClick );
            loadMoreButtonClick++;
        });

        $(document).on( 'click', '.ssbp-insert-pattern', function() {
            let patternID = $(this).attr('data-id');
            if( '' !== patternID ) {
                $(this).addClass('updating-message');
                // Insert Block Pattern
                insertBlockPatterns( patternID );
            }
        });

        $(document).on( 'click', '#ssbp-block-patterns-directory-wrap .notice-dismiss', function() {
            $('#ssbp-block-patterns-directory-wrap .notice').hide();
        });
    });
});

function loadAutherSpecificBlockPatterns( userName ) {
    jQuery.ajax({
        method: 'GET',
        url: 'https://wordpress.org/patterns/wp-json/wp/v2/wporg-pattern/?_locale=user&locale=en_US&per_page=100&author_name=' + userName + '&_fields=id,title,link',
        success: function(data) {
            var obj = JSON.stringify(data);
            var patterns = jQuery.parseJSON(obj);
            if( patterns.length === 0 ) {
                alert(ssbpApiSettings.no_patterns);
            } else {
                jQuery('.patterns-list-outer .spinner').css('display', 'none');
                jQuery('.patterns-list-main').empty();
                createBlockPatternsHTML(patterns);
            }
        }
    });
}

function loadMoreBlockPatterns(patternsPage) {
    jQuery.ajax({
        method: 'GET',
        url: 'https://wordpress.org/patterns/wp-json/wp/v2/wporg-pattern/?_locale=user&locale=en_US&page='+patternsPage+'&_fields=id,title,link',
        success: function(data) {
            var obj = JSON.stringify(data);
            var patterns = jQuery.parseJSON(obj);
            if( patterns.length === 0 ) {
                alert(ssbpApiSettings.no_patterns);
            } else {
                jQuery('.load-more-patterns button').removeClass('updating-message');
                createBlockPatternsHTML(patterns);
            }
        }
    });
}

function insertBlockPatterns(patternID) {
    var ssbp_insert_pattern = jQuery('#ssbp_insert_pattern').val();
    jQuery.ajax({
        method: 'POST',
        url: ssbpApiSettings.ajaxurl,
        data: {
            'action' : 'ssbp_insert_pattern_ajax',
            'patternID' : patternID,
            'security' : ssbp_insert_pattern
        },
        success: function() {
            jQuery('.ssbp-insert-pattern[data-id="'+patternID+'"]').removeClass('updating-message');
            jQuery('#ssbp-block-patterns-directory-wrap .notice').show();
        }
    });
}

function createBlockPatternsHTML(patternsData) {
    var patternHTML = '';
    for(i = 0; i < patternsData.length; i++) {
        patternHTML += '<div class="block-pattern">';
        patternHTML += '<h5>' + patternsData[i].title.rendered + '</h5>';
        patternHTML += '<div class="pattern-buttons">';
        patternHTML += '<button class="button button-primary ssbp-insert-pattern" data-id="'+patternsData[i].id+'">'+ ssbpApiSettings.insert_pattern +'</button>';
        patternHTML += '<a href="'+patternsData[i].link+'" target="_blank" class="button">'+ ssbpApiSettings.preview +'</a>';
        patternHTML += '</div>';
        patternHTML += '</div>';
    }
    jQuery('.patterns-list-main .first-notice').remove();
    jQuery('.patterns-list-main').append(patternHTML);
 }