
<?php

session_start();

include_once('bootstrap.php');
include_once('db.php');

?>

<STYLE>
    .login-form {
        margin: 3px;
        padding: 5px;
        border: solid 2px #0F5EAF;
    }

    .login-item {
        margin: 5px;
        padding: 5px;
    }

    .mealBox {
        border: solid 2px blue; 
        margin: 3px;
        padding: 10px;
    }

    .scrollable-box {
        overflow: auto;
        max-height: 85%;

        margin: 5px;
        padding: 2px;

        position: fixed;
        display: grid;
        top: 150;
        left: 250;image_url
        right: 0;
    }
</STYLE>

<?php
function loginForm() {
    ?>

    <FORM class='login-form' action='dashboard.php?menu=login' method='post'>
        <INPUT class='login-item' type='text' name='uName' placeholder='Username' size=5 />
        <INPUT class='login-item' type='text' name='pWord' placeholder='Password' size=5 />
        Remember Me<INPUT class='login-item' type='checkbox' name='rm'/>
        <INPUT type='submit' value='Login'/>
    </FORM>

    <?php
}

function logoutForm() {
    ?>

    <FORM class='login-form' action='?menu=logout' method='post'>
        <INPUT type='submit' value='Logout'/>
    </FORM>

    <?php
}

function getUID($db, $userInfo) {
    $uName = $_POST['uName'];
    $pWord = $_POST['pWord'];
    
    $sql = "SELECT id "
         . "FROM user "
         . "WHERE uName='$uName' AND pWord='$pWord'";

    $res = $db->query($sql);

    if ($res) {
        $row = $res->fetch();
        return $row['id'];
    }

    header('refresh:2;?menu=landing-page');
    echo 'Failed to login. Either the Username or Password is incorrect!';
}

function showProfile($db, $userInfo) {

}

// Shows the recipe with all steps, ingredients, and picture
function showRecipe($db, $mid) {
    $sql = "SELECT mName, meal_image "
        . "FROM meal "
        . "WHERE mid=$mid";

    $res = $db->query($sql);
    if (!$res) {
        header('refresh:2?menu=dashboard');
        echo 'Failed to find the recipe!';
    }

    $mealInfo = $res->fetch();
    $mName = $mealInfo['mName'];
    $image_url = $mealInfo['meal_image'];
    ?>

    <STYLE>
        .recipe {
            display: grid;
        }

        .meal-name {
            text-align: center;
            grid-row: 1;
        }

        .recipe_image {
            grid-row: 1;
            grid-column: 1;
            justify-self: center;
            margin: 25px;
        }
    </STYLE>

    <DIV class='recipe'>

    <?php
        echo "<P class='meal-name'>$mName</P>";
        ?>
        <DIV style='display: grid;'>
            <?php
            echo "<IMG class='recipe_image' src='$image_url' alt='$mName' width='200' height='200'>";
            echo "<DIV style='grid-column: 0; grid-row: 1; margin: 30px'>";
            $sql = "SELECT step "
            . "FROM meal NATURAL JOIN recipe_step "
            . "WHERE mid=$mid";

            $res = $db->query($sql);
            if (!$res) {
                header('refresh:2?menu=dashboard');
                echo 'Failed to find the recipe!';
            }

            $i = 0;
            while ($step = $res->fetch()) {
                echo "<P>" . ++$i . "). " . $step[0] . "</P>";
            }

            $sql = "SELECT iName, type "
                . "FROM meal NATURAL JOIN meal_uses "
                . "NATURAL JOIN ingredient "
                . "WHERE mid=$mid";

            $res = $db->query($sql);
            if (!$res) {
                header('refresh:2?menu=dashboard');
                echo 'Failed to find the ingredients used in the recipe';
            }

            $ingredients = $res->fetchAll();
            ?>
        </DIV>
    </DIV>
    <?php
}

// 
function displayMeal($db, $mealInfo) {
    $mid = $mealInfo['mid'];
    $name = $mealInfo['mName'];
    $ings = $mealInfo['ings'];
 
    echo "<A style='grid-columns: 1;' href='?menu=recipe&mid=$mid'>$name</A>";
    echo "<BR/><BR/>";

    $ing_types = array(
        'Dairy'      => array(),
        'Fruit'      => array(),
        'Protein'    => array(),
        'Vegetables' => array(),
        'Grain'      => array(),
        
        0       => 'Dairy',
        1       => 'Fruit',
        2       => 'Protein',
        3       => 'Vegetables',
        4       => 'Grain'
    );

    foreach ($ings as $ing) {
        $iName = $ing[1];
        $type  = $ing[2];

        array_push($ing_types[$type], $iName);
    }

    for ($i = 0; $i < count($ing_types) / 2; ++$i) {
        $type = $ing_types[$i];

        $size = count($ing_types[$type]);
        if ($size > 0) {
            echo "<SELECT name='$type'>";
            echo "<OPTION>$type</OPTION>";
        }
        
        for ($f = 0; $f < $size; ++$f) {
            $iName = $ing_types[$type][$f];
            echo "<OPTION disabled>$iName</OPTION>";
        }

        if ($size > 0)
            echo "</SELECT>";
    }
}

// Allows an end user to browse meals by displaying meals
// in rows of two.
//
// Also, allows the user to add ingredients to their list.
function browseCatalog($db, $uid) {
    $sql = "SELECT * "
        . "FROM meal";

    $res = $db->query($sql);

    echo "<DIV class='scrollable-box'>";
    if ($res) {
        $meals = $res->fetchAll();
        for ($i = 0; $i < count($meals); ++$i) {
            $meal = $meals[$i];
            $mid = $meal['mid'];
            $sql = "SELECT * "
                . "FROM meal_uses NATURAL JOIN ingredient "
                . "WHERE mid=$mid";

            $res = $db->query($sql);
            $ings = array();
            while ($row = $res->fetch())
                array_push($ings, array($row[0], $row[2], $row[3]));

            echo "<DIV class='mealBox' style='grid'>";
            $meal['ings'] = $ings;
            displayMeal($db, $meal);
            echo "</DIV>";
        }
    }
    echo "</DIV>";
}

// Creates a form for an end user to create a meal
function makeRecipe($db) {

}

//
function getPreviousRecipes($db, $uid) {
    
}

?>
