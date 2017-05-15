<?php 
$urlStrings = explode("/", $_SERVER['PHP_SELF']);
$self = $urlStrings[count($urlStrings) - 1];
?>
<script>
window.onload = function() {
   var headerLinks = document.getElementsByTagName("nav")[0].childNodes;
   for(var i = 1; i < headerLinks.length; i+=2) {
      var urlArray = headerLinks[i].href.split("/");
      var self = urlArray[urlArray.length - 1];
      if(self == <?php echo json_encode($self); ?>)
         headerLinks[i].className = "active";
   }
}
</script>