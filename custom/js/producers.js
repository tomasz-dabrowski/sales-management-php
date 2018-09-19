var manageProducerTable;

$(document).ready(function() {
    // top bar active
    $('#navProducer').addClass('active');

    // manage producer table
    manageProducerTable = $("#manageProducerTable").DataTable({
        'ajax': 'controller/fetchProducer.php',
        'order': []
    });

    // submit producer form modal
    $("#submitProducerForm").unbind('submit').bind('submit', function() {
        // remove the error text
        $(".text-danger").remove();
        // remove the form error
        $('.form-group').removeClass('has-error').removeClass('has-success');

        var producerName = $("#producerName").val();
        var producerStatus = $("#producerStatus").val();

        if(producerName == "") {
            $("#producerName").after('<p class="text-danger">Producer Name field is required</p>');
            $('#producerName').closest('.form-group').addClass('has-error');
        } else {
            // remov error text field
            $("#producerName").find('.text-danger').remove();
            // success out for form
            $("#producerName").closest('.form-group').addClass('has-success');
        }

        if(producerStatus == "") {
            $("#producerStatus").after('<p class="text-danger">Producer Name field is required</p>');

            $('#producerStatus').closest('.form-group').addClass('has-error');
        } else {
            // remove error text field
            $("#producerStatus").find('.text-danger').remove();
            // success out for form
            $("#producerStatus").closest('.form-group').addClass('has-success');
        }

        // form filled
        if(producerName && producerStatus) {
            var form = $(this);
            // button loading
            $("#createProducerBtn").button('loading');

            $.ajax({
                url : form.attr('action'),
                type: form.attr('method'),
                data: form.serialize(),
                dataType: 'json',
                success:function(response) {
                    // button loading
                    $("#createProducerBtn").button('reset');

                    if(response.success == true) {
                        // reload the manage member table
                        manageProducerTable.ajax.reload(null, false);

                        // reset the form text
                        $("#submitProducerForm")[0].reset();
                        // remove the error text
                        $(".text-danger").remove();
                        // remove the form error
                        $('.form-group').removeClass('has-error').removeClass('has-success');

                        $('#add-producer-messages').html('<div class="alert alert-success">'+
                            '<button type="button" class="close" data-dismiss="alert">&times;</button>'+
                            '<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> '+ response.messages +
                            '</div>');

                        $(".alert-success").delay(500).show(10, function() {
                            $(this).delay(3000).hide(10, function() {
                                $(this).remove();
                            });
                        }); // /.alert
                    }  // if

                } // /success
            }); // /ajax
        } // if

        return false;
    }); // /submit producer form function

});

