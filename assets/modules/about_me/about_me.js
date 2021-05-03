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
  const updateInfo = $('#update-info');
  $('#update-btn').click(() => {
    $.ajax({
      url: '/update',
      method: 'POST',
    })
      .done(res => {
        updateInfo.text('Success! Refresh the page to see the new images.');
      })
      .fail((jqXHR, textStatus) => {
        updateInfo.text('Oops... Something went wrong.');
      });
  });
});
