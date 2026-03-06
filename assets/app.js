/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
import './styles/app.scss';

import $ from 'jquery';
global.$ = global.jQuery = $;
window.jQuery = $;


import { Tooltip, Toast, Popover } from 'bootstrap';
// create global $ and jQuery variables


// start the Stimulus application
import './bootstrap';

import Vue from 'vue';
import PasswordCheckComponent from './components/PasswordCheckComponent.vue';
//import DeleteMessage from './components/DeleteMessage.vue';



if(document.querySelector('#password-check')){
    new Vue({
        el: '#password-check',
        components: {
          PasswordCheckComponent
        }
      });
}
/*

// Enregistrement global du composant (s'il doit être disponible pour toutes les instances)
Vue.component('delete-message', DeleteMessage);
if(document.querySelector('#app')){
    new Vue({
        el: '#app',
        data: {
            messages: window.messages || [],
            messagesUnknow: window.messagesUnknow || []
        },
        components: {
            'delete-message': DeleteMessage
        },
        methods: {
            handleMessageDeleted(messageId) {
                // Supprimez le message de l'affichage ou rechargez la page
            }
        },
    });
}
*/



import 'slick-carousel/slick/slick.css';
import 'slick-carousel/slick/slick-theme.css';
import 'slick-carousel/slick/slick.js';


$(function () {
  $('.carousel-formation .slick-slider').slick({
    mobileFirst: true,
    slidesToShow: 1.05,
    slidesToScroll: 1,
    infinite: true,
    dots: true,     // ✅ ON
    arrows: false,  // ✅ OFF en mobile
    adaptiveHeight: true,

    responsive: [
      { breakpoint: 576, settings: { slidesToShow: 2, dots: true, arrows: true } },
      { breakpoint: 992, settings: { slidesToShow: 3, dots: true, arrows: true } },
      { breakpoint: 1200, settings: { slidesToShow: 4, dots: true, arrows: true } },
    ]
  });
});

//cookies
document.addEventListener('DOMContentLoaded', () => {
  const banner = document.getElementById('cookie-banner');
  const acceptBtn = document.getElementById('cookie-accept-all');
  const rejectBtn = document.getElementById('cookie-reject-all');
  const customizeBtn = document.getElementById('cookie-customize');

  if (!banner) return;

  const setConsentCookie = (value) => {
    document.cookie = `cookie_consent=${value}; path=/; max-age=${60 * 60 * 24 * 180}; SameSite=Lax`;
  };

  acceptBtn?.addEventListener('click', () => {
    setConsentCookie('accepted');
    banner.remove();
    window.location.reload();
  });

  rejectBtn?.addEventListener('click', () => {
    setConsentCookie('rejected');
    banner.remove();
    window.location.reload();
  });

  customizeBtn?.addEventListener('click', () => {
    alert('La personnalisation des cookies sera bientôt disponible.');
  });
});