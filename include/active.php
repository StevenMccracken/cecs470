
<?php 
$strings = explode("/", $_SERVER['PHP_SELF']);
$self = $strings[count($strings) - 1];
?>
<script>
window.onload = function() {
   var headerLinks = document.getElementsByTagName("nav")[0].childNodes;
   // console.log(headerLinks);
   for(var i = 1; i < headerLinks.length; i+=2) {
      var urlArray = headerLinks[i].href.split("/");
      var self = urlArray[urlArray.length - 1];
      // console.log(self);
      if(self == <?php echo json_encode($self); ?>)
         headerLinks[i].className = "active";
   }
}
</script>