import './slider.css';

import $ from 'jquery';

class Slider {
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

        this.startSlider();
        this.registerButtonEvents();
        this.registerNavButtonsEvents();
    }

    startSlider() {
        this.switchInterval = setInterval(this.nextSlide.bind(this), this.sliderInterval);
        let onHoverUp = (function() {
            clearInterval(this.switchInterval);
        }).bind(this);
        let onHover = (function() {
            this.switchInterval = setInterval(this.nextSlide.bind(this), this.sliderInterval);
        }).bind(this);
        this.viewport.hover(onHoverUp, onHover);
    }

    registerButtonEvents() {
        this.next_btn.click(this.nextSlide.bind(this));
        this.prev_btn.click(this.prevSlide.bind(this));
    }

    registerNavButtonsEvents() {
        let that = this;
        let onClick = function() {
            let translateWidth;
            that.navBtnId = $(this).index();
            if (that.navBtnId != that.slideNow) {
                translateWidth = -that.viewport.width() * that.navBtnId;
                that.wrapper.css({
                    'transform': 'translate(' + translateWidth + 'px, 0)',
                    '-webkit-transform': 'translate(' + translateWidth + 'px, 0)',
                    '-ms-transform': 'translate(' + translateWidth + 'px, 0)',
                });
                that.slideNow = that.navBtnId;
            }
        }
        this.nav_btns.click(onClick);
    }

    nextSlide() {
        let translateWidth;
        if (this.currentSlide <= 0 || this.currentSlide >= this.slideAmount) {
            this.wrapper.css('transform', 'translate(0, 0)');
            this.currentSlide = 1;
        } else {
            translateWidth = -this.viewport.width() * this.currentSlide;
            this.wrapper.css({
                'transform': 'translate(' + translateWidth + 'px, 0)',
                '-webkit-transform': 'translate(' + translateWidth + 'px, 0)',
                '-ms-transform': 'translate(' + translateWidth + 'px, 0)',
            });
            this.currentSlide++;
        }
    }

    prevSlide() {
        let translateWidth;
        if (this.currentSlide <= 1 || this.currentSlide > this.slideAmount) {
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

export default Slider;
