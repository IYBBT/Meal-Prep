
<?php include("util.php"); ?>

<HTML>
    <HEAD>
        <TITLE>Website</TITLE>
        <?php include_once("bootstrap.php"); ?>    
        
        <STYLE>
            .main {
                height: 100%;
                width: 100%;
                position: fixed;
                z-index: 2;
                top: 0;
                left: 200;
                background-color: #E0E0E0;
                overflow-x: hidden;
                padding-top: 10px;
                padding-left: 20px;
            }

            .sidenav {
                height: 100%;
                width: 200px;
                position: fixed;
                z-index: 1;
                top: 0;
                left: 0;
                background-color: #F8F8F8;
                overflow-x: hidden;
                padding-top: 10px;

                text-align: center;
            }

            .sidenav-links {
                border: solid #5E5E5E 1px;
                border-radius: 5px;
                padding: 5px;
            }

            .user-icon {
                width: 70px;
                height: 70px;
                display: block;
                margin: 0 auto 20px auto;
                border-radius: 50%;
                background-color: gray;
            }

            .menuItem {
                border: solid 1px black;
                border-radius: 5px;
                text-align: center;
                font-size: 20px;
                background-color: #E0E0E0;
                color: blue;
            }

            .menuItem:hover {
                background-color: blue;
                color: #E0E0E0;
            }
        </STYLE>
    </HEAD>

    <BODY>
        <DIV class='container'>
            <DIV class='sidenav'>
                <DIV class='user-icon'></DIV>
                <DIV style='margin: auto; width: 50%; text-align: left;'>
                    Welcome
                    <P style='color: #0FAF80'>Kasen Groth</P>
                </DIV>

                <DIV style='margin: 10px;'>
                    <A class='sidenav-links' href='landing_page.php?menu=logout'>Sign out</A>
                </DIV>
                
                <DIV style='margin: 10px;'>
                    <A class='sidenav-links' href='dashboard.php?menu=dashboard'>Dashboard</A>
                </DIV>

                <DIV style='margin: 10px;'>
                    <A class='sidenav-links' href='dashboard.php?menu=previousRecipes'>Previous Recipes</A>
                </DIV>
            </DIV>

            <DIV class='main'>
                <DIV class='row'>
                    <DIV class='col-5 menuItem'>
                        Browse Recipes
                    </DIV>
                    <DIV class='col-5 menuItem'>
                        Make Recipe
                    </DIV>
                </DIV>

                <?php
                if ($menu == 'browse') {
                    browseCatalog();
                } else if ($menu == 'makeRecipe') {
                    makeRecipe();
                } else if ($menu == 'previousRecipes') {
                    getPreviousRecipes();
                }
                ?>
            </DIV>
        </DIV>
    </BODY>
</HTML>
