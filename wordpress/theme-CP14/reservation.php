<?php
/*
Template Name: Reservation
*/
$user = wp_get_current_user();
if($user->ID == 0){
    header('location:login');
}

?>
<?php get_header();?>
<div>
    <h1>Mes informations</h1>
    <?php if(isset($_POST['btn_16'])): ?>
        <h2 class="success-msg">Votre reservation pour le Lundi 16 septembre 2019 a bien ete enregistre</h2>
    <?php endif ?>
    <?php if(isset($_POST['btn_18'])): ?>
        <h2 class="success-msg">Votre reservation pour le Mercredi 18 septembre 2019 a bien ete enregistre</h2>
    <?php endif ?>
    <?php if(isset($_POST['btn_19'])): ?>
        <h2 class="success-msg">Votre reservation pour le Jeudi 19 septembre 2019 a bien ete enregistre</h2>
    <?php endif ?>
    <?php if(isset($_POST['btn_20'])): ?>
        <h2 class="success-msg">Votre reservation pour le Vendredi 20 septembre 2019 a bien ete enregistre</h2>
    <?php endif ?>
    <?php if(isset($_POST['btn_30'])): ?>
        <h2 class="success-msg">Votre reservation pour le Lundi 30 septembre 2019 a bien ete enregistre</h2>
    <?php endif ?>


    <form action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="post">
        <TABLE BORDER=3 CELLSPACING=3 CELLPADDING=3>
            <TR>
                <TD COLSPAN="7" ALIGN=center><B>Septembre 2019</B></TD>
            </TR>

            <TR>
                <TD COLSPAN="7" ALIGN=center><I>Reservez votre espace de travail</I></TD>
            </TR>

            <TR>
                <TD ALIGN=center>Lundi</TD>
                <TD ALIGN=center>Mardi</TD>
                <TD ALIGN=center>Mercredi</TD>
                <TD ALIGN=center>Jeudi</TD>
                <TD ALIGN=center>Vendredi</TD>
                <TD ALIGN=center>Samedi</TD>
                <TD ALIGN=center>Dimanche</TD>
            </TR>

            <TR>
                <TD ALIGN=center></TD>
                <TD ALIGN=center></TD>
                <TD ALIGN=center></TD>
                <TD ALIGN=center></TD>
                <TD ALIGN=center></TD>
                <TD ALIGN=center style="background-color: #5b7e8e"></TD>
                <TD ALIGN=center style="background-color: #5b7e8e">1</TD>
            </TR>

            <TR>
                <TD ALIGN=center style="background-color: gray">2</TD>
                <TD ALIGN=center style="background-color: gray">3</TD>
                <TD ALIGN=center style="background-color: gray">4</TD>
                <TD ALIGN=center style="background-color: gray">5</TD>
                <TD ALIGN=center style="background-color: gray">6</TD>
                <TD ALIGN=center style="background-color: #5b7e8e">7</TD>
                <TD ALIGN=center style="background-color: #5b7e8e">8</TD>
            </TR>

            <TR>
                <TD ALIGN=center style="background-color: gray">9</TD>
                <TD ALIGN=center style="background-color: gray">10</TD>
                <TD ALIGN=center style="background-color: gray">11</TD>
                <TD ALIGN=center style="background-color: gray">12</TD>
                <TD ALIGN=center style="background-color: gray">13</TD>
                <TD ALIGN=center style="background-color: #5b7e8e">14</TD>
                <TD ALIGN=center style="background-color: #5b7e8e">15</TD>
            </TR>

            <TR>
                <TD ALIGN=center <?php if(isset($_POST['btn_16'])): ?> style="background-color: green" <?php endif ?>>
                    <input type="submit" name="btn_16" value="16">
                </TD>
                <TD ALIGN=center style="background-color: red">17</TD>
                <TD ALIGN=center <?php if(isset($_POST['btn_18'])): ?> style="background-color: green" <?php endif ?>>
                    <input type="submit" name="btn_18" value="18">
                </TD>
                <TD ALIGN=center <?php if(isset($_POST['btn_19'])): ?> style="background-color: green" <?php endif ?>>
                    <input type="submit" name="btn_19" value="19">
                </TD>
                <TD ALIGN=center <?php if(isset($_POST['btn_20'])): ?> style="background-color: green" <?php endif ?>>
                    <input type="submit" name="btn_20" value="20">
                </TD>
                <TD ALIGN=center style="background-color: #5b7e8e">21</TD>
                <TD ALIGN=center style="background-color: #5b7e8e">22</TD>
            </TR>

            <TR>
                <TD ALIGN=center style="background-color: red">23</TD>
                <TD ALIGN=center style="background-color: red">24</TD>
                <TD ALIGN=center style="background-color: red">25</TD>
                <TD ALIGN=center style="background-color: red">26</TD>
                <TD ALIGN=center style="background-color: red">27</TD>
                <TD ALIGN=center style="background-color: #5b7e8e">28</TD>
                <TD ALIGN=center style="background-color: #5b7e8e">29</TD>
            </TR>

            <TR>
                <TD ALIGN=center <?php if(isset($_POST['btn_30'])): ?> style="background-color: green" <?php endif ?>>
                    <input type="submit" name="btn_30" value="30">
                </TD>
                <TD ALIGN=center></TD>
                <TD ALIGN=center></TD>
                <TD ALIGN=center></TD>
                <TD ALIGN=center></TD>
                <TD ALIGN=center style="background-color: #5b7e8e"></TD>
                <TD ALIGN=center style="background-color: #5b7e8e"></TD>

            </TR>

        </TABLE>
    </form>
</div>
<?php get_footer(); ?>