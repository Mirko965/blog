   <footer>
     <p>Copiright: Mirko Jelic</p>
    </footer>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script src="js/main.js"></script>
  </body>
</html>
<?php
// 5. CLOSE CONECTION
if(isset($dbconn)){
  mysqli_close($dbconn);
}

?>
