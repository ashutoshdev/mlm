<table>
    <tr>
        <td>Select Item</td>
        <td id="add_items">
            <?php echo $html; ?>
        </td>
    </tr>
    <tr>
        <td><button id="another">add More items</button></td>
    </tr>
</table>
<script type="text/javascript" src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $("#another").click(function(){
            $.ajax({
                url: "/items/retrieve/ajaxify",
                type: "GET",
                success: function(data){
                    $('#add_items').append(data);
                }
            });
            
        });        
    });
</script>