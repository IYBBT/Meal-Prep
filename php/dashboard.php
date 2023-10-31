
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
        </STYLE>
    </HEAD>

    <BODY>
        <DIV class='container'>
            <DIV class='sidenav'>
                <DIV style='margin: auto; width: 50%; text-align: left;'>
                    Welcome
                    <P style='color: #0FAF80'>Kasen Groth</P>
                </DIV>

                <DIV style='margin: 10px;'>
                    <A class='sidenav-links' href='landing_page.php?menu=logout'>Sign out</A>
                </DIV>
                
                <DIV style='margin: 10px;'>
                    <A class='sidenav-links' href=''>Dashboard</A>
                </DIV>

                <DIV style='margin: 10px;'>
                    <A class='sidenav-links' href=''>Cooking Reports</A>
                </DIV>
            </DIV>

            <DIV class='main'>

            </DIV>
        </DIV>
    </BODY>
</HTML>
