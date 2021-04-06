import './about_me.css';

import $ from 'jquery';
import Slider from '../components/slider/slider';

// Iterate through all the .slider blocks and make them dynamic
$(document).ready(function() {
    $('.slider').each(function(i, obj) {
        let slider = new Slider($(obj));
        slider.initialize();
    })
});
