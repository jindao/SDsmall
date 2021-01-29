
var KTAppOptions = {
    "colors": {
        "state": {
            "brand": "#374afb",
            "light": "#ffffff",
            "dark": "#282a3c",
            "primary": "#5867dd",
            "success": "#34bfa3",
            "info": "#36a3f7",
            "warning": "#ffb822",
            "danger": "#fd3995"
        },
        "base": {
            "label": ["#c5cbe3", "#a1a8c3", "#3d4465", "#3e4466"],
            "shape": ["#f0f3ff", "#d9dffa", "#afb4d4", "#646c9a"]
        }
    }
};



function removeShoppingCartItem(id, reload) {
    manageShoppingCart('remove', id, reload);
}
function manageShoppingCart(action, article_id, reload) {

    if (action == 'add') {
        
    }
    if (action == 'remove') {
        
    }
    $.ajax({
        type: "POST",
        url: base_url + "home/manageShoppingCart",
        data: {article_id: article_id, action: action}
    }).done(function (data) {
        if (data == 0 )
        {
            $("#mycart_size").html( 0 );
            $("#mycart__body").html(
                '<div class="kt-mycart__section"></div><div class="kt-mycart__section m-2 mt-3 mb-3">' + 
                '<span class="kt-mycart__subtitle">0 item in cart</span>' + 
               '<button type="button" class="btn update-cart p-0 text-normal"> Update cart <i class="flaticon-refresh"></i></button>' + 
             '</div>' + 
             '<div class="kt-mycart__section p-1">' + 
               '<div class="kt-align-right p-1">' + 
                 '<span style = "left: 50px;position: absolute;" class="kt-mycart__subtitle">Subtotal:</span>' + 
                 '<span class="kt-mycart__price ml-3 text-normal">$ 0.00</span>' + 
               '</div>' + 
               '<div class="kt-align-right p-1">' + 
                 '<span style = "left: 50px;position: absolute;" class="kt-mycart__subtitle">Taxation:</span>' + 
                 '<span class="kt-mycart__price ml-3 text-normal">$ 0.00</span>' + 
               '</div>' + 
               '<div class="kt-align-right p-1">' + 
                 '<span style = "left: 50px;position: absolute;" class="kt-mycart__subtitle">Total:</span>' + 
                 '<span class="kt-mycart_price ml-3 text-green">$ 0.00</span>' + 
               '</div>' + 
             '</div>'
            );

            $("#checkout_cart_body").html(
                '<div class="kt-mycart__section m-2 mt-3 mb-5">' + 
                   ' <div class = "form-group row">' + 
                   ' <span class="kt-mycart__subtitle pl-4">0 item in cart</span>' + 
                   ' </div> ' + 
                   ' <div class="form-group row">' + 
                    '<label class="col-6 col-form-label pl-4 ft-1">Cupon Code</label>' + 
                    '<div class="col-6">' + 
                    '<input class="form-control" type="text" name="cuponcode" >' + 
                    '</div>' + 
                    '</div>' + 
                    '<div class="form-group row">' + 
                    '<button type="button" onclick = "manageShoppingCart(\'\' , \'\' );" class="btn update-cart p-0 text-normal">Update cart<i class="flaticon-refresh"></i></button>' + 
                    '</div>' + 
                '</div>' + 
                '<div class="kt-mycart__section p-2 ml-2 ">' + 
                 '   <div class="kt-mycart__price  pl-2">' + 
                 '   <span class="kt-mycart__subtitle text-normal ft-1">Subtotal:</span>' + 
                  '  <span class="ml-3 float-right text-normal ft-1">$ 0.00</span>' + 

                   ' </div>' + 
                    '<div class="kt-mycart__price  pl-2">' + 
                    '<span class="kt-mycart__subtitle text-normal ft-1">Taxation:</span>' + 
                    '<span class="kt-mycart__price float-right ml-3 text-normal ft-1">$ 0.00</span>' + 
                    '</div>' + 
                    '<hr class = "dashed-hr text-normal">' + 
                    '<div class="kt-mycart__price  pl-2">' + 
                    '<span class="kt-mycart__subtitle text-green ft-6">Order Total:</span>' + 
                    '<span class="kt-mycart_price float-right ml-3 text-green ft-6">$ 0.00</span>' + 
                    '</div>' + 
                '</div>' 
            );

            return 
        }
        var jsonData = JSON.parse(data); console.log(jsonData);
        var listStr = "";
          for(var i = 0 ; i < jsonData["array"].length ; i++){
                listStr += '<div class="kt-mycart__item alert alert-secondary alert-dismissible p-2 m-2">'
                listStr += '<span>' +   jsonData["array"][i]["season_name"] + '</span>';
                listStr +=  '<button type="button" class="close p-2 m-0" data-dismiss="alert" onclick="removeShoppingCartItem(\'' + jsonData["array"][i]["id"] + '\')">&times;</button>';
                listStr +=  '</div>';
            }

            $("#mycart_size").html(jsonData["array"].length);
            $("#mycart__body").html(
                '<div class="kt-mycart__section">'+listStr+'</div><div class="kt-mycart__section m-2 mt-3 mb-3">' + 
                '<span class="kt-mycart__subtitle">'+ jsonData["array"].length +' items in cart</span>' + 
               '<button type="button" class="btn update-cart p-0 text-normal"> Update cart <i class="flaticon-refresh"></i></button>' + 
             '</div>' + 
             '<div class="kt-mycart__section p-1">' + 
               '<div class="kt-align-right p-1">' + 
                 '<span style = "left: 50px;position: absolute;" class="kt-mycart__subtitle">Subtotal:</span>' + 
                 '<span class="kt-mycart__price ml-3 text-normal">$ '+ jsonData["finalSum"] +'</span>' + 
               '</div>' + 
               '<div class="kt-align-right p-1">' + 
                 '<span style = "left: 50px;position: absolute;" class="kt-mycart__subtitle">Taxation:</span>' + 
                 '<span class="kt-mycart__price ml-3 text-normal">$ 0.00</span>' + 
               '</div>' + 
               '<div class="kt-align-right p-1">' + 
                 '<span style = "left: 50px;position: absolute;" class="kt-mycart__subtitle">Total:</span>' + 
                 '<span class="kt-mycart_price ml-3 text-green">$ '+ jsonData["finalSum"] +'</span>' + 
               '</div>' + 
             '</div>'
            );

            $("#checkout_cart_body").html(
                '<div class="kt-mycart__section">'+listStr+'</div><div class="kt-mycart__section m-2 mt-3 mb-5">' + 
                   ' <div class = "form-group row">' + 
                   ' <span class="kt-mycart__subtitle pl-4">'+ jsonData["array"].length +' items in cart</span>' + 
                   ' </div> ' + 
                   ' <div class="form-group row">' + 
                    '<label class="col-6 col-form-label pl-4 ft-1">Cupon Code</label>' + 
                    '<div class="col-6">' + 
                    '<input class="form-control" type="text" name="cuponcode" >' + 
                    '</div>' + 
                    '</div>' + 
                    '<div class="form-group row">' + 
                    '<button type="button" onclick = "manageShoppingCart(\'\' , \'\' );" class="btn update-cart p-0 text-normal">Update cart<i class="flaticon-refresh"></i></button>' + 
                    '</div>' + 
                '</div>' + 
                '<div class="kt-mycart__section p-2 ml-2 ">' + 
                 '   <div class="kt-mycart__price  pl-2">' + 
                 '   <span class="kt-mycart__subtitle text-normal ft-1">Subtotal:</span>' + 
                  '  <span class="ml-3 float-right text-normal ft-1">$ '+ jsonData["finalSum"] +'</span>' + 

                   ' </div>' + 
                    '<div class="kt-mycart__price  pl-2">' + 
                    '<span class="kt-mycart__subtitle text-normal ft-1">Taxation:</span>' + 
                    '<span class="kt-mycart__price float-right ml-3 text-normal ft-1">$ 0.00</span>' + 
                    '</div>' + 
                    '<hr class = "dashed-hr text-normal">' + 
                    '<div class="kt-mycart__price  pl-2">' + 
                    '<span class="kt-mycart__subtitle text-green ft-6">Order Total:</span>' + 
                    '<span class="kt-mycart_price float-right ml-3 text-green ft-6">$ '+ jsonData["finalSum"] +'</span>' + 
                    '</div>' + 
                '</div>' 
            );

        if (action == 'add') {

        }
        if (action == 'remove') {
            
        }
        if (reload == true) {
            location.reload(false);
            return;
        } else if (typeof reload == 'string') {
            location.href = reload;
            return;
        }
        
    }).fail(function (err) {
        
    }).always(function () {
        if (action == 'add') {
            
        }
    });
}

function clearCart() {
    $.ajax({
        type: "POST",
        url: base_url + "home/clearShoppingCart",
        data: {}
    }).done(function (data) {
        
    })
    
}
