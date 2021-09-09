// Header Stack
if(document.getElementById("widget-slide-header").classList.contains("stack")) {
    var header = document.getElementById("header");
    header.classList.add("header-stack");
}

// Handles loading the events for <model-viewer>'s slotted progress bar
const onProgress = (event) => {
    const progressBar = event.target.querySelector('.progress-bar');
    const updatingBar = event.target.querySelector('.update-bar');
    updatingBar.style.width = `${event.detail.totalProgress * 100}%`;
    if (event.detail.totalProgress === 1) {
      progressBar.classList.add('hide');
    } else {
      progressBar.classList.remove('hide');
      if (event.detail.totalProgress === 0) {
        event.target.querySelector('.center-pre-prompt').classList.add('hide');
      }
    }
  };
  document.querySelector('model-viewer').addEventListener('progress', onProgress);

  
// Flickity
var elem = document.querySelector('#hold-list.carousel');
var flkty = new Flickity(elem, {
    wrapAround: true,
    //cellAlign: 'left',
    draggable: true,

    prevNextButtons: true,
    pageDots: false,

    //autoPlay: 7000,
    //pauseAutoPlayOnHover: true,
    
    cellSelector: '.card',
    
    freeScroll: true,
	freeScrollFriction: 0.03,

    arrowShape:  'M30.6,77.8l1.6-1.6c1-1,1-2.7,0-3.8L13.4,53.8h83.9c1.5,0,2.7-1.2,2.7-2.7v-2.2c0-1.5-1.2-2.7-2.7-2.7H13.4l18.7-18.6c1-1,1-2.7,0-3.8l-1.6-1.6c-1-1-2.7-1-3.8,0l-26,25.9c-1,1-1,2.7,0,3.8l26,25.9C27.8,78.8,29.5,78.8,30.6,77.8z'
});

// Accordion
var acc = document.getElementsByClassName("title-accordion");
//var acc = document.querySelector('.item-accordion .title');
var i;

for (i = 0; i < acc.length; i++) {
    acc[i].addEventListener("click", function() {
        this.classList.toggle("active");
        var panel = this.nextElementSibling;
        
        if (panel.style.maxHeight) {
            panel.style.maxHeight = null;
        } else {
            panel.style.maxHeight = panel.scrollHeight + "px";
        }
    });
}

// Parallax
var rellax = new Rellax('.rellax', {
    //breakpoints: [300, 765, 1024]
});