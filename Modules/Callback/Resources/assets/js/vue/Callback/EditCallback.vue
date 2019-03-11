<template>
    <v-container>
        <v-layout wrap row>
            <v-progress-circular v-if="loader" indeterminate :size="100" color="primary"></v-progress-circular>
            <v-flex v-if="!loader">
                <v-card>
                    <v-card-title>
                        <h1>Редактирование Callback</h1>
                    </v-card-title>
                    <v-card-text>
                        <v-container>
                            <v-layout row wrap>
                                <v-flex>
                                    <v-form ref="form" lazy-validation v-model="valid">
                                        <template v-for="(field, num) in fields">
                                            <form-builder :field="field" v-if="num!=='description'" :num="num" :items="item" @update="updateField"></form-builder>
                                        </template>
                                        <wysiwyg
                                            :element-id="id"
                                            name="description"
                                            url="image-wysiwyg-upload"
                                            url-file="upload-file"
                                            type-file-upload="file"
                                            type-file="image-wysiwyg"
                                            model=""
                                            v-model="item.description">
                                        </wysiwyg>
                                        <file-box url="/files/upload" :fileable-id="Number(item.id)" :type-files="typeFiles" :model="model"></file-box>
                                        <v-flex text-xs-left>
                                            <v-btn large :class="{primary: valid, 'red lighten-3': !valid}" :disabled="isSending" @click.prevent="onSubmit">Сохранить</v-btn>
                                        </v-flex>
                                    </v-form>
                                </v-flex>
                            </v-layout>
                        </v-container>
                    </v-card-text>
                </v-card>
            </v-flex>
        </v-layout>
    </v-container>
</template>
<script>
    import { mapActions, mapState, mapMutations } from 'vuex'
    import { ACTIONS, GLOBAL } from '@/constants'
    import formBuilder from '@/vue/FormBuilder'
    import Wysiwyg from '@/vue/Wysiwyg.vue'
    //import fileBox from '@file/components/file-box/FileBox'
    export default {
        props: {
            id: {
                type: String,
                required: true
            },
        },
        data: function() {
            return {
                valid: false,
                loader: true,
                isSending: false
            }
        },
        beforeRouteEnter(to, from, next) {
            next(vm => {
                vm.init(to.params.id)
                vm.loader = false
            })
        },
        beforeRouteUpdate(to, from, next) {
            this.init(to.params.id)
            this.loader = false
            next()
        },
        computed: {
            ...mapState('Callback', ['item', 'items', 'fields', 'model'])
        },
        watch: {
            'fields' (to, from) {
                if(!_.isEmpty(to)) {
                    this.updateRelations(this.item.type_product_id)
                }
            }
        },
        components: {
            formBuilder,
            //fileBox
        },
        methods: {
            ...mapActions('Callback',{
                save: ACTIONS.SAVE_DATA,
                updateField: ACTIONS.UPDATE_FIELD,
                getAttributes: ACTIONS.ATTRIBUTES,
                updateRelations: ACTIONS.UPDATE_RELATIONS
            }),
            ...mapMutations('initializer', {resetError: 'RESET_ERROR'}),
            init(id) {
                this.resetError();
                if(this.items.length == 0) {
                    this.$router.push({name: 'products'})
                }
            },
            onSubmit() {
                if(this.$refs.form.validate()) {
                    this.isSending = true
                    this.save(this.item).then(response => {
                        this.isSending = false
                    })
                }
            },
        }
    }
</script>