   // menu code

   if( 'ontouchstart' in window )
   { var click = 'touchstart'; }
   else { var click = 'click'; }
 
 
   $('div.burger').on(click, function(){
 
       if( !$(this).hasClass('open') ){ 
         openMenu();
          } 
       else {
        closeMenu(); 
      }
 
   });
   
 
   $('div.menu ul li a').on(click, function(e){
     // e.preventDefault();
 
     let href = $(this).attr("href")
     console.log("href => " , href)
     
     // closeMenu();
   });
 
   function openMenu(){
     // Edit function
 
     
 
 
 
     $('div.circle').addClass('expand');
           
     $('div.burger').addClass('open'); 
     $('div.x, div.y, div.z').addClass('collapse2');
     $('.menu li').addClass('animate');
     $('div.circle').closest(".screen").addClass("z-index");
     setTimeout(function(){ 
       
 
       $('div.y').hide(); 
       $('div.x').addClass('rotate30'); 
       $('div.z').addClass('rotate150'); 
     }, 70);
     setTimeout(function(){
       $('div.x').addClass('rotate45'); 
       $('div.z').addClass('rotate135');  
       
     }, 120);
     
     
 
   }
   
   function closeMenu(){
 
     
     $('div.burger').removeClass('open');  
     $('div.x').removeClass('rotate45').addClass('rotate30'); 
     $('div.z').removeClass('rotate135').addClass('rotate150');        
     $('div.circle').removeClass('expand');
     $('.menu li').removeClass('animate');
     $('div.circle').closest(".screen").removeClass("z-index");
     setTimeout(function(){      
       
       $('div.x').removeClass('rotate30'); 
       $('div.z').removeClass('rotate150');      
     }, 50);
     setTimeout(function(){
       $('div.y').show(); 
       $('div.x, div.y, div.z').removeClass('collapse2');
       
     }, 70);                         
     
   }


 /************************* */
 $(function () {
  $("#datepicker").datepicker();
});

/********************************* */

// $('select').niceSelect();
 $("#us3").locationpicker({
location: {
  latitude: "24.774265",
  longitude: "46.738586",
},
radius: 300,
zoom: 7,
inputBinding: {
  latitudeInput: $("#us3-lat"),
  longitudeInput: $("#us3-lon"),
  radiusInput: $("#us3-radius"),
  locationNameInput: $("#us3-address,#address"),
},
enableAutocomplete: true,
});

 
     
 
 
 