<script>
    $(document).ready(function() {
        $('.footer-menu-list').click(function() {
            $('.footer-menu-list').removeClass('active');
            $(this).addClass('active');
        });
        //mencari apakah ada class active pada child navbarDropdown
        if ($('#li_data').find('.active').length) {
            //jika ada maka akan menjalankan perintah dibawah
            //mencari child navbarDropdown yang memiliki class active
            $('#navbarDropdown').parent().addClass('active');
        }else{
            //jika tidak ada maka akan menjalankan perintah dibawah
            //mencari child navbarDropdown yang memiliki class active
            $('#navbarDropdown').parent().removeClass('active');
        }
        

    });
</script>