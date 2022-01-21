<?php if (dynamic_sidebar('footer')) : else : endif; ?>
<?php wp_footer(); ?>
</body>
<script>
    $(document).ready(function () {
        $('#imageGallery').lightSlider({
            gallery: true,
            adaptiveHeight: true,
            item: 1,
            loop: true,
            thumbItem: 9,
            slideMargin: 0,
            enableDrag: false,
            currentPagerPosition: 'left',
            onSliderLoad: function (el) {
                el.lightGallery({
                    selector: '#imageGallery .lslide'
                });
            }
        });
    });
</script>
</html>