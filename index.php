﻿<!DOCTYPE html>
<html lang="en">
    <?php 
        // Load xml
        $GLOBALS['XMLReader'] = simplexml_load_file("config/Site.xml") or die("Failed to load");
        $GLOBALS['WebConfig'] = simplexml_load_file("config/env.xml") or die("Failed to load");
        $GLOBALS['CredConfig'] = simplexml_load_file("config/credentials.xml") or die("Failed to load");

        include 'function/database.php';

        echo "<head>";
        echo "<title>" . $GLOBALS['XMLReader']->SiteTitle . "</title>";
        echo "<meta charset=\"UTF-8\">";
        // Load CSS
        foreach($GLOBALS['XMLReader']->Header->StyleSheets as $ref){echo "<link rel=\"stylesheet\" href=\"" . $ref . "\">";}
        echo "</head>";
    ?>
    <body>
        <?php 
            // Load Javascripts
            foreach($GLOBALS['XMLReader']->Scripts->Script as $script){echo "<script src=\"" . $script . "\"></script>";}
        ?>
        <div class="header">
            <div class="hero-text">
                <?php 
                    // Button Links
                    foreach($GLOBALS['XMLReader']->Links->Link as $link){echo "<a href=\"" . $link->URL . "\" class=\"button\">" . $link->Name . "</a> ";}
                ?>
            </div>
        </div>
        <div class="Content">

            <?php 
                /* Bio */ 
                echo "<div class=\"bio-container\">";
                $Bio = QueryByFile("sql/GetBio.sql"); 
                echo "<img src='img/SMTrip.jpg'/>";
                echo "<p>" . $Bio['VALUE'] . "</p>";
                echo "</div>";
            ?>
            
            <?php 
                // Projects
                echo "<h2>Projects</h2>";
                $i = 1;
                foreach($GLOBALS['XMLReader']->Projects->Project as $Project)
                {
                    echo "<div class=\"Project\">";
                    echo "<div class=\"Project-Title\">" . $Project['Topic'] . "</div>";
                    echo "<div class=\"Project-Description\">" . $Project->Description . "</div>";
                    
                    // SlideShow Container
                    if(!empty($Project->SlideShow))
                    {
                        echo "<div class=\"slideshow-container border-box\">";
                        foreach($Project->SlideShow->ImageFile as $Image)
                        {
                            echo "<div class=\"Slide SlideClass" . $i . "\">";
                            echo "<img src=\"" . $Image . "\" class=\"ImageSlides\">";
                            echo "</div>";
                        }
                        echo "<a class=\"prev\" onclick=\"plusSlides(-1,'SlideClass" . $i . "')\">&#10094;</a>";
                        echo "<a class=\"next\" onclick=\"plusSlides(1,'SlideClass" . $i . "')\">&#10095;</a>";
                        echo "</div>";
                        echo "<script>";
                        echo "showSlides(1,'SlideClass" . $i . "')";
                        echo "</script>";
                    }
                    echo "</div>";
                    $i++;
                }
            ?>


            <?php 
                echo "<footer>";
                echo "<p>© " .  str_replace("@year", date("Y"), $GLOBALS['XMLReader']->Footer->Copyright) . "</p>";
                echo "<p><a href=\"https://github.com/BrandonMFong/Site\">Open Source</a></p>";
                echo "<p><a href=\"login\">Login</a></p>";
                echo "</footer>";
            ?>
        </div>
    </body>
</html>