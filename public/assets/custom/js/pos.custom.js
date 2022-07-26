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

$(document).on('click', '.product__results li', function(e){
    /* From DB */
    let product_name = $(this).text();
    let product_id = $(this).attr('id');
    let product_usd = $(this).attr('usd');
    let product_zwl = $(this).attr('zwl');
    let product_barcode = $(this).attr('barcode');
    let product_list = $(this).closest('.product__results');
    /** 
     *  Duplicate
    */
    let insert_area = $('.product__insertArea');
    let product_rowFirst = $('.product__row:first');
    let clone_row = product_rowFirst.clone();
    //Clone
    clone_row.removeClass('display__none'); 
    let name_text = clone_row.find('.name__text');
    let name_value = clone_row.find('.name__value');
    let barcode_text = clone_row.find('.barcode__text');
    let barcode_value = clone_row.find('.barcode__value');
    let price_text = clone_row.find('.price__text');
    let usd_value = clone_row.find('.usd__value');
    let zwl_value = clone_row.find('.zwl__value');
    if(product_id != null){
        /* Insert Product Name */
        name_text.text(product_name);
        name_value.val(product_name);
        /* Insert Product Barcode */
        barcode_text.text(product_barcode)
        barcode_value.val(product_barcode)
        /* Insert Product Price */
        price_text.text(product_usd);
        usd_value.val(product_usd);
        zwl_value.val(product_zwl);
        /*  */
        /* Append */
        let insert = insert_area.append(clone_row);
    }else{
        return false;
    }

});


/* Remove Product From List */
$(document).on('click', '.remove__btn', function(e){
    $(this).closest('.product__row').slideUp("normal", function() { $(this).remove(); } );
    e.preventDefault();
});