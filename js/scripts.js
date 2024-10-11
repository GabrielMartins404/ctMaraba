$( document ).ready(function() {

  // Parallax

  // setTimeout serve para carregar primeiro as imagens
  setTimeout(function() {
    $('#data-area').parallax({imageSrc: 'img/cidadeparallax.png'});
    $('#apply-area').parallax({imageSrc: 'img/pattern.png'});
  }, 200);

  // Filtro portfólio

  $(".filter-btn").on('click', function() {
    let type = $(this).attr('id')
    let boxes = $('.project-box')

    $(".main-btn").removeClass('active') // Remove a classe de ativo do botão que a tenha
    $(this).addClass('active') // Adicionano a class no botão que foi clicado

    if(type == 'all-btn'){
      eachBox('all', boxes)
    }
    if(type == 'even-btn'){
      eachBox('even', boxes)
    }
    if(type == 'noti-btn'){
      eachBox('noti', boxes)
    }
    if(type == 'nova-btn'){
      eachBox('nova', boxes)
    }

  })

  function eachBox(type, boxes){
    if(type == 'all'){
      $(boxes).fadeIn()
    }else{
      $(boxes).each(function(){ //Faz uma passagem por cada box passado semelhante a um loop
        if(!$(this).hasClass(type)){
          $(this).fadeOut('slow')
        }else{
          $(this).fadeIn()
        }
      })
    }
  }
  // scroll para as seções

  let navBtn = $('.nav-item');

  let bannerSection = $('#mainSlider');
  let aboutSection = $('#about-area');
  let servicesSection = $('#services-area');
  let teamSection = $('#team-area');
  let portfolioSection = $('#portfolio-area');
  let contactSection = $('#contact-area');

  let scrollTo = '';

  $(navBtn).click(function() {

    let btnId = $(this).attr('id');

    if(btnId == 'conselho-menu') {
      scrollTo = aboutSection;
    } else if(btnId == 'servicos-menu') {
      scrollTo = servicesSection;
    } else if(btnId == 'conselheiros-menu') {
      scrollTo = teamSection;
    } else if(btnId == 'contatos-menu') {
      scrollTo = portfolioSection;
    } else if(btnId == 'contact-menu') {
      scrollTo = contactSection;
    } else {
      scrollTo = bannerSection;
    }

    $([document.documentElement, document.body]).animate({
        scrollTop: $(scrollTo).offset().top - 70
    }, 1500);
  });

});

window.addEventListener('resize', function(){

  //770px]
  
  var windowWidth = window.innerWidth;
	console.log(windowWidth)
});