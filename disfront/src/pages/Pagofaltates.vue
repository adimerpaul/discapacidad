<template>
  <q-page class="q-pa-xs">
    <q-card>
      <div class="text-h6">Pagos Faltantes</div>
    </q-card>
    <div class="row">
      <div class="col-12">
        <q-card  bordered class="">
          <!--          <q-card-section>-->
          <!--            <div class="text-h6">-->
          <!--              Historial por dia-->
          <!--            </div>-->
          <!--          </q-card-section>-->
          <!--          <q-separator  inset />-->

          <q-card-section>
            <q-badge color="info" class="full-width text-h6 text-center" ><q-icon name="today"/>  Consulta por mes</q-badge>
            <q-form class="q-ma-xs" @submit.prevent="registrosmesfaltante">
              <div class="row">
                <div class="col-4 ">
                  <q-select outlined :options="meses" label="Mes" v-model="mes"/>
                </div>
                <div class="col-4 ">
                  <q-select outlined :options="anios" label="Año" v-model="anio"/>
                </div>
                <div class="col-4 flex flex-center">
                  <q-btn icon="search" label="Buscar" color="info" type="submit" />
                </div>
              </div>
            </q-form>
            <q-badge color="accent" class="full-width text-h6 text-center" ><q-icon name="today"/>  Consulta por Año</q-badge>
            <q-form class="q-ma-xs" @submit.prevent="registrosaniofaltante">
              <div class="row">
                <div class="col-6 ">
                  <q-select outlined :options="anios" label="Año" v-model="anio"/>
                </div>
                <div class="col-6 flex flex-center">
                  <q-btn icon="search" label="Buscar" color="negative" type="submit" />
                </div>
              </div>
            </q-form>
            <table id="example" class="display" style="width:100%">
              <thead>
              <tr>
                <th>#</th>
                <th>Nro</th>
                <th>Razon</th>
                <th>Mes</th>
                <th>Gestion</th>
                <th>Fecha pago</th>
                <th>Responsable</th>
                <th>Usuario</th>
              </tr>
              </thead>
              <tbody>
              <tr v-for="(re,index) in registros" :key="index">
                <td>{{index+1}}</td>
                <td>{{re.nro}}</td>
                <td>{{re.razon}}</td>
                <td>{{re.mes}}</td>
                <td>{{re.gestion}}</td>
                <td>{{re.fechapago}}</td>
                <td>{{re.responzable}}</td>
                <td>{{re.usuario}}</td>
              </tr>
              </tbody>
            </table>
          </q-card-section>
        </q-card>
      </div>
    </div>

  </q-page>
</template>
<script>
var $  = require( 'jquery' );
// // var dt = require( 'datatables.net' )( window, $ );
// require( 'jszip' );
// require( 'pdfmake' );
// require( 'datatables.net-dt' )();
// require( 'datatables.net-buttons-dt' )();
// require( 'datatables.net-buttons/js/buttons.colVis.js' )();
// import datatable from 'datatables.net-buttons-bs4'
require( 'datatables.net-buttons/js/buttons.html5.js' )();
require( 'datatables.net-buttons/js/buttons.print.js' )();
require('datatables.net-buttons/js/dataTables.buttons');
require('datatables.net-dt/css/jquery.dataTables.min.css');
import print from 'datatables.net-buttons/js/buttons.print';
import jszip from 'jszip/dist/jszip';
import pdfMake from 'pdfmake/build/pdfmake';
import pdfFonts from 'pdfmake/build/vfs_fonts';
pdfMake.vfs=pdfFonts.pdfMake.vfs;
window.JSZip=jszip;
import { date } from 'quasar';
export default {
  data(){
    return{
      fecha:date.formatDate(Date(),'YYYY-MM-DD',{
        // days: ['Duminica', 'Luni', /* and all the rest of days - remember starting with Sunday */],
        // daysShort: ['Dum', 'Lun', /* and all the rest of days - remember starting with Sunday */],
        months: [
          'ENERO',
          'FEBRERO',
          'MARZO',
          'ABRIL',
          'MAYO',
          'JUNIO',
          'JULIO',
          'AGOSTO',
          'SEPTIEMBRE',
          'OCTUBRE',
          'NOVIEMBRE',
          'DICIEMBRE',
        ],
        // monthsShort: ['Ian', 'Feb', /* and all the rest of months */]
      }),
      crear:false,
      registro:{tipo2:'NATURAL'},
      registros:[],
      mes:{
        val:date.formatDate(Date(),'M'),
        label:date.formatDate(Date(),'MMMM',{
          months: [
            'ENERO',
            'FEBRERO',
            'MARZO',
            'ABRIL',
            'MAYO',
            'JUNIO',
            'JULIO',
            'AGOSTO',
            'SEPTIEMBRE',
            'OCTUBRE',
            'NOVIEMBRE',
            'DICIEMBRE',
          ],
        })
      },
      meses:[
        {val:'ENERO',label:'ENERO'},
        {val:'FEBRERO',label:'FEBRERO'},
        {val:'MARZO',label:'MARZO'},
        {val:'ABRIL',label:'ABRIL'},
        {val:'MAYO',label:'MAYO'},
        {val:'JUNIO',label:'JUNIO'},
        {val:'JULIO',label:'JULIO'},
        {val:'AGOSTO',label:'AGOSTO'},
        {val:'SEPTIEMBRE',label:'SEPTIEMBRE'},
        {val:'OCTUBRE',label:'OCTUBRE'},
        {val:'NOVIEMBRE',label:'NOVIEMBRE'},
        {val:'DICIEMBRE',label:'DICIEMBRE'},
      ],
      tipos:[
        "C. BANC.",
        "C. GG.",
        "C. GRAL",
        "C. C.",
        "C. CAT.",
        "CN. COD.",
        "CN. NOMB.",
        "DRENAJE",
        "EXEDENCIA",
        "I. T.",
        "MOD. DATOS",
        "MOD. CI.",
        "R. IMP.",
        "REC.",
        "REC. COD.",
        "RECTA.",
        "REC. IMP.",
      ],
      anios:[],
      anio:date.formatDate(Date(),'YYYY'),
    }
  },
  mounted() {
    $('#example').DataTable( {
      dom: 'Bfrtip',
      buttons: [
        'copy', 'csv', 'excel', 'pdf', 'print'
      ]
    } );
    //this.misregistros();
    // console.log(
    //   date.formatDate(Date(),'M',{
    //     months: [
    //       'ENERO',
    //       'FEBRERO',
    //       'MARZO',
    //       'ABRIL',
    //       'MAYO',
    //       'JUNIO',
    //       'JULIO',
    //       'AGOSTO',
    //       'SEPTIEMBRE',
    //       'OCTUBRE',
    //       'NOVIEMBRE',
    //       'DICIEMBRE',
    //     ],
    //   })
    // )
    for (let i= parseInt( date.formatDate(Date(),'YYYY'))-30;i<= parseInt( date.formatDate(Date(),'YYYY'));i++){
      // console.log(i)
      this.anios.push(i)
    }
  },
  methods:{
    // cambio(re){
    //   // console.log(re);
    //   // re.tipo3='INACTIVO';
    //   this.$q.loading.show()
    //   this.$axios.put(process.env.API+'/registro/'+re.id).then(res=> {
    //     // console.log(res.data)
    //     // re.tipo3=res.data;
    //     // this.$q.loading.hide()
    //     this.misregistros()
    //   });
    // },
       registrosmesfaltante(){
      this.$q.loading.show()
      this.$axios.post(process.env.API+'/mesfaltante',{mes:this.mes.val,anio:this.anio}).then(res=>{
        console.log(res.data)
        this.registros=[]
        res.data.forEach(r=>{
          // console.log(r)
          this.registros.push({
            nro:r.nro+''+r.exp,
            razon:r.razon,
            mes:r.mes,
            gestion:r.gestion,
            fechapago:r.fechapago,
            estado:r.estado,
            monto:r.monto,
            responzable: r.responsable==undefined?'': r.responsable.nombre+' Parentesco:'+r.responsable.relacion,
            usuario:r.user.name,
          })
        })
        $('#example').DataTable().destroy();
        this.$nextTick(()=>{
          $('#example').DataTable( {
            dom: 'Bfrtip',
            buttons: [
              'copy', 'csv', 'excel', 'pdf', 'print'
            ],
            "order": [[ 0, "desc" ]]
          } );
          this.$q.loading.hide();
        })
      })
    },
    registrosaniofaltante(){
      this.$q.loading.show()
      this.$axios.post(process.env.API+'/aniofaltante',{anio:this.anio}).then(res=>{
        // console.log(res.data)
        this.registros=[]
        res.data.forEach(r=>{
          // console.log(r)
          this.registros.push({
            nro:r.nro+''+r.exp,
            razon:r.razon,
            mes:r.mes,
            gestion:r.gestion,
            fechapago:r.fechapago,
            estado:r.estado,
            monto:r.monto,
            responzable: r.responsable==undefined?'': r.responsable.nombre+' Parentesco:'+r.responsable.relacion,
            usuario:r.user.name,
          })
        })
        $('#example').DataTable().destroy();
        this.$nextTick(()=>{
          $('#example').DataTable( {
            dom: 'Bfrtip',
            buttons: [
              'copy', 'csv', 'excel', 'pdf', 'print'
            ],
            "order": [[ 0, "desc" ]]
          } );
          this.$q.loading.hide();
        })
      })
    },
    buscarcontribuyente(){
      // console.log()
      if (this.registro.ci!=''){
        this.$axios.get(process.env.API+'/contribuyente/'+this.registro.ci).then(res=>{
          if (res.data.length>0){
            // console.log(res.data)
            this.registro.contribuyente=res.data[0].contribuyente
          }
        })
      }
    },
    agregar(){
      if (this.registro.tipo=='' || this.registro.tipo==undefined){
        this.$q.notify({
          color:'red',
          icon:'error',
          message:'Tienes que selecionar tipo de tramite'
        })
        return false
      }
      // console.log(this.registro)
      this.$q.loading.show()
      this.$axios.post(process.env.API+'/registro',this.registro).then(res=>{
        // console.log(res.data)
        this.misregistros()
        this.registro={tipo2:'NATURAL'}
        // this.$q.loading.hide()
      })
    }
  }
}
</script>
