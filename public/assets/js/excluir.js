$(document).ready(function($){
    excluir();
});

function excluir(){
    $('.show_confirm').click(function( e ) {
        var form =  $(this).closest("form");
        var name = $(this).data("name");
        e.preventDefault();
        swal({
                title: "Tem certeza que deseja excluir esse registro!",
                icon: "warning",
                type: "warning",
                buttons: ["Cancelar","Sim!"],
            }).then((willDelete) => {
            if (willDelete) {
                form.submit();
            }
        });
    });
}
