import Dropzone from "dropzone";
Dropzone.autoDiscover = false;
if(document.getElementById("dropzone")) {
    
    const dropzone = new Dropzone(".dropzone", {
        dictDefaultMessage: "Sube aquí tu imagen",
        acceptedFiles: ".png,.jpg,.jpeg,.gif",
        addRemoveLinks: true,
        dictRemoveFile: "Borrar archivo",
        maxFiles: 1,
        uploadMultiple: false,
        init: function(){

            if(document.querySelector('[name="imagen"]').value.trim()){
                const imagenPublicada={};
                imagenPublicada.size=1234;
                imagenPublicada.name=document.querySelector('[name="imagen"]').value;
                this.options.addedfile.call(this,imagenPublicada);
                this.options.thunbnail.call(this,imagenPublicada,'/uploads/${imagenPublicada.name}'); 

                imagenPublicada.previewElement.classList.add("dz-success","dz-complete");
            }
        },
    });
    // dropzone.on('sending',(file,xhr,formData)=>{
    //     console.log(formData);
    // });
    dropzone.on('success',(file,response)=>{

       // console.log(response);
        document.querySelector('[name="imagen"]').value=response.imagen;

    });
    // dropzone.on('error',(file,message)=>{
    //     console.log(message);
    // });
    dropzone.on('removedFile',function(){
     //   console.log("Archivo eliminado");
     
     document.querySelector('[name="imagen"]').value= "";
    });
}

