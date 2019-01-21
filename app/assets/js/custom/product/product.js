var wishlistManager;

var Wishlist = function() {
    this.settings = {
        'addUrl': '/product/add-to-wishlist/'  ,
        'removeUrl': '/product/remove-from-wishlist/',
        'productId': -1,
        'wishlistId': -1
    };
};

Wishlist.prototype.add = function(button) {
    var data = {
        product_id : button.attr('data-id')
    };

    self = this;

    $.ajax({
        type: "POST",
        dataType: "json",
        url: this.settings.addUrl,
        data: data,
        success: function(id) {
            self.updateButton(button, id, true);
            notificationManager.successfulWishlistAdding();
        },
        error: function() {
            notificationManager.wishlistError();
        }
    });
};

Wishlist.prototype.remove = function(button) {
    var data = {
        wishlist_id : button.attr('data-id')
    };

    self = this;

    $.ajax({
        type: "POST",
        dataType: "json",
        url: this.settings.removeUrl,
        data: data,
        success: function(id) {
            self.updateButton(button, id, false);
            notificationManager.successfulWishlistRemoving();
        },
        error: function() {
            notificationManager.wishlistError();
        }
    });
};

Wishlist.prototype.updateButton = function(button, id, isAdded) {
    if (isAdded) {
        button.addClass('wishlist-remove').removeClass('wishlist-add');
        button.find('span').html('Удалить из списка желаний');
    } else {
        button.removeClass('wishlist-remove').addClass('wishlist-add');
        button.find('span').html('Добавить в список желаний');
    }

    button.attr('data-id', id);
};

Wishlist.prototype.processButtonClick = function(button) {
    if (button.hasClass('wishlist-add')) {
        this.add(button);
    } else {
        this.remove(button);
    }
};

$(document).ready(function() {
    wishlistManager = new Wishlist();

    $('.wishlist-ctrl').click(function() {
        var button = $(this);

        wishlistManager.processButtonClick(button);
    });
});