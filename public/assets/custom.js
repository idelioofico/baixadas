$('#tipo_destino').on('change', function() {
    var tipo_destino = $(this).val();
    if (tipo_destino == 1) {

        $('.site').css({
            'display': 'block'
        })

        $('.destino_do_material').css({
            'display': 'none'
        })
    }

    if (tipo_destino == 2) {

        $('.destino_do_material').css({
            'display': 'block'
        })

        $('.site').css({
            'display': 'none'
        })

    }

});



$(document).ready(function() {
    $('#myTable').DataTable({
        "pageLength": '10'
    });
});