/**
 * Функции для отправки запросов на создание, редактирование и удаление платежей
 */

/**
 * Редактирование платежа
 */

function paymentedit(id)
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
    getedit = "editpayment=1&moneyeditid=" + id + "&moneyeditdate=" + editdate + "&moneyeditnapravlenie=" + editnapravlenie + "&moneyeditcategory=" + category + "&moneyeditsubcategory=" + subcategory + "&moneyeditmoney=" + editmoney;
    $.ajax({
        type: "GET",
        url: 'paymenttools',
        data: getedit,
        success: setTimeout(updatemainlog(document.getElementById('pagination').getAttribute('activepage')), 1000)
    });
}

/**
 * Удаление платежа
 */

function paymentdelete(id)
{
    getdelete = "deletepayment=1&moneydeleteid=" + id;
    $.ajax({
        type: "GET",
        url: 'paymenttools',
        data: getdelete,
        success: setTimeout(updatemainlog(document.getElementById('pagination').getAttribute('activepage')), 1000)
    });
}

/**
 * Добавление платежа
 */

function addpayment(afterfunction = "")
{
    getadd = "";
    adddate = document.getElementById('adddate').value;
    addnapravleniefirst = document.getElementById('addnapravlenie');
    addnapravlenie = addnapravleniefirst.options[addnapravleniefirst.selectedIndex].value;
    selectcategoryid = 'addcategory' + addnapravlenie;
    categorydraft = document.getElementById(selectcategoryid);
    category = categorydraft.options[categorydraft.selectedIndex].value;
    selectsubcategoryid = 'addsubcategory' + category;
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