"use strict";
var dataTable;
var initTable1 = function() {
    var table = $('#kt_table_1');

    // begin first table
    dataTable = table.DataTable({
        responsive: true,
        ajax: {
            url: base_url + "admin/sport/ajaxList",
            type: "POST"
        },
        columns: [
            {data: 'ID'},
            {data: 'Sport'},
            {data: 'Link'},
            {data: 'Actions', responsivePriority: -1},
        ],
        
        columnDefs: [
            {
                targets: -1,
                title: 'Actions',
                orderable: false,
                render: function(data, type, full, meta) { 
                    return `
                      
                        <a href='#' onclick='editSport( `+data+` )' class = "dayHead editTable kt-menu__link"><i class="la la-edit la-2x"></i>  </a>
                      
                      `;
                },
            }
        ],
    });

};

var KTDatatablesDataSourceHtml = function() {

    return {

        //main function to initiate the module
        init: function() {
            initTable1();
        },

    };

}();

jQuery(document).ready(function() {
    KTDatatablesDataSourceHtml.init();
});


async function editSport( data )
{
    //var data = JSON.parse(item);
    if(data){
        const { value: formValues } = await Swal.fire({
            title: 'Edit Sport',
            showCancelButton: true,
            confirmButtonText: `Save`,
            html:
    
              '<label class="col-sm-12" style = "text-align: left;">Name</label><input id="swal-input_name" class="swal2-input" value = '+data["name"]+'>' +
              '<label class="col-sm-12" style = "text-align: left;">Link</label><input id="swal-input_link" class="swal2-input" value = '+data['link']+'>',
            focusConfirm: false,
            preConfirm: () => {
              return {
                "name" : document.getElementById('swal-input_name').value,
                "link"   : document.getElementById('swal-input_link').value
              }
            }
          })
    
      if (formValues) {
        $.ajax({
            type: 'POST',
            url: base_url + "admin/sport/ajaxUpdateSport",
            data: {
                id : data["id"],
                name:formValues["name"],
                link:formValues["link"]
            },
            dataType: "json",
            success: function(resultData) { 
                if(resultData == "1"){
                    Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: 'Your work has been saved',
                        showConfirmButton: false,
                        timer: 1500
                      })
                      dataTable.ajax.reload();
                } else {

                }
            }
        });
      }
    } else {
        const { value: formValues } = await Swal.fire({
            title: 'Create Sport',
            showCancelButton: true,
            confirmButtonText: `Save`,
            html:
    
              '<label class="col-sm-12" style = "text-align: left;">Name</label><input id="swal-input_name" class="swal2-input" value = "">' +
              '<label class="col-sm-12" style = "text-align: left;">Link</label><input id="swal-input_link" class="swal2-input" value = "">',
            focusConfirm: false,
            preConfirm: () => {
              return {
                "name" : document.getElementById('swal-input_name').value,
                "link"   : document.getElementById('swal-input_link').value
              }
            }
          })
    
      if (formValues) {
        $.ajax({
            type: 'POST',
            url: base_url + "admin/sport/ajaxCreateSport",
            data: {
                name:formValues["name"],
                link:formValues["link"]
            },
            dataType: "json",
            success: function(resultData) { 
                if(resultData == "1"){
                    Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: 'Your work has been saved',
                        showConfirmButton: false,
                        timer: 1500
                      })
                      dataTable.ajax.reload();  
                } else {

                }
            }
        });
      }
    }

}