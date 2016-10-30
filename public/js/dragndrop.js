  // target elements with the "draggable" class
  interact('.draggable')
    .draggable({
      // enable inertial throwing
      inertia: true,
      // keep the element within the area of it's parent
      restrict: {
        restriction: "parent",
        endOnly: true,
        elementRect: { top: 0, left: 0, bottom: 1, right: 1 }
      },
      // enable autoScroll
      autoScroll: true,

      // call this function on every dragmove event
      onmove: dragMoveListener,
      // call this function on every dragend event
      onend: function (event) {
        var textEl = event.target.querySelector('p');

/*        textEl && (textEl.textContent =
          'moved a distance of '
          + (Math.sqrt(event.dx * event.dx +
                       event.dy * event.dy)|0) + 'px');*/

        textEl && (textEl.textContent =
              'x:' + Math.round(event.target.getAttribute('data-x')) +
              'y : ' + Math.round(event.target.getAttribute('data-y')));
        ;}
      })
    //double clic sur le hotspot
/*      .on('doubletap', function (event) {
        alert('Ajouter !');
      });*/

    function dragMoveListener (event) {
      var target = event.target,
          // keep the dragged position in the data-x/data-y attributes
          x = (parseFloat(target.getAttribute('data-x')) || 0) + event.dx,
          y = (parseFloat(target.getAttribute('data-y')) || 0) + event.dy;

      // translate the element
      target.style.webkitTransform =
      target.style.transform =
        'translate(' + x + 'px, ' + y + 'px)';

      // update the posiion attributes
      target.setAttribute('data-x', x);
      target.setAttribute('data-y', y);
      console.log(target.getAttribute('data-x'));
      console.log(target.getAttribute('data-y'));
    }

/*    // this is used later in the resizing and gesture demos
    window.dragMoveListener = dragMoveListener;*/

//===========================double tap==================================//

/*interact('.tap-target')
  .on('tap', function (event) {
    event.currentTarget.classList.toggle('switch-bg');
    event.preventDefault();
  })
  .on('doubletap', function (event) {
    event.currentTarget.classList.toggle('large');
    event.currentTarget.classList.remove('rotate');
    event.preventDefault();
  })
  .on('hold', function (event) {
    event.currentTarget.classList.toggle('rotate');
    event.currentTarget.classList.remove('large');
  });
*/

/*jQuery(document).ready(function($) {

      $('#myCarousel').carousel({
              interval: 5000
      });

      $('#carousel-text').html($('#slide-content-0').html());

      //Handles the carousel thumbnails
      $('[id^=carousel-selector-]').click( function(){
              var id_selector = $(this).attr("id");
              var id = id_selector.substr(id_selector.length -1);
              var id = parseInt(id);
              $('#myCarousel').carousel(id);
      });


      // When the carousel slides, auto update the text
      $('#myCarousel').on('slid', function (e) {
              var id = $('.item.active').data('slide-number');
              $('#carousel-text').html($('#slide-content-'+id).html());
      });
});
*/