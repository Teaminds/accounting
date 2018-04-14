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
