
<?php include("util.php"); ?>

<HTML>
    <HEAD>
        <TITLE>Website</TITLE>
        <?php include_once("bootstrap.php"); ?>    
        
        <STYLE>
            .main {
                height: 100%;
                width: 90%;
                position: fixed;
                z-index: 2;

                display: flex;
                justify-content: center;
                align-items: center;

                top: 0;
                left: 250;
                right: 0;

                background-color: #E0E0E0;
                overflow-x: hidden;
            }

            .grid {
                position: fixed;
                display: grid;

                top: 0;
                left: 250;
                right: 0;
            }

            .sidenav {
                height: 100%;
                width: 250px;
                position: fixed;
                z-index: 1;

                top: 0;
                left: 0;

                background-color: #F8F8F8;

                overflow-x: hidden;
                padding-top: 10px;

                text-align: center;
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
                height: 30px;
                margin: 10px;

                border: solid 1px black;
                border-radius: 5px;
                text-align: center;
                font-size: 20px;
                background-color: #E0E0E0;
                color: blue;

                text-decoration: none;
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
                    <P style='color: #0FAF80'>grotka01</P>
                </DIV>

                <A class='menuItem' style='position: fixed; top: 165; left: 20; width: 185;' href='landing_page.php?menu=logout'>Sign out</A>
                <A class='menuItem' style='position: fixed; top: 215; left: 20; width: 185;' href='?menu=dashboard'>Dashboard</A>
                <A class='menuItem' style='position: fixed; top: 265; left: 20; width: 185;'  href='?menu=previousRecipes'>Previous Recipes</A>
            </DIV>

            <DIV class='main'>
                <DIV class='grid'>
                    <DIV style='grid-column: 1;'></DIV>
                    <A class='menuItem' style='grid-column: 2' href='?menu=browse'>Browse Recipes</A>
                    <A class='menuItem' style='grid-column: 3' href='?menu=makeRecipe'>Make Recipe</A>
                    <DIV style='grid-column: 4;'></DIV>
                </DIV>

                <?php
                // print_r($_GET);
                $menu = $_GET['menu'];
                if ($menu == 'login' || $menu == 'dashboard') {
                    showProfile($db, $uid);
                } else if ($menu == 'browse') {
                    browseCatalog($db, $uid);
                } else if ($menu == 'recipe') {
                    showRecipe($db, $_GET['mid']);
                } else if ($menu == 'makeRecipe') {
                    makeRecipe($db);
                } else if ($menu == 'previousRecipes') {
                    getPreviousRecipes($db, $uid);
                }
                ?>
            </DIV>
        </DIV>
    </BODY>
</HTML>
