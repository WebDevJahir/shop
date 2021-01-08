/*price range*/

if ($.fn.slider) {
    $('#sl2').slider();
}

var RGBChange = function () {
    $('#RGB').css('background', 'rgb(' + r.getValue() + ',' + g.getValue() + ',' + b.getValue() + ')')
};

/*scroll to top*/

$(document).ready(function () {
    $(function () {
        $.scrollUp({
            scrollName: 'scrollUp', // Element ID
            scrollDistance: 300, // Distance from top/bottom before showing element (px)
            scrollFrom: 'top', // 'top' or 'bottom'
            scrollSpeed: 300, // Speed back to top (ms)
            easingType: 'linear', // Scroll to top easing (see http://easings.net/)
            animation: 'fade', // Fade, slide, none
            animationSpeed: 200, // Animation in speed (ms)
            scrollTrigger: false, // Set a custom triggering element. Can be an HTML string or jQuery object
            //scrollTarget: false, // Set a custom target element for scrolling to the top
            scrollText: '<i class="fa fa-angle-up"></i>', // Text for element, can contain HTML
            scrollTitle: false, // Set a custom <a> title if required.
            scrollImg: false, // Set true to use image
            activeOverlay: false, // Set CSS color to display scrollUp active point, e.g '#00FFFF'
            zIndex: 2147483647 // Z-Index for the overlay
        });
    });
});

$(document).ready(function(){
    $("#sellSize").change(function(){
        var idSize = $(this).val();
        if(idSize ==""){
            return false;
        }
        $.ajax({
            type:'get',
            url:'/get-product-price',
            data:{idSize:idSize},
            success:function(resp){
                var arr = resp.split('#');
                var arr1 = arr[0].split('-');
                $("#getPrice").html("TK "+arr1[0]+"<br><h2>USD "+arr1[1]+"<br>EUR "+arr1[2]+"<br>GBP "+arr1[3]+"</h2>");
                $("#price").val(arr1[0]);
                if(arr[1]==0){
                    $("#cartButton").hide();
                    $("#Availability").text('Out of Stock');
                }else{
                    $("#cartButton").show();
                    $("#Availability").text('In Stock');
                    }
            },error:function(){
                alert('Error');
            }
        });
    });
});

$(document).ready(function(){
    $(".changeImage").click(function(){

        var image = $(this).attr("src");
        $(".mainImage").attr("src",image);
    });
});

$('#current_password').keyup(function(){
    var current_password = $(this).val();
    $.ajax({
        headers:{
            'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
        },
        type:'post',
        url:'/check-user-password',
        data: {current_password:current_password},
        success:function(resp){
            if(resp=="false"){
                $("#check").html("<h6 style='color:red'>Current Password is Incorrect</h6>");
            }else if(resp=="true"){
                $("#check").html("<h6 style='color:green'>Current Password is Correct</h6>");
            }
        },error:function(){
                alert('Error');
        }
    });
});


$().ready(function(){
    $('#registerForm').validate({
        rules:{
            name:{
                required:true,
                minlength:4,
                lettersonly:true
            },
            password:{
                required:true,
                minlength:6
            },
            email:{
                required:true,
                email:true,
                remote: "/check-email"
            }
        },
        messages:{
            name:{
                required: "Please enter your name",
                minlength: "Your name must be atleast 4 characters long",
                lettersonly: "Your name must contain only letters"
            },
            password:{
            required:"Please provide your password",
            mimlength:"Your Password must be atleast 6 characters long"
            },
            email:{
                required:"Please enter your Email",
                email:"You should enter valid email",
                remote:"Email already existes"
            }
        }
    });

    $('#loginForm').validate({
        rules:{
            password:{
                required:true
            },
            email:{
                required:true,
                email:true
            }
        },
        messages:{
            password:{
            required:"Please provide your password"
            },
            email:{
                required:"Please enter your Email",
                email:"You should enter valid email"
            }
        }
    });
        $('#passwordForm').validate({
        rules:{
            current_password:{
                required: true,
                minlength:6,
                maxlength:20
            },
            new_password:{
                required: true,
                minlength:6,
                maxlength:20
            },
            confirm_password:{
                required:true,
                minlength:6,
                maxlength:20,
                equalTo:"#new_password"
            }
        },
        messages:{
            password:{
            required:"Please provide your password"
            },
            email:{
                required:"Please enter your Email",
                email:"You should enter valid email"
            }
        }
    });
    $('#accountForm').validate({
        rules:{
            name:{
                required:true,
                minlength:4,
                lettersonly:true
            },
            address:{
                required:true
            },
            city:{
                required:true
            },
            state:{
                required:true
            },
            country:{
                required:true
            },
            pincode:{
                required:true
            },
            mobile:{
                required:true
            }
        },
        messages:{
            name:{
                required: "Please enter your name",
                minlength: "Your name must be atleast 4 characters long",
                lettersonly: "Your name must contain only letters"
            },
            address:{
                required: "Please Enter your address"
            },
            city:{
                required: "Please enter your city"
            },
            state:{
                required: "Please enter the state"
            },
            country:{
                required: "Select your Conutry"
            },
            pincode:{
                required: "Enter your Zip Code"
            },
            mobile:{
                required: "Ener your phone number"
            }
        }
    });





$('#password').passtrength({
  passwordToggle:true,
  eyeImg :"images/fronted_image/eye.svg" // toggle icon
});

$('#billtoship').click(function(){
    if(this.checked){
        $('#shipping_name').val($('#billing_name').val());
        $('#shipping_address').val($('#billing_address').val());
        $('#shipping_city').val($('#billing_city').val());
        $('#shipping_state').val($('#billing_state').val());
        $('#shipping_pincode').val($('#billing_pincode').val());
        $('#shipping_mobile').val($('#billing_mobile').val());
        $('#shipping_country').val($('#billing_country').val());
    }else{
        $('#shipping_name').val('');
        $('#shipping_address').val('');
        $('#shipping_city').val('');
        $('#shipping_state').val('');
        $('#shipping_pincode').val('');
        $('#shipping_mobile').val('');
        $('#shipping_country').val('');
    }
});
});

function selectPaymentMethod(){
    if($('#Paypal').is(':checked') || $('#COD').is(':checked') || $('#Payumoney').is(':checked')) {
        return true;
    }else{
        alert("Please select payment method");
        return false;
    }
}

function checkPincode(){
    var pincode = $("#chkPincode").val();
    if(pincode == ""){
        alert("Please Enter Pincode"); return false;
    }
    $.ajax({
        headers:{
            'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
        },
        type:'post',
        url:'/check-pincode',
        data: {pincode :pincode},
        success:function(resp){
            if(resp>0){
                $("#pincodeResponse").html("<h6 style='color:green'>"+"This pincode is available"+"</h6>");
            }
            if(resp==0){
                $("#pincodeResponse").html("<h6 style='color:red'>"+"This pincode is not available"+"</h6>");
            }
        },error:function(){
            alert("Got a Error");
        }
    });
}
