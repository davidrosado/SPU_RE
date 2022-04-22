var $ = jQuery.noConflict();

function filtrar() {
  // Obtener el ID del boton clickeado
  let claseboton = event.target.id
  let botones = document.getElementsByClassName('boton-filtro-block-1');
  for (let d = 0; d < botones.length; d++) {
    botones[d].classList.remove("filtrado")
  }

  // Ocultar todos los eventos
  let elements = document.getElementsByClassName('item-evento-block-1');
  for (let i = 0; i < elements.length; i++) {
      elements[i].classList.add("hidden")
  }

  // Mostrar todos los eventos de la clase del boton clickeado
  document.getElementById(claseboton).classList.add("filtrado")
  let elementsclass = document.getElementsByClassName(claseboton);    
  for (let c = 0; c < elementsclass.length; c++) {
    elementsclass[c].classList.remove("hidden")
    elementsclass[c].classList.add("show")
  }
}

function showall() {
  let botones = document.getElementsByClassName('boton-filtro-block-1');
  for (let d = 0; d < botones.length; d++) {
    botones[d].classList.remove("filtrado")
  }  

  let claseboton = event.target.id
  document.getElementById(claseboton).classList.add("filtrado")  

  botonvermas = document.getElementById("ver-mas-eventos")
  if (botonvermas) {
    botonvermas.classList.add('hidden')
  }
  
  let elements = document.getElementsByClassName('item-evento-block-1');
  for (let i = 0; i < elements.length; i++) {
      elements[i].classList.remove("hidden")
      elements[i].classList.add("show")
  }
}

function verMasEvento() {
  botonvermas = document.getElementById("ver-mas-eventos")
  if (botonvermas) {
    botonvermas.classList.add('hidden')
  }

  let elements = document.getElementsByClassName("item-evento-block-1")
  for (let i = 0; i < elements.length; i++) {
      elements[i].classList.remove("hidden")
      elements[i].classList.add("show")
  }    

}   

function filtrar_2() {
  // Obtener el ID del boton clickeado
  let claseboton = event.target.id
  let botones = document.getElementsByClassName('boton-filtro-block-2');
  for (let d = 0; d < botones.length; d++) {
    botones[d].classList.remove("filtrado")
  }

  // Ocultar todos los eventos
  let elements = document.getElementsByClassName('item-evento-block-2');
  for (let i = 0; i < elements.length; i++) {
    elements[i].classList.add("hidden")
  }

  // Mostrar todos los eventos de la clase del boton clickeado
  document.getElementById(claseboton).classList.add("filtrado")
  let elementsclass = document.getElementsByClassName(claseboton);
  for (let c = 0; c < elementsclass.length; c++) {
    elementsclass[c].classList.remove("hidden")
    elementsclass[c].classList.add("show")
  }
}

function showall_2() {
  let botones = document.getElementsByClassName('boton-filtro-block-2');
  for (let d = 0; d < botones.length; d++) {
    botones[d].classList.remove("filtrado")
  }

  let claseboton = event.target.id
  document.getElementById(claseboton).classList.add("filtrado")

  botonvermas = document.getElementById("ver-mas-eventos-block-2")
  if (botonvermas) {
    botonvermas.classList.add('hidden')
  }
  
  let elements = document.getElementsByClassName("item-evento-block-2")
  for (let i = 0; i < elements.length; i++) {
    elements[i].classList.remove("hidden")
    elements[i].classList.add("show")
  }
}

function verMasEvento_2() {
  botonvermas = document.getElementById("ver-mas-eventos-block-2")
  if (botonvermas) {
    botonvermas.classList.add('hidden')
  }

  let elements = document.getElementsByClassName("item-evento-block-2")
  for (let i = 0; i < elements.length; i++) {
    elements[i].classList.remove("hidden")
    elements[i].classList.add("show")
  }

}  


$('#slider-ponentes').slick({
  dots:true,
  slidesToShow: 1,
  slidesToScroll: 1,
  infinite: true,
  autoplay: true,
  autoplaySpeed: 2500,
  arrows: true,
  fade: true,
  responsive: [
      {
          breakpoint: 991,
          settings: { 
            arrows: false,                    
          }
      },          
  ] 
});

$('.slider-relacionados').slick({
  dots:false,
  slidesToShow: 4,
  slidesToScroll: 4,
  infinite: true,
  autoplay: false,
  autoplaySpeed: 5000,
  arrows: false,
  dots: true, 
  responsive: [
      {
          breakpoint: 1360,
          settings: {                           
            slidesToShow: 3,
            slidesToScroll: 3                  
          }
      },
      {
          breakpoint: 960,
          settings: {                           
            slidesToShow: 2,
            slidesToScroll: 2                   
          }
      },        
      {
          breakpoint: 468,
          settings: {                                         
            slidesToShow: 1,
            slidesToScroll: 1                   
          }
      }            
  ]   
});