function editProducers(producerId = null) {
    if(producerId) {
        // remove hidden producer id text
        $('#producerId').remove();

        // remove the error
        $('.text-danger').remove();
        // remove the form-error
        $('.form-group').removeClass('has-error').removeClass('has-success');

        // modal loading
        $('.modal-loading').removeClass('div-hide');
        // modal result
        $('.edit-producer-result').addClass('div-hide');
        // modal footer
        $('.editProducerFooter').addClass('div-hide');

        $.ajax({
            url: 'controller/fetchSelectedProducer.php',
            type: 'post',
            data: {producerId : producerId},
            dataType: 'json',
            success:function(response) {
                // modal loading
                $('.modal-loading').addClass('div-hide');
                // modal result
                $('.edit-producer-result').removeClass('div-hide');
                // modal footer
                $('.editProducerFooter').removeClass('div-hide');

                // setting the producer name value
                $('#editProducerName').val(response.producer_name);
                // setting the producer status value
                $('#editProducerStatus').val(response.producer_active);
                // producer id
                $(".editProducerFooter").after('<input type="hidden" name="producerId" id="producerId" value="'+response.producer_id+'" />');

                // update producer form
                $('#editProducerForm').unbind('submit').bind('submit', function() {

                    // remove the error text
                    $(".text-danger").remove();
                    // remove the form error
                    $('.form-group').removeClass('has-error').removeClass('has-success');

                    var producerName = $('#editProducerName').val();
                    var producerStatus = $('#editProducerStatus').val();

                    if(producerName == "") {
                        $("#editProducerName").after('<p class="text-danger">Producer Name field is required</p>');
                        $('#editProducerName').closest('.form-group').addClass('has-error');
                    } else {
                        // remov error text field
                        $("#editProducerName").find('.text-danger').remove();
                        // success out for form
                        $("#editProducerName").closest('.form-group').addClass('has-success');
                    }

                    if(producerStatus == "") {
                        $("#editProducerStatus").after('<p class="text-danger">Producer Name field is required</p>');

                        $('#editProducerStatus').closest('.form-group').addClass('has-error');
                    } else {
                        // remove error text field
                        $("#editProducerStatus").find('.text-danger').remove();
                        // success out for form
                        $("#editProducerStatus").closest('.form-group').addClass('has-success');
                    }

                    if(producerName && producerStatus) {
                        var form = $(this);

                        // submit btn
                        $('#editProducerBtn').button('loading');

                        $.ajax({
                            url: form.attr('action'),
                            type: form.attr('method'),
                            data: form.serialize(),
                            dataType: 'json',
                            success:function(response) {

                                if(response.success == true) {
                                    console.log(response);
                                    // submit btn
                                    $('#editProducerBtn').button('reset');

                                    // reload the manage member table
                                    manageProducerTable.ajax.reload(null, false);
                                    // remove the error text
                                    $(".text-danger").remove();
                                    // remove the form error
                                    $('.form-group').removeClass('has-error').removeClass('has-success');

                                    $('#edit-producer-messages').html('<div class="alert alert-success">'+
                                        '<button type="button" class="close" data-dismiss="alert">&times;</button>'+
                                        '<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> '+ response.messages +
                                        '</div>');

                                    $(".alert-success").delay(500).show(10, function() {
                                        $(this).delay(3000).hide(10, function() {
                                            $(this).remove();
                                        });
                                    }); // /.alert
                                } // /if

                            }// /success
                        });	 // /ajax
                    } // /if

                    return false;
                }); // /update producer form

            } // /success
        }); // ajax function

    } else {
        alert('error!! Refresh the page again');
    }
} // /edit producers function

// remove producers function
function removeProducers(producerId = null) {

    if(producerId) {
        $('#removeProducerId').remove();
        $.ajax({
            url: 'controller/fetchSelectedProducer.php',
            type: 'post',
            data: {producerId : producerId},
            dataType: 'json',
            success:function(response) {
                $('.removeProducerFooter').after('<input type="hidden" name="removeProducerId" id="removeProducerId" value="'+response.producer_id+'" /> ');

                // click on remove button to remove the producer
                $("#removeProducerBtn").unbind('click').bind('click', function() {
                    // button loading
                    $("#removeProducerBtn").button('loading');

                    $.ajax({
                        url: 'controller/removeProducer.php',
                        type: 'post',
                        data: {producerId : producerId},
                        dataType: 'json',
                        success:function(response) {
                            console.log(response);
                            // button loading
                            $("#removeProducerBtn").button('reset');
                            if(response.success == true) {

                                // hide the remove modal
                                $('#removeProducerModal').modal('hide');

                                // reload the producer table
                                manageProducerTable.ajax.reload(null, false);

                                $('.remove-messages').html('<div class="alert alert-success">'+
                                    '<button type="button" class="close" data-dismiss="alert">&times;</button>'+
                                    '<strong><i class="fas fa-check"></i></strong> '+ response.messages +
                                    '</div>');

                                $(".alert-success").delay(500).show(10, function() {
                                    $(this).delay(3000).hide(10, function() {
                                        $(this).remove();
                                    });
                                }); // /.alert
                            } else {

                            } // /else
                        } // /response messages
                    }); // /ajax function to remove the producer

                }); // /click on remove button to remove the producer

            } // /success
        }); // /ajax

        $('.removeProducerFooter').after();
    } else {
        alert('error!! Refresh the page again');
    }
} // /remove producers function