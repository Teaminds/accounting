/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function addcategory(type) {
    newcategoryid = 'category' + type;
    newcategory = document.getElementById(newcategoryid).value;
    getnewcategory = "addcategory=1&addcategorytype=" + type + "&addcategoryname=" + newcategory;
    $.ajax({
        type: "GET",
        url: 'category',
        data: getnewcategory,
        success: ''
    });
    setTimeout(location.reload(true), 500);
}
function addsubcategory(parentid) {
    newsubcategoryid = 'subcategory' + parentid;
    newsubcategory = document.getElementById(newsubcategoryid).value;
    getnewsubcategory = "addsubcategory=1&addsubcategoryparentid=" + parentid + "&addsubcategoryname=" + newsubcategory;
    $.ajax({
        type: "GET",
        url: 'category',
        data: getnewsubcategory,
        success: ''
    });
    setTimeout(location.reload(true), 500);
}