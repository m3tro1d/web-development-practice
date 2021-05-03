import './about_me.css';

import $ from 'jquery';
import Slider from '../components/slider/slider';

$(document).ready(() => {
  // Iterate through all the .slider blocks and make them dynamic
  $('.slider').each((i, obj) => {
    const slider = new Slider($(obj));
    slider.initialize();
  })

  // Add update button handler
  $('#update-btn').click(() => {
    $.ajax({
      url: '/update',
      method: 'POST',
    })
      .done(res => {
        console.log(res);
      });
  });
});
