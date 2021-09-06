<template>
  <q-page class="q-pa-xs">
    <q-card>
      <div class="text-h6">Pago</div>
      <br>
      <div class="row">
        <div class="col-6"> 
      <q-select
        filled
        v-model="carnet"
        use-input
        input-debounce="0"
        label="Listado Beneficiario"
        :options="options"
        @filter="filterFn"
        
      >
        <template v-slot:no-option>
          <q-item>
            <q-item-section class="text-grey">
              No results
            </q-item-section>
          </q-item>
        </template>
      </q-select>
      </div>
      <div class="col-2">
          <q-btn color="warning" icon="check" label="Buscar" @click="cargar" />

      </div>
      </div>
      <br>
      <div >
        <div >
          <!--template v-for="pag in pend">
           {{pag.mes}}
                
          </template-->
          <q-checkbox v-for="(pag,index) in pend" :key="index" v-model="pag.estado" val="teal" :label="pag.mes+' '+pag.gestion+' '+pag.monto+'Bs'" color="teal" size="lg" style="width:100%"/>

          <label for="">
          Total : {{total}} Bs.
          </label>
        </div>
        <div>
            <q-input v-model="responsable.ci" type="text" label="Cedula de Identidad" @keypress="buscaresp"/>
            <q-input v-model="responsable.nombre" type="text" label="Nombre Completo" />
            <q-input v-model="responsable.relacion" type="text" label="Relacion" />
        </div>
        <div>
        <q-uploader
              style="max-width: 300px"
              label="Fotografia"
              :factory="uploadFile"
              max-files="1"
              accept=".jpg,.png, image/*"
              v-model="imagen"
              lazy-rules
              :rules="[ val => val && val.length > 0 || 'Por favor ingresa foto']"
            />
        </div>
        <div class="row">
            <div class="col-12 ">
              <q-btn label="mandar" @click="guardar" class="full-width" color='teal' icon="send" />
            </div>
          </div>
      </div>
    </q-card>
  </q-page>
</template>

<script>
export default {
  data(){
    return{
      listado:[],
      options:[],
      carnet:'',
      pend:[],
      cancelar:[],
      responsable:{id:'',ci:'',nombre:'',relacion:''},
      imagen:''
    }
  },
  created(){
    this.listado=[];
     this.$axios.get(process.env.API+'/pago').then(res=>{
       console.log(res.data);
        res.data.forEach(element => {
            this.listado.push({label:element.nro+' '+element.razon,value:element.nro});          
        });
        this.options=this.listado;
     });
  },
  methods:{
    guardar(){
      if(this.pend.length==0 || this.total==0){
          this.$q.notify({
          color: 'red-5',
          textColor: 'white',
          icon: 'warning',
          message: 'No ha selecionado '
        });
        return false;
      }
      if(this.imagen.length==0){
          this.$q.notify({
          color: 'red-5',
          textColor: 'white',
          icon: 'warning',
          message: 'Debe  tomar Fotografia '
        });
        return false;
      }
      this.$axios.post(process.env.API+'/pago',{pend:this.pend,responsable:this.responsable,foto:this.imagen}).then(res=>{
       console.log(res.data);
       this.imagen='';
       this.responsable={id:'',ci:'',nombre:'',relacion:''};
       this.pend=[];
       this.carnet='';
               this.$q.notify({
          color: 'green-4',
          textColor: 'white',
          icon: 'cloud_done',
          message: 'Registrado Correctamente'
        });

     });
    },
    filterFn (val, update) {
      if (val === '') {
        update(() => {
          this.options = this.listado
          // with Quasar v1.7.4+
          // here you have access to "ref" which
          // is the Vue reference of the QSelect
        })
        return
      }
      update(() => {
        const needle = val.toLowerCase()
        this.options = this.listado.filter(v => v.label.toLowerCase().indexOf(needle) > -1)
      })
    },
    cargar(){
          console.log(this.carnet);
        this.$axios.post(process.env.API+'/verpendiente',{nro:this.carnet.value}).then(res=>{
          console.log(res.data);
          //this.pend=res.data;
          this.pend=[]
          res.data.forEach(r=>{
            this.pend.push({
              estado:false,
              id:r.id,
              mes:r.mes,
              gestion:r.gestion,
              monto:r.monto,
            })
          })
        })
        
    },
    buscaresp(){
        this.$axios.post(process.env.API+'/buscaresp',{ci:this.responsable.ci}).then(res=>{
          console.log(res.data);
          if(res.data.length==0){
                    this.responsable.nombre='';
                    this.responsable.relacion='';
                    this.responsable.id='';
                    }
          else{
                    this.responsable.nombre=res.data[0].nombre;
                    this.responsable.relacion=res.data[0].relacion;
                    this.responsable.id=res.data[0].id;
          }
        })

    },
    uploadFile(files) {
      this.file_path = files[0]
      const fileData = new FormData()
      fileData.append('imagen', this.file_path)
      const uploadFile = this.$axios.post(process.env.API+'/upload', fileData, {
        headers: {
          'Content-Type': 'multipart/form-data'
        }
      }).then((response) => {
        this.imagen=response.data;
        this.$q.notify({
          color: 'green-4',
          textColor: 'white',
          icon: 'cloud_done',
          message: 'Imagen subido correctamente!'
        });
      });
    },

  },
  computed:{
    
    total:function (){
      let t=0;
      this.pend.forEach(element => {
         if(element.estado)
          t+=parseFloat(element.monto);
      });
      return t.toFixed(2);
    }
  }
}
</script>
