import './slider.css';

import $ from 'jquery';

export default class Slider {
    constructor(object) {
        // Slider objects
        this.master = $(object);
        this.viewport = $(object.children()[0]);
        this.wrapper = $(this.viewport.children()[0]);
        this.prev_btn = $(this.viewport.children()[1]);
        this.next_btn = $(this.viewport.children()[2]);
        this.nav_btns = $(this.viewport.children()[3]).children();

        // Slider info
        this.currentSlide = 1;
        this.slideAmount = this.wrapper.children().length;
        this.sliderInterval = 2000;
        this.navBtnId = 0;
    }

    initialize() {
        this._startSlider();
        this._registerButtonEvents();
        this._registerNavButtonsEvents();
    }

    _startSlider() {
        this.switchInterval = setInterval(this._nextSlide.bind(this), this.sliderInterval);
        const onHoverUp = (function() {
            clearInterval(this.switchInterval);
        }).bind(this);
        const onHover = (function() {
            this.switchInterval = setInterval(this._nextSlide.bind(this), this.sliderInterval);
        }).bind(this);
        this.viewport.hover(onHoverUp, onHover);
    }

    _registerButtonEvents() {
        this.next_btn.click(this._nextSlide.bind(this));
        this.prev_btn.click(this._prevSlide.bind(this));
    }

    _registerNavButtonsEvents() {
        // Save the slider as 'that', because we need 'this' for the event button id
        const that = this;
        const onClick = function() {
            let translateWidth;
            that.navBtnId = $(this).index();
            if (that.navBtnId + 1 != that.currentSlide) {
                translateWidth = -that.viewport.width() * (that.navBtnId);
                that.wrapper.css({
                    'transform': 'translate(' + translateWidth + 'px, 0)',
                    '-webkit-transform': 'translate(' + translateWidth + 'px, 0)',
                    '-ms-transform': 'translate(' + translateWidth + 'px, 0)',
                });
                that.currentSlide = that.navBtnId + 1;
            }
        }
        this.nav_btns.click(onClick);
    }

    _nextSlide() {
        let translateWidth;
        if (this.currentSlide == this.slideAmount || this.currentSlide <= 0 || this.currentSlide > this.slideAmount) {
            this.wrapper.css('transform', 'translate(0, 0)');
            this.currentSlide = 1;
        } else {
            translateWidth = -this.viewport.width() * (this.currentSlide);
            this.wrapper.css({
                'transform': 'translate(' + translateWidth + 'px, 0)',
                '-webkit-transform': 'translate(' + translateWidth + 'px, 0)',
                '-ms-transform': 'translate(' + translateWidth + 'px, 0)',
            });
            this.currentSlide++;
        }
    }

    _prevSlide() {
        let translateWidth;
        if (this.currentSlide == 1 || this.currentSlide <= 0 || this.currentSlide > this.slideAmount) {
            translateWidth = -this.viewport.width() * (this.slideAmount - 1);
            this.wrapper.css({
                'transform': 'translate(' + translateWidth + 'px, 0)',
                '-webkit-transform': 'translate(' + translateWidth + 'px, 0)',
                '-ms-transform': 'translate(' + translateWidth + 'px, 0)',
            });
            this.currentSlide = this.slideAmount;
        } else {
            translateWidth = -this.viewport.width() * (this.currentSlide - 2);
            this.wrapper.css({
                'transform': 'translate(' + translateWidth + 'px, 0)',
                '-webkit-transform': 'translate(' + translateWidth + 'px, 0)',
                '-ms-transform': 'translate(' + translateWidth + 'px, 0)',
            });
            this.currentSlide--;
        }
    }
}
