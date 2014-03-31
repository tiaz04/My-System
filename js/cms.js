/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
$( document ).ready(function() {

$('.deletebt').on("click",function(e){
    e.preventDefault();
    $('#deleteElement').modal('show');
    
    
    
    $('.btnDelete').attr("href",$(this).attr("href"));
});

});