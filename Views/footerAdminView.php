<footer class="container fixed-bottom d-flex justify-content-center">
    <span>Isabelle - Thomas - Anthony - Johanna ® 2020</span>

    <span id="page-result">Pages: 
    <!--affiche la page précédente-->



    <a style="color:#fff"  href=<?=$linkPage . "var="?><?=$_SESSION['pages']?>&action=decr >< </a>
    <!--page acutel-->
    <?=$_SESSION['displayPages'] + 1?>
    /
    <!--page totale-->
    <?=$maxPage?>
    <a style="color:#fff"  href=<?=$linkPage . "var="?><?=$_SESSION['pages']?>&action=incr > ></a>


</span>
    <!--Nombre d'entré totale-->
    <span id="result">Entrées: <?=$entree?></span>
    
</footer>

</body>

</html>