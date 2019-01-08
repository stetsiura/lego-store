var imageSlider;

var Slider = function (sliderId) {
    var sliderNode = $('#' + sliderId);

    this.elements = {
        slider: sliderNode,
        sliderBox: sliderNode.find('.slider-box'),
        slides: sliderNode.find('.slide'),
        controlLeft: sliderNode.find('.slide-control.prev'),
        controlRight: sliderNode.find('.slide-control.next')
    };

    // Initial settings
    this.settings = {
        currentSlide: 0,
        totalSlidesCount: 1
    };

    this.onResize();

    var self = this;

    this.elements.controlLeft.click(function () {
        self.navigate(-1);
    });

    this.elements.controlRight.click(function () {
        self.navigate(1);
    });
};

Slider.prototype.onResize = function () {
    this.settings.totalSlidesCount = this.elements.slides.length;
    this.settings.slideWidth = this.elements.slider.width();

    this.elements.slides.css('width', this.settings.slideWidth + 'px');
    this.elements.sliderBox.css('width', this.settings.slideWidth * this.settings.totalSlidesCount + 'px');

    this.animate();
};

Slider.prototype.navigate = function (direction) {
    if (direction > 0) {
        this.settings.currentSlide = (this.settings.currentSlide + 1) % this.settings.totalSlidesCount;
    } else {
        if (this.settings.currentSlide === 0) {
            this.settings.currentSlide = this.settings.totalSlidesCount - 1;
        } else {
            this.settings.currentSlide -= 1;
        }
    }

    this.animate();
};

Slider.prototype.animate = function () {
    var left = this.settings.currentSlide * this.settings.slideWidth;
    this.elements.sliderBox.css('left', -1 * left + 'px');
};

$(window).resize(function () {
    imageSlider.onResize();
});