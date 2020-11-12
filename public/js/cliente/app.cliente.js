$(document).ready(function (){
    if($(document).find('[class="alert alert-success"]')){
        setTimeout(() => {
            $(document).find('[class="alert alert-success text-center"]').remove()
        }, 3000);
    }
});