<template>
    <div>
        <div class="row">
            <div class="col-6" style="text-align: center    ;">       
                <h2 class="text-center">Cadastrar desenvolvedor</h2>
            </div>  
            <div class="col-6" style="text-align: right    ;">
                <router-link :to="{name: 'developer.list'}" class="btn btn-primary" title="Voltar"><i class="fa fa-list-ul"></i></router-link>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <form @submit.prevent="addDeveloper">
                    <div class="form-group">
                        <label>Nome</label>
                        <input type="text" class="form-control" v-model.trim="developer.nome" required>
                    </div> 
                    <div class="form-group">
                        <label>Sexo</label>
                         <select class="form-control" v-model="developer.sexo" required>                             
                            <option v-for="s in sexos"
                                :value="s.id">{{ s.nome }}
                            </option>                            
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
        methods: {
            addDeveloper() {
                this.axios
                    .post('/api/developers', this.developer)
                    .then(response => (
                        this.$router.push({ name: 'developer.list' })
                    ))
                     .catch(erro => {                        
                        this.$swal({ icon: 'error', title: erro.response.data.errors.name[0]});                                               
                    })
                    .finally(() => this.loading = false)
            }
        }
    }
</script>