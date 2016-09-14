<!DOCTYPE html>
<html>
    <head>
        <title>Ithaca Physics Bus</title>
        <meta charset="utf-8">
        <link rel="stylesheet" href ="../css/style.css">
        <link href='http://fonts.googleapis.com/css?family=Raleway:700%7CJulius+Sans+One' rel='stylesheet' type='text/css'>
        <link href='http://fonts.googleapis.com/css?family=Oxygen' rel='stylesheet' type='text/css'>

        <script type="text/javascript">
            var image1 = new Image()
            image1.src = "../images/slideshow/slide001.JPG"
            var image2 = new Image()
            image2.src = "../images/slideshow/slide002.JPG"
            var image3 = new Image()
            image3.src = "../images/slideshow/slide003.JPG"
            var image4 = new Image()
            image4.src = "../images/slideshow/slide004.JPG"
			var image5 = new Image()
            image5.src = "../images/slideshow/slide005.JPG"
        </script>
    </head>
    <body>

        <div id="fb-root"></div>
        <script>(function (d, s, id) {
                        var js, fjs = d.getElementsByTagName(s)[0];
                        if (d.getElementById(id))
                            return;
                        js = d.createElement(s);
                        js.id = id;
                        js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.0";
                        fjs.parentNode.insertBefore(js, fjs);
                    }(document, 'script', 'facebook-jssdk'));
        </script>
        <script type="text/javascript">
            function swap(one, two) {
                document.getElementById(one).style.display = 'block';
                document.getElementById(two).style.display = 'none';
            }
			
        </script>

        <div>
            <?php
            $page_title = "Ithaca Physics Bus";

            include 'header.php';
            ?>

            <div class="slide-container">
                <img id="slideshow" src="../images/slideshow/slide001.JPG" alt="" />
                <a class="left slide-control" onClick="regress()" href="#myCarousel" data-slide="prev">&lsaquo;</a>
                <a class="right slide-control" onClick="advance()" href="#myCarousel" data-slide="next">&rsaquo;</a>
                <script type="text/javascript">
                    var slidenum = 5;
					var was_clicked = false;
                    var step = 0;
                    function slideit()
                    {   if (was_clicked) {
					        was_clicked = false;
					        setTimeout("slideit()", 5000);
						}
						else {
							if (step < slidenum)
								step++;
							else
								step = 1;
							document.images.slideshow.src = eval("image" + step + ".src");
							setTimeout("slideit()", 5000);
						}
                    }
                    function advance()
                    {
                        if (step < slidenum)
                            step++;
                        else
                            step = 1;
                        document.images.slideshow.src = eval("image" + step + ".src");
						was_clicked = true;
                    }
                    function regress()
                    {
                        if (step > 1)
                            step--;
                        else
                            step = slidenum;
                        document.images.slideshow.src = eval("image" + step + ".src");
						was_clicked = true;
                    }
                    slideit();
                </script>
            </div>
        </div>

        <div class="wrapper"> <!-- Start Wrapper -->

		    <div id="introdescription">
			<p><em>The Ithaca Physics Factory, a Community Science Workshop with a Bus, is about experiencing physics because it's fun, beautiful, and useful. This mobile exhibition of upcycled appliances awakens interest and creativity in physics through direct sensory experience of unusual phenomena.</em></p>
			</div>
		
            <div class="blog"> <!-- Start Blog -->
			

                <?php include 'blog/rss2html_mainblog.php'; ?>

            </div> <!-- End Blog -->
			<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
			<script>
				jQuery(document).ready(function() {
				jQuery('.tabs .tab-links a').on('click', function(e)  {
					var currentAttrValue = jQuery(this).attr('href');
			 
					// Show/Hide Tabs
			    jQuery('.tabs ' + currentAttrValue).fadeIn(400).siblings().hide();
			 
					// Change/remove current tab to active
					jQuery(this).parent('li').addClass('active').siblings().removeClass('active');
			 
					e.preventDefault();
				});
		    	});
			</script>
			<div class="tabs">
				<ul class="tab-links">
					<li class="active"><a href="#tab1">Twitter</a></li>
					<li><a href="#tab2">Facebook</a></li>
				</ul>
			 
				<div class="tab-content">
					<div id="tab1" class="tab active">
						 <a class="twitter-timeline" data-dnt="true" href="https://twitter.com/Physicsbus" data-widget-id="531173772846317568">Tweets by @Physicsbus</a>
                    <script>!function (d, s, id) {
                            var js, fjs = d.getElementsByTagName(s)[0], p = /^http:/.test(d.location) ? 'http' : 'https';
                            if (!d.getElementById(id)) {
                                js = d.createElement(s);
                                js.id = id;
                                js.src = p + "://platform.twitter.com/widgets.js";
                                fjs.parentNode.insertBefore(js, fjs);
                            }
                        }(document, "script", "twitter-wjs");</script>
					</div>
			 
					<div id="tab2" class="tab">
						<div class="fb-like-box" data-href="https://www.facebook.com/IthacaPhysicsFactory" data-height="800" data-width="200" data-colorscheme="light" data-show-faces="false" data-header="false" data-stream="true" data-show-border="true"></div>
					</div>
				</div>
			</div>
			
        </div> <!-- End Wrapper -->

        <?php include 'footer.php'; ?>

    </body>
</html>