var category;

var Category = function() {
    this.init();
    this.processUrl();
    this.updateControls();
    this.initPagination();
};

Category.prototype.init = function() {

    var alias = $('input#alias').val();

    this.settings = {
        page: 1,
        sort: 'name',
        order: 'asc',
        inStock: 'true',
        filters : [],
        alias: alias,
        getUrl: '/category/' + alias,
        ajaxUrl: '/category/load/' + alias,
    };
};

Category.prototype.buildUrl = function() {
    var getParts = '?';

    getParts += 'filters=' + this.settings['filters'].join('--');
    getParts += '&inStock=' + this.settings['inStock'];
    getParts += '&page=' + this.settings['page'];
    getParts += '&sort=' + this.settings['sort'];
    getParts += '&order=' + this.settings['order'];

    this.settings['getUrl'] = '/category/' + this.settings['alias'] + getParts;
    this.settings['ajaxUrl'] = '/category/load/' + this.settings['alias'] + getParts;
};

Category.prototype.inArray = function(value, array) {
    return array.indexOf(value) > -1;
};

Category.prototype.removeFromArray = function(value, array) {
    var index = array.indexOf(value);

    if (index > -1) {
        array.splice(index, 1);
    }
}

Category.prototype.setFilter = function(checkbox) {
    var checked = checkbox.prop('checked') == true,
        alias = checkbox.attr('data-alias');

    if (checked) {
        if (!this.inArray(alias, this.settings['filters'])) {
            this.settings['filters'].push(alias);
        }
    } else {
        if (this.inArray(alias, this.settings['filters'])) {
            this.removeFromArray(alias, this.settings['filters']);
        }
    }

    this.setPageToFirst();
    this.processPage();
};

Category.prototype.setPage = function(button) {
    var page = button.attr('data-page') * 1;

    this.settings['page'] = page;

    this.processPage();
};

Category.prototype.setPageToFirst = function() {
    this.settings['page'] = 1;
};

Category.prototype.setSortAndOrder = function(select) {
    var values = select.val().split('-');

    this.settings['sort'] = values[0];
    this.settings['order'] = values[1];

    this.setPageToFirst();
    this.processPage();
};

Category.prototype.setInStock = function(checkbox) {
    var checked = checkbox.prop('checked') == true;

    this.settings['inStock'] = checked ? 'true' : 'false';

    this.setPageToFirst();
    this.processPage();
};

Category.prototype.toggleLoader = function(show) {
    var loader = $('#loader');

    if (show) {
        loader.fadeIn(200);
    } else {
        loader.fadeOut(200);
    }
};

Category.prototype.setAddress = function() {
    window.history.replaceState(this.settings, "", this.settings['getUrl']);
};

Category.prototype.processPage = function() {
    this.buildUrl();
    this.setAddress();
    this.loadProducts();
};

Category.prototype.loadProducts = function() {
    this.toggleLoader(true);

    var self = this;

    $('#products-block').load(this.settings['ajaxUrl'], function() {
        $('#products-count-text').html($('input#products-count').val());
        self.initPagination();
        self.toggleLoader(false);
    });
};

Category.prototype.getUrlParameter = function (name) {
    var url = window.location.href;
    name = name.replace(/[\[\]]/g, "\\$&");
    var regex = new RegExp("[?&]" + name + "(=([^&#]*)|&|#|$)"),
        results = regex.exec(url);
    if (!results) return null;
    if (!results[2]) return '';
    return decodeURIComponent(results[2].replace(/\+/g, " "));
};

Category.prototype.parameterSet = function(value) {
    return value !== null && value !== '';
}

Category.prototype.processUrl = function() {
    var sort = this.getUrlParameter('sort');

    if (this.parameterSet(sort)) {
        this.settings['sort'] = sort;
    }

    var order = this.getUrlParameter('order');

    if (this.parameterSet(order)) {
        this.settings['order'] = order;
    }

    var inStock = this.getUrlParameter('inStock');

    if (this.parameterSet(inStock)) {
        this.settings['inStock'] = inStock;
    }

    var filters = this.getUrlParameter('filters');

    if (this.parameterSet(filters)) {
        this.settings['filters'] = filters.split('--');
    }

    var page = this.getUrlParameter('page');

    if (this.parameterSet(page)) {
        this.settings['page'] = page * 1;
    }

    console.log(this.settings);
};

Category.prototype.updateSortOrderSelect = function() {
    var key = this.settings['sort'] + '-' + this.settings['order'],
        select = $('select#sort-order');

    select.val(key);

    updateCustomSelect('.custom-select');
};

Category.prototype.updateInStockCheckbox = function() {
    var checkbox = $('#in-stock'),
        inStock = this.settings['inStock'] == 'true';

    checkbox.prop('checked', inStock);
};

Category.prototype.updateControls = function() {
    this.updateSortOrderSelect();
    this.updateInStockCheckbox();
};

Category.prototype.initPagination = function() {
    $('.pagination a').click(function (e) {
        e.preventDefault();

        var button = $(this);

        category.setPage(button);
    });
};


$(document).ready(function() {

    category = new Category();

    $('.filter-check').change(function() {
        var checkbox = $(this);

        category.setFilter(checkbox);
    });

    $('select#sort-order').change(function() {
        var select = $(this);

        category.setSortAndOrder(select);
    });

    $('#in-stock').change(function() {
        var checkbox = $(this);

        category.setInStock(checkbox);
    });

});
