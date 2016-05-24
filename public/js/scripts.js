$(document).ready(function() {
	//var w = $("#widget").width();
	//alert(w);
	$("div.texto").each(function(){
		//$(this).html("");
		html2canvas($(this), {
            onrendered: function(canvas) {
                theCanvas = canvas;
                document.body.appendChild(canvas);

                // Convert and download as image 
                //Canvas2Image.saveAsPNG(canvas); 
                $(this).find("div.widget").append(canvas);
                //$("div.texto.widget").append(canvas);
                //$(this).html("");
                // Clean up 
                //document.body.removeChild(canvas);
            }
    	});
	});
});