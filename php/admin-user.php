
<?php
include_once("admin_util.php");
?>

<HTML>
    <HEAD>
        <TITLE>Admin Page</TITLE>
    </HEAD>

    <STYLE>
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

        .main {
            position: fixed;

            left: 250;
            right: 0;

            overflow-x: hidden;
            padding-top 10px;
            text-align: center;
        }

        A {
            text-decoration: none;
        }
    </STYLE>

    <BODY>
        <DIV class='container'>
            <DIV class='sidenav'>
                <?php
                $uid = $_SESSION['uid'];
                ?>
                <DIV>
                    <H2>Admin-Users</H2>
                    <?php
                    getAdminUsers($db, $uid);
                    ?>
                    <BR/><BR/>
                </DIV>
                <DIV>
                    <H2>End-Users</H2>
                    <?php
                    getEndUsers($db, $uid);
                    ?>
                </DIV>
            </DIV>
            
            <?php
            $menu = $_GET['menu'];
            if ($menu == 'admin-user' || $menu == 'end-user') {
                echo "<DIV class='main'>";
                displayUserInfo($db, $_GET);
                echo "</DIV>";
            } else if ($menu == 'removeRecipe') {
                $mid = $_GET['mid'];
                removeRecipe($db, $mid);
            } else if ($menu == 'removeRating') {
                $rid = $_GET['rid'];
                removeRating($db, $rid);
            }
            ?>
        </DIV>
    </BODY>
</HTML>
