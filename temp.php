<!--홍진서-->
<header id="main_header">
    <ul class="header_ul">
        <?php
        if (isset($_SESSION['name'])) { ?>
            <li><a href="./logout.php"> Log out</a></li>
        <?php
        } else { ?>
            <li><a href="./login.php"> Login</a></li>
        <?php
        }
        ?>
    </ul>
</header>