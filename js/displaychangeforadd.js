/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function displaychangeforadd() {
    nowvisblecategory = document.getElementsByClassName('categoryblock')[0];
    if (nowvisblecategory) {
        document.getElementsByClassName('categoryblock')[0].classList.replace("categoryblock", "d-none");
    }
    typefield = document.getElementById('addnapravlenie');
    typefield = typefield.options[typefield.selectedIndex].value;
    blockcategoryid = 'blockcategory' + typefield;
    categoryid = 'category' + typefield;
    document.getElementById(blockcategoryid).classList.replace("d-none", "categoryblock");

    nowvisblesubcategory = document.getElementsByClassName('subcategoryblock')[0];
    if (nowvisblesubcategory) {
        document.getElementsByClassName('subcategoryblock')[0].classList.replace("subcategoryblock", "d-none");
    }
    subtypefield = document.getElementById(categoryid);
    subtypefield = subtypefield.options[subtypefield.selectedIndex].value;
    blocksubcategoryid = 'blocksubcategory' + subtypefield;
    document.getElementById(blocksubcategoryid).classList.replace("d-none", "subcategoryblock");
}
