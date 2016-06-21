$(document).ready(function() {

    var iFrame = $('<iframe name="uploadFrame" id="uploadFrame" src=""></iframe>').hide();

    $('body').append(iFrame);

    $('#uploadForm').attr('target', 'uploadFrame');


    $('#uploadForm').attr('action', 'new/things/addandedit/add?asyncUpload=1');

 

    $('#uploadForm').submit(function() {

        $('#uploadForm #submit').attr('disabled', 'disabled');

        $('#information').html('Wysy³anie pliku - proszê czekaæ');

        return true;

    });


    window.finishUpload = function(information) {

        $('#information').html(information);

        $('#uploadForm #submit').attr('disabled', '');

    }   

});
