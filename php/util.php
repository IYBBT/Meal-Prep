
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

    .meal-box {
        border: solid 2px blue;
        margin: 3px;
        padding: 10px;
    }

    .scrollable-box {
        overflow: auto;
        max-height: 85%;
        grid-row: 0;
        display: grid;
    }

    .browse_tab {
        display: grid;
        position: fixed;

        margin: 10px;
        padding: 2px;

        top: 100;
        bottom: 0;
        left: 250;
        right: 0;
    }

    label, input {
        font-family: cursive, sans-serif;
    }

    .ing_list {
        margin-bottom: 10px;
        margin-top: 10px;
        margin-right: 20px;
        padding: 4px;

        font-family: cursive, sans-serif;
        outline: 0;
        background: #2ECC71;
        color: #FFF;
        border: 1px solid crimson;
        border-radius: 9px;
    }

    .submit-button {
        margin-top: 20px;
        font-family: cursive, sans-serif;
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

function showProfile($db, $uid) {
    $sql = "SELECT * "
        . "FROM meal "
        . "WHERE uid=$uid";

    $res = $db->query($sql);
    if (!$res) {
        header("refresh: 2;url=dashboard.php?menu=dashboard");
        echo "Could not find your meals";
    } else {
        echo "<DIV class='browse_tab'>";
        while ($meal = $res->fetch()) {
            echo "<DIV class='meal-box'>";
            $mid = $meal['mid'];
            $meal['ings'] = getIngredients($db, $mid);
            
            displayMeal($db, $meal);
            echo "</DIV>";
        }
        echo "</DIV>";
    }
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
            grid-row: 0;
        }

        .recipe_image {
            grid-row: 1;
            grid-column: 1;
            justify-self: center;
            margin: 25px;
        }

        .review-bar {

        }
    </STYLE>

    <DIV class='recipe'>
        <P class='meal-name'><?php echo $mName ?></P>
        <DIV class=''>
            <?php
            $ings = getIngredients($db, $mid);
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
            ?>
        </DIV>

        <DIV style='display: grid; margin: 5px;'>
            <?php
            echo "<IMG class='recipe_image' src='$image_url' alt='$mName' width='200' height='200'>";
            echo "<DIV style='grid-column: 0; grid-row: 2; margin: 3px'>";
            $sql = "SELECT step "
                . "FROM meal NATURAL JOIN recipe_step "
                . "WHERE mid=$mid";

            $res = $db->query($sql);
            if (!$res) {
                header('refresh:2?menu=dashboard');
                echo 'Failed to find the recipe!';
            }

            $i = 0;
            while ($step = $res->fetch())
                echo "<P>" . ++$i . "). " . $step[0] . "</P>";
            ?>
        </DIV>
        <DIV class='review-bar'>
            <DIV style='grid-row: 1;'>

            </DIV>
            <DIV style='grid-row: 0; display: grid;'>
                <?php
                for ($i = 1; $i <= 5; ++$i) {
                    ?>
                    <A style='grid-column: <?php echo $i + 10; ?>; grid-row: 1;' href='<?php echo "?menu=recipe&mid=$mid&review=$i"; ?>'>
                        <IMG src='../png/star1.png' />
                    </A>
                    <?php
                }

                $review = $_GET['review'];
                echo "<FORM style='grid-column: 1 / 25; grid-row: 0; display: grid;' method='post' action='?menu=addreview'>";
                echo "<LABEL style='text-align: center; grid-row: 1;' for='review'>Review:</LABEL>";
                echo "<TEXTAREA style='grid-row: 0;' name='review' rows='2' cols='64' maxlength='256'></TEXTAREA>";
                echo "<INPUT type='hidden' name='rating' value='$review' />";
                echo "<INPUT type='hidden' name='mid' value='$mid' />";
                echo "<INPUT type='submit' value='submit' />";
                echo "</FORM>";
                ?>
            </DIV>
        </DIV>
        <DIV>
            <?php
            $sql = "SELECT "
            ?>
        </DIV>
    </DIV>
    <?php
}

// Shows the meals in the browse menu. Allows the user to click on the
// recipe's name to access the information of the recipe.
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
}

