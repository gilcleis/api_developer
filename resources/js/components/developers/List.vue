<template>
    <div>
       <div class="row">
            <div class="col-6" style="text-align: center    ;">       
                <h2 class="text-center">Lista de desenvolvedores</h2>
            </div>  
            <div class="col-6" style="text-align: right    ;">
                
                <router-link :to="{name: 'developer.create'}" class="btn btn-primary" title="Cadastrar Novo"><i class="fa fa-plus"></i> Cadastrar desenvolvedor</router-link>
            </div>
        </div>
        
       
        <table class="table">
            <thead>
            <tr>
                <!-- <th>ID</th> -->
                 <th>
                   Nome                
                </th>  
                <th>
                   sexo                
                </th> 
                <th>
                   idade                
                </th>  
                <th>
                   hobby                
                </th>    
                <th>
                   Data nascimento                
                </th>              
                <th>
                    Criado em                  
                </th>
                <!-- <th>Actions</th> -->
            </tr>
            </thead>
            <tbody>
            <tr v-for="developer in developers.data" :key="developer.id">
                <!-- <td>{{ developer.id }}</td> -->
                <td>{{ developer.nome }}</td>
                <td>{{ developer.sexo }}</td>
                <td>{{ developer.idade}}</td>
                <td>{{ developer.hobby }}</td>
                <td>{{ developer.datanascimento | formatDate }}</td>
                <td>{{ developer.created_at | formatDateTime }}</td>
                <td>
                    <div class="btn-group" role="group">
                        <router-link :to="{name: 'developer.edit', params: { id: developer.id }}" class="btn btn-success" title="Editar"><i class="fa fa-edit"></i></router-link>
                        <button class="btn btn-danger" @click="deleteDeveloper(developer.id)" title="Excluir"><i class="fas fa-fw fa-trash"></i></button>
                    </div>
                </td>
            </tr>
            </tbody>
        </table>
        <pagination :data="developers" @pagination-change-page="getResults"></pagination>
    </div>
</template>
 
<script>
    export default {
        data() {
            return {
                developers: {},
                interval:null
            }
        },
         created() {            
            this.getResults();
            this.interval = setInterval(function () {
                this.getResults();                  
                //console.log(new Date(),this.interval)             
            }.bind(this), 30000); 
        },
        beforeDestroy: function(){
            clearInterval(this.interval);
        },
        
     
        methods: {
           
           getResults() {
                axios.get('/api/developers')
                    .then(response => {
                        this.developers = response.data;
                    });
            },
             moment: function () {
                return moment();
            },
            deleteDeveloper(id) {
                this.$swal({
                    title: 'Tem certeza que deseja excluir?',                    
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    cancelButtonText:'Cancelar',
                    confirmButtonText: 'Sim, Exclua!'
                }).then((result) => {
                    if (result.value) {
                        axios.delete('/api/developers/' + id)
                            .then(response => {                                                      
                                this.$swal({title:'Excluido com sucesso!',icon: 'success'});                
                                this.getResults();
                            }).catch(errors  => {                                                          
                            this.$swal({ icon: 'error', title: errors.response.data.message, text: errors.response.data.errors[0],});
                        });
                    }
                })
            }           
        }
    }
</script>
