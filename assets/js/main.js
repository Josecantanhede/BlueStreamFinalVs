

$.when($.ready).then(() => {
    startScroller();
    startClientsCarousel();
});

let startScroller = () => {
    $('.navbar a').click(function (event) {
        event.preventDefault();
        $([document.documentElement, document.body]).animate({
            scrollTop: $($(this).attr('href')).offset().top - NAVBAR_HEIGHT,
            easing: 'linear'
        }, 800);
    });

    $(CONTACT_NOW_BUTTON_ID).click(function (event) {
        event.preventDefault();
        $([document.documentElement, document.body]).animate({
            scrollTop: $($(this).attr('href')).offset().top - NAVBAR_HEIGHT,
            easing: 'linear'
        }, 300);
    });
};

let startClientsCarousel = () => {
    $(".owl-carousel").owlCarousel({
        center: true,
        items: 6,
        margin: 35,
        autoplay: true,
        loop: true,
        autoplayTimeout: 6000,
        fluidSpeed: 6000,
        autoplayHoverPause: true
    });
};


/**
 * Constants and Variables
 */
// Navbar

const TOP_NAVBAR_ID = '#top-navbar';
const NAVBAR_HEIGHT = 120;
const CONTACT_NOW_BUTTON_ID = '#contactNowButton';

// Teammates Picker
const TEAMMATES_PICKER_ID = '#teammates-picker';
const TEAMMATES_LIST_ID = '#teammates-list';
const TEAMMATE_ITEM_CLASS = '.teammate-item';

// Teammates Displayer
const TEAMMATES_DISPLAYER_ID = '#teammates-displayer';

// Contact Form

const CONTACT_FORM_ID = '#contact-form';
const CONTACT_SUBMIT_BUTTON_ID = '#contactSubmitButton';
const CONTACT_SENDING_LOADER_ID = '#contactSendingLoader';

let teammatesListEl = null;
let teammatesDisplayerEl = null;
let teammatesItems = [];
let teammates = [];
let activeTeammate = null;

let contactFormValidation = null;
