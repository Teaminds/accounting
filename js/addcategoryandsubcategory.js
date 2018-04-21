/**
 * Функции добавления категорий и подкатегорий
 */

function addcategory(type) {
    newcategoryid = 'category' + type;
    newcategory = document.getElementById(newcategoryid).value;
    getnewcategory = "addcategory=1&addcategorytype=" + type + "&addcategoryname=" + newcategory;
    $.ajax({
        type: "GET",
        url: 'category',
        data: getnewcategory,
        success: function(){
            location.reload(true);
        }
    });
}
function addsubcategory(parentid) {
    newsubcategoryid = 'subcategory' + parentid;
    newsubcategory = document.getElementById(newsubcategoryid).value;
    getnewsubcategory = "addsubcategory=1&addsubcategoryparentid=" + parentid + "&addsubcategoryname=" + newsubcategory;
    $.ajax({
        type: "GET",
        url: 'category',
        data: getnewsubcategory,
        success: function(){
            location.reload(true);
        }
    });
}