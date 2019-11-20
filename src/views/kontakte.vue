<template>
    <form @submit.prevent action="#">
        <div class="form-group row">
            <label for="name" class="col-sm-2 col-form-label">Name(*)</label>
            <div class="col-sm-10">
                <input :class="cssStyle.name" type="text" v-model="kontakt.name">
            </div>
        </div>
        <div class="form-group row">
            <label for="vorname" class="col-sm-2 col-form-label">Vorname(*)</label>
            <div class="col-sm-10">
                <input :class="cssStyle.vorname" type="text" v-model="kontakt.vorname">
            </div>
        </div>
            <div class="form-group row">
            <label for="vorname" class="col-sm-2 col-form-label">Strasse</label>
            <div class="col-sm-10">
                <input class="form-control" type="text" v-model="kontakt.strasse">
            </div>
        </div>
        <div class="form-group row">
            <label for="plz" class="col-sm-2 col-form-label">Plz</label>
            <div class="col-sm-2">
                <input class="form-control" type="text" v-model="kontakt.plz">
            </div>
            <label for="ort" class="col-sm-2 col-form-label">Ort</label>
            <div class="col-sm-6">
                <input class="form-control" type="text" v-model="kontakt.ort">
            </div>
        </div>
        <div class="form-group row">
            <label for="email" class="col-sm-2 col-form-label">Email(*)</label>
            <div class="col-sm-10">
                <input :class="cssStyle.email" type="text" v-model="kontakt.email">
            </div>
        </div>
            <div class="form-group row">
            <label for="telpriv" class="col-sm-2 col-form-label">Telefon Privat</label>
            <div class="col-sm-10">
                <input class="form-control" type="text" v-model="kontakt.tpriv">
            </div>
        </div>
            <div class="form-group row">
            <label for="telgesch" class="col-sm-2 col-form-label">Telefon Geschäft</label>
            <div class="col-sm-10">
                <input class="form-control" type="text" v-model="kontakt.tgesch">
            </div>
        </div>
        <div class="form-group row">
            <div class="col-auto">
                <button class="btn btn-outline-secondary" @click="senden">Senden</button>
                <button class="btn btn-outline-secondary" @click="abbrechen">Abbrechen</button>
            </div>
        </div>
    </form>
</template>
<script>
    export default{
        data(){
            return {
                kontakt:{name: '',vorname: '',strasse: '',plz: '',ort: '',email: '',tpriv: '', tgesch: ''},
                cssStyle:{name: 'form-control', vorname: 'form-control', email: 'form-control'}
            };
        },
        methods: {
            senden(){
                this.axios.post('/api/index.php',
                    {
                        id: 'kontakt',
                        func: 'speichern',
                        kontakt: this.kontakt
                    }
                )
                .then(response => {
                    if(response.data.status){
                        for(let el in this.cssStyle){
                            this.cssStyle[el] = 'form-control';
                        }
                    } else {
                        for(let el in response.data.data){
                            if(response.data.data[el]){
                                 this.cssStyle[el] = 'form-control';
                            } else {
                                 this.cssStyle[el] = 'form-control is-invalid';
                            }
                        }
                    }
                    console.log(response.data);
                })
                .catch(error => {
                    console.log(error);
                });
            },
            abbrechen(){
                for(let el in this.kontakt){
                    this.kontakt[el] = '';
                }
                for(let el in this.cssStyle){
                    this.cssStyle[el] = 'form-control';
                }
            }
        }
    }
</script>