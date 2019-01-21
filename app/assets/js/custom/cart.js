var cart;

(function() {
	
	var Cart = function() {
		
		this.settings = {
			addUrl : '/cart/add/'
		};
		
		this.init();
		
	};
	
	Cart.prototype.add = function(id) {
		var data = {
			product_id : id
		};
		
		self = this;
		
		$.ajax({
			type: "POST",
			dataType: "json",
			url: this.settings.addUrl,
			data: data,
			success: function(data) {
				self.updateCartBadges(data);
				notificationManager.successfulCartAdding(data.product_name);
			},
			error: function() {
				notificationManager.showNotification(false, 'Произошла ошибка');
			}
		});
	};
	
	Cart.prototype.updateCartBadges = function(data) {
		
		$('#cart-total-count').text(data.count);
		
	};
	
	Cart.prototype.init = function() {
		var self = this;
		
		$('.cart-ctrl').click(function() {
			var productId = $(this).attr('data-product-id');
			$(this).prop('disabled', true);
			self.add(productId);
		});
	};
	
	Cart.prototype.updateCount = function (select) {
		var form = select.parents('form');
		form.submit();
	};
	
	$(document).ready(function() {
		cart = new Cart();
		
		$('.cart-count').change(function() {
			cart.updateCount($(this));
		});
	});
	
})();