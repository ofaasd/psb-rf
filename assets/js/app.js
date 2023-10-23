    $(document).ready(function(){
        var i = $("#tpl tr").length;
        $(".addNew").click(function(){
        if(i>=0)
        {
            $("#tpl").append('<tr class="add'+i+'"><td>'+i+'</td><td><input type="text" required class="form-control" name="code['+i+']" id="pl_'+i+'"/></td><td><input type="text" required class="form-control" name="desc['+i+']" readonly></td><td><input type="text" name="price['+i+']" class="form-control"></td><td><input type="text" name="qty['+i+']" class="form-control"></td></tr>');
            i++;
         } 
         else
         {
            i=1;
         }          
        return false;
        });
	    $(".remNew").click(function(){
            if(i>0)
            {
                i--;
	           $(".add"+i).remove();
            }
            else
            {
                i=1;
            }
           return false;
	    });
    });


;