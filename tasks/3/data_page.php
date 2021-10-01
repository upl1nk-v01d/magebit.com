<html> 
<head>
	<title>display mysql data</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1, minimum-scale=1">

    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
</head>
<body>
    <div id="tabele"></div>
</body>
<script>
	    
        function get_data() {
			var r = null;
			$.ajax({
				async: false, 
				type: "GET",
				url: "mysql/db_gather_data.php",
				dataType:'json',
				success: function(data) {
					r = data;
				}
			});
			return r;
		};	
		
        function remove_row(id) {
    		$.ajax({
    			async: false, 
    			type: "POST",
    			data:{id:id},
    			url: "mysql/db_remove_row.php",
    			success: function(data) {
    					console.log(data);
    			}
    		});
    	}
		
		
        function json_to_arr(target){
            var arr = [];
            $.each(target, function(i, e){
                //console.log(e);
                $.each(e, function(key, val){
                    arr.push(val);
                    //console.log(key);
                });
            });
            return arr;
        }
        
        function comparer(index) {
            return function(a, b) {
                var valA = getCellValue(a, index), valB = getCellValue(b, index);
                return $.isNumeric(valA) && $.isNumeric(valB) ? valA - valB : valA.toString().localeCompare(valB);
            }
        }
        
        function getCellValue(row, index){ 
            return $(row).children('td').eq(index).text(); 
        }
        
        function append_img(e,img){
            $(e).append('<img src="../res/ic_'+img+'.png" style="display:inline-block; width:24px; height:18px">');
        }
        
		$('#tabele').append('<table id="data" font-size: 12px;"></table>');    
		$('#data').append('<tbody></tbody>');
		$('#data').prepend('<th>id</th><th>email</th><th>reg_date</th><th>rem</th>');
		$('th').css({'cursor' : 'pointer'});
		$('table').attr('border', '1');
		$('table, tr, td').css({'border' : '1px solid black', 'border-collapse' : 'collapse',});
		$('th:lt(3)').addClass('sortable');
		

	$(document).ready(function(){

        var data = json_to_arr(get_data());
        console.log(data);
        var mails = [ 'gmail', 'yahoo', 'outlook' ];
        
		for (c=0;c<data.length;c+=3){
				$("#data tbody").append('<tr><td class="td_id">'+data[c]+'</td><td class="td_email">'+data[c+1]+'</td><td class="td_reg_data">'+data[c+2]+'</td><td class="remove_btn">&#9997</td></tr>');
				
			        /*$.each(mails, function(i,v){
                        console.log(mails[i]);
                        if (data[c+1].indexOf(mails[i]>-1)) {
                            append_img('td:eq(1)','outlook');
                        }
                    });*/
				//append_img('tr td:eq(1)','outlook'); 
				$( "tr:eq("+c/3+") td:contains('outlook.com')" ).append('<img src="../res/ic_outlook.png" style="display:inline-block; width:24px; height:18px">');
				$( "tr:eq("+c/3+") td:contains('gmail.com')" ).append('<img src="../res/ic_gmail.png" style="display:inline-block; width:24px; height:18px">');
				$( "tr:eq("+c/3+") td:contains('yahoo.com')" ).append('<img src="../res/ic_yahoo.png" style="display:inline-block; width:24px; height:18px">');
				
		}
		
	//	if ($( "td:contains('outlook.com')" )) { append_img('td:eq(1)','outlook'); }

		$('td.remove_btn').css({'cursor' : 'pointer', 'text-align' : 'center'});

		$("#data").on('click', '.remove_btn', function () {
			if ($('#data tr').length>1){
				var n = $(this).next().text();
				remove_row($(this).closest("tr").find('td:first').text());
				$(this).closest('tr').remove();
			    //console.log($(this).closest("tr").find('td:first').text());
		}});
		
        $('th.sortable').click(function(){
            var table = $(this).parents('table').eq(0)
            var rows = table.find('tr').toArray().sort(comparer($(this).index()))
            this.asc = !this.asc
            if (!this.asc){rows = rows.reverse()}
            for (var i = 0; i < rows.length; i++){table.append(rows[i])}
        })
        
        $('th.sortable:eq(2)').click();
});
</script>
</html>