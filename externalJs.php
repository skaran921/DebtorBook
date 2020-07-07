<!-- include js files -->
    <script src="http://localhost/DebtorBook/js/jquery.js"></script>
    <script src="http://localhost/DebtorBook/js/popover.js"></script>
    <script src="http://localhost/DebtorBook/js/bootstrap.min.js"></script>
    <script src="http://localhost/DebtorBook/js/fontAwesome.js"></script>
     <script>
        //  this function open logout confirmation modal
        function openLogoutModal(){
            $('#logoutModal').modal({
                backdrop: 'static',
                keyboard: false
           });
        }

        const openInfoModal=()=>{
            $('#infoModal').modal({
                backdrop: 'static',
                keyboard: false
           });
        }
     </script>