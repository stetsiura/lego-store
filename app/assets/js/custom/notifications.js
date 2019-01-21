var notificationManager;

(function() {
    
    var NotificationManager = function() {
        
        this.timout = null;
        this.notificationPopup = $('#notification');
        this.notificationIcon = this.notificationPopup.find('i.fa');
        this.notificationMessageContainer = this.notificationPopup.find('#notification-content');
        
        this.settings = {
            successPopupClass: 'success',
            warningPopupClass: 'warning',
            successIconClass: 'fa-check-circle',
            warningIconClass:'fa-warning',
            displayPeriod: 5000
        };
        
    };
    
    NotificationManager.prototype.hideNotification = function() {
      clearTimeout(this.timeout);
      this.notificationPopup.removeClass('shown');
    };
    
    NotificationManager.prototype.prepareNotification = function(success, message) {
        this.setNotificationIconAndClass(success);
        
        this.notificationMessageContainer.html(message);
    };
    
    NotificationManager.prototype.setNotificationIconAndClass = function(success) {
      if (success) {
          this.notificationIcon.removeClass(this.settings.warningIconClass);
          this.notificationIcon.addClass(this.settings.successIconClass);
          
          this.notificationPopup.removeClass(this.settings.warningPopupClass);
          this.notificationPopup.addClass(this.settings.successPopupClass);
      } else {
          this.notificationIcon.removeClass(this.settings.successIconClass);
          this.notificationIcon.addClass(this.settings.warningIconClass);
          
          this.notificationPopup.removeClass(this.settings.successPopupClass);
          this.notificationPopup.addClass(this.settings.warningPopupClass);
      }
    };
    
    NotificationManager.prototype.showNotification = function(success, message) {
        this.hideNotification();
        this.prepareNotification(success, message);
        
        this.notificationPopup.addClass('shown');
        
        var self = this;
        
        this.timeout = setTimeout(function() {
            self.hideNotification();
        }, this.settings.displayPeriod);
    };

    NotificationManager.prototype.successfulCartAdding = function(productName) {
        var message = 'Набор &laquo;' + productName + '&raquo; добавлен в <a href="/cart/">Корзину</a>.';
        this.showNotification(true, message);
    };
	
	NotificationManager.prototype.successfulWishlistAdding = function() {
        var message = 'Товар добавлен в список желаний';
        this.showNotification(true, message);
    };

    NotificationManager.prototype.successfulWishlistRemoving = function() {
        var message = 'Товар удален из списка желаний';
        this.showNotification(true, message);
    };

    NotificationManager.prototype.wishlistError = function() {
        var message = 'Произошла ошибка';
        this.showNotification(false, message);
    };

    NotificationManager.prototype.successfulSubscription = function() {
        var message = 'Вы успешно подписаны на E-mail рассылку MINISO';
        this.showNotification(true, message);
    };

    NotificationManager.prototype.unsuccessfulSubscription = function() {
        var message = 'Произошла ошибка';
        this.showNotification(false, message);
    };

    NotificationManager.prototype.subscriptionValidationError = function() {
        var message = 'Пожалуйста, укажите корректный адрес E-mail';
        this.showNotification(false, message);
    };
    
    $(document).ready(function() {
        notificationManager = new NotificationManager();
    });
    
})();





