
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
</STYLE>

<?php

session_start();

include_once('bootstrap.php');
include_once('db.php');

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

// Displays the meal with all of its ingredients
function displayMeal($mealInfo) {
    ?>
    <DIV>
        <?php
        $mid = $mealInfo['mid'];
        $name = $mealInfo['mName'];
        $ings = $mealInfo['ings'];
        
        echo "<A href='?menu=recipe&mid=$mid'>$name</A>";
        ?>
    </DIV>
    <?php
}

// Allows an end user to browse meals by displaying meals
// in rows of two.
//
// Also, allows the user to add ingredients to their list.
function browseCatalog($db, $uid) {
    $sql = "SELECT * "
        . "FROM meal";

    $res = $db->query($sql);
    if ($res != False) {
        for ($i = 0; $i < count($res); ++$i) {
            $meal = $res->fetch();
            
            if (!($i % 2))
                echo "<DIV class='row'>";
    
            echo "<DIV class='col-6 mealBox'>";

            print_r($meal);
            displayMeal($meal);

            echo "</DIV>";

            if ($i % 2)
                echo "</DIV>";
        }
    }
}

// Creates a form for an end user to create a meal
function makeRecipe($db) {

}

//
function getPreviousRecipes($db, $uid) {

}

?>

