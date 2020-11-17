var id;
$(function(){
    $(".show_this").hover(function(){
        $(".show_me").show();
    });

    $(".button1").click(function(){
 id = $(this).attr("id");
   

}); 



    

});

   
function submitContactForm(){
    

var reg = /^[A-Z0-9._%+-]+@([A-Z0-9-]+\.)+[A-Z]{2,4}$/i;
var name = $('#txt_name').val();
var message = $('#txt_desc').val();
if(name.trim() == '' ){
    alert('Please enter your name.');
    $('#txt_name').focus();
    return false;
}else if(name.trim() != '' && !reg.test(name)){
    alert('Please enter valid name.');
    $('#txt_name').focus();
    return false;
}else if(message.trim() == '' ){
    alert('Please Subcategory Description.');
    $('#txt_desc').focus();
    return false;
}else{
    $.ajax({
        type:'POST',
        url:'category.php',
        data:'contactFrmSubmit=1&name='+name+'&message='+message+'&id='+id,
        beforeSend: function () {
            $('.submitBtn').attr("disabled","disabled");
            $('.modal-body').css('opacity', '.5');
        },
        success:function(msg){
            
            if(msg == 'ok'){
                location.reload();
            }else{
                $('.statusMsg').html('<span style="color:red;">Some problem occurred, please try again.</span>');
                console.log("HEY");
            }
            $('.submitBtn').removeAttr("disabled");
            $('.modal-body').css('opacity', '');
        }
    });
}
}


