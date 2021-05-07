import './about_me.css';

import $ from 'jquery';

import Slider from '../components/slider';
import handleKeywordUpdate from './components/keyword-update-btns';
import handleHobbiesUpdate from './components/hobbies-update-btn';

$(document).ready(() => {
  // Iterate through all the .slider blocks and make them dynamic
  $('.slider').each((i, obj) => {
    const slider = new Slider($(obj));
    slider.initialize();
  })

  // Add update button handlers
  handleHobbiesUpdate($('#update-btn'));
  $('.hobbies__update-keyword-btn').each((i, btn) => {
    handleKeywordUpdate(btn);
  });
});
