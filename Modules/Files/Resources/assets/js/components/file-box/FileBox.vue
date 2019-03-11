<template>
    <div>
        <h2>Область загрузки файлов</h2>
        <vue-dropzone
                ref="productDropzone"
                :options="dropzoneOptions"
                :include-styling="false"
                @vdropzone-thumbnail="thumbnail"
                @vdropzone-success="showSuccess"
                @vdropzone-error="showError"
                @vdropzone-mounted="dropzoneMounted"
                @vdropzone-removed-file="fileRemoved"
                @vdropzone-sending="vsending"
                id="customdropzone"
                :destroyDropzone="false">
        </vue-dropzone>
    </div>
</template>

<script>
    import vueDropzone from 'vue2-dropzone'

    export default {
        props: {
            'url': {
                type: String,
                required: true
            },
            'fileableId': {
                type: Number,
                required: true
            },
            'typeFiles' :  {
                type: Array,
                required: true
            },
            'model': {
                type: String,
                required: true
            }
        },
        data: function() {
            return {
                dropzoneOptions: {
                    dictDefaultMessage: '<br>Переместите файлы для загрузки ',
                    url: this.url,
                    thumbnailWidth: 150,
                    previewTemplate: this.template(),
                    addRemoveLinks: true,
                    headers: { 'X-CSRF-TOKEN': window.token },
                    maxFiles: 5,
                },
                errorMessage: ''
            }
        },
        components: {
            vueDropzone
        },
        mounted() {
            this.getImages()
        },
        watch: {
            fileableId: function (val) {
                $(".dz-preview").remove();
                this.getImages()
            }
        },
        beforeRouteEnter(to, from, next) {
            console.log('work')
            next(vm => vm.getImages())
        },
        beforeRouteUpdate(to, from ,next) {
            console.log('work2')
          this.getImages()
          next()
        },
        methods: {
            template() {
                return `
                    <div class="dz-preview dz-file-preview" id="drop-img-vue">
                        <div class="dz-image">
                            <div data-dz-thumbnail-bg></div>
                        </div>
                        <div class="dz-details">
                            <div class="dz-size"><span data-dz-size></span></div>
                            <div class="dz-filename"><span data-dz-name></span></div>
                        </div>
                        <div class="dz-progress"><span class="dz-upload" data-dz-uploadprogress></span></div>
                        <div class="dz-error-message"><span data-dz-errormessage></span></div>
                        <div class="dz-success-mark"><i class="fa fa-check"></i></div>
                        <div class="dz-error-mark"><i class="fa fa-close"></i></div>
                        <a class="dz-remove ms" href="javascript:undefined;" data-dz-remove="">Удалить</a>
                    </div>
            `;
            },
            thumbnail: function(file, dataUrl) {
                var j, len, ref, thumbnailElement;
                if (file.previewElement) {
                    file.previewElement.classList.remove("dz-file-preview");
                    ref = file.previewElement.querySelectorAll("[data-dz-thumbnail-bg]");
                    for (j = 0, len = ref.length; j < len; j++) {
                        thumbnailElement = ref[j];
                        thumbnailElement.alt = file.name;
                        thumbnailElement.style.backgroundImage = 'url("' + dataUrl + '")';
                    }
                    return setTimeout(((function(_this) {
                        return function() {
                            return file.previewElement.classList.add("dz-image-preview");
                        };
                    })(this)), 1);
                }
            },
            vsending(file, xhr, formData) {
                formData.append('fileableId',this.fileableId);
                formData.append('typeFiles', this.typeFiles);
                formData.append('model', this.model);
            },
            showSuccess(file,data) {
                //this.getImages()
                /*var $element = document.getElementById("files-id");
                var ids = JSON.parse($element.value);
                //console.log('Data:'+data);
                //console.log('File:'+file);
                ids.push(data.id);
                $element.value = JSON.stringify(ids);*/
            },
            showError(file, message, xhr) {
                let response = xhr.response;
                let parse = JSON.parse(response, (key, value)=>{
                    return value;
                });
                $('.dz-error-message span').text(parse.message);
                //this.errorMessage = 'error';
                //console.log('Error: ',message);
                //console.log(message.message)
            },
            fileRemoved(file)  {
                let id = undefined;
                if(file.xhr) {
                    let resp = JSON.parse(file.xhr.response)
                    id = resp.id;
                }
                else {
                    id = file.id;
                }
                if(id) {
                    axios.get('/files/delete-file/'+id, {}).then(function (response) {
                    }).catch(function (error)
                    {
                        console.log(error);
                    });
                }
                else {
                    console.log('Не существующий id')
                }
            },
            dropzoneMounted() {
                //this.getImages()
                /*let dropzone = this.$refs.productDropzone;
                axios.post('/files/get-images/', {'id':this.fileableId, 'model': this.model}).then(function (response)
                {
                    console.log("Images: ",response.data)
                    response.data.forEach(function(item) {
                        if(item.config.files["small"]) {
                            let id = item.id;
                            let filename = item.config.files["small"].filename;
                            let size = item.config.files["small"].size;
                            let mockFile = {id: id, name: filename, size: size};
                            dropzone.manuallyAddFile(mockFile,"/storage/"+filename,null,null,{dontSubstractMaxFiles: false, addToFiles: true});
                        }
                    });
                }).catch(function (error)
                {
                    console.log(error);
                });*/
            },
            getImages() {
                let dropzone = this.$refs.productDropzone;
                axios.post('/files/get-images', {id:this.fileableId, model: this.model}).then(function (response)
                {
                    response.data.forEach(function(item) {
                        if(item.config.files["main"]) {
                            let id = item.id;
                            let filename = item.config.files["main"].filename;
                            let size = item.config.files["main"].size;
                            let mockFile = {id: id, name: filename.slice(0,19), size: size};
                            dropzone.manuallyAddFile(mockFile,"/storage/"+filename,null,null,{dontSubstractMaxFiles: false, addToFiles: true});
                        }
                    });
                }).catch(function (error)
                {
                    console.log(error);
                });
            }
        }
    }
</script>
<style>
    #customdropzone {
        background-color: #3949AB;
        font-family: 'Arial', sans-serif;
        letter-spacing: 0.2px;
        color: #777;
        transition: background-color .2s linear;
        height: 230px;
        padding: 40px;
    }
    #customdropzone .dz-preview {
        width: 160px;
        display: inline-block
    }
    #customdropzone .dz-preview .dz-image {
        width: 80px;
        height: 80px;
        margin-left: 40px;
        margin-bottom: 10px;
    }
    #customdropzone .dz-preview .dz-image > div {
        width: inherit;
        height: inherit;
        border-radius: 50%;
        background-size: cover;
    }
    #customdropzone .dz-preview .dz-image > img {
        width: 100%;
    }
    #customdropzone .dz-preview .dz-details {
        color: white;
        transition: opacity .2s linear;
        text-align: center;
    }
    #customdropzone .dz-success-mark, .dz-error-mark, .dz-remove {
        display: none;
    }
    #customdropzone .dz-error-message {
        color: red;
    }
    #customdropzone .dz-preview .dz-remove {
        color: white;
    }
    .ms {
        display: block;
        text-align: center;
        text-decoration: none;
    }
</style>
