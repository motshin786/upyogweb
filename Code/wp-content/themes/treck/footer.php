<?php

/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package treck
 */

?>



</div><!-- #page -->

<div class="footer-wrapper">
	<?php do_action('treck_footer'); ?>
</div><!-- /.footer-wrapper -->


   <style>
   #loadMoreButton {
            background-color: #574B73;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }
          .button-container {
            display: flex;
            justify-content: center;
            margin-top: 0px;
            margin-bottom:20px;
        }
        #extraContent {
            display: none;
   
        } 
    </style>
 <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Get the button and content div elements
            const loadMoreButton = document.getElementById('loadMoreButton');
            const extraContent = document.getElementById('extraContent');

            // Toggle the display of the extra content on button click
            loadMoreButton.addEventListener('click', function() {
                if (extraContent.style.display === 'none' || extraContent.style.display === '') {
                    extraContent.style.display = 'block'; // Show the div
                    loadMoreButton.textContent = 'Show Less'; // Change button text
                } else {
                    extraContent.style.display = 'none'; // Hide the div
                    loadMoreButton.textContent = 'Load More'; // Reset button text
                }
            });
        });
    </script>
    





 <!--<style>
        /* Style for the WhatsApp button */
        .whatsapp-button {
            position: fixed;
            left: 20px;
            bottom: 20px;
            background-color: #25D366; /* WhatsApp green color */
            color: white;
            border-radius: 50%;
            width: 60px;
            height: 60px;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            cursor: pointer;
            z-index: 1000; /* Make sure it's on top */
            text-decoration: none;
        }
        /* Icon size */
        .whatsapp-button img {
            width: 30px;
            height: 30px;
        }
    </style>


    <!-- WhatsApp button -->
    <!--<a href="https://wa.me/+919600579387" target="_blank" class="whatsapp-button">
        <img src="https://upload.wikimedia.org/wikipedia/commons/5/5e/WhatsApp_icon.png" alt="WhatsApp">
    </a>-->




<?php wp_footer(); ?>
</body>
</html>