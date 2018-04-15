/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function displaychangeforadd(targetprefix) {
    
    nowvisblecategory = document.getElementsByClassName(targetprefix+'categoryblock')[0];
    if (nowvisblecategory) {
        document.getElementsByClassName(targetprefix+'categoryblock')[0].classList.replace(targetprefix+"categoryblock", "d-none");
    }
    typefield = document.getElementById(targetprefix+'napravlenie');
    typefield = typefield.options[typefield.selectedIndex].value;
    blockcategoryid = targetprefix+'blockcategory' + typefield;
    categoryid = targetprefix+'category' + typefield;
    document.getElementById(blockcategoryid).classList.replace("d-none", targetprefix+"categoryblock");

    nowvisblesubcategory = document.getElementsByClassName(targetprefix+'subcategoryblock')[0];
    if (nowvisblesubcategory) {
        document.getElementsByClassName(targetprefix+'subcategoryblock')[0].classList.replace(targetprefix+"subcategoryblock", "d-none");
    }
    subtypefield = document.getElementById(categoryid);
    subtypefield = subtypefield.options[subtypefield.selectedIndex].value;
    blocksubcategoryid = targetprefix+'blocksubcategory' + subtypefield;
    document.getElementById(blocksubcategoryid).classList.replace("d-none", targetprefix+"subcategoryblock");
}

function set_matching_select(selectObj, txtObj)
{
   var name = txtObj;
   for(var i = 0; i < 30; i++)
   {
      if(selectObj.options[i].value == name) {
      selectObj.selectedIndex = i;
      i="50";
      }
   }
}


function editwindowdatainsert(id) {
    getbyid = "getpayment=1&getpaymentformat=json&getpaymentid=" + id;
    $.ajax({
        type: "GET",
        url: 'paymenttools',
        data: getbyid,
        success: function (data) {
            var parse = jQuery.parseJSON(data);
            buttondelete = document.getElementById("buttondelete");
            buttonedit = document.getElementById("buttonedit");
            inputid = document.getElementById("editid");
            inputdate = document.getElementById('editdate');
            inputnapravlenie = document.getElementById('editnapravlenie');
            inputcategoryid = document.getElementById('editcategory' + parse.napravlenie.id);
            inputsubcategoryid = document.getElementById('editsubcategory' + parse.category.id);
            inputmoney = document.getElementById('editmoney');
            buttondelete.setAttribute("onclick", "paymentdelete"+"('"+ parse.id +"')");
            buttonedit.setAttribute("onclick", "paymentedit"+"('"+ parse.id +"')");
            inputid.setAttribute("value", parse.id);
            inputdate.setAttribute("value", parse.date);
            inputmoney.setAttribute("value", parse.money);
            set_matching_select(inputnapravlenie, parse.napravlenie.id);
            displaychangeforadd('edit');
            set_matching_select(inputcategoryid, parse.category.id);
            displaychangeforadd('edit');
            set_matching_select(inputsubcategoryid, parse.subcategory.id);
        }
    });
}