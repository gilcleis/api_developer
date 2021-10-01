<template>
    <div>
        <div class="row">
            <div class="col-6" style="text-align: center    ;">       
                <h2 class="text-center">Editar desenvolvedor</h2>
            </div>  
            <div class="col-6" style="text-align: right    ;">
                <router-link :to="{name: 'developer.list'}" class="btn btn-primary" title="Voltar"><i class="fa fa-list-ul"></i></router-link>
            </div>
        </div>
        <div class="row">
            
            <div class="col-md-6">
                <form @submit.prevent="updateDeveloper">
                    <div class="form-group">
                        <label>Nome</label>
                        <input type="text" class="form-control" v-model.trim="developer.nome" required>
                    </div> 
                    <div class="form-group">
                        <label>Sexo</label>
                         <select class="form-control" v-model="developer.sexo" required>                            
                            <option v-for="s in sexos"
                                :value="s.id">{{ s.nome }}</option>
                        </select>                        
                    </div> 
                     <div class="form-group">
                        <label>Data Nascimento</label>
                        <input type="date" class="form-control" v-model.trim="developer.datanascimento" required>
                    </div>  
                    <div class="form-group">
                        <label>Hobby</label>
                        <input type="text" class="form-control" v-model.trim="developer.hobby" required>
                    </div>       
         
                    <button type="submit" class="btn btn-primary">Salvar</button>
                </form>
            </div>
        </div>
    </div>
</template>
 
<script>
    export default {
        data() {
            return {        
                developer: {},
                sexos: [{ id: 'F', nome: "Feminino" }, { id: 'M', nome: "Masculino" }],
            }
        },
        created() {
            this.axios                
                .get(`/api/developers/${this.$route.params.id}`)
                .then((res) => {
                    this.developer = res.data;                    
                });    
        },
        methods: {
            updateDeveloper() {
                this.axios
                    .patch(`/api/developers/${this.$route.params.id}`, this.developer)
                    .then((res) => {
                        this.transacaoStatus = 'sucess'
                        this.$router.push({ name: 'developer.list' });
                    })
                    .catch(erro => {
                        console.log(erro.response.data)
                        this.$swal({ icon: 'error', title: erro.response.data.errors.name[0]});                                               
                    });
            }
        }
    }
</script>