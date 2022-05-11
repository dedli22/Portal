<footer>
    <div class='text-left' style='float: left; margin-left: 40px; margin-top: 15px;'><b>Portal.lv</b> - Visas Tiesibas aizsargātas</div>
            <div class='text-right'style='float: right; margin-right: 40px; margin-top: 15px;'>
            © <?php
    $copyYear = 2022; // Mājaslapas sākuma laiks
    $curYear = date('Y'); // Gads ,kurš ir
    echo $copyYear . (($copyYear != $curYear) ? '-' . $curYear : '');
    ?> Copyright.
    </div>    
</footer>




</div>
</body>
</html>