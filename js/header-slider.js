jQuery( document ).ready( function( $ ) {
  if ($(".header_slider")) {
    // find and loop through each header slider
    $(".header_slider").each(function(index) {
      // find and loop through each child slide
      if ($(this).children(".header_slider-slide")) {

        //store total number of slides & set initial active state to 1
        var totalSlide = $(this).children(".header_slider-slide").length;
        var activeSlide = 1;
        var slides = $(this).children(".header_slider-slide");

        //set zindex in seperate function to be called after delay
        // var e;
        var z;
        function setZ(e) {
          e.css('z-index', z); //set zindex
          e.children('.img-wpr').css('left', '0'); //reset image position
          // console.log(e);
          // console.log(z);
        }

        // function to handle changing active slide
        function changeActiveSlide(isactive, check, transition) {
          console.log("a");
          if (check) {
            console.log("b");
            check.each(function(index) {
              console.log("c");
              if ($(this).data("slide") == isactive) {
                $(this).addClass("active"); //set active class
                z = totalSlide; //set z-index to bring to front
              } else {
                $(this).removeClass("active"); //remove active class
                if ($(this).css('z-index') == totalSlide) {
                  //slide was PREVOUSLY active
                  // Wipe image to left
                  $(this).children('.img-wpr').css('left', '-100%');
                  z = 1; //move to bottom
                } else {
                  z = parseInt($(this).css('z-index')) + 1;; //move up one spot in queue
                }
              }
              setTimeout(setZ($(this)), 500); //call function to reset z-index
            });
          }
        }

        //run slide loop
        function changeSlide() {
          //set new active slide
          if(activeSlide < totalSlide) {
            activeSlide +=1;
          } else {
            activeSlide = 1;
          }
          //change slide
          changeActiveSlide(activeSlide, slides, .5);
        }
        setInterval(changeSlide, 3000);
      }
    });
  }
});
