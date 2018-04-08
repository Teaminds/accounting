/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


function addpayment(afterfunction = "")
{
    getadd = "";
    adddate = document.getElementById('adddate').value;
    addnapravleniefirst = document.getElementById('addnapravlenie');
    addnapravlenie = addnapravleniefirst.options[addnapravleniefirst.selectedIndex].value;
    selectcategoryid = 'category' + addnapravlenie;
    categorydraft = document.getElementById(selectcategoryid);
    category = categorydraft.options[categorydraft.selectedIndex].value;
    selectsubcategoryid = 'subcategory' + category;
    subcategorydraft = document.getElementById(selectsubcategoryid);
    subcategory = subcategorydraft.options[subcategorydraft.selectedIndex].value;
    addmoney = document.getElementById('addmoney').value;
    getadd = "addpayment=1&moneyadddate=" + adddate + "&moneyaddnapravlenie=" + addnapravlenie + "&moneyaddcategory=" + category + "&moneyaddsubcategory=" + subcategory + "&moneyaddmoney=" + addmoney;
    $.ajax({
        type: "GET",
        url: 'mainlog',
        data: getadd,
        success: console.log("success add")
    })
    setTimeout(afterfunction(), 500);
}