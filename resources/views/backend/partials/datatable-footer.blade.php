
<script>
    function logOutFrom(){
        event.preventDefault();
        var from = document.getElementById("logout");
        from.submit();
    }

    function deleteFrom(){
        if(confirm('Are you sure delete this')){
            event.preventDefault();
            var from = document.getElementById("delete");
            from.submit();
        }
    }

    function approvePostFrom(){
        if(confirm('Are you sure approve this')){
            event.preventDefault();
            var from = document.getElementById("approval-from");
            from.submit();
        }
    }

    // function adminFrom(){
    //     if(confirm('Are you sure make this user a admin?')){
    //         event.preventDefault();
    //         var from = document.getElementById("admin-from");
    //         from.submit();
    //     }
    // }

</script>

<script>
    ClassicEditor
        .create( document.querySelector( '#post-body' ) )
        .catch( error => {
            console.error( error );
        } );
</script>


    <!-- Jquery Core Js -->
    <script src="{{asset('/')}}backend-assets/plugins/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core Js -->
    <script src="{{asset('/')}}backend-assets/plugins/bootstrap/js/bootstrap.js"></script>

    <!-- Select Plugin Js -->
    <script src="{{asset('/')}}backend-assets/plugins/bootstrap-select/js/bootstrap-select.js"></script>

    <!-- Slimscroll Plugin Js -->
    <script src="{{asset('/')}}backend-assets/plugins/jquery-slimscroll/jquery.slimscroll.js"></script>

    <!-- Waves Effect Plugin Js -->
    <script src="{{asset('/')}}backend-assets/plugins/node-waves/waves.js"></script>

    <!-- Jquery DataTable Plugin Js -->
    <script src="{{asset('/')}}backend-assets/plugins/jquery-datatable/jquery.dataTables.js"></script>
    <script src="{{asset('/')}}backend-assets/plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js"></script>
    <script src="{{asset('/')}}backend-assets/plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js"></script>
    <script src="{{asset('/')}}backend-assets/plugins/jquery-datatable/extensions/export/buttons.flash.min.js"></script>
    <script src="{{asset('/')}}backend-assets/plugins/jquery-datatable/extensions/export/jszip.min.js"></script>
    <script src="{{asset('/')}}backend-assets/plugins/jquery-datatable/extensions/export/pdfmake.min.js"></script>
    <script src="{{asset('/')}}backend-assets/plugins/jquery-datatable/extensions/export/vfs_fonts.js"></script>
    <script src="{{asset('/')}}backend-assets/plugins/jquery-datatable/extensions/export/buttons.html5.min.js"></script>
    <script src="{{asset('/')}}backend-assets/plugins/jquery-datatable/extensions/export/buttons.print.min.js"></script>

    <!-- Custom Js -->
    <script src="{{asset('/')}}backend-assets/js/admin.js"></script>
    <script src="{{asset('/')}}backend-assets/js/pages/tables/jquery-datatable.js"></script>

    <!-- Demo Js -->
    <script src="{{asset('/')}}backend-assets/js/demo.js"></script>
</body>

</html>
