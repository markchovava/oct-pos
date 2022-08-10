
$(document).on('click', '.remove__categoryBtn', function(e){
    e.preventDefault();
    let category_select = $(this).closest('.category__select');
    category_select.remove();
});

$(document).on('click', '.add__categoryBtn', function(e){
    let category_insert = $('.category__insert');
    let category_select = $('.category__select:first');
    let clone_row = category_select.clone(true, true);
    clone_row.removeClass('display__none'); 
    let category = clone_row.find('.category');
    category.attr('name', 'category[]');
    category_insert.prepend(clone_row);
});

$(document).on('click', '.remove__brandBtn', function(e){
    e.preventDefault();
    let category_select = $(this).closest('.brand__select');
    category_select.remove();
});

$(document).on('click', '.add__brandBtn', function(e){
    let brand_insert = $('.brand__insert');
    let brand_select = $('.brand__select:first');
    let clone_row = brand_select.clone(true, true);
    clone_row.removeClass('display__none'); 
    let brand = clone_row.find('.brand');
    brand.attr('name', 'brand[]');
    brand_insert.prepend(clone_row);
});