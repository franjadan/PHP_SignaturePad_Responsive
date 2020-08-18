 <script src="https://cdn.jsdelivr.net/npm/signature_pad@2.3.2/dist/signature_pad.min.js"></script>
 <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.js"></script>
 <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

<style>
	#signature-pad {height: 300px}
	#signature-pad canvas {position: relative;left: 0;top: 0;width: 100%;height: 100%; backgroundColor: #000000;}
</style>


    <div class="container mt-5">
		<h1>Firmar contrato</h1>

		<div class="row">
		   <div style="background-color: red" class="col-6">
				<p class="text-center">PDF</p>
		   </div>

			<div class="col-6">
				<div id="savedSignature" class="mb-3"></div>
				<input type="hidden" id="signature" name="signature"/>
				<div id="signature-pad"><canvas style="border:1px solid #000" id="sign"></canvas></div>
				 <div class="mt-3">
                    <button type="button" class="btn btn-sm btn-secondary" data-action="clear">Limpiar</button>
                    <button type="button" class="btn btn-sm btn-primary" data-action="save">Guardar firma</button>
                 </div>
			</div>
		</div>
	</div>


<script>

$(document).ready(function() {
	var wrapper = document.getElementById("signature-pad");
	var clearButton = document.querySelector("[data-action=clear]");
    var saveButton = document.querySelector("[data-action=save]");
	var canvas = wrapper.querySelector("canvas");

	var sign = new SignaturePad(document.getElementById('sign'), {
	  backgroundColor: 'rgba(255, 255, 255, 0)',
	  penColor: 'rgb(0, 0, 0)'
	});
	
	function resizeCanvas() {
		var ratio =  Math.max(window.devicePixelRatio || 1, 1);

		canvas.width = canvas.offsetWidth * ratio;
		canvas.height = canvas.offsetHeight * ratio;
		canvas.getContext("2d").scale(ratio, ratio);
		
		if(document.getElementById("savedSignature").getElementsByTagName("img")[0] != undefined){
			document.getElementById("savedSignature").getElementsByTagName("img")[0].width = canvas.offsetWidth;

		}
		
	}

	window.onresize = resizeCanvas;
	resizeCanvas();
	
	clearButton.addEventListener("click", function(event) {
        sign.clear();
    });

    saveButton.addEventListener("click", function(event) {
        event.preventDefault();
        if(sign.isEmpty()) {
            alert("Debes añadir una firma primero");
        } else {
            var dataUrl = sign.toDataURL();
            $('#signature').val(dataUrl);
                
            var image = new Image();
            image.src = dataUrl;
			var savedSignature = document.getElementById("savedSignature");
            savedSignature.appendChild(image);
			savedSignature.getElementsByTagName("img")[0].width = canvas.offsetWidth;
        }
    });
});

</script>