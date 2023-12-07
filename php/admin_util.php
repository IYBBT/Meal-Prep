
<?php
session_start();
include_once('end_util.php');
include_once('bootstrap.php');
include_once('db.php');
?>

<STYLE>
    .user-box {
        border: solid 2px blue;
        padding: 10px;
        margin: 5px;
        margin-left: 10px;
        margin-right: 10px;
    }

    .scroll-box {
        overflow-y: scroll;
        max-height: 90vh;
    }
</STYLE>

<?php

function isAdmin($db, $uid) {
    $sql = "SELECT aid "
        . "FROM admin "
        . "WHERE aid IN ($uid)";

    $res = $db->query($sql);
    if ($res) {
        while ($res->fetch())
            return TRUE;
        return FALSE;
    } else {
        ?>
        <SCRIPT>
            change_page("landing_page.php", 1000);
        </SCRIPT>
        <?php
    }
}

function getAdminUsers($db, $uid) {
    $sql = "SELECT aid, uName "
        . "FROM admin JOIN user "
        . "ON id=aid "
        . "WHERE aid IN ("
        . " SELECT uid "
        . " FROM manages "
        . " WHERE aid=$uid)";

    $res = $db->query($sql);
    if ($res) {
        while ($row = $res->fetch()) {
            $id = $row['aid'];
            $uName = $row['uName'];
            echo "<DIV class='admin-user'>";
            echo "<A href='?menu=admin-user&uid=$id&a=TRUE'>$uName</A>";
            echo "</DIV>";
        }
    } else {
        echo "<SCRIPT>change_page('landing_page.php', 1000)</SCRIPT>";
        echo "Could not find admin users.";
    }
}

function getEndUsers($db, $uid) {
    $sql = "SELECT uid, uName "
        . "FROM end JOIN user "
        . "ON id=uid "
        . "WHERE uid IN ("
        . " SELECT uid "
        . " FROM manages "
        . " WHERE aid=$uid)";

    $res = $db->query($sql);
    if ($res) {
        while ($row = $res->fetch()) {
            $id = $row['uid'];
            $uName = $row['uName'];
            echo "<DIV class='end-user'>";
            echo "<A href='?menu=end-user&uid=$id&a=FALSE'>$uName</A>";
            echo "</DIV>";
        }
    } else {
        echo "<SCRIPT>change_page('landing_page.php', 1000)</SCRIPT>";
        echo "Could not find end users.";
    }
}

function displayUserInfo($db, $userInfo) {
    $id = $userInfo['uid'];
    $admin = $userInfo['a'] == "TRUE";
    $window = $userInfo['window'];
    
    $uName = getUName($db, $id);
    echo "<H2>$uName</H2>";
    if ($admin) {

    } else {
        ?>
        <DIV>
            <A href='?menu=end-user&uid=<?php echo $id; ?>&a=FALSE&window=meals'>Recipes</A>
            <A href='?menu=end-user&uid=<?php echo $id; ?>&a=FALSE&window=reviews'>Reviews</A><BR/>
            <?php
            if ($window == "meals") {
                $sql = "SELECT mid, mName "
                    . "FROM meal "
                    . "WHERE uid=$id";

                $res = $db->query($sql);
                if ($res) {
                    echo "<DIV class='scroll-box'>";
                    while ($meal = $res->fetch()) {
                        $mid = $meal['mid'];
                        $mName = $meal['mName'];
                        $ings = getIngredients($db, $mid);
                        displayUserRecipe($db, array($mid, $mName, $ings));
                        echo "<BR/>";
                    }
                    echo "</DIV>";
                } else {
                    echo "<SCRIPT>change_page('?menu=end-user', 500)</SCRIPT>";
                    echo "Could not load the users meals.";
                }
            } else if ($window == "reviews") {
                $sql = "SELECT rid, mid, rating, review "
                    . "FROM review "
                    . "WHERE uid=$id";

                $res = $db->query($sql);
                if ($res) {
                    echo "<DIV class='scroll-box'>";
                    while ($review = $res->fetch()) {
                        $rid = $review['rid'];

                        echo "<DIV class='user-box'>";
                        echo "<P>" . $review['mid'] . ", " . $review['rating'] . ", \"" . $review['review'] . "\"</P>";
                        echo "<FORM action='?menu=removeRating&rid=$rid' method='post'>";
                        echo "<INPUT type='submit' value='Remove' />";
                        echo "</FORM>";
                        echo "</DIV>";
                    }
                    echo "</DIV>";
                } else {
                    echo "<SCRIPT>change_page('?menu=end-user', 500)</SCRIPT>";
                    echo "Could not load the users reviews.";
                }
            }
            ?>
        </DIV>
        <?php
    }
}