$('.slider-filtros').slick({
  dots:false,
  slidesToShow: 4,
  slidesToScroll: 1,
  infinite: false,
  autoplay: false,
  autoplaySpeed: 5000,
  arrows: true,
  dots: false, 
  responsive: [
      {
          breakpoint: 1360,
          settings: {                           
            slidesToShow: 3,
            slidesToScroll: 1                   
          }
      },
      {
          breakpoint: 960,
          settings: {                           
            slidesToShow: 2,
            slidesToScroll: 1                   
          }
      },        
      {
          breakpoint: 468,
          settings: {                                         
            slidesToShow: 1,
            slidesToScroll: 1                   
          }
      }            
  ]   
});

/*DESLIZAR AL HREF DEL BOTON*/
$('a.go-to').click(function() {
  if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
    var target = $(this.hash);
    target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
    if (target.length) {
      $('html,body').animate({
        scrollTop: target.offset().top
      }, 150);
      return false;
    }
  }
});   

/*
$(window).scroll(function(){
    if($(window).scrollTop() > 180){
      $('#cabecera-site').addClass('menu-fijo')
    } else {
      $('#cabecera-site').removeClass('menu-fijo')
    }
}) */

  function userNew() {
    document.getElementById('NOMBRES_PROSPECTO').value = ""
    document.getElementById('APATERNO_PROSPECTO').value = ""
    document.getElementById('AMATERNO_PROSPECTO').value = ""
    document.getElementById('DNI_PROSPECTO').value = ""
    document.getElementById('CELULAR_PROSPECTO').value = ""
    document.getElementById('CORREO_PROSPECTO').value = ""
    document.getElementById('user-old').classList.remove('active')
    document.getElementById('user-new').classList.add('active')    

    document.getElementById('content-campo-NOMBRES_PROSPECTO').classList.remove("hidden")
    document.getElementById('content-campo-APATERNO_PROSPECTO').classList.remove("hidden")
    document.getElementById('content-campo-AMATERNO_PROSPECTO').classList.remove("hidden")
    document.getElementById('content-campo-CELULAR_PROSPECTO').classList.remove("hidden")
    document.getElementById('flex-campos').classList.remove("flex-column-reverse")        
  }

  function userOld() {
    document.getElementById('NOMBRES_PROSPECTO').value = localStorage.getItem('NOMBRES_PROSPECTO')
    document.getElementById('APATERNO_PROSPECTO').value = localStorage.getItem('APATERNO_PROSPECTO')
    document.getElementById('AMATERNO_PROSPECTO').value = localStorage.getItem('AMATERNO_PROSPECTO')
    document.getElementById('DNI_PROSPECTO').value = localStorage.getItem('DNI_PROSPECTO')
    document.getElementById('CELULAR_PROSPECTO').value = localStorage.getItem('CELULAR_PROSPECTO')
    document.getElementById('CORREO_PROSPECTO').value = localStorage.getItem('CORREO_PROSPECTO')

    document.getElementById('content-campo-NOMBRES_PROSPECTO').classList.add("hidden")
    document.getElementById('content-campo-APATERNO_PROSPECTO').classList.add("hidden")
    document.getElementById('content-campo-AMATERNO_PROSPECTO').classList.add("hidden")
    document.getElementById('content-campo-CELULAR_PROSPECTO').classList.add("hidden")
    document.getElementById('flex-campos').classList.add("flex-column-reverse")

    document.getElementById('user-old').classList.add('active')
    document.getElementById('user-new').classList.remove('active')
  }
      
  document.addEventListener( 'wpcf7mailsent', function( event ) {
    var inputs = event.detail.inputs;

    // CARGAR DATA ENVIADA DEL FORM A LOCALSTORAGE
    for ( var i = 0; i < inputs.length; i++ ) {
      if ( 'NOMBRES_PROSPECTO' == inputs[i].name ) {
        localStorage.setItem('NOMBRES_PROSPECTO', inputs[i].value)
        //break;
      }
      if ( 'APATERNO_PROSPECTO' == inputs[i].name ) {
        localStorage.setItem('APATERNO_PROSPECTO', inputs[i].value)
      }     
      if ( 'AMATERNO_PROSPECTO' == inputs[i].name ) {
        localStorage.setItem('AMATERNO_PROSPECTO', inputs[i].value)
      }       
      if ( 'DNI_PROSPECTO' == inputs[i].name ) {
        localStorage.setItem('DNI_PROSPECTO', inputs[i].value)
      }  
      if ( 'CELULAR_PROSPECTO' == inputs[i].name ) {
        localStorage.setItem('CELULAR_PROSPECTO', inputs[i].value)
      }  
      if ( 'CORREO_PROSPECTO' == inputs[i].name ) {
        localStorage.setItem('CORREO_PROSPECTO', inputs[i].value)
      }             
      if ( 'SLUG_CATEGORIA' == inputs[i].name ) {
        localStorage.setItem('SLUG_CATEGORIA', inputs[i].value)
      } 
      if ( 'POSTSINGLE' == inputs[i].name ) {
        localStorage.setItem('POSTSINGLE', inputs[i].value)
      }             
    }

    // REDIRECCIONAR A PAGINA DE GRACIAS
    location = urlredirect
    
  }, false );