function getIngredients($db, $mid) {
    $sql = "SELECT * "
        . "FROM meal_uses NATURAL JOIN ingredient "
        . "WHERE mid=$mid";
    
    $res = $db->query($sql);
    if (!$res) {
        header('refresh:2?menu=dashboard');
        echo 'Could not find the ingredients for a recipe.';
    }

    $ings = array();
    while ($row = $res->fetch())
        array_push($ings, array($row[0], $row[2], $row[3]));
    
    return $ings;
}

// Allows an end user to browse meals by displaying meals
// in rows of two.
//
// Also, allows the user to add ingredients to their list.
function browseCatalog($db) {
    $sql = "SELECT mid, mName "
        . "FROM meal";

    $res = $db->query($sql);

    ?>
    <DIV class='browse_tab'>
        <?php
        recipeForm($db);

        echo "<DIV class='scrollable-box'>";
        if ($res) {
            while ($meal = $res->fetch()) {
                echo "<DIV class='meal-box'>";
                $mid = $meal['mid'];
                $meal['ings'] = getIngredients($db, $mid);
                
                displayMeal($db, $meal);
                echo "</DIV>";
            }
        }
        echo "</DIV>";
    echo "</DIV>";
}

function recipeForm($db) {
    $types = [ 'Dairy', 'Fruit', 'Protein', 'Vegetables', 'Grain' ];

    echo "<FORM style='grid-row: 1;' name='recipe' action ='dashboard.php?menu=generateRecipe'  method='POST'>\n";

    $i = 0;
    foreach ($types as $type) {
        echo "<DIV style='display: inline-grid;'>";
        echo "<LABEL style='grid-row: 1; text-align: center' for='$type'>$type:</LABEL>";
        echo "<SELECT style='grid-row: 0;' class='ing_list' name='$type' size='2'  multiple>";

        $sql = "SELECT iid, iName FROM ingredient WHERE type = '$type'";
        $res = $db->query($sql);

        if ($res) {
            while ($row = $res->fetch()) {
                $iid = $row['iid'];
                $iName = $row['iName'];

                echo "<OPTION value='$iid'>$iName</OPTION>\n";
            }
        }

        echo "</SELECT>";
        echo "</DIV>";
        ++$i;
    }

    echo "<DIV class='submit-button'>";
    echo "<INPUT type='submit' value='Cooking...'>";
    echo "</DIV>";

    echo"</FORM>";
}

function genRecipe($db, $selectedIngredients) {

    // Turn the array of selected ingredient IDs into a comma-separated string
    $ingredientIds = implode(", ", $selectedIngredients);
    
    // echo $ingredientIds;
      
    $recipeSql = "SELECT DISTINCT meal.mid, meal.mName "
                . "FROM meal "
                . "INNER JOIN meal_uses ON meal.mid = meal_uses.mid "
                . "WHERE meal_uses.iid IN ($ingredientIds)";
    
    $possibleRecipes = $db->query($recipeSql);

    echo "<DIV class='browse_tab'>";
    recipeForm($db);
    if ($possibleRecipes) {
        echo "<DIV class='scrollable-box'>";
        while ($meal = $possibleRecipes->fetch()) {
            echo "<DIV class='meal-box'>";
            $mid = $meal['mid'];
            $meal['ings'] = getIngredients($db, $mid);

            displayMeal($db, $meal);
            echo "</DIV>";
        }
        echo "</DIV>";
    } else {
        echo "No recipes found with the selected ingredients.";
    }
}

function addReview($db, $uid, $reviewInfo) {
    $mid = $reviewInfo['mid'];
    $review = $reviewInfo['review'];
    $rating = $reviewInfo['rating'];

    $sql = "INSERT INTO review "
        . "VALUE($uid, $mid, $rating, '$review')";

    $res = $db->query($sql);
    if (!$res) {
        header("refresh: 2;Location: dashboard.php?menu=dashboard");
        echo "Error adding review.";
    } else {
        header("Location: dashboard.php?menu=dashboard");
    }
}

// Creates a form for an end user to create a meal
function makeRecipe($db) {

}

//
function getPreviousRecipes($db, $uid) {
    
}

?>
