var itemsSliders = [];

var ItemsSlider = function (sliderBox) {
    console.log('init');
    this.elements = {

        sliderBox: sliderBox,
        sliderRow: sliderBox.find('.slider-box'),
        slides: sliderBox.find('.slider-item'),

        controlLeft: sliderBox.find('.slider-nav.left'),
        controlRight: sliderBox.find('.slider-nav.right')

    };

    this.settings = {
        sliderBoxWidth: this.elements.sliderBox.width(),
        sliderRowInitialPosition: 0,
        slideMargin: 20,
        visibleSlidesCount: {
            '1300-5000': 4,
            '1250-1300': 4,
            '950-1250': 3,
            '570-950': 2,
            '0-570': 1
        },
        slideWidth: 300,
        currentSlide: 0,
        slidesCount: this.elements.slides.length
    };

    var self = this;

    this.elements.controlLeft.click(function () {
        self.moveBackward();
    });

    this.elements.controlRight.click(function () {
        self.moveFarward();
    });

    this.onResize();
}

ItemsSlider.prototype.onResize = function() {

    this.getContainerWidth();

    this.setSlideWidth();

    this.resetSlider();
    console.log('resize');
};

ItemsSlider.prototype.getContainerWidth = function () {
    this.settings.sliderBoxWidth = this.elements.sliderBox.width();
};

ItemsSlider.prototype.resetSlider = function () {
    this.elements.sliderRow.css('left', this.settings.sliderRowInitialPosition + 'px');

    this.settings.currentSlide = 0;
};

ItemsSlider.prototype.setSlideWidth = function () {
    var currentVisibleSlidesCount = this.getCurrentVisibleSlidesCount(),
        slideWidth = 
            (this.settings.sliderBoxWidth -
            ((currentVisibleSlidesCount - 1) * 2 * this.settings.slideMargin) - this.settings.slideMargin * 2
            ) / currentVisibleSlidesCount;
                console.log(slideWidth);
    this.elements.slides.css('width', slideWidth + 'px');
    this.settings.slideWidth = slideWidth;
};

ItemsSlider.prototype.getCurrentVisibleSlidesCount = function () {
    var windowWidth = $(window).width();

    for (var range in this.settings.visibleSlidesCount) {
        var bounds = range.split('-');
        if (windowWidth > bounds[0] * 1 && windowWidth <= bounds[1] * 1) {
            return this.settings.visibleSlidesCount[range];
        }
    }

    return 3;
};

ItemsSlider.prototype.forwardSlidesCount = function () {
    return this.settings.slidesCount - (this.settings.currentSlide + this.getCurrentVisibleSlidesCount());
};

ItemsSlider.prototype.backwardSlidesCount = function () {
    return this.settings.currentSlide;
}

ItemsSlider.prototype.moveFarward = function () {

    if (this.forwardSlidesCount() > 0) {
        this.settings.currentSlide++;
        this.animate();
    }
}

ItemsSlider.prototype.moveBackward = function () {

    if (this.backwardSlidesCount() > 0) {
        this.settings.currentSlide--;
        this.animate();
    }


}

ItemsSlider.prototype.animate = function () {
    var left = this.settings.sliderRowInitialPosition -
        (
            this.settings.currentSlide * (this.settings.slideWidth + this.settings.slideMargin * 2)
        );

    this.elements.sliderRow.css('left', left + 'px');

    if (this.backwardSlidesCount() > 0) {
        this.elements.controlLeft.addClass('active');
    } else {
        this.elements.controlLeft.removeClass('active');
    }

    if (this.forwardSlidesCount() > 0) {
        this.elements.controlRight.addClass('active');
    } else {
        this.elements.controlRight.removeClass('active');
    }
}

$(document).ready(function () {
    /* courseSlider = new CourseSlider($('#course-slider'));

    courseSlider.elements.controlLeft.click(function () {
        courseSlider.moveBackward();
    });

    courseSlider.elements.controlRight.click(function () {
        courseSlider.moveFarward();
    });

    courseSlider.elements.sliderBox.on('swipeleft', function () {
        courseSlider.moveFarward();
    });

    courseSlider.elements.sliderBox.on('swiperight', function () {
        courseSlider.moveBackward();
    }); */

    var itemsSliderWrappers = $('.items-slider');

    itemsSliderWrappers.each(function (i, sliderWrapper) {
        var itemsSlider = new ItemsSlider($(sliderWrapper));
        itemsSliders.push(itemsSlider);
    });
});

$(window).resize(function () {
    for (var i = 0, length = itemsSliders.length; i < length; i++) {
        itemsSliders[i].onResize();
    }

    console.log(itemsSliders);
});