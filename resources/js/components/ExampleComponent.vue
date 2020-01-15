<template>
    <div class="container">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">Placa</th>
                    <th scope="col">Marca</th>
                    <th scope="col">Propietario</th>
                    <th scope="col">Conductor</th>
                </tr>
            </thead>
            <tbody>
                    <tr v-for="(item, index) in datos" :key="index">
                    <td>
                        <p>{{item.vehi_placa}}</p>
                    </td>
                    <td>
                        <p>{{item.vehi_marca}}</p>
                    </td>
                    <td>
                        <p>{{getprop(item.id_propietario)}}</p>
                    </td>
                    <td>
                        <p>{{getcond(item.id_conductor)}}</p>
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
    </div>
</template>

<script>
    export default {
        data() {
            return {
                datos:[],
                propietarios:[],
                conductores:[],
                dato:{id:'',vehi_placa:'',vehi_color:'',vehi_marca:'',vehi_tipo_vehiculo:'',id_propietario:'',id_conductor:''},
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
            
            axios.get('/vehiculo')
            .then(res=>{
                this.datos = res.data.vehiculo.data,
                this.propietarios = res.data.propietario,
                this.conductores = res.data.conductor,
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
            getprop(id)
            {
                return this.propietarios.find(element => element.id == id).prop_fnombre
            },
            getcond(id)
            {
                return this.conductores.find(element => element.id == id).prop_fnombre
            },
             getvehiculo: function(page){

               axios.get('vehiculo?page='+page)
                .then(res=>{
                this.datos = res.data.propietario.data,
                this.pagination = res.data.paginate
            })
            },
            changePage: function(page){
                this.pagination.current_page = page;
                this.getvehicul(page);
            }
        }
    }
</script>
