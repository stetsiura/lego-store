(function () {

    var productSliders = [];


    var ProductSlider = function (sliderWrapper) {

        console.log(sliderWrapper);

        this.elements = {
            sliderBox: sliderWrapper.find('.slider-box'),
            slides: sliderWrapper.find('.slider-item'),
            controlLeft: sliderWrapper.find('.slider-nav.left'),
            controlRight: sliderWrapper.find('.slider-nav.right'),
            sliderWrapper: sliderWrapper
        };

        this.settings = {
            slideWidth: 200,
            slidesCount: this.elements.slides.length,
            sliderBoxPosition: 0
        };

        var self = this;

        this.elements.controlLeft.click(function () {
            self.navigate(-1);
        });

        this.elements.controlRight.click(function () {
            self.navigate(1);
        });

        this.onResize();

    };

    ProductSlider.prototype.onResize = function () {
        this.settings.sliderWrapperWidth = this.elements.sliderWrapper.width();
        this.settings.sliderBoxWidth = this.settings.slideWidth * this.settings.slidesCount;
        this.settings.step = this.settings.sliderWrapperWidth - this.settings.slideWidth;

        this.reset();
    };

    ProductSlider.prototype.reset = function () {
        this.settings.sliderBoxPosition = 0;
        this.processLeftControl();
        this.processRightControl();

        this.animate(this.settings.sliderBoxPosition);
    };

    ProductSlider.prototype.animate = function (left) {
        this.elements.sliderBox.css('left', -1 * left + 'px');
    };

    ProductSlider.prototype.navigate = function (direction) {
        if (direction > 0) {
            var availableOffset = this.settings.sliderBoxWidth - (this.settings.sliderBoxPosition + this.settings.sliderWrapperWidth);
            if (availableOffset > this.settings.step) {
                this.settings.sliderBoxPosition += this.settings.step;
            } else {
                this.settings.sliderBoxPosition = this.settings.sliderBoxWidth - this.settings.sliderWrapperWidth;
            }
        } else {
            var availableOffset = this.settings.sliderBoxPosition;
            if (availableOffset > this.settings.step) {
                this.settings.sliderBoxPosition -= this.settings.step;
            } else {
                this.settings.sliderBoxPosition = 0;
            }
        }

        this.processLeftControl();
        this.processRightControl();
        this.animate(this.settings.sliderBoxPosition);
    };

    ProductSlider.prototype.processLeftControl = function () {
        var showControl = this.settings.sliderBoxPosition > 0;

        if (showControl) {
            this.elements.sliderWrapper.removeClass('slider-start');
        } else {
            this.elements.sliderWrapper.addClass('slider-start');
        }
    };

    ProductSlider.prototype.processRightControl = function () {
        var showControl = this.settings.sliderBoxPosition <
                          this.settings.sliderBoxWidth - this.settings.sliderWrapperWidth;

        if (showControl) {
            this.elements.sliderWrapper.removeClass('slider-end');
        } else {
            this.elements.sliderWrapper.addClass('slider-end');
        }
    };

    $(document).ready(function () {

        var productSliderWrappers = $('.product-slider');

        productSliderWrappers.each(function (i, sliderWrapper) {
            var productSlider = new ProductSlider($(sliderWrapper));
            productSliders.push(productSlider);
        });

    });

    $(window).resize(function () {

        for (var i = 0, length = productSliders.length; i < length; i++) {
            productSliders[i].onResize();
        }

    });

})();