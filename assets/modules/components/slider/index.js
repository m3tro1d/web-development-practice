import './styles.css';

import $ from 'jquery';

export default class Slider {
  constructor(object) {
    // Slider objects
    this._master = $(object);
    this._viewport = $(object.children()[0]);
    this._wrapper = $(this._viewport.children()[0]);
    this._prev_btn = $(this._viewport.children()[1]);
    this._next_btn = $(this._viewport.children()[2]);
    this._nav_btns = $(this._viewport.children()[3]).children();

    // Slider info
    this._currentSlide = 1;
    this._slideAmount = this._wrapper.children().length;
    this._sliderInterval = 2000;
    this._navBtnId = 0;
  }

  initialize() {
    this._startSlider();
    this._registerButtonEvents();
    this._registerNavButtonsEvents();
  }

  _startSlider() {
    this._switchInterval = setInterval(this._nextSlide.bind(this), this._sliderInterval);
    const onHoverUp = (function() {
      clearInterval(this._switchInterval);
    }).bind(this);
    const onHover = (function() {
      this._switchInterval = setInterval(this._nextSlide.bind(this), this._sliderInterval);
    }).bind(this);
    this._viewport.hover(onHoverUp, onHover);
  }

  _registerButtonEvents() {
    this._next_btn.click(this._nextSlide.bind(this));
    this._prev_btn.click(this._prevSlide.bind(this));
  }

  _registerNavButtonsEvents() {
    // Save the slider as 'that', because we need 'this' for the event button id
    const that = this;
    const onClick = function() {
      let translateWidth;
      that._navBtnId = $(this).index();
      if (that._navBtnId + 1 != that._currentSlide) {
        translateWidth = -that._viewport.width() * (that._navBtnId);
        that._wrapper.css({
          'transform': 'translate(' + translateWidth + 'px, 0)',
          '-webkit-transform': 'translate(' + translateWidth + 'px, 0)',
          '-ms-transform': 'translate(' + translateWidth + 'px, 0)',
        });
        that._currentSlide = that._navBtnId + 1;
      }
    }
    this._nav_btns.click(onClick);
  }

  _nextSlide() {
    let translateWidth;
    if (this._currentSlide == this._slideAmount || this._currentSlide <= 0 || this._currentSlide > this._slideAmount) {
      this._wrapper.css('transform', 'translate(0, 0)');
      this._currentSlide = 1;
    } else {
      translateWidth = -this._viewport.width() * (this._currentSlide);
      this._wrapper.css({
        'transform': 'translate(' + translateWidth + 'px, 0)',
        '-webkit-transform': 'translate(' + translateWidth + 'px, 0)',
        '-ms-transform': 'translate(' + translateWidth + 'px, 0)',
      });
      this._currentSlide++;
    }
  }

  _prevSlide() {
    let translateWidth;
    if (this._currentSlide == 1 || this._currentSlide <= 0 || this._currentSlide > this._slideAmount) {
      translateWidth = -this._viewport.width() * (this._slideAmount - 1);
      this._wrapper.css({
        'transform': 'translate(' + translateWidth + 'px, 0)',
        '-webkit-transform': 'translate(' + translateWidth + 'px, 0)',
        '-ms-transform': 'translate(' + translateWidth + 'px, 0)',
      });
      this._currentSlide = this._slideAmount;
    } else {
      translateWidth = -this._viewport.width() * (this._currentSlide - 2);
      this._wrapper.css({
        'transform': 'translate(' + translateWidth + 'px, 0)',
        '-webkit-transform': 'translate(' + translateWidth + 'px, 0)',
        '-ms-transform': 'translate(' + translateWidth + 'px, 0)',
      });
      this._currentSlide--;
    }
  }
}
