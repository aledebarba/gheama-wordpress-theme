// Header Stack
if(document.getElementById("widget-slide-header")) {
    if (document.getElementById("widget-slide-header").classList.contains("stack")) {
      var header = document.getElementById("header");
      header.classList.add("header-stack");
    }
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

// Register GSAP ScroolTrigger Plugin
gsap.registerPlugin(ScrollTrigger);
smoothScroll("main");
console.log('done')

//scrollTrigger scroll Helper
// this is the helper function that sets it all up. Pass in the content <div>
// and then the wrapping viewport <div> (can be the elements or selector text).
// It also sets the default "scroller" to the content so you don't have to do that on all your ScrollTriggers.

function smoothScroll(content, viewport, smoothness) {
	content = gsap.utils.toArray(content)[0];
	smoothness = smoothness || 1;

	gsap.set(viewport || content.parentNode, {overflow: "hidden", position: "fixed", height: "100%", width: "100%", top: 0, left: 0, right: 0, bottom: 0});
	gsap.set(content, {overflow: "visible", width: "100%"});

	let getProp = gsap.getProperty(content),
		setProp = gsap.quickSetter(content, "y", "px"),
		setScroll = ScrollTrigger.getScrollFunc(window),
		removeScroll = () => content.style.overflow = "visible",
		killScrub = trigger => {
			let scrub = trigger.getTween ? trigger.getTween() : gsap.getTweensOf(trigger.animation)[0]; // getTween() was added in 3.6.2
			scrub && scrub.kill();
			trigger.animation.progress(trigger.progress);
		},
		height, isProxyScrolling;

	function onResize() {
		height = content.clientHeight;
		content.style.overflow = "visible"
		document.body.style.height = height + "px";
	}

	onResize();
	ScrollTrigger.addEventListener("refreshInit", onResize);
	ScrollTrigger.addEventListener("refresh", () => {
		removeScroll();
		requestAnimationFrame(removeScroll);
	})

	ScrollTrigger.defaults({scroller: content});
	ScrollTrigger.prototype.update = p => p; // works around an issue in ScrollTrigger 3.6.1 and earlier (fixed in 3.6.2, so this line could be deleted if you're using 3.6.2 or later)

	ScrollTrigger.scrollerProxy(content, {
		scrollTop(value) {
			if (arguments.length) {
				isProxyScrolling = true; // otherwise, if snapping was applied (or anything that attempted to SET the scroll proxy's scroll position), we'd set the scroll here which would then (on the next tick) update the content tween/ScrollTrigger which would try to smoothly animate to that new value, thus the scrub tween would impede the progress. So we use this flag to respond accordingly in the ScrollTrigger's onUpdate and effectively force the scrub to its end immediately.
				setProp(-value);
				setScroll(value);
				return;
			}
			return -getProp("y");
		},
		getBoundingClientRect() {
			return {top: 0, left: 0, width: window.innerWidth, height: window.innerHeight};
		}
	});

	return ScrollTrigger.create({
		animation: gsap.fromTo(content, {y:0}, {
			y: () => document.documentElement.clientHeight - height,
			ease: "none",
			onUpdate: ScrollTrigger.update
		}),
		scroller: window,
		invalidateOnRefresh: true,
		start: 0,
		end: () => height - document.documentElement.clientHeight,
		scrub: smoothness,
		onUpdate: self => {
			if (isProxyScrolling) {
				killScrub(self);
				isProxyScrolling = false;
			}
		},
		onRefresh: killScrub // when the screen resizes, we just want the animation to immediately go to the appropriate spot rather than animating there, so basically kill the scrub.
	});
}