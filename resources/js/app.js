import './bootstrap';
import '~resources/scss/app.scss';
import * as bootstrap from 'bootstrap';
import.meta.glob([
    '../img/**'
])


const inputImageFile = document.getElementById('new_image')
console.log(inputImageFile);
const previewImage = document.getElementById('preview-image')
const previewtext = document.getElementById('preview-text')

inputImageFile.addEventListener('change', function() {
    const fileLoaded = this.files[0];
    if(fileLoaded){
        const reader =new FileReader;
        reader.addEventListener('load', function(){
            previewImage.src = reader.result;
        })
        previewtext.innerHTML = 'Anteprima:'
        reader.readAsDataURL(fileLoaded)
    }
})