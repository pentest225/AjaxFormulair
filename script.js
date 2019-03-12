var form =document.getElementById('contact-form');
var error =document.getElementById('error');

form.addEventListener('submit',function(e){
    e.preventDefault();
    var xhr =new XMLHttpRequest()
    xhr.onreadystatechange=function(){
        if (xhr.readyState ===4){
            error.innerHTML=xhr.responseText;
            
        }
    }
    xhr.open('')
})
