jQuery(document).ready(function() {
  console.log('CUSTOM CHAPTER JS');

  jQuery( "#tabs" ).tabs();

  //Mobile menu stuff
  jQuery("body").on("click", ".mobile-navigation .icon-wrapper", function(){
  	jQuery(this).next().toggle();

  });

});
