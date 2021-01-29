"use strict";
var KTSelect2 = function() {
    var validator;
    // Private functions
    var demos = function() {

        $('#country_id, #league_id,#category_id,#season_id').select2({
            placeholder: "Please select one"
        });
    }

    var initValidation = function () {
        validator = $( "#frmProductCreate" ).validate({
            // define validation rules
            rules: {
                season_from: {
                    
                },
                season_to: {
                    
                },
                category_id: {
                    required: true
                },
                country_id: {
                },
                league_id: {
                    required: true
                },
                season_id: {
                    required: true
                },

                price: {
                    required: true,
                    minlength: 2,
                    maxlength: 4
                },
                summary_columns: {
                    required: true
                },
                detail_columns: {
                    required: true
                },

                last_updated: {
                },

            },
            
            //display error alert on form submit  
            invalidHandler: function(event, validator) {             
            // var alert = $('#kt_form_1_msg');
            // alert.removeClass('kt-hidden').show();
            // KTUtil.scrollTo('#price', -200);
            },

            submitHandler: function (form) {
                console.log(form);
                form[0].submit(); // submit the form
            }
        });      
    }

    // Public functions
    return {
        init: function() {
            demos();
            initValidation();
        }
    };
}();


jQuery(document).ready(function() {
    //$('body').on('click', '.kt-menu__link[href="#"]', function(e) {
    //    swal.fire("Coming Soon...", "You have clicked on a non-functional dummy link!");
    //    e.preventDefault();
    //});

    KTSelect2.init();

    $('#last_updated').datepicker({
        todayHighlight: true,
        disabled: true,
        templates: {
            leftArrow: '<i class="la la-angle-left"></i>',
            rightArrow: '<i class="la la-angle-right"></i>'
        }
    }).unbind('focus');
    
    // $('#btnCreateProduct').on('click', function(e) {
    //    swal.fire("Coming Soon...", "You have clicked on a non-functional dummy link!");
    //    e.preventDefault();
    // });

    $('#category_id').on('change', function(e) {
        if($(this).val() != "")
            $.ajax({
                type: 'POST',
                url: base_url + "admin/product/ajaxLeagueList",
                data: {
                    sport_id : $('#category_id').val()
                },
                dataType: "json",
                success: function(resultData) { 
                    console.log(resultData);
                    var content = "<option></option>";
                    for( var i = 0 ; i < resultData.length ; i++) {
                        content += "<option value = '"+resultData[i].id+"' >" + resultData[i].name + "</option>";    
                    }
                    $("#league_id").html(content);
                    $('#league_id').select2({
                        placeholder: "Please select one"
                    });
                    if( category_id == $('#category_id').val())
                    {
                        $("#league_id").val(league_id).change();
                    }
                }
            });
    });

    $('#country_id').on('change', function(e) { 
        if($(this).val() != "" && ($("#league_id").val() != "") )
            $.ajax({
                type: 'POST',
                url: base_url + "admin/product/ajaxSeasonList",
                data: {
                    country_link : $('#country_id').find(":selected").attr('data-name'),
                    league_id : $('#league_id').val(),
                },
                dataType: "json",
                success: function(resultData) { 
                    console.log(resultData);
                    var content = "<option></option>";
                    for( var i = 0 ; i < resultData.length ; i++) {
                        var linkSplit = resultData[i].link.split("/"); 
                        var country_name = "";
                        if(linkSplit.length > 0)
                        {
                            country_name = linkSplit[2];
                        }
                        content += "<option value = '"+resultData[i].link+"' >" + resultData[i].name + "( "+country_name+" )" + "</option>"; 
                    }
                    $("#season_id").html(content);
                    $('#season_id').select2({
                        placeholder: "Please select one"
                    });
                }
            });
        $("#country_id1").val($(this).val());    
    });

    $('#league_id').on('change', function(e) {
        if($(this).val() != "" )
            $.ajax({
                type: 'POST',
                url: base_url + "admin/product/ajaxSeasonList",
                data: {
                    country_link : $('#country_id').find(":selected").attr('data-name'),
                    league_id : $('#league_id').val(),
                },
                dataType: "json",
                success: function(resultData) { 
                    console.log(resultData);
                    var content = "<option></option>";
                    for( var i = 0 ; i < resultData.length ; i++) {
                        var linkSplit = resultData[i].link.split("/"); 
                        var country_name = "";
                        if(linkSplit.length > 0)
                        {
                            country_name = linkSplit[2];
                        }
                        content += "<option value = '"+resultData[i].link+"' >" + resultData[i].name + "( "+country_name+" )" + "</option>";    
                    }
                    $("#season_id").html(content);
                    $('#season_id').select2({
                        placeholder: "Please select one"
                    });
                    if( league_id == $('#league_id').val())
                    {
                        $("#season_id").val(season_id).change();
                        $("#season_from").val(season_from);
                        $("#season_to").val(season_to);
                    }
                }
            });
    });

    $('#season_id').on('change', function(e) {
        if($(this).val() != "" )
        {
            var yearRegex = /(\d{4})/g;
            var years = $(this).val().match(yearRegex);
            if(years){
                $("#season_from").val(years[0]);
                if(years.length > 1)
                {
                    $("#season_to").val(years[1]);
                } else {
                    $("#season_to").val('');
                }
            } else {
                $("#season_to").val('');
                $("#season_from").val('');
            }
            
            var linkSplit = $(this).val().split("/"); 
            if(linkSplit.length > 0)
            {
                //$('#country_id option[data-name="'+linkSplit[2]+'"]').attr("selected", true);
                //$('#country_id').children().filter(function(){
                //    return $(this).attr("data-name") == linkSplit[2];
                //}).attr('selected', true);
                //$("#country_id").find('option[data-name="'+linkSplit[2]+'"]').attr('selected',"selected");
                //$("#country_id").change();
                $("#country_id1").val($("#country_id").find('option[data-name="'+linkSplit[2]+'"]').attr('value'));    
            }
            
        }
    });

    $("#category_id").val(category_id).change();
  
    $("#country_id").val(country_id).change();

});