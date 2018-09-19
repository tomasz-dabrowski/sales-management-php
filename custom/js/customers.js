var manageCustomersTable;

$(document).ready(function() {
    // active sidebar customers
    $('#navCustomers').addClass('active');
    // manage customers table
    manageCustomersTable = $('#manageCustomersTable').DataTable({
        'ajax' : 'controller/fetchCustomers.php',
        'order': []
    });

    // submit customers form modal
    $('#addCustomersModalBtn').unbind('click').bind('click', function() {
        // reset the form text
        $("#submitCustomersForm")[0].reset();
        // remove the error text
        $(".text-danger").remove();
        // remove the form error
        $('.form-group').removeClass('has-error').removeClass('has-success');

        // submit customers form function
        $("#submitCustomersForm").unbind('submit').bind('submit', function() {

            // remove the error text
            $(".text-danger").remove();
            // remove the form error
            $('.form-group').removeClass('has-error').removeClass('has-success');

            var customersFirstName = $("#customersFirstName").val();
            var customersLastName = $("#customersLastName").val();
            var customersCompany = $("#customersCompany").val();
            var customersEmail = $("#customersEmail").val();
            var customersPhone = $("#customersPhone").val();
            var customersAddressStreet = $("#customersAddressStreet").val();
            var customersAddressNumber = $("#customersAddressNumber").val();
            var customersAddressPost = $("#customersAddressPost").val();
            var customersAddressCity = $("#customersAddressCity").val();


            if(customersFirstName == "") {
                $("#customersFirstName").after('<p class="text-danger">First Name is required</p>');
                $('#customersFirstName').closest('.form-group').addClass('has-error');
            } else {
                $("#customersFirstName").find('.text-danger').remove(); // remove error text
                $("#customersFirstName").closest('.form-group').addClass('has-success'); // success out for form
            }

            if(customersLastName == "") {
                $("#customersLastName").after('<p class="text-danger">Last Name is required</p>');
                $('#customersLastName').closest('.form-group').addClass('has-error');
            } else {
                $("#customersLastName").find('.text-danger').remove(); // remove error text
                $("#customersLastName").closest('.form-group').addClass('has-success'); // success out for form
            }

            if(customersCompany == "") {
                $("#customersCompany").after('<p class="text-danger">Company name is required</p>');
                $('#customersCompany').closest('.form-group').addClass('has-error');
            } else {
                $("#customersCompany").find('.text-danger').remove(); // remove error text
                $("#customersCompany").closest('.form-group').addClass('has-success'); // success out for form
            }

            if(customersEmail == "") {
                $("#customersEmail").after('<p class="text-danger">Email is required</p>');
                $('#customersEmail').closest('.form-group').addClass('has-error');
            } else {
                $("#customersEmail").find('.text-danger').remove(); // remove error text
                $("#customersEmail").closest('.form-group').addClass('has-success'); // success out for form
            }

            if(customersPhone == "") {
                $("#customersPhone").after('<p class="text-danger">Phone number is required</p>');
                $('#customersPhone').closest('.form-group').addClass('has-error');
            } else {
                $("#customersPhone").find('.text-danger').remove(); // remove error text
                $("#customersPhone").closest('.form-group').addClass('has-success'); // success out for form
            }

            if(customersAddressStreet == "") {
                $("#customersAddressStreet").after('<p class="text-danger">Street is required</p>');
                $('#customersAddressStreet').closest('.form-group').addClass('has-error');
            } else {
                $("#customersAddressStreet").find('.text-danger').remove(); // remove error text
                $("#customersAddressStreet").closest('.form-group').addClass('has-success'); // success out for form
            }

            if(customersAddressNumber == "") {
                $("#customersAddressNumber").after('<p class="text-danger">Required</p>');
                $('#customersAddressNumber').closest('.form-group').addClass('has-error');
            } else {
                $("#customersAddressNumber").find('.text-danger').remove(); // remove error text
                $("#customersAddressNumber").closest('.form-group').addClass('has-success'); // success out for form
            }

            if(customersAddressPost == "") {
                $("#customersAddressPost").after('<p class="text-danger">Required</p>');
                $('#customersAddressPost').closest('.form-group').addClass('has-error');
            } else {
                $("#customersAddressPost").find('.text-danger').remove(); // remove error text
                $("#customersAddressPost").closest('.form-group').addClass('has-success'); // success out for form
            }

            if(customersAddressCity == "") {
                $("#customersAddressCity").after('<p class="text-danger">City name is required</p>');
                $('#customersAddressCity').closest('.form-group').addClass('has-error');
            } else {
                $("#customersAddressCity").find('.text-danger').remove(); // remove error text
                $("#customersAddressCity").closest('.form-group').addClass('has-success'); // success out for form
            }

            if (customersFirstName && customersLastName && customersCompany && customersEmail && customersPhone
                && customersAddressStreet && customersAddressNumber && customersAddressPost && customersAddressCity) {

                var form = $(this);
                // button loading
                $("#createCustomersBtn").button('loading');

                $.ajax({
                    url : form.attr('action'),
                    type: form.attr('method'),
                    data: form.serialize(),
                    dataType: 'json',
                    success:function(response) {
                        // button loading
                        $("#createCustomersBtn").button('reset');

                        if(response.success == true) {
                            // reload the manage member table
                            manageCustomersTable.ajax.reload(null, false);

                            // reset the form text
                            $("#submitCustomersForm")[0].reset();
                            // remove the error text
                            $(".text-danger").remove();
                            // remove the form error
                            $('.form-group').removeClass('has-error').removeClass('has-success');

                            $('#add-customers-messages').html('<div class="alert alert-success">'+
                                '<button type="button" class="close" data-dismiss="alert">&times;</button>'+
                                '<strong><i class="fas fa-check-circle"></i> </strong> '+ response.messages +
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
        }); // submit customers form function
    }); // /on click on submit customers form modal

}); // /document

// edit customers function
function editCustomers(customersId = null) {
    if (customersId) {
        // remove the added customers id
        $('#editCustomersId').remove();
        // reset the form text
        $("#editCustomersForm")[0].reset();
        // reset the form text-error
        $(".text-danger").remove();
        // reset the form group errro
        $('.form-group').removeClass('has-error').removeClass('has-success');

        // edit customers messages
        $("#edit-customers-messages").html("");
        // modal spinner
        $('.modal-loading').removeClass('div-hide');
        // modal result
        $('.edit-customers-result').addClass('div-hide');
        //modal footer
        $(".editCustomersFooter").addClass('div-hide');

        $.ajax({
            url: 'controller/fetchSelectedCustomers.php',
            type: 'post',
            data: {customersId: customersId},
            dataType: 'json',
            success:function(response) {

                // modal spinner
                $('.modal-loading').addClass('div-hide');
                // modal result
                $('.edit-customers-result').removeClass('div-hide');
                //modal footer
                $(".editCustomersFooter").removeClass('div-hide');

                // set the values
                $("#editCustomersFirstName").val(response.first_name);
                $("#editCustomersLastName").val(response.last_name);
                $("#editCustomersCompany").val(response.company);
                $("#editCustomersEmail").val(response.email);
                $("#editCustomersPhone").val(response.phone);
                $("#editCustomersAddressStreet").val(response.address_street);
                $("#editCustomersAddressNumber").val(response.address_number);
                $("#editCustomersAddressPost").val(response.address_post);
                $("#editCustomersAddressCity").val(response.address_city);

                // add customer id
                $(".editCustomersFooter").after('<input type="hidden" name="editCustomersId" id="editCustomersId" value="'+response.customer_id+'" />');

                // submit of edit categories form
                $("#editCustomersForm").unbind('submit').bind('submit', function() {
                    var customersFirstName = $("#editCustomersFirstName").val();
                    var customersLastName = $("#editCustomersLastName").val();
                    var customersCompany = $("#editCustomersCompany").val();
                    var customersEmail = $("#editCustomersEmail").val();
                    var customersPhone = $("#editCustomersPhone").val();
                    var customersAddressStreet = $("#editCustomersAddressStreet").val();
                    var customersAddressNumber = $("#editCustomersAddressNumber").val();
                    var customersAddressPost = $("#editCustomersAddressPost").val();
                    var customersAddressCity = $("#editCustomersAddressCity").val();


                    if(customersFirstName == "") {
                        $("#editCustomersFirstName").after('<p class="text-danger">First Name is required</p>');
                        $('#editCustomersFirstName').closest('.form-group').addClass('has-error');
                    } else {
                        $("#editCustomersFirstName").find('.text-danger').remove(); // remove error text
                        $("#editCustomersFirstName").closest('.form-group').addClass('has-success'); // success out for form
                    }

                    if(customersLastName == "") {
                        $("#editCustomersLastName").after('<p class="text-danger">Last Name is required</p>');
                        $('#editCustomersLastName').closest('.form-group').addClass('has-error');
                    } else {
                        $("#editCustomersLastName").find('.text-danger').remove(); // remove error text
                        $("#editCustomersLastName").closest('.form-group').addClass('has-success'); // success out for form
                    }

                    if(customersCompany == "") {
                        $("#editCustomersCompany").after('<p class="text-danger">Company name is required</p>');
                        $('#editCustomersCompany').closest('.form-group').addClass('has-error');
                    } else {
                        $("#editCustomersCompany").find('.text-danger').remove(); // remove error text
                        $("#editCustomersCompany").closest('.form-group').addClass('has-success'); // success out for form
                    }

                    if(customersEmail == "") {
                        $("#editCustomersEmail").after('<p class="text-danger">Email is required</p>');
                        $('#editCustomersEmail').closest('.form-group').addClass('has-error');
                    } else {
                        $("#editCustomersEmail").find('.text-danger').remove(); // remove error text
                        $("#editCustomersEmail").closest('.form-group').addClass('has-success'); // success out for form
                    }

                    if(customersPhone == "") {
                        $("#editCustomersPhone").after('<p class="text-danger">Phone number is required</p>');
                        $('#editCustomersPhone').closest('.form-group').addClass('has-error');
                    } else {
                        $("#editCustomersPhone").find('.text-danger').remove(); // remove error text
                        $("#editCustomersPhone").closest('.form-group').addClass('has-success'); // success out for form
                    }

                    if(customersAddressStreet == "") {
                        $("#editCustomersAddressStreet").after('<p class="text-danger">Street is required</p>');
                        $('#editCustomersAddressStreet').closest('.form-group').addClass('has-error');
                    } else {
                        $("#editCustomersAddressStreet").find('.text-danger').remove(); // remove error text
                        $("#editCustomersAddressStreet").closest('.form-group').addClass('has-success'); // success out for form
                    }

                    if(customersAddressNumber == "") {
                        $("#editCustomersAddressNumber").after('<p class="text-danger">Required</p>');
                        $('#editCustomersAddressNumber').closest('.form-group').addClass('has-error');
                    } else {
                        $("#editCustomersAddressNumber").find('.text-danger').remove(); // remove error text
                        $("#editCustomersAddressNumber").closest('.form-group').addClass('has-success'); // success out for form
                    }

                    if(customersAddressPost == "") {
                        $("#editCustomersAddressPost").after('<p class="text-danger">Required</p>');
                        $('#editCustomersAddressPost').closest('.form-group').addClass('has-error');
                    } else {
                        $("#editCustomersAddressPost").find('.text-danger').remove(); // remove error text
                        $("#editCustomersAddressPost").closest('.form-group').addClass('has-success'); // success out for form
                    }

                    if(customersAddressCity == "") {
                        $("#editCustomersAddressCity").after('<p class="text-danger">City name is required</p>');
                        $('#editCustomersAddressCity').closest('.form-group').addClass('has-error');
                    } else {
                        $("#editCustomersAddressCity").find('.text-danger').remove(); // remove error text
                        $("#editCustomersAddressCity").closest('.form-group').addClass('has-success'); // success out for form
                    }

                    if (customersFirstName && customersLastName && customersCompany && customersEmail && customersPhone
                        && customersAddressStreet && customersAddressNumber && customersAddressPost && customersAddressCity) {

                        var form = $(this);
                        // button loading
                        $("#editCustomersBtn").button('loading');

                        $.ajax({
                            url : form.attr('action'),
                            type: form.attr('method'),
                            data: form.serialize(),
                            dataType: 'json',
                            success:function(response) {
                                // button loading
                                $("#editCustomersBtn").button('reset');

                                if(response.success == true) {
                                    // reload the manage member table
                                    manageCustomersTable.ajax.reload(null, false);

                                    // remove the error text
                                    $(".text-danger").remove();
                                    // remove the form error
                                    $('.form-group').removeClass('has-error').removeClass('has-success');

                                    $('#edit-customers-messages').html('<div class="alert alert-success">'+
                                        '<button type="button" class="close" data-dismiss="alert">&times;</button>'+
                                        '<strong><i class="fas fa-check-circle"></i> </strong> '+ response.messages +
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
                }); // /submit of edit categories form

            } // /success
        }); // /fetch the selected categories data

    } else {
        alert('Oops!! Refresh the page');
    }
} // /edit categories function

// remove categories function
function removeCustomers(customersId = null) {
    //$('#removeCustomersModal').remove();
    $.ajax({
        url: 'controller/fetchSelectedCustomers.php',
        type: 'post',
        data: {customersId: customersId},
        dataType: 'json',
        success:function(response) {

            // remove categories btn clicked to remove the categories function
            $("#removeCustomersBtn").unbind('click').bind('click', function() {
                // remove categories btn
                $("#removeCustomersBtn").button('loading');

                $.ajax({
                    url: 'controller/removeCustomers.php',
                    type: 'post',
                    data: {customersId: customersId},
                    dataType: 'json',
                    success:function(response) {
                        if(response.success == true) {
                            // remove categories btn
                            $("#removeCustomersBtn").button('reset');
                            // close the modal
                            $("#removeCustomersModal").modal('hide');
                            // update the manage categories table
                            manageCustomersTable.ajax.reload(null, false);

                            // udpate the messages
                            $('.remove-messages').html('<div class="alert alert-success">'+
                                '<button type="button" class="close" data-dismiss="alert">&times;</button>'+
                                '<strong></strong> '+ response.messages +
                                '</div>');

                            $(".alert-success").delay(500).show(10, function() {
                                $(this).delay(3000).hide(10, function() {
                                    $(this).remove();
                                });
                            }); // /.alert
                        } else {
                            // close the modal
                            $("#removeCustomersModal").modal('hide');

                            // udpate the messages
                            $('.remove-messages').html('<div class="alert alert-success">'+
                                '<button type="button" class="close" data-dismiss="alert">&times;</button>'+
                                '<strong><i class="fas fa-check-circle"></i> </strong> '+ response.messages +
                                '</div>');

                            $(".alert-success").delay(500).show(10, function() {
                                $(this).delay(3000).hide(10, function() {
                                    $(this).remove();
                                });
                            }); // /.alert
                        } // /else


                    } // /success function
                }); // /ajax function request server to remove the categories data
            }); // /remove categories btn clicked to remove the categories function

        } // /response
    }); // /ajax function to fetch the categories data
} // remove categories function