function displayUserRecipe($db, $mealInfo) {
    $mid = $mealInfo[0];
    $mName = $mealInfo[1];
    $ings = $mealInfo[2];

    echo "<DIV class='user-box'>";
    echo "<P>$mName</P>";

    $sql = "SELECT DISTINCT type "
        . "FROM ingredient ";

    $res = $db->query($sql);
    if (!$res) {
        echo "<SCRIPT>change_page('?menu=end-user', 500)</SCRIPT>";
        echo "Could not get ingredient types.";
    }

    $i = 0;
    while ($typeInfo = $res->fetch()) {
        $type = $typeInfo['type'];
        $ing_types[$type] = array();
        $ing_types[$i++] = $type;
    }

    foreach ($ings as $ing) {
        $iName = $ing[1];
        $type  = $ing[2];

        array_push($ing_types[$type], $iName);
    }

    for ($i = 0; $i < count($ing_types) / 2; ++$i) {
        $type_array = $ing_types[($type = $ing_types[$i])];

        if (($size = count($type_array)) > 0) {
            echo "<SELECT class='ing_list' name='$type'>";
            echo "<OPTION>$type</OPTION>";
        
            for ($f = 0; $f < $size; ++$f) {
                $iName = $type_array[$f];
                echo "<OPTION disabled>$iName</OPTION>";
            }

            echo "</SELECT>";
        }
    }

    $sql = "SELECT step "
        . "FROM recipe_step "
        . "WHERE mid=$mid";

    $res = $db->query($sql);
    if ($res) {
        $i = 0;
        echo "<BR/><BR/>";
        while ($step = $res->fetch())
            echo "<P>" . ++$i . "). " . $step[0] . "</P>";
    }

    echo "<FORM action='?menu=removeRecipe&mid=$mid' method='post'>";
    echo "<INPUT type='submit' value='Remove' />";
    echo "</FORM>";
    echo "</DIV>";
}

function removeRecipe($db, $mid) {
    $sql = "SELECT uid "
    . "FROM meal "
    . "WHERE mid=$mid";

    $res = $db->query($sql);
    if (!$res) {
        echo "<SCRIPT>change_page('?menu=end-user', 1000);</SCRIPT>";
        echo "Could not find the user.";
    } else {
        $uid = $res->fetch()['uid'];

        $sql = "DELETE FROM meal "
            . "WHERE mid=$mid";

        $res = $db->query($sql);
        if (!$res) {
            $time = 1000;
            echo "Could not delete review";
        }
        echo "<SCRIPT>change_page('?menu=end-user&uid=$uid&a=FALSE&window=reviews', $time);</SCRIPT>";
    }
}

function removeRating($db, $rid) {
    $sql = "SELECT uid "
        . "FROM review "
        . "WHERE rid=$rid";

    $res = $db->query($sql);
    if (!$res) {
        echo "<SCRIPT>change_page('?menu=end-user', 1000);</SCRIPT>";
        echo "Could not find the user.";
    } else {
        $uid = $res->fetch()['uid'];

        $sql = "DELETE FROM review "
            . "WHERE rid=$rid";
    
        $res = $db->query($sql);
        if (!$res) {
            $time = 1000;
            echo "Could not delete review";
        }
        echo "<SCRIPT>change_page('?menu=end-user&uid=$uid&a=FALSE&window=reviews', $time);</SCRIPT>";
    }
}

?>
