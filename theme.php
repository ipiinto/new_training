<html lang="en-us">
    <head>
        <meta charset="utf-8">
        <title>INSPINIA - Responsive Admin Theme - Live Preview - WrapBootstrap</title>
        <meta name="description" content="Live preview for INSPINIA - Responsive Admin Theme at WrapBootstrap">
        <meta name="viewport" content="width=1024">
        <!--[if lt IE 9]><script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
        <link rel="stylesheet" type="text/css" media="screen" href="//d85wutc1n854v.cloudfront.net/live/css/screen_preview.css">
        <!--<script src="//cdn.optimizely.com/js/233905874.js"></script>-->
        <script type="text/javascript" async="" src="http://www.google-analytics.com/ga.js"></script><script src="//d85wutc1n854v.cloudfront.net/live/js/behavior.js"></script>
        <script type="text/javascript">
            var _gaq = _gaq || [];
            _gaq.push(['_setAccount', 'UA-28871117-1']);
            _gaq.push(['_setDomainName', 'wrapbootstrap.com']);
            _gaq.push(['_trackPageview']);
            (function() {
                var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
                ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
                var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
            })();
        </script>
            <link rel="shortcut icon" href="//d85wutc1n854v.cloudfront.net/live/imgs/favicon.ico">
        <style type="text/css"></style>
    </head>
    <body>
        <div id="main">
        <div id="tray" class="topbar" sty1le="width: auto;">
            <div class="fill">
                <div class="container">
                    <a class="brand" href="https://wrapbootstrap.com/"><img src="//d85wutc1n854v.cloudfront.net/live/imgs/logo.png"></a>
                    <h1 id="item_name"><a href="https://wrapbootstrap.com/theme/inspinia-responsive-admin-theme-WB0R5L90S">INSPINIA - Responsive Admin Theme</a></h1>
                    <div class="remove">
                        <a class="btn" href="http://webapplayers.com/inspinia_admin-v1.9.2/" title="Remove this frame">Remove this frame »</a></div>
                    </div>
                </div>
            </div>
            <iframe id="preview" src="http://webapplayers.com/inspinia_admin-v1.9.2/" frameborder="0" width="100%" height="296px"></iframe>
        </div>
        <script>
            $(document).ready(function(){
                function fix_height(){
                    var h = $("#tray").height();   
                    $("#preview").attr("height", (($(window).height()) - h) + "px");
                }
                $(window).resize(function(){ fix_height(); }).resize();
                //$("#preview").contentWindow.focus();
            });
        </script>
    </body>
</html>