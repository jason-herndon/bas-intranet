<?php
/**
 * Loop for blog posts
 */
?>
          <div class="row">
   
            <?php 
              // get post format and display code for that format
              if ( !get_post_format() ) 
              {
                get_template_part('post-formats/format', 'standard'); 
              } else {
                get_template_part('post-formats/format', get_post_format() ); 
              }
            ?>

          </div>