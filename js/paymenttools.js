/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function paymentedit (id)
{
    getedit = "";
    editdate = document.getElementById('editdate').value;
    editnapravleniefirst = document.getElementById('editnapravlenie');
    editnapravlenie = editnapravleniefirst.options[editnapravleniefirst.selectedIndex].value;
    selectcategoryid = 'editcategory' + editnapravlenie;
    categorydraft = document.getElementById(selectcategoryid);
    category = categorydraft.options[categorydraft.selectedIndex].value;
    selectsubcategoryid = 'editsubcategory' + category;
    subcategorydraft = document.getElementById(selectsubcategoryid);
    subcategory = subcategorydraft.options[subcategorydraft.selectedIndex].value;
    editmoney = document.getElementById('editmoney').value;
    getedit = "editpayment=1&moneyeditid="+id+"&moneyeditdate=" + editdate + "&moneyeditnapravlenie=" + editnapravlenie + "&moneyeditcategory=" + category + "&moneyeditsubcategory=" + subcategory + "&moneyeditmoney=" + editmoney;
    $.ajax({
        type: "GET",
        url: 'paymenttools',
        data: getedit,
        success: setTimeout(updatemainlog(document.getElementById('pagination').getAttribute('activepage')), 1000)
    });
}

function paymentdelete (id)
{
    getdelete = "deletepayment=1&moneydeleteid=" + id;
    $.ajax({
        type: "GET",
        url: 'paymenttools',
        data: getdelete,
        success: setTimeout(updatemainlog(document.getElementById('pagination').getAttribute('activepage')), 1000)
    });
}

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
    });
    setTimeout(afterfunction(), 500);
}