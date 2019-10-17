//function for monitorying Onscroll event for animation//
$(function() {

    var $window           = $(window),
        win_height_padded = $window.height() * 1.1,
        isTouch           = Modernizr.touch;
  
    if (isTouch) { $('.revealOnScroll').addClass('animated'); }
  
    $window.on('scroll', revealOnScroll);
  
    function revealOnScroll() {
      var scrolled = $window.scrollTop(),
          win_height_padded = $window.height() * 1.1;
  
      // Showed...
      $(".revealOnScroll:not(.animated)").each(function () {
        var $this     = $(this),
            offsetTop = $this.offset().top;
  
        if (scrolled + win_height_padded > offsetTop) {
          if ($this.data('timeout')) {
            window.setTimeout(function(){
              $this.addClass('animated ' + $this.data('animation'));
            }, parseInt($this.data('timeout'),10));
          } else {
            $this.addClass('animated ' + $this.data('animation'));
          }
        }
      });
      // Hidden...
     $(".revealOnScroll.animated").each(function (index) {
        var $this     = $(this),
            offsetTop = $this.offset().top;
        if (scrolled + win_height_padded < offsetTop) {
          $(this).removeClass('animated fadeInUp swing bounceIn')
        }
      });
    }
  
    revealOnScroll();
  });

  function slideDown() {
    let emailSlide =  document.getElementById('emailSlide');
    if (emailSlide.style.display='none') {
      emailSlide.style.display = 'block';
    } else {
      emailSlide.style.display = 'none';
    }
  }

  function slideDown1(){
    let ownerKey =  document.getElementById('ownerKey');
    if (ownerKey.style.display='none') {
      ownerKey.style.display = 'block';
    } else {
      ownerKey.style.display = 'none';
    }
  }

   // Add slideDown animation to Bootstrap dropdown when expanding.
   $('.dropdown').on('show.bs.dropdown', function() {
    $(this).find('.dropdown-menu').first().stop(true, true).slideDown();
  });

  // Add slideUp animation to Bootstrap dropdown when collapsing.
  $('.dropdown').on('hide.bs.dropdown', function() {
    $(this).find('.dropdown-menu').first().stop(true, true).slideUp();
  });

  //code snippet hides and shows password change fields in profile->settings
  $(document).ready(function () {
    if ($('#password_change_div').css('display')=='block')
    {
      $('#open').hide();
      $('#close').show(); 
    }
    else
    {
      $('#open').show();
      $('#close').hide();
    }
    
    $("#open").click(function () {
        $("#password_change_div").slideDown();
        $('#open').hide();
        $('#close').show();
    });
    $("#close").click(function () {
      $('#close').hide();
      $('#open').show();
      $('#password_change_div').slideUp();
    });
  });
  //end

  //code snippet shows and hides button loaders
  $('#login_form').submit(function() {
    $('#gif').css('visibility', 'visible');
  });
  //end

//code snippet changes image src on click for active potfolio//
$(document).ready( function () {
  //code for side img
  $('#side').click( function (){
    let side = $('#side').attr('src');
    $('#main').attr('src', side);
    $('#main').addClass('animated fadeIn slower delay-1s');
  });

  //code for front img
  $('#front').click( function (){
    let front = $('#front').attr('src');
    $('#main').attr('src', front);
    $('#main').addClass('animated fadeIn slower delay-1s');
  });
  //code for back img
  $('#back').click( function (){
    let back = $('#back').attr('src');
    $('#main').attr('src', back);
    $('#main').addClass('animated fadeIn slower delay-1s');
  });

});
//end

//code is for unveiling and veiling ticket responses
$(document).ready(function() {
  $('.message').each(function(index) {
      var these = $(this);
      var msg = $(this).html();
      if (msg.length > 250) {
      var new_msg = msg;
      var msg2 = msg.substring(0, 300);
      $(this).html(msg2).append('......');
      $(this).append(" <p class='no-margin text-center x30-font-size drop'> <a href='javascript:void(0);' class='normal-link success-link continue grey'> <i class='fas fa-chevron-circle-down'></i></a> </p>");
      
      //Set Data Attributes for source and truncated
      $(this).data("source", msg);
      $(this).data("truncated", msg2);
      } else {
      $(this).html(msg);
      }
  });

  /**code display remaining ticket response content */
  $(document).on('click', '.continue', function() {
      $(this).closest('.message').html($(this).closest('.message').data("source")).append("<p class='no-margin text-center x30-font-size'> <a class='normal-link delete-link discontinue grey'> <i class='fas fa-chevron-circle-up'></i> </a> </p>");
      $(this).closest('.message').append("<p class='no-margin text-center x30-font-size'> <a class='normal-link delete-link discontinue grey'> <i class='fas fa-chevron-circle-up'></i> </a> </p>");
  });
  /**code truncates ticket response content */
  $(document).on('click', '.discontinue', function() {
      $(this).closest('.message').html($(this).closest('.message').data("truncated")).append('......').append(" <p class='no-margin text-center x30-font-size drop'> <a class='normal-link success-link continue grey'> <i class='fas fa-chevron-circle-down'></i> </a> </p>");

  });
});
//end
$(document).ready(function(){
  $(document).on('click', '.reply-link', function(){
    var modal = $('#myModal');
    modal.modal('show');
  });
});

/**code makes notification link bg remain transparent */
$(document).on('click', '.dropdown-toggle', function(e){
  $(this).css({'background-color':'transparent'});

});
//end

// code snippet hides divs in info page
// for personal hider//
$(document).on('click', '#personal-hider', function(e){
  $(this).toggleClass('fa-chevron-up fa-chevron-down');
  $('#personal-data').slideToggle();
});

// for kin information//
$(document).on('click', '#kin-hider', function(e){
  $(this).toggleClass('fa-chevron-up fa-chevron-down');
  $('#kin-data').slideToggle();
});

// for bank bank hider//
$(document).on('click', '#bank-hider', function(e){
  $(this).toggleClass('fa-chevron-up fa-chevron-down');
  $('#bank-data').slideToggle();
});
// end //

// code snippet to hide about us details
//for who we are//
$(document).on('click', '.who-button', function(e){
  $('#who-button').toggleClass('fa-chevron-up fa-chevron-down light-blue grey');
  $('#who-we-are-div').toggleClass('border-bottom-footer-color');
  $('#who-we-are-paragraph').slideToggle();
});

//for what we do//
$(document).on('click', '.what-button', function(e){
  $('#what-button').toggleClass('fa-chevron-up fa-chevron-down light-blue grey');
  $('#what-we-do-div').toggleClass('border-bottom-footer-color');
  $('#what-we-do-paragraph').slideToggle();
});

//for our essence //
$(document).on('click', '.essence-button', function(e){
  $('#essence-button').toggleClass('fa-chevron-up fa-chevron-down light-blue grey');
  $('#essence-div').toggleClass('border-bottom-footer-color')
  $('#our-essence-paragraph').slideToggle();
});

// for meet our team
$(document).on('click', '.team-button', function(e){
  $('#team-button').toggleClass('fa-chevron-up fa-chevron-down light-blue grey');
  $('#our-team-div').toggleClass('border-bottom-footer-color');
  $('#item-container').slideToggle();
});



