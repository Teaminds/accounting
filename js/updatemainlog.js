/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
function updatemainlog(newpage = document.getElementById('pagination').getAttribute('activepage'))
{
    if (newpage > 0) {
        document.getElementById('page').value = newpage;
    }
    datestart = document.getElementById('datestart').value;
    dateend = document.getElementById('dateend').value;
    typefield = document.getElementById('napravlenie');
    typefield = typefield.options[typefield.selectedIndex].value;
    page = document.getElementById('page').value;
    getbody = "datestart=" + datestart + "&dateend=" + dateend + "&napravlenie=" + typefield + "&page=" + page;
    $.ajax({
        type: "GET",
        url: 'mainlog',
        data: getbody,
        success: function (data) {
            $('#mainlog').html(data);
        }
    })
}