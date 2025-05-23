window.preview_image = (event, querySelector) =>{

	//Recuperamos el input que desencadeno la acción
	let input = event.target;
	
	//Recuperamos la etiqueta img donde cargaremos la imagen
	let imgPreview = document.querySelector(querySelector);

	// Verificamos si existe una imagen seleccionada
	if(!input.files.length) return
	
	//Recuperamos el archivo subido
	let file = input.files[0];

	//Creamos la url
	let objectURL = URL.createObjectURL(file);
	
	//Modificamos el atributo src de la etiqueta img
	imgPreview.src = objectURL;

	//remover la clase hidden a label con id btn-quit
	let label = document.querySelector('#btn-quit');
	if(label){
		label.classList.remove('hidden');
	}
                
}

window.remove_preview = (event, selector) => {
    let image = document.querySelector(selector);
    image.src = 'https://dicesamexico.com.mx/wp-content/uploads/2021/06/no-image.jpeg';
    const label = document.querySelector('#btn-quit');
    if (label) {
        label.classList.add('hidden');
		image_path.value = 'delete';
    }
    
    // Resetear el input file
    const input = document.querySelector('input[type="file"]');
    if (input) {
        input.value = '';
    }
};