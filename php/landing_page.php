
<!DOCTYPE HTML>

<?php
session_start();
include_once('util.php');
?>

<HTML>
    <HEAD>
        <TITLE>Landing Page</TITLE>
    
        <?php
        $menu = 'landing-page';
        if (isset($_GET['menu'])) {
            $menu = $_GET['menu'];
            if ($menu == 'login') {
                $_SESSION['uid'] = getUID($db, $_POST);
                if ($_SESSION['uid'])
                    unset($_SESSION['uid']);
                $menu = 'main';
            } else if ($menu == 'logout') {
                unset($_SESSION['uid']);
                $menu = 'landing-page';
            }
        }
        $uid = isset($_SESSION["uid"]) ? $_SESSION["uid"] : 0;
        ?>

        <STYLE>
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
        </STYLE>
    </HEAD>

    <BODY>
        <DIV class=''>
        <?php
        if ($menu == 'landing-page') {
            ?>
            <DIV class='col-2 sidenav'>
                <?php
                loginForm();
                ?>
            </DIV>
            <?php
        } else if ($menu == 'main') {
            ?>
            <DIV>
                <?php
                logoutForm();
                ?>
            </DIV>
            <?php
        }
        ?>
        </DIV>
    </BODY>
</HTML>
