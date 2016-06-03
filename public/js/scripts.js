$(document).ready(function() {
	//var w = $("#widget").width();
	//alert("w");
	$("div.texto").each(function(){
		//$(this).html("");
        var idt = $(this).attr("id");
        //alert(idt);
        var widget = $(this).find("div.widget");
        var idw = widget.attr("id");
        //alert(idw);
        var img = $(this).find("div.convertir");
        if (idw == idt) {
    		html2canvas($(img), {
                onrendered: function(canvas) {
                    theCanvas = canvas;
                    document.body.appendChild(canvas);

                    // Convert and download as image 
                    //Canvas2Image.saveAsPNG(canvas); 
                    //widget = $(this).find("div.widget");
                    //widget.append(canvas);
                    $(widget).append(canvas);
                    Canvas2Image.saveAsPNG(canvas); 
                    //$(this).html("");
                    // Clean up 
                    //document.body.removeChild(canvas);
                }
        	});
            //alert("fin if");
        };
	});
    //$("div.convertir").remove();
});