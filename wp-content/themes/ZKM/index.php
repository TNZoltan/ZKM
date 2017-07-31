<?php
/**
 * Created by PhpStorm.
 * User: Zoli
 * Date: 7/31/2017
 * Time: 4:08 PM
 */
?>

<?php
if ($_GET['password'] === 'bunnyears') {
    $_SESSION['accepted'] = true;
}
?>

<?php if (!$_SESSION['accepted']): ?>
    <form>
        <input type="password" name="password"/>
        <input type="submit" class="btn btn-info">
    </form>
<?php else: ?>
    
<?php endif; ?>
