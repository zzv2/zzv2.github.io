<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <title>Donate</title>
        <link href="../css/style.css" rel="stylesheet" type="text/css"/>
        <link href="../lightbox/css/lightbox.css" rel="stylesheet" type="text/css"/>
        <link href='http://fonts.googleapis.com/css?family=Raleway:700%7CJulius+Sans+One' rel='stylesheet' type='text/css'>
        <link href='http://fonts.googleapis.com/css?family=Oxygen' rel='stylesheet' type='text/css'>

        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        <script src="../lightbox/js/lightbox.min.js" type="text/javascript"></script>
        <script src="../js/script.js" type="text/javascript"></script>

    </head>
    <body>
        <?php
        $page_title = "Donate";
        include 'header.php';
        ?>



        <div class="wrapper">
            
            <div class="par_wrap" id="donate_wrap">
                
                <h2>
                    Donate
                </h2>
                <img id="donate_header" src="../images/donate_header.jpg" alt=""/>
                <h2 class="donatetitle">
                    Network for Good
                </h2>
                <div class="donatesection">

                    <p>
                        Ithaca Physics Factory is a chapter of the Tucson, AZ based Physics Factory, founded in 2004. 
                        Its programming depends entirely on the generous support of sponsors and donors. Your contribution is fully tax deductible and will provide the materials, equipment, and volunteer support necessary to maintain the operation and programming of Ithaca's Physics Bus and stimulate the growth of the Ithaca Physics Factory.

                        Click here to donate through Network For Good (please type "Ithaca" in the designation box):
                    </p>
                    <a id="donatebutton" href="https://www.networkforgood.org/donation/ExpressDonation.aspx?ORGID2=20-2894569&amp;vlrStratCode=InZpCXd9xqYHv%2fkhWs9HRJJXhEGZtyYgTSJ0YbIdDri4jkfVga5prXU0NyztWiYp" target="_blank">
                        <span>I Want to Donate!</span>
                    </a><br><br>
                </div>

                <h2 class="donatetitle">
                    Get an Ithaca Physics Bus T-shirt! 
                </h2>
                <div class="donatesection">
                    <!--<img src="../images/t-shirt.jpg" alt="T-shirt"/>-->
                    <a href="../images/t-shirt_large.jpg" rel="lightbox">
                        <img src="../images/t-shirt.jpg" alt="T-shirt">
                    </a>

                    <form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_blank">

                        <select name="os0">
                            <option value="Small">Small $20.00 USD</option>
                            <option value="Medium">Medium $20.00 USD</option>
                            <option value="Large">Large $20.00 USD</option>
                            <option value="X-Large">X-Large $20.00 USD</option>
                        </select><br>

                        <input type="hidden" name="currency_code" value="USD">
                        <input type="hidden" name="cmd" value="_s-xclick">
                        <input type="hidden" name="hosted_button_id" value="WC3QQZNYU5AT6">

                        <input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_buynowCC_LG.gif" 
                               name="submit" alt="PayPal - The safer, easier way to pay online!">
                    </form>
                </div>
            </div>
            <img id="donate_img" src="../images/donate_pic.jpg" alt=""/>
        </div>

        <?php include 'footer.php'; ?>

    </body>
</html>

