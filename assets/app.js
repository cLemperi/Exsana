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


$(function() {
    $('.slick-slider').slick({
        slidesToShow: 4,
        slidesToScroll: 4,
        prevArrow: '<button type="button" class="slick-prev">&lt;</button>',
        nextArrow: '<button type="button" class="slick-next">&gt;</button>',
        dots: true,
        centerMode:true,
        cssEase:'ease-in',
        appendArrows: $('.slick-slider'),
        responsive: [
            {
                breakpoint: 1024, // breakpoint pour tablette
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 2
                }
            },
            {
                breakpoint: 768, // breakpoint pour téléphone
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
                }
            }
        ]
    });
});

