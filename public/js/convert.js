$(function () {
    
    $(document).on('submit','#form-converter',function(e){
        e.preventDefault();
        $('.alert').hide();       

        let $loading = '<strong>Loading... </strong><div class="spinner-grow text-primary" role="status">'+
        '<span class="sr-only">Loading...</span>'+
        '</div>'+
        '<div class="spinner-grow text-primary" role="status">'+
        '<span class="sr-only">Loading...</span>'+
        '</div>'+
        '<div class="spinner-grow text-primary" role="status">'+
        '<span class="sr-only">Loading...</span>'+
        '</div>'+
        '<div class="spinner-grow text-primary" role="status">'+
        '<span class="sr-only">Loading...</span>'+
        '</div>'+
        '<div class="spinner-grow text-primary" role="status">'+
        '<span class="sr-only">Loading...</span>'+
        '</div>';

        $("#loading-badge").append($loading);

        this.submit();
    })



});