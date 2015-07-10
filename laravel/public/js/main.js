/**
 * Created by max on 15/05/15.
 */
var id_elimina;
var manutenzione;

$(document).ready(function () {

    $('#main').dataTable({
        "iDisplayLength": 30,
        "lengthMenu": [[10, 30, 50], [10, 30, 50]],
        "aaSorting": [],
        "bAutoWidth"       : true,
        "fnInitComplete": function(oSettings, json) {
            $("#loader").hide();
            $("#main_wrapper .row").first().before($("#main_wrapper .row").last())
            $("#main").show();
        }
    });


    $( ".datepicker" ).datepicker({ dateFormat: 'dd-mm-yy' });

    $.fn.hasAttr = function(name) {
        return this.attr(name) !== undefined;
    };

    $('body').on('click', '.delete', function() {
        id_elimina = 0;
        manutenzione = 0;
        if($(this).hasAttr('data-delete-id')) {
            id_elimina = $(this).attr('data-delete-id');
        }
        if($(this).hasAttr('data-manutenzione')) {
            manutenzione = $(this).attr('data-manutenzione');
        }
        $('#delete').modal('show');
    });



});
