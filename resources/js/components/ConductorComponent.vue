<template>
    <div class="container">
        <div class="row">
            <div class="col-md-6"><button class="btn btn-success" data-toggle="modal" data-target="#staticBackdrop">Nuevo Usuario</button></div>
            <div class="col-md-6">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="inputGroup-sizing-default">Buscar</span>
                    </div>
                    <input type="text" placeholder="Cedula" class="form-control" name="search" v-model="busqueda" @keyup.enter="buscar()"></div>
                </div>
        </div>
        
        <br>
        <br>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">id</th>
                    <th scope="col">Nombres</th>
                    <th scope="col">Apellidos</th>
                    <th scope="col">Cedula</th>
                    <th scope="col">Direccion</th>
                    <th scope="col">Telefono</th>
                    <th scope="col">Ciudad</th>
                    <th scope="col">Editar</th>
                    <th scope="col">Eliminar</th>
                </tr>
            </thead>
            <tbody>
                    <tr v-for="(item, index) in datos" :key="index">
                    <td>
                        <p>{{item.id}}</p>
                    </td>
                    <td>
                        <p>{{item.prop_fnombre}} {{item.prop_Lnombre}} </p>
                    </td>
                    <td>
                        <p>{{item.prop_apellidos}}</p>
                    </td>
                    <td>
                        <p>{{item.prop_cedula}}</p>
                    </td>
                    <td >
                        <p>{{item.prop_direccion}}</p>
                    </td>
                    <td>
                        <p>{{item.prop_telefono}}</p>
                    </td>
                    <td>
                        <p>{{item.prop_Ciudad}}</p>
                    </td>
                    <td>
                        <button class="btn btn-danger" type ="submit" @click="eliminar(item, index)">Eliminar</button>
                    </td>
                    <td>
                        <button class="btn btn-primary" data-target="#staticBackdrop2" data-toggle="modal" id="staticBackdropLabel" @click="info(item)">editar</button>
                    </td>
                    </tr>
                </tbody>
        </table>
        <nav aria-label="Page navigation example">
            <ul class="pagination">
                <li class="page-item" v-if="pagination.current_page > 1">
                    <a class="page-link" href="#" @click.prevent="changePage(pagination.current_page -1)">
                        <span>atras</span>
                    </a>
                </li>
                <li class="page-item" v-if="pagination.current_page < pagination.last_page">    
                    <a class="page-link" href="#" @click.prevent="changePage(pagination.current_page +1)">
                        <span>siguiente</span>
                    </a>
                </li>
                </ul>
            </nav>

        
        <div class="modal fade" id="staticBackdrop" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form role="form"  @submit.prevent="agregar">
                    <div class="modal-body">
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="inputEmail4">Primer Nombre</label>
                                <input type="text" class="form-control" v-model="dato.prop_fnombre" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputPassword4">Segundo Nombre</label>
                                <input type="text" class="form-control" v-model="dato.prop_Lnombre" required> 
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="inputEmail4">Apellidos</label>
                                <input type="text" class="form-control" v-model="dato.prop_apellidos" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputPassword4">Cedula</label>
                                <input type="number" class="form-control" v-model="dato.prop_cedula" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="inputEmail4">Direccion</label>
                                <input type="text" class="form-control" v-model="dato.prop_direccion" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputPassword4">Telefono</label>
                                <input type="text" class="form-control" v-model="dato.prop_telefono" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="inputEmail4">Ciudad</label>
                                <input type="text" class="form-control" v-model="dato.prop_Ciudad" required>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button class="btn btn-success" type="submit" >Guardar</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="modal fade" id="staticBackdrop2" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form role="form"  @submit.prevent="editar(dato)">
                    <div class="modal-body">
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="inputEmail4">Primer Nombre</label>
                                <input type="text" class="form-control" v-model="dato.prop_fnombre" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputPassword4">Segundo Nombre</label>
                                <input type="text" class="form-control" v-model="dato.prop_Lnombre" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="inputEmail4">Apellidos</label>
                                <input type="text" class="form-control" v-model="dato.prop_apellidos" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputPassword4">Cedula</label>
                                <input type="number" class="form-control" v-model="dato.prop_cedula" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="inputEmail4">Direccion</label>
                                <input type="text" class="form-control" v-model="dato.prop_direccion" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputPassword4">Telefono</label>
                                <input type="text" class="form-control" v-model="dato.prop_telefono" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="inputEmail4">Ciudad</label>
                                <input type="text" class="form-control" v-model="dato.prop_Ciudad" required>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button class="btn btn-success" type="submit" >Editar</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                datos:[],
                dato:{id:'',prop_fnombre:'',prop_Lnombre:'',prop_apellidos:'',prop_cedula:'',prop_direccion:'',prop_telefono:'',prop_Ciudad:''},
                busqueda:'',
                pagination:{
                    'total' : 0,
                    'current_page': 0,
                    'per_page' : 0,
                    'last_page' : 0,
                    'from' : 0,
                    'to':0,
                },
            }
        },
        created(){
            
            axios.get('/conductor')
            .then(res=>{
                this.datos = res.data.conductor.data,
                this.pagination = res.data.paginate
            })
        },
        computed:{
            isActive: function(){
                return this.pagination.current_page;
            },
            pagesNumber: function(){
                if(!this.pagination.to){
                    return[];
                }
                var from = this.pagination.current_page - 2;//todo offset
                if(from < 1){
                    from = 1;
                }
                var to = from + ( 2 * 2 );//todo
                if(to >= this.pagination.last_page){
                    to = this.pagination.last_page;
                }

                var pagesArray = [];
                while(from <= to){
                    pagesArray.push(from);
                    from++;
                }
                return pagesArray;
            }
        },
        methods:{
            agregar(){
            const datoNueva = this.dato;
            this.dato = {id:'',prop_fnombre:'',prop_Lnombre:'',prop_apellidos:'',prop_cedula:'',prop_direccion:'',prop_telefono:'',prop_Ciudad:''}
            axios.post('/conductor', datoNueva)
                .then((res) =>{
                const datoServidor = res.data;
                this.datos.push(datoServidor);
                })
            alert('Usuario Guardado con Correctamente');
            },

            eliminar(item ,index){
                const confirmacion = confirm(`desea eliminar el conductor: ${item.prop_fnombre}`);
                if (confirmacion) {
                    axios.delete(`/conductor/${item.id}`)
                    .then(()=>{
                        this.datos.splice(index,1);
                    })
                    .catch(function (error) {
                        alert('el usuario no se puede eliminar: se encunetra asociado a un vehiculo');
                    });
                }
            },
            info(item){
                this.dato.id = item.id;
                this.dato.prop_fnombre = item.prop_fnombre;
                this.dato.prop_Lnombre = item.prop_Lnombre;
                this.dato.prop_apellidos = item.prop_apellidos;
                this.dato.prop_cedula = item.prop_cedula;
                this.dato.prop_direccion = item.prop_direccion;
                this.dato.prop_telefono = item.prop_telefono;
                this.dato.prop_Ciudad = item.prop_Ciudad;

            },
            editar(dato){

                const params = {prop_fnombre: dato.prop_fnombre,prop_fnombre: dato.prop_fnombre,prop_Lnombre:dato.prop_Lnombre,prop_apellidos:dato.prop_apellidos,prop_cedula:dato.prop_cedula,
                prop_direccion:dato.prop_direccion,prop_telefono:dato.prop_telefono,prop_Ciudad:dato.prop_Ciudad}
                axios.put(`/conductor/${dato.id}`, params)
                    .then(res=>{
                        axios.get('/conductor')
                        .then(res=>{
                            this.datos = res.data.propietario.data
                        })
                    alert('Conductor Editado Correctamente'); 
                    })
                
                
            },
            buscar(){
                axios.get(`/conductores?prop_cedula=${this.busqueda}`)
                        .then(res=>{
                            this.datos = res.data;
                })
            },
             getconductor: function(page){

               axios.get('conductor?page='+page)
                .then(res=>{
                this.datos = res.data.propietario.data,
                this.pagination = res.data.paginate
            })
            },
            changePage: function(page){
                this.pagination.current_page = page;
                this.getconductor(page);
            }
        }
    }
</script>
