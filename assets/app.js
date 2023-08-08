/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
import './styles/app.scss';

import $ from 'jquery';
import { Tooltip, Toast, Popover } from 'bootstrap';

window.jQuery = $;

// start the Stimulus application
import './bootstrap';

//Slick carousel
import Vue from 'vue';

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

