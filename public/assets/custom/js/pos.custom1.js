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

/* Check Currency Selected */
$(document).on('click', '.zwl__currency', function(){
    $('.usd__currency').empty().addClass('display__none');
    //e.preventDefault();
});
$(document).on('click', '.usd__currency', function(){
    $('.zwl__currency').empty().addClass('display__none');
    //e.preventDefault();
});


$(document).on('click', '.product__results li', function(e){
    /* From DB */
    let product_name = $(this).text();
    let product_id = $(this).attr('id');
    let product_usd = $(this).attr('usd');
    let product_zwl = $(this).attr('zwl');
    let product_barcode = $(this).attr('barcode');
    let product_list = $(this).closest('.product__results');
    let usd_currency = $('input[value="USD"]');
    let zwl_currency = $('input[value="ZWL"]');
    /**
     *  Calculate
     **/
    let product_usdNumber = Number(product_usd); // for hidden input
    let product_usdCalculate = product_usdNumber / 100;
    let product_usdDecimal = product_usdCalculate.toFixed(2); // for display
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
    // Clone Attributes
    let product_totalText = clone_row.find('.product__total_text');
    let product_totalValue = clone_row.find('.product__total_value');
    product_totalValue.attr('name', 'product_total[]');
    clone_row.removeClass('display__none'); 
    let name_text = clone_row.find('.name__text');
    let id = name_text.attr('id', product_id); // Product id
    let name_value = clone_row.find('.name__value');
    name_value.attr('name', 'name[]')
    let barcode_text = clone_row.find('.barcode__text');
    let barcode_value = clone_row.find('.barcode__value');
    barcode_value.attr('name', 'barcode[]');
    let price_text = clone_row.find('.price__text');
    let price_value = clone_row.find('.price__value');
    price_value.attr('name', 'price[]')
    let usd_value = clone_row.find('.usd__value');
    usd_value.attr('name', 'usd[]');
    let zwl_value = clone_row.find('.zwl__value');
    zwl_value.attr('name', 'zwl[]');
    /* usd_value.attr('name', 'usd[]'); */
    let quantity_value = clone_row.find('.quantity__value');
    quantity_value.attr('type', 'number');
    quantity_value.attr('name', 'quantity[]');
    let product_quantity = quantity_value.val();
    /* Product Total */
    if(product_id != null){
        /* Insert Product Name */
        name_text.text(product_name);
        name_value.val(product_name);
        /* Insert Product Barcode */
        barcode_text.text(product_barcode)
        barcode_value.val(product_barcode)
        /* Insert Product Price */
        if( usd_currency.is(':checked') ){
            price_text.text(product_usdDecimal);
            price_value.val(product_usdNumber);
            /* Product ToTAL */
            product_totalText.text(product_usdDecimal);
            product_totalValue.val(product_usdNumber);
            /* AA */
        } else if( zwl_currency.is(':checked') ){
            price_text.text(product_zwlDecimal);
            price_value.val(product_zwlNumber);
            /* Product ToTAL */
            product_totalText.text(product_zwlDecimal);
            product_totalValue.val(product_zwlNumber);
        } else{
            return false;
        }
        usd_value.val(product_usd);
        zwl_value.val(product_zwl);
        /* Append */
        let insert = insert_area.append(clone_row);
        product_list.empty().addClass('display__none');
    }else{
        product_list.empty().addClass('display__none');
        return false;
    }
    product_list.empty().addClass('display__none');
});


// Quantity Value
$(document).on('change', '.quantity__value', function(){
    let product_totalText = $(this).closest('.product__row').find('.price__text');
    let product_totalValue = $(this).closest('.product_row').find('.product__total_value').val();
    let price_text = $(this).closest('.product__row').find('.price__text');
    let price_value = $(this).closest('.product__row').find('.price__value').val();
    let product_quantityValue = $(this).val();
    let product_quantityNumber = Number(product_quantityValue);  
    let price_valueNumber = Number(price_value);
    let product_total = product_quantityNumber * price_valueNumber;
    let product_totalNumber = Number(product_total); // for display
    let product_totalCalculate = product_totalNumber / 100;
    let product_totalDecimal = product_totalCalculate.toFixed(2); // for hidden input
    product_totalText.text(product_totalDecimal)
    price_text.text(product_totalDecimal);
   
});




/* Remove Product From List */
$(document).on('click', '.remove__btn', function(e){
    $(this).closest('.product__row').slideUp("normal", function() { $(this).remove(); } );
    e.preventDefault();
});