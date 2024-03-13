<script>
    function searchFocus() {
        if (document.sform.stext.value == 'Tìm kiếm sản phẩm...') {
            document.sform.stext.value = ''
        }
    }

    function searchBlur() {
        if (document.sform.stext.value == '') {
            document.sform.stext.value = 'Tìm kiếm sản phẩm...'
        }
    }
</script>

<form method="post" name="sform" action="index.php?page_layout=danhsachtimkiem">
    <input type="submit" name="sbutton" value="" />
    <input onfocus="searchFocus();" onblur="searchBlur();" type="text" name="stext" placeholder="tìm kiếm sản phẩm..." />
</form>