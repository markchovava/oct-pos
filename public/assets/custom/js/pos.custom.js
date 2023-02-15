/**
 * By Mark
 */

$('.search__btn').click(function(e){
    e.preventDefault();
    if(this.id == "search__btn"){
        var product_name = $(this).closest('.product__search').find('.product__name').val();
        var product_results = $(this).closest('.product__search').siblings('.product__results');       
        let product_search = $(this).attr('href');
        if( product_name != "" ){
            product_results.removeClass('display__none').append('<li class="text-success">Loading...</li>');
            $.ajaxSetup({
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
            });
            $.ajax({
                headers: {  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')  },
                url: product_search,
                method: "GET",
                dataType: "json",
                data: { name: product_name },
                success: function(res){
                    console.log(res.product);
                    if(res.product.length > 0){
                        product_results.empty();
                        console.log(res.product);
                        for(var i = 0; i < res.product.length; i++){
                            $.each(res, function () {
                                product_results.append(
                                    '<li usd="' + (res.product[i].price.usd) + '"' + 
                                    'zwl="' + (res.product[i].price.zwl) + '"' +
                                    'quantity="' + (res.product[i].stock.quantity) + '"' +
                                    'barcode="' + (res.product[i].barcode) + '"' +
                                    ' id="' + res.product[i].id + '" ' +
                                    '">' + res.product[i].name +
                                    '</li>'
                                );
                            });
                        }
                    } else{
                        product_results.empty();
                        product_results.append('<li class="text-danger" style="text-decoration:none;">No Results.</li>');
                    }
                }
            }); 
        }
        
    }
});


/* document.addEventListener('textInput', function(){
    let barcode_insertValue = $('input[name="barcode"]').val();
    console.log(barcode_insertValue);
}) */

$(document).on('click', '#barcode__search', function(e){
    e.preventDefault();
    let barcode_insertValue = $('input[name="barcode"]').val();
    let product_results = $(this).closest('.barcode__searchArea').siblings('.product__results');  
    let barcode_searchRoute = $(this).attr('href');
    /* Choosing Currency */
    let usd_currency = $('input[value="USD"]');
    let zwl_currency = $('input[value="ZWL"]');
    if(this.id == "barcode__search"){
        if( barcode_insertValue != "" ){
            product_results.removeClass('display__none').append('<li class="text-success">Loading...</li>');
            $.ajaxSetup({
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
            });
            $.ajax({
                headers: {  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')  },
                url: barcode_searchRoute,
                method: "GET",
                dataType: "json",
                data: { barcode: barcode_insertValue },
                success: function(res){
                    console.log(res.product);
                    if(res.product.length > 0){
                        product_results.empty();
                        console.log(res.product);
                        for(var i = 0; i < res.product.length; i++){
                            $.each(res, function () {
                                /* From DB */
                                let product_name = res.product[i].name;
                                let product_id = res.product[i].id;
                                let stock_quantity = res.product[i].stock.quantity;
                                let product_usd = res.product[i].price.usd;
                                let product_zwl = res.product[i].price.zwl;
                                let product_barcode = (res.product[i].barcode);
                                /**
                                 *  Calculate
                                 **/
                                // USD
                                let product_usdNumber = Number(product_usd); // for hidden input
                                let product_usdCalculate = product_usdNumber / 100;
                                let product_usdDecimal = product_usdCalculate.toFixed(2); // for display
                                // ZWL
                                let product_zwlNumber = Number(product_zwl); // for hidden input
                                let prduct_zwlCalculate = product_zwlNumber / 100;
                                let product_zwlDecimal = prduct_zwlCalculate.toFixed(2); // for display
                                /** 
                                 *  Duplicate
                                */
                                let insert_area = $('.product__insertArea');
                                let product_rowFirst = $('.product__row:first');
                                //alert(product_zwlNumber)
                                //Clone
                                let clone_row = product_rowFirst.clone(true, true);
                                clone_row.removeClass('display__none'); 
                                /**
                                 *  Clone Children 
                                 **/ 
                                let product_totalText = clone_row.find('.product__totalText');
                                let product_totalValue = clone_row.find('.product__totalValue');
                                product_totalValue.attr('name', 'product_total[]');
                                /* Product Name */
                                let name_text = clone_row.find('.name__text');
                                let name_value = clone_row.find('.name__value');
                                name_value.attr('name', 'product_name[]');
                                /* Product ID */
                                let product_idValue = clone_row.find('.product__idValue'); // Product id
                                product_idValue.attr('name', 'product_id[]');
                                /* Product Stock Quantity */
                                let stock_quantityText = clone_row.find('.stock__quantityText');
                                let stock_quantityValue = clone_row.find('.stock__quantityValue');
                                stock_quantityValue.attr('name', 'stock_quantity[]');
                                let stock = clone_row.find('.stock'); // Fixed value for calculating stock deduction
                                stock.attr('name', 'stock[]');
                                /* Product Barcode */
                                let barcode_text = clone_row.find('.barcode__text');
                                let barcode_value = clone_row.find('.barcode__value');
                                barcode_value.attr('name', 'product_barcode[]');
                                let price_text = clone_row.find('.price__text');
                                let price_value = clone_row.find('.price__value');
                                price_value.attr('name', 'product_price[]');
                                let usd_value = clone_row.find('.usd__value');
                                usd_value.attr('name', 'usd_unit_price[]');
                                let zwl_value = clone_row.find('.zwl__value');
                                zwl_value.attr('name', 'zwl_unit_price[]');
                                let quantity_value = clone_row.find('.quantity__value');
                                quantity_value.attr('type', 'number');
                                quantity_value.attr('name', 'product_quantity[]');
                            //let product_quantity = quantity_value.val();
                            /* */
                            if ( product_id != null ){
                                /* Insert Product Name */
                                name_text.text(product_name);
                                name_value.val(product_name);
                                product_idValue.val(product_id);
                                /* Stock Quantity */
                                stock_quantityText.text(stock_quantity)
                                stock_quantityValue.val(stock_quantity);
                                stock.val(stock_quantity);
                                /* Insert Product Barcode */
                                barcode_text.text(product_barcode)
                                barcode_value.val(product_barcode)
                                if( usd_currency.is(':checked') ){
                                    price_text.text(product_usdDecimal);
                                    price_value.val(product_usdNumber);
                                    /* Product ToTAL */
                                    product_totalText.text(0.00);
                                    product_totalValue.val(0);
                                    /**
                                    *  Subtotal
                                    */
                                    let subtotal_text = $('.subtotal__text');
                                    let subtotal_value = $('.subtotal__value');
                                    let products_totalArray = new Array();
                                    $('.product__totalValue').each((i, item) => {
                                        products_totalArray.push(item.value);
                                    }); 
                                    let subtotal =  products_totalArray.reduce((a, b) => Number(a) + Number(b));
                                    let subtotalNumber = Number(subtotal);
                                    let subtotal_calculate = subtotalNumber / 100;
                                    let subtotal_decimal = subtotal_calculate.toFixed(2);
                                    subtotal_text.text(subtotal_decimal);
                                    subtotal_value.val(subtotalNumber);
                                    } else if( zwl_currency.is(':checked') ){
                                        price_text.text(product_zwlDecimal);
                                        price_value.val(product_zwlNumber);
                                        /* Product ToTAL */
                                        product_totalText.text(0.00);
                                        product_totalValue.val(0);
                                        /**
                                         *  Subtotal
                                         */
                                        let subtotal_text = $('.subtotal__text');
                                        let subtotal_value = $('.subtotal__value');
                                        let products_totalArray = new Array();
                                        $('.product__totalValue').each((i, item) => {
                                            products_totalArray.push(item.value);
                                        }); 
                                        let subtotal =  products_totalArray.reduce((a, b) => Number(a) + Number(b));
                                        let subtotalNumber = Number(subtotal);
                                        let subtotal_calculate = subtotalNumber / 100;
                                        let subtotal_decimal = subtotal_calculate.toFixed(2);
                                        subtotal_text.text(subtotal_decimal);
                                        subtotal_value.val(subtotalNumber);
                                    } else{
                                        return false;
                                    }
                                    usd_value.val(product_usd);
                                    zwl_value.val(product_zwl);
                                    /* Append */
                                    let insert = insert_area.append(clone_row);
                                    /* Empty and hide list */
                                    product_list.empty().addClass('display__none');
                                } else{
                                    /* Empty and hide list */
                                    product_list.empty().addClass('display__none');
                                    return false;
                                }
                                product_list.empty().addClass('display__none');
                            });
                        }
                    } else{
                        product_results.empty();
                        product_results.append('<li class="text-danger" style="text-decoration:none;">No Results.</li>');
                    }
                }
            }); 
        }
        
    }
});


/* Check Currency Selected */
$(document).on('click', '.zwl__currency', function(){
    $('.usd__currency').empty().addClass('display__none');
    //e.preventDefault();
});
$(document).on('click', '.usd__currency', function(){
    $('.zwl__currency').empty().addClass('display__none');
    //e.preventDefault();
});

$(document).on('click', '.product__results li', function(){
    /* From DB */
    let product_name = $(this).text();
    let product_id = $(this).attr('id');
    let product_usd = $(this).attr('usd');
    let product_zwl = $(this).attr('zwl');
    let stock_quantity = $(this).attr('quantity');
    let product_barcode = $(this).attr('barcode');
    let product_list = $(this).closest('.product__results');
    /* Choosing Currency */
    let usd_currency = $('input[value="USD"]');
    let zwl_currency = $('input[value="ZWL"]');
    /**
     *  Calculate
     **/
    // USD
    let product_usdNumber = Number(product_usd); // for hidden input
    let product_usdCalculate = product_usdNumber / 100;
    let product_usdDecimal = product_usdCalculate.toFixed(2); // for display
    // ZWL
    let product_zwlNumber = Number(product_zwl); // for hidden input
    let prduct_zwlCalculate = product_zwlNumber / 100;
    let product_zwlDecimal = prduct_zwlCalculate.toFixed(2); // for display
    /** 
     *  Duplicate
    */
    let insert_area = $('.product__insertArea');
    let product_rowFirst = $('.product__row:first');
    //Clone
    let clone_row = product_rowFirst.clone(true, true);
    clone_row.removeClass('display__none'); 
    // Clone Children
    let product_totalText = clone_row.find('.product__totalText');
    let product_totalValue = clone_row.find('.product__totalValue');
    product_totalValue.attr('name', 'product_total[]');
    /* Stock Quantity */
    let stock_quantityText = clone_row.find('.stock__quantityText');
    let stock_quantityValue = clone_row.find('.stock__quantityValue');
    stock_quantityValue.attr('name', 'stock_quantity[]');
    let stock = clone_row.find('.stock'); // Fixed value for calculating stock deduction
    stock.attr('name', 'stock[]');
    let name_text = clone_row.find('.name__text');
    let product_idValue = clone_row.find('.product__idValue'); // Product id
    product_idValue.attr('name', 'product_id[]');
    let name_value = clone_row.find('.name__value');
    name_value.attr('name', 'product_name[]');
    let barcode_text = clone_row.find('.barcode__text');
    let barcode_value = clone_row.find('.barcode__value');
    barcode_value.attr('name', 'product_barcode[]');
    let price_text = clone_row.find('.price__text');
    let price_value = clone_row.find('.price__value');
    price_value.attr('name', 'product_price[]');
    let usd_value = clone_row.find('.usd__value');
    usd_value.attr('name', 'usd_unit_price[]');
    let zwl_value = clone_row.find('.zwl__value');
    zwl_value.attr('name', 'zwl_unit_price[]');
    let quantity_value = clone_row.find('.quantity__value');
    quantity_value.attr('type', 'number');
    quantity_value.attr('name', 'product_quantity[]');
    quantity_value.val(1); // Add 1
    //let product_quantity = quantity_value.val();
    /* Initial total */
    
    /* */
    if ( product_id != null ){
        /* Insert Product Name */
        name_text.text(product_name);
        name_value.val(product_name);
        product_idValue.val(product_id);
        /* Stock Quantity */
        stock_quantityText.text(stock_quantity)
        stock_quantityValue.val(stock_quantity);
        stock.val(stock_quantity);
        /* Insert Product Barcode */
        barcode_text.text(product_barcode)
        barcode_value.val(product_barcode)
        if( usd_currency.is(':checked') ){
            price_text.text(product_usdDecimal);
            price_value.val(product_usdNumber);
            /* Product ToTAL */
            product_totalText.text(product_usdDecimal);
            product_totalValue.val(product_usdNumber);
            /**
             *  Subtotal
             */
            let subtotal_text = $('.subtotal__text');
            let subtotal_value = $('.subtotal__value');
            let products_totalArray = new Array();
            $('.product__totalValue').each((i, item) => {
                products_totalArray.push(item.value);
            }); 
            let subtotal =  products_totalArray.reduce((a, b) => Number(a) + Number(b));
            let subtotalNumber = Number(subtotal);
            let subtotal_calculate = subtotalNumber / 100;
            let subtotal_decimal = subtotal_calculate.toFixed(2);
            subtotal_text.text(subtotal_decimal);
            subtotal_value.val(subtotalNumber);
        } else if( zwl_currency.is(':checked') ){
            price_text.text(product_zwlDecimal);
            price_value.val(product_zwlNumber);
            /* Product ToTAL */
            product_totalText.text(product_zwlDecimal);
            product_totalValue.val(product_zwlNumber);
            /**
             *  Subtotal
             */
             let subtotal_text = $('.subtotal__text');
             let subtotal_value = $('.subtotal__value');
             let products_totalArray = new Array();
             $('.product__totalValue').each((i, item) => {
                 products_totalArray.push(item.value);
             }); 
             let subtotal =  products_totalArray.reduce((a, b) => Number(a) + Number(b));
             let subtotalNumber = Number(subtotal);
             let subtotal_calculate = subtotalNumber / 100;
             let subtotal_decimal = subtotal_calculate.toFixed(2);
             subtotal_text.text(subtotal_decimal);
             subtotal_value.val(subtotalNumber);
        } else{
            return false;
        }
        usd_value.val(product_usd);
        zwl_value.val(product_zwl);
        /* Append */
        let insert = insert_area.append(clone_row);
        /* Empty and hide list */
        product_list.empty().addClass('display__none');
    } else{
        /* Empty and hide list */
        product_list.empty().addClass('display__none');
        return false;
    }
    product_list.empty().addClass('display__none');
});

// Quantity Value
$(document).on('change', '.quantity__value', function(){
    let product_totalText = $(this).closest('.product__row').find('.product__totalText');
    let product_totalValue = product_totalText.siblings('.product__totalValue')
    let price_value = $(this).closest('.product__row').find('.price__value').val();
    let product_quantityValue = $(this).val();
    let product_quantityNumber = Number(product_quantityValue);  
    let price_valueNumber = Number(price_value);
    let product_total = product_quantityNumber * price_valueNumber;
    let product_totalNumber = Number(product_total); // for display
    let product_totalCalculate = product_totalNumber / 100;
    let product_totalDecimal = product_totalCalculate.toFixed(2); // for hidden input
    product_totalValue.attr('value', product_totalNumber);
    product_totalText.text(product_totalDecimal);  
    /* Stock Quantity */
    let stock_quantityText = $(this).closest('.product__row').find('.stock__quantityText'); 
    let stock_quantityValue = $(this).closest('.product__row').find('.stock__quantityValue'); 
    let stock_value = $(this).closest('.product__row').find('.stock').val(); 
    let stock_valueNumber = Number(stock_value);
    /* Deduct Quantity stock */
    let current_stockValue = stock_valueNumber - product_quantityNumber;
    stock_quantityText.text(current_stockValue);
    stock_quantityValue.val(current_stockValue);
    /**
     *  Calculation 
     *  Subtotal,
     *  Tax,
     *  Subtotal
     */
    /* Subtotal  */
    let subtotal_text = $('.subtotal__text');
    let subtotal_value = $('.subtotal__value');
    /* Grand Total  */
    let grandtotal_text = $('.grandtotal__text');
    let grandtotal_value = $('.grandtotal__value');

    let products_totalArray = new Array();
    $('.product__totalValue').each((i, item) => {
        products_totalArray.push(item.value);
    });
    /* Grand Total */
    let grandtotal =  products_totalArray.reduce((a, b) => Number(a) + Number(b));
    let grandtotalNumber = Number(grandtotal);
    let grandtotal_calculate = grandtotalNumber / 100;
    let grandtotal_decimal = grandtotal_calculate.toFixed(2);
    grandtotal_text.text(grandtotal_decimal);
    grandtotal_value.val(grandtotalNumber); 
    /* Tax */
    let tax_text = $('.tax__text');
    let tax_value = $('.tax__value');
    let tax = $('input[name="tax_percent"]').val();
    let tax_calculate = (Number(tax) / 100) * grandtotalNumber;
    let tax_currency = tax_calculate / 100;
    let tax_decimal = tax_currency.toFixed(2);
    tax_text.text(tax_decimal);
    tax_value.val(tax_calculate);
     /*   Subtotal   */
     let subtotal = grandtotalNumber - tax_calculate; // Tax Calculation
     let subtotalNumber = Number(subtotal);
     let subtotal_calculate = subtotalNumber / 100;
     let subtotal_decimal = subtotal_calculate.toFixed(2);
     subtotal_text.text(subtotal_decimal);
     subtotal_value.val(subtotalNumber);
});

/**
 *  Amount Paid and Change
**/
$(document).on('click', '#amount__confirmBtn', function(){
    let amount_paidValue = $(this).closest('#amount__paidInsert').find('.amount__paidValue').val();
    let amount_paidCentsValue = $('.amount__paidCentsValue');
    let grandtotal_value = $('.grandtotal__value').val();   
    let change_text = $('.change__text');
    let change_value = $('.change__value');
    // Calculate
    let amount_paidCents = amount_paidValue * 100;
    let amount_paidNumber = Number(amount_paidCents);
    let grandtotal_number = Number(grandtotal_value)
    let change = amount_paidNumber - grandtotal_number;
    let change_calculate = change / 100;
    let change_decimal = change_calculate.toFixed(2);
    // Output
    if( !isNaN(change)){
        change_text.text(change_decimal)
        change_value.val(change)
        amount_paidCentsValue.val(amount_paidNumber);
    }else{
        alert('Please enter in the following format: 00.00');
        return false;
    }
    
});

/**
 *    Clear Prices
 **/
$(document).on('click', '.reset__amount', function(e){
    let tax__text = $('.tax__text').empty();
    let tax__value = $('.tax__value').val('');
    let subtotal_value = $('.subtotal__value').val('');
    let subtotal_text = $('.subtotal__text').empty();
    let grandtotal_value = $('.grandtotal__value').val('');
    let grandtotal_text = $('.grandtotal__text').empty();
});

/**
 *    Remove Product From List 
 **/
$(document).on('click', '.remove__btn', function(e){
    $(this).closest('.product__row').slideUp("fast", function() { $(this).remove(); } );
    e.preventDefault();
});


let a = true;
$(document).on('keypress', 'input[type="text"], .quantity__value, input[type="hidden"], input[type="number"], input[name="product_quantity[]"]', function(e){
    // Prevent keypress on enter
    if(e.keyCode == 13){
        return false;
    }
    if(a == true){
        let barcode_value = $(this).val();
        a = false;
    }
});

/** 
*   Disable Submit if Status is not Active
**/
  
/* Attached to an event listener */
$(document).on('click', '#submit__btn', function(e){
    let the_user_status = $('input[name="user_status"]').val();
    if( the_user_status == 1 ){
        $('#submit__btn').attr('disabled', false);
    }
    else if( the_user_status == 0 ){
        $('#submit__btn').attr('disabled', true);
        alert('You are required to be active to submit this Order.');
        return false;
    }
}); 




