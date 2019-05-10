<script>
            $(document).ready(function($) {
                $(window).on('resize', function() {
                    if ($(window).width() <= 991) {
                        $('.nav-toggle').click(function() {
                            if ($(this).hasClass('nav-open')) {
                                $(this).removeClass("nav-open");
                                //$('.nav-sections').removeClass('nav-open');
                                $('html').removeClass('nav-open');

                            } else {
                                $(this).addClass("nav-open");
                                //$('.nav-sections').addClass('nav-open');
                                $('html').addClass('nav-open');

                            }
                        });
                    }
                }).trigger("resize");

                $('.menu-icon').click(function(event) {
                    if ($(this).hasClass('active')) {
                        $('.menu-icon').next('.submenu').hide();
                        $('.menu-icon').removeClass('active');
                    } else {
                        $('.menu-icon').next('.submenu').hide();
                        $('.menu-icon').removeClass('active');
                        $(this).next('.submenu').show();
                        $(this).addClass('active');
                    }
                    return false;

                });
            });
        </script>
</body>
</html>