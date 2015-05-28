<div class='center'>
    <form method='POST' id='logout'>
        <p>Logged in as <?php echo $_SESSION['username']?>&nbsp;
            <input type='submit' name='logout' value='(logout)'
                onclick='return confirm("Are you sure you want to logout?")'>
    </form>
</div>