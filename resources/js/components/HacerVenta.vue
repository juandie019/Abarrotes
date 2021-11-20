<template>
    <div id="app">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-12">
                            <div  @submit.prevent = "buscarProducto()">
                                <div class="row">
                                    <div class ="col-md-3 form-inline text-primary">
                                        <div class="text-left">Folio:</div>
                                        <div v-text="folio" class="text-right ml-1"></div>
                                    </div>
                                    <div class ="col-md-2 form-inline text-primary">
                                        <div class="text-left">ID Cajero: </div>
                                        <div class="text-right ml-1" v-text="empleadoId"></div>
                                    </div>
                                    <div class="col-md-3">
                                        <input type="text" v-model="id_producto" class="form-control" name="id_producto"  required autocomplete="id_producto" autofocus placeholder="Id de producto">
                                    </div>
                                    <div class="col-md-2">
                                        <input id="cantidad" v-model="cantidad" type="number" class="form-control" name="cantidad"  required placeholder="Cantidad de productos">
                                    </div>
                                    <div class="col-md-2">
                                        <input type="submit" class="btn btn-primary form-control"  value = "Agregar producto" @click = "buscarProducto">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="table-responsive">
                            <table class="table">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>Id producto</th>
                                        <th>Nombre</th>
                                        <th>Descripcion</th>
                                        <th>Precio</th>
                                        <th>Cantidad</th>
                                        <th>Total</th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tr v-for="(producto, index) in productos" :key="index">
                                    <td>{{producto['id_producto']}}</td>
                                    <td>{{producto['nombre']}}</td>
                                    <td>{{producto['descripcion']}}</td>
                                    <td>{{producto['precio']}}</td>
                                    <td>{{producto['cantidad']}}</td>
                                    <td>{{producto['total']}}</td>
                                    <th></th><th></th>
                                </tr>
                                <tr class="table-info">
                                    <th></th><th></th> <th></th><th></th><th></th>
                                    <th>{{this.subtotal}}</th>
                                    <th>Subtotal</th>
                                    <th></th><th></th>
                                </tr>
                                <tr class="table-primary">
                                    <th></th><th></th><th></th>
                                    <th>Total</th>
                                    <th>{{this.total_productos}}</th>
                                    <th>{{this.total}}</th>
                                    <th >IVA {{(this.total - this.subtotal).toFixed(2)}}</th>
                                    <th></th><th></th>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="col-md-2" v-if = this.productos.length>
                        <input type="submit" class="btn btn-primary form-control" @click = "registrarVenta" value="Finalizar Venta">
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import swal from 'sweetalert';
    export default {

        props: ['folioAux', 'empleadoId'],

        data(){
            return{
                id_producto: '',
                cantidad: 1,
                subtotal: 0,
                total: 0,
                total_productos: 0,
                productos: [],
                folio: '',
                subtotalAux: 0,
            }
        },


        mounted() {
            this.folio = this.folioAux;
        },

        methods: {
          buscarProducto(){
            if(this.posicion >= 0){ //buscamos si el producto ya existe en la lista;
                if(this.productos[this.posicion].cantidad_disponible < this.cantidad){
                    swal("No suficiente en stock", "Cantidad disponible: " + this.productos[this.posicion].cantidad_disponible, "error");
                    this.cantidad = 1;
                }else{
                    var precio = this.productos[this.posicion].precio;

                    this.productos[this.posicion].cantidad += parseInt(this.cantidad);
                    this.productos[this.posicion].total = precio * parseInt(this.productos[this.posicion].cantidad);

                    this.productos[this.posicion].cantidad_disponible -=  this.cantidad;
                    this.subtotal += precio * parseInt(this.cantidad);
                    this.id_producto = '';
                    this.total_productos += parseInt(this.cantidad);

                    this.total = this.subtotal + (this.subtotal * .16);
                }
            }else{
                    axios.post('/producto/search', {id: this.id_producto , cantidad:this.cantidad})
                    .then(response => {
                        console.log(response.data);
                        if(response.data['noFound']){
                            swal("No se encontro el producto", "ID: " + this.id_producto, "error");
                            this.id_producto = '';
                        }else if(response.data['noSuficiente']){
                            swal("No suficiente en stock", "Cantidad disponible: " + response.data['cantidad'], "error");
                            this.cantidad = 1;
                        }
                        else{
                            this.productos.push({
                                id_producto: response.data['id_producto'],
                                nombre: response.data['nombre'],
                                descripcion: response.data['observaciones'],
                                precio: response.data['precio'],
                                cantidad: this.cantidad,
                                cantidad_disponible: response.data['stock'] - this.cantidad,
                                total: response.data['precio'] * parseInt(this.cantidad),
                            })

                            this.id_producto = '';
                            this.subtotal += response.data['precio'] * parseInt(this.cantidad);
                            this.total_productos += parseInt(this.cantidad);
                            this.total = this.subtotal + (this.subtotal * .16);
                        }
                    })
                  .catch(function (error){
                   console.log(error);
                })
            }
          },

          registrarVenta(){
              axios.post('/venta/store',
              {data:{lista:this.productos, id_cliente:this.id_cliente_real,descuento:this.descuento,
               cantidad:this.total_productos, total:this.total, folio:this.folio, cantidad_cupones:this.cantidad_cupones}
              })
              .then(response => {
                  //recuperar errores
                  swal("Venta registrada", "Con Exito", "success");

                  this.folio = response.data;
                  this.productos = [];
                  this.cliente = '';
                  this.id_cliente = '';
                  this.id_cliente_real = '';
                  this.cantidad = 1;
                  this.total_productos = 0;
                  this.total = 0;
                  this.subtotal = 0;
                  this.descuento = 0;
                  this.id_producto = '';
                  this.cupon = false;
                  this.nombre_cliente = '';
               })
          },
        },

        computed: {
            posicion: function () {
                for (var i=0; i < this.productos.length; i++) {
                    if (this.productos[i].id_producto == this.id_producto) {
                      return this.posicion = i;
                    }
                }
                return this.posicion = -1;
            }
        },
    }
</script>
