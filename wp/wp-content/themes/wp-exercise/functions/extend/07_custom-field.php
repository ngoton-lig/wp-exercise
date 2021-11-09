<?php
function register_post_assets() {
    $screens = get_post_types();
    add_meta_box('featured-post', __('Featured Post'), 'add_featured_meta_box', $screens, 'normal', 'high');
}
add_action('admin_init', 'register_post_assets', 1);

function add_featured_meta_box($post) {
    $featured = get_post_meta($post->ID, '_featured-post', true);
    echo "<input type='checkbox' name='_featured-post' id='featured-post' value='1' ".checked(1, $featured, false)." />";
    echo "<label for='featured-post'>".__('Set featured post', 'foobar')."</label>";
}

function save_featured_meta($post_id){
    if (isset($_REQUEST['_featured-post']))
        update_post_meta($post_id, '_featured-post', esc_attr($_REQUEST['_featured-post']));
}
add_action('save_post', 'save_featured_meta');

add_action( 'admin_init', 'add_post_gallery' );
add_action( 'admin_head-post.php', 'print_scripts' );
add_action( 'admin_head-post-new.php', 'print_scripts' );
add_action( 'save_post', 'update_post_gallery', 10, 2 );

/**
 * Add custom Meta Box to Posts post type
 */
function add_post_gallery()
{
    $screens = get_post_types();
    add_meta_box('post_gallery', 'Information', 'post_gallery_options', $screens, 'normal', 'high');
}

/**
 * Print the Meta Box content
 */
function post_gallery_options()
{
    global $post;
    $gallery_data = get_post_meta( $post->ID, 'gallery_data', true );

    // Use nonce for verification
    wp_nonce_field( plugin_basename( __FILE__ ), 'noncename' );
    ?>

    <div id="dynamic_form">

        <div id="field_wrap">
            <?php
            if ( isset( $gallery_data['image_url'] ) ):
            for( $i = 0; $i < count( $gallery_data['image_url'] ); $i++ ):
            ?>

            <div class="field_row">

                <div class="field_left">
                    <div class="form_field">
                        <label>Image URL</label>
                        <input type="text"
                               class="meta_image_url"
                               name="gallery[image_url][]"
                               value="<?php esc_html_e( $gallery_data['image_url'][$i] ); ?>"
                        />
                    </div>
                    <div class="form_field">
                        <label>Description</label>
                        <input type="text"
                               class="meta_image_desc"
                               name="gallery[image_desc][]"
                               value="<?php esc_html_e( $gallery_data['image_desc'][$i] ); ?>"
                        />
                    </div>
                </div>

                <div class="field_right image_wrap">
                    <img src="<?php esc_html_e( $gallery_data['image_url'][$i] ); ?>" height="48" width="48" />
                </div>

                <div class="field_right">
                    <input class="button" type="button" value="Choose File" onclick="add_image(this)" /><br />
                    <input class="button" type="button" value="Remove" onclick="remove_field(this)" />
                </div>

                <div class="clear" /></div>
        </div>
        <?php
            endfor;
        endif;
        ?>
    </div>

    <div style="display:none" id="master-row">
        <div class="field_row">
            <div class="field_left">
                <div class="form_field">
                    <label>Image URL</label>
                    <input class="meta_image_url" value="" type="text" name="gallery[image_url][]" />
                </div>
                <div class="form_field">
                    <label>Description</label>
                    <input class="meta_image_desc" value="" type="text" name="gallery[image_desc][]" />
                </div>
            </div>
            <div class="field_right image_wrap">
            </div>
            <div class="field_right">
                <input type="button" class="button" value="Choose File" onclick="add_image(this)" />
                <br />
                <input class="button" type="button" value="Remove" onclick="remove_field(this)" />
            </div>
            <div class="clear"></div>
        </div>
    </div>

    <div id="add_field_row">
        <input class="button" type="button" value="Add Field" onclick="add_field_row();" />
    </div>

    </div>

    <?php
}

/**
 * Print styles and scripts
 */
function print_scripts()
{
    ?>
    <style type="text/css">
        .field_left {
            float:left;
        }

        .field_right {
            float:left;
            margin-left:10px;
        }

        .clear {
            clear:both;
        }

        #dynamic_form {
            width:580px;
        }

        #dynamic_form input[type=text] {
            width:300px;
        }

        #dynamic_form .field_row {
            border:1px solid #999;
            margin-bottom:10px;
            padding:10px;
        }

        #dynamic_form label {
            padding:0 6px;
        }
    </style>

    <script type="text/javascript">
        function add_image(obj) {
            const parent=jQuery(obj).parent().parent('div.field_row');
            const inputField = jQuery(parent).find("input.meta_image_url");

            tb_show('', 'media-upload.php?TB_iframe=true');

            window.send_to_editor = function(html) {
                const url = jQuery(html).find('img').attr('src');
                inputField.val(url);
                jQuery(parent)
                    .find("div.image_wrap")
                    .html('<img src="'+url+'" height="48" width="48" />');

                // inputField.closest('p').prev('.awdMetaImage').html('<img height=120 width=120 src="'+url+'"/><p>URL: '+ url + '</p>');

                tb_remove();
            };

            return false;
        }

        function remove_field(obj) {
            const parent=jQuery(obj).parent().parent();
            parent.remove();
        }

        function add_field_row() {
            const row = jQuery('#master-row').html();
            jQuery(row).appendTo('#field_wrap');
        }
    </script>
    <?php
}

/**
 * Save post action, process fields
 */
function update_post_gallery( $post_id, $post_object )
{
    // Verify authenticity
    if ( !wp_verify_nonce( $_POST['noncename'], plugin_basename( __FILE__ ) ) )
        return;

    if ( $_POST['gallery'] )
    {
        // Build array for saving post meta
        $gallery_data = array();
        for ($i = 0; $i < count( $_POST['gallery']['image_url'] ); $i++ )
        {
            if ( '' != $_POST['gallery']['image_url'][ $i ] )
            {
                $gallery_data['image_url'][]  = $_POST['gallery']['image_url'][ $i ];
                $gallery_data['image_desc'][] = $_POST['gallery']['image_desc'][ $i ];
            }
        }

        if ( $gallery_data )
            update_post_meta( $post_id, 'gallery_data', $gallery_data );
        else
            delete_post_meta( $post_id, 'gallery_data' );
    }
    // Nothing received, all fields are empty, delete option
    else
    {
        delete_post_meta( $post_id, 'gallery_data' );
    }
}