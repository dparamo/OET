<template>
  <div class="container">
    <div class="row">
      <div class="col-md-6">
        <button
          class="btn btn-success"
          data-toggle="modal"
          data-target="#staticBackdrop"
        >Nuevo vehiculo</button>
      </div>
      <div class="col-md-6">
        <div class="input-group mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text" id="inputGroup-sizing-default">Buscar</span>
          </div>
          <input
            type="text"
            placeholder="Placa"
            class="form-control"
            name="search"
            v-model="busqueda"
            @keyup.enter="buscar()"
          />
        </div>
      </div>
    </div>

    <br />
    <br />
    <table class="table table-striped">
      <thead>
        <tr>
          <th scope="col">id</th>
          <th scope="col">Placa</th>
          <th scope="col">Color</th>
          <th scope="col">Marca</th>
          <th scope="col">Tipo</th>
          <th scope="col">Propietario</th>
          <th scope="col">Conductor</th>
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
            <p>{{item.vehi_placa}}</p>
          </td>
          <td>
            <p>{{item.vehi_color}}</p>
          </td>
          <td>
            <p>{{item.vehi_marca}}</p>
          </td>
          <td>
            <p>{{item.vehi_tipo_vehiculo}}</p>
          </td>
          <td>
            <p>{{getprop(item.id_propietario)}}</p>
          </td>
          <td>
            <p>{{getcond(item.id_conductor)}}</p>
          </td>
          <td>
            <button class="btn btn-danger" type="submit" @click="eliminar(item, index)">Eliminar</button>
          </td>
          <td>
            <button
              class="btn btn-primary"
              data-target="#staticBackdrop2"
              data-toggle="modal"
              id="staticBackdropLabel"
              @click="info(item)"
            >editar</button>
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

    <div
      class="modal fade"
      id="staticBackdrop"
      data-backdrop="static"
      tabindex="-1"
      role="dialog"
      aria-labelledby="staticBackdropLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form role="form" @submit.prevent="agregar">
            <div class="modal-body">
              <div class="row">
                <div class="form-group col-md-6">
                  <label for="PlacaMod">Placa</label>
                  <input type="text" name="PlacaMod" id="PlacaMod" class="form-control" v-model="dato.vehi_placa" onkeypress="TextAndNumberMax6(event)" required  />
                </div>
                <div class="form-group col-md-6">
                  <label for="inputPassword4">Color</label>
                  <input
                    type="text"
                    class="form-control"
                    v-model="dato.vehi_color"                    
                    onkeypress="TextOnly(event)" required
                  />
                </div>
              </div>
              <div class="row">
                <div class="form-group col-md-6">
                  <label for="inputEmail4">Marca</label>
                  <input type="text" class="form-control" v-model="dato.vehi_marca" onkeypress="TextOnlyWhiteSpace(event)"  required />
                </div>
                <div class="form-group col-md-6">
                  <label for="inputPassword4">Tipo</label>
                  <select class="form-control" v-model="dato.vehi_tipo_vehiculo" required>
                    <option value="particular">particular</option>
                    <option value="publico">publico</option>
                  </select>
                </div>
              </div>
              <div class="row">
                <div class="form-group col-md-6">
                  <label for="inputEmail4">Propietario</label>
                  <select class="form-control" v-model="dato.id_propietario" required>
                    <option
                      v-for="option in propietarios"
                      v-bind:key="option.id"
                      v-bind:value="option.id"
                    >{{option.prop_fnombre}}</option>
                  </select>
                </div>
                <div class="form-group col-md-6">
                  <label for="inputPassword4">Conductor</label>
                  <select class="form-control" v-model="dato.id_conductor" required>
                    <option
                      v-for="option in conductores"
                      v-bind:key="option.id"
                      v-bind:value="option.id"
                    >{{option.prop_fnombre}}</option>
                  </select>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button class="btn btn-success" type="submit">Guardar</button>
            </div>
          </form>
        </div>
      </div>
    </div>

    <div
      class="modal fade"
      id="staticBackdrop2"
      data-backdrop="static"
      tabindex="-1"
      role="dialog"
      aria-labelledby="staticBackdropLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form role="form" @submit.prevent="editar(dato)">
            <div class="modal-body">
              <div class="row">
                <div class="form-group col-md-6">
                  <label for="inputEmail4">Placa</label>
                  <input type="text" name="PlacaMod" id="PlacaMod" class="form-control" v-model="dato.vehi_placa"  onkeypress="TextAndNumberMax6(event)" required />
                </div>
                <div class="form-group col-md-6">
                  <label for="inputPassword4">Color</label>
                  <input type="text" class="form-control" v-model="dato.vehi_color" onkeypress="TextOnly(event)" required />
                </div>
              </div>
              <div class="row">
                <div class="form-group col-md-6">
                  <label for="inputEmail4">Marca</label>
                  <input type="text" class="form-control" v-model="dato.vehi_marca" onkeypress="TextOnlyWhiteSpace(event)" required />
                </div>
                <div class="form-group col-md-6">
                  <label for="inputPassword4">Tipo</label>
                  <select class="form-control" v-model="dato.vehi_tipo_vehiculo" required>
                    <option value="particular">particular</option>
                    <option value="publico">publico</option>
                  </select>
                </div>
              </div>
              <div class="row">
                <div class="form-group col-md-6">
                  <label for="inputEmail4">Propietario</label>
                  <select class="form-control" v-model="dato.id_propietario" required>
                    <option
                      v-for="option in propietarios"
                      v-bind:key="option.id"
                      v-bind:value="option.id"
                    >{{option.prop_fnombre}}</option>
                  </select>
                </div>
                <div class="form-group col-md-6">
                  <label for="inputPassword4">Conductor</label>
                  <select class="form-control" v-model="dato.id_conductor" required>
                    <option
                      v-for="option in conductores"
                      v-bind:key="option.id"
                      v-bind:value="option.id"
                    >{{option.prop_fnombre}}</option>
                  </select>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button class="btn btn-success" type="submit">Editar</button>
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
      datos: [],
      propietarios: [],
      conductores: [],
      dato: {
        id: "",
        vehi_placa: "",
        vehi_color: "",
        vehi_marca: "",
        vehi_tipo_vehiculo: "",
        id_propietario: "",
        id_conductor: ""
      },
      busqueda: "",
      pagination: {
        total: 0,
        current_page: 0,
        per_page: 0,
        last_page: 0,
        from: 0,
        to: 0
      }
    };
  },
  created() {
    axios.get("/vehiculo").then(res => {
      (this.datos = res.data.vehiculo.data),
        (this.propietarios = res.data.propietario),
        (this.conductores = res.data.conductor),
        (this.pagination = res.data.paginate);
    });
  },
  computed: {
    isActive: function() {
      return this.pagination.current_page;
    },
    pagesNumber: function() {
      if (!this.pagination.to) {
        return [];
      }
      var from = this.pagination.current_page - 2; //todo offset
      if (from < 1) {
        from = 1;
      }
      var to = from + 2 * 2; //todo
      if (to >= this.pagination.last_page) {
        to = this.pagination.last_page;
      }

      var pagesArray = [];
      while (from <= to) {
        pagesArray.push(from);
        from++;
      }
      return pagesArray;
    }
  },
  methods: {
    getprop(id) {
      return this.propietarios.find(element => element.id == id).prop_fnombre;
    },
    getcond(id) {
      return this.conductores.find(element => element.id == id).prop_fnombre;
    },
    agregar() {
      const datoNueva = this.dato;
      this.dato = {
        id: "",
        vehi_placa: "",
        vehi_color: "",
        vehi_marca: "",
        vehi_tipo_vehiculo: "",
        id_propietario: "",
        id_conductor: ""
      };
      axios.post("/vehiculo", datoNueva).then(res => {
        const datoServidor = res.data;
        this.datos.push(datoServidor);
      });
      alert("Usuario Guardado con Correctamente");
    },

    eliminar(item, index) {
      const confirmacion = confirm(
        `desea eliminar el vehiculo: ${item.prop_fnombre}`
      );
      if (confirmacion) {
        axios
          .delete(`/vehiculo/${item.id}`)
          .then(() => {
            this.datos.splice(index, 1);
          })
          .catch(function(error) {
            alert(
              "el usuario no se puede eliminar: se encunetra asociado a un vehiculo"
            );
          });
      }
    },
    info(item) {
      this.dato.id = item.id;
      this.dato.vehi_placa = item.vehi_placa;
      this.dato.vehi_color = item.vehi_color;
      this.dato.vehi_marca = item.vehi_marca;
      this.dato.vehi_tipo_vehiculo = item.vehi_tipo_vehiculo;
      this.dato.id_propietario = item.id_propietario;
      this.dato.id_conductor = item.id_conductor;
    },
    editar(dato) {
      const params = {
        vehi_placa: dato.vehi_placa,
        vehi_color: dato.vehi_color,
        vehi_marca: dato.vehi_marca,
        vehi_tipo_vehiculo: dato.vehi_tipo_vehiculo,
        id_propietario: dato.id_propietario,
        id_conductor: dato.id_conductor
      };
      axios.put(`/vehiculo/${dato.id}`, params).then(res => {
        axios.get("/vehiculo").then(res => {
          this.datos = res.data.vehiculo.data;
        });
        alert("vehiculo Editado Correctamente");
      });
    },
    buscar() {
      axios.get(`/vehiculos?vehi_placa=${this.busqueda}`).then(res => {
        this.datos = res.data;
      });
    },
    getvehiculo: function(page) {
      axios.get("vehiculo?page=" + page).then(res => {
        (this.datos = res.data.vehiculo.data),
          (this.pagination = res.data.paginate);
      });
    },
    changePage: function(page) {
      this.pagination.current_page = page;
      this.getvehiculo(page);
    },
    // TextOnly(event) {
    //   if (event.charCode > 64 || event.charCode < 91) {
    //     event.returnValue = false;
    //   } else {
    //     event.returnValue = true;
    //   }
    // }
  }
};
</script>
