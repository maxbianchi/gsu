/**
 * Created by max on 15/05/15.
 */
var id_elimina;
var manutenzione;

$(document).ready(function () {

    $('#main').dataTable({
        "iDisplayLength": 30,
        "lengthMenu": [[10, 30, 50, -1], [10, 30, 50, "All"]],
        "aaSorting": [],
        "fnInitComplete": function(oSettings, json) {
            $("#loader").hide();
            $("#main").show();
        }
    });

    $('#main tbody').on( 'click', 'tr', function () {
        if ( $(this).hasClass('selected') ) {
            $(this).removeClass('selected');
        }
        else {
            $('tr.selected').removeClass('selected');
            $(this).addClass('selected');
        }
    } );

    $("#reimposta").click(function(){
        $("input[type=text]").val("");
        $("input[type=checkbox]").attr("checked", false);
    });

    $( ".datepicker" ).datepicker({ dateFormat: 'dd-mm-yy' });


    $(".delete").click(function(){
        id_elimina = $(this).attr('delete-id');
        manutenzione = $(this).attr('manutenzione');
        $('#delete').modal('show');
    });

});