<footer class="container fixed-bottom d-flex justify-content-center">
    <span>Isabelle - Thomas - Anthony - Johanna ® 2020</span>

    <span id="page-result">Pages: 
    <!--affiche la page précédente-->
    <a  style="color:#fff" href=<?=$linkPage?>down > < </a>
    <!--page acutel-->
    <?=$pages?>
    /
    <!--page totale-->
    <?=$maxPage?>
    <!--affiche la page suivante-->
    <a  style="color:#fff" href=<?=$linkPage?>next > > </a>
</span>
    <!--Nombre d'entré totale-->
    <span id="result">Entrées: <?=$entree?></span>
    
</footer>

</body>

</html>