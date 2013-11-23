<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the id=main div and all content after
 *
 * @package dsframework
 * @since dsframework 1.0
 */
?><div class="ftr">
<div class="contact">  48 E. Sudbrook Lane<br> Pikesville, MD &nbsp; 21208<br>Phone: 410-602-1441, 401-602-1442</div>
  <div class="hours">M: Closed<br>Tu-Th: 11:30AM-10:00PM<br>Fr&Sa: 11:30AM-10:30PM<br>Su: 12:00PM-10:00PM
</div>
<div class="social">
	<a href="http://www.facebook.com/pages/Jumbo-Seafood/111466698894138"><img src="/jumboseafoodpikesville.com/wp-content/images/facebook.jpg"/></a>
	<a href="https://plus.google.com/115671432646571840384/"><img src="/jumboseafoodpikesville.com/wp-content/images/google.jpg"/></a>
	<a href="http://www.yelp.com/biz/jumbo-seafood-chinese-restaurant-pikesville"><img src="/jumboseafoodpikesville.com/wp-content/images/yelp.jpg"/></a>
	<a href="http://www.urbanspoon.com/r/31/351510/restaurant/Baltimore/Jumbo-Seafood-Chinese-Pikesville"><img src="/jumboseafoodpikesville.com/wp-content/images/urbanspoon.jpg"/></a>
	<!--
<a href="#" class="facebook"></a>
	<a href="#" class="google"></a>
	<a href="#" class="yelp"></a>
-->
</div>
  </div></div>
<?php // this semantics is such a boring thing ?>
</div>
</div>
<?php echo get_ds_option('google_analytics'); ?>
<?php wp_footer(); ?>
<script type="text/javascript" src="/jumboseafoodpikesville.com/wp-content/themes/dimsemenov-Touchfolio-7c2e0cc/js/jquery.slabtext.min.js"></script>
    <script>
        // Function to slabtext the H1 headings
        function slabTextHeadlines() {
                $(".yum").slabText({
                        // Don't slabtext the headers if the viewport is under 380px
                        "viewportBreakpoint":380
                });
        };

        // Called one second after the onload event for the demo (as I'm hacking the fontface load event a bit here)
        // you should really use google WebFont loader events (or something similar) for better control
        $(window).load(function() {
                setTimeout(slabTextHeadlines, 1000);
        });
    </script>
</body>
</html>