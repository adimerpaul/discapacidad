<template>
  <q-layout view="lHh Lpr lFf">
    <q-header >
      <q-toolbar>
        <q-btn
          flat
          dense
          round
          icon="menu"
          aria-label="Menu"
          @click="leftDrawerOpen = !leftDrawerOpen"
        />

        <q-toolbar-title>
          {{$store.state.login.user.name}}
        </q-toolbar-title>
        <div>Discapacitados {{ $q.version }}</div>
      </q-toolbar>
      <div class="q-px-lg q-pt-xl q-mb-md">
        <div class="text-h3">G.A.M.O.</div>
        <div class="text-subtitle1">{{now}} </div>
      </div>
      <q-img
        src="~assets/mountains.jpg"
        class="header-image absolute-top"
      />
    </q-header>

    <q-drawer
      v-model="leftDrawerOpen"
      show-if-above
      :width="270"
      :breakpoint="600"
    >
      <q-scroll-area style="height: calc(100% - 192px); margin-top: 192px; border-right: 1px solid #ddd">
        <q-list bordered>
          <q-item to="/" exact clickable v-ripple>
            <q-item-section avatar>
              <q-icon name="home" />
            </q-item-section>
            <q-item-section>
              <q-item-label> Principal</q-item-label>
              <q-item-label caption>Menu de consulta</q-item-label>
            </q-item-section>
          </q-item>
          <q-item to="/login" exact clickable v-ripple v-if="!$store.getters['login/isLoggedIn']">
            <q-item-section avatar>
              <q-icon name="login" />
            </q-item-section>
            <q-item-section>
              <q-item-label> Ingresar</q-item-label>
              <q-item-label caption>Ingresar al sistema</q-item-label>
            </q-item-section>
          </q-item>
          <q-item to="importar"  exact clickable v-ripple v-if="$store.getters['login/isLoggedIn']">
            <q-item-section avatar>
              <q-icon name="upload" />
            </q-item-section>
            <q-item-section>
              <q-item-label> Importar</q-item-label>
              <q-item-label caption>Controlar Importacion</q-item-label>
            </q-item-section>
          </q-item>
          <q-item to="user"  exact clickable v-ripple v-if="$store.getters['login/isLoggedIn']">
            <q-item-section avatar>
              <q-icon name="people" />
            </q-item-section>
            <q-item-section>
              <q-item-label> Usuarios</q-item-label>
              <q-item-label caption>Controlar Importacion</q-item-label>
            </q-item-section>
          </q-item>

          <q-item to="pago"  exact clickable v-ripple v-if="$store.getters['login/isLoggedIn']">
            <q-item-section avatar>
              <q-icon name="money" />
            </q-item-section>
            <q-item-section>
              <q-item-label> Pago</q-item-label>
              <q-item-label caption>Control de pagos</q-item-label>
            </q-item-section>
          </q-item>
          <q-item to="pagorealizado"  exact clickable v-ripple v-if="$store.getters['login/isLoggedIn']">
            <q-item-section avatar>
              <q-icon name="shop" />
            </q-item-section>
            <q-item-section>
              <q-item-label> Pagos Realizados</q-item-label>
              <q-item-label caption>Control de pagos</q-item-label>
            </q-item-section>
          </q-item>
          <q-item to="pagofaltantes"  exact clickable v-ripple v-if="$store.getters['login/isLoggedIn']">
            <q-item-section avatar>
              <q-icon name="code" />
            </q-item-section>
            <q-item-section>
              <q-item-label> Pagos Faltantes</q-item-label>
              <q-item-label caption>Control de pagos</q-item-label>
            </q-item-section>
          </q-item>
          <q-item to="mispagos"  exact clickable v-ripple v-if="$store.getters['login/isLoggedIn']">
            <q-item-section avatar>
              <q-icon name="paid" />
            </q-item-section>
            <q-item-section>
              <q-item-label> Mis pagos </q-item-label>
              <q-item-label caption>MIs pagos</q-item-label>
            </q-item-section>
          </q-item>


          <q-item @click="logout"  exact clickable v-ripple v-if="$store.getters['login/isLoggedIn']">
            <q-item-section avatar>
              <q-icon name="logout" />
            </q-item-section>
            <q-item-section>
              <q-item-label> Salir</q-item-label>
              <q-item-label caption>Salir del sistema</q-item-label>
            </q-item-section>
          </q-item>
        </q-list>
      </q-scroll-area>

      <q-img class="absolute-top" src="~assets/mountains.jpg" style="height: 192px">
        <div class="absolute-bottom bg-transparent">
          <q-avatar size="56px" class="q-mb-sm">
            <img src="~assets/logo.png">
          </q-avatar>
          <div class="text-weight-bold">G.A.M.O.</div>
          <div>Gobierno autonomo</div>
        </div>
      </q-img>
    </q-drawer>

    <q-page-container>
      <router-view />
    </q-page-container>
  </q-layout>
</template>

<script>
import {date} from 'quasar';
export default {
  name: 'MainLayout',
  data () {
    return {
      leftDrawerOpen: false,
      // essentialLinks: linksData
    }
  },
  computed:{
    now(){
      let timeStamp = Date.now()
      // let formattedString = date.formatDate(timeStamp, 'dddd D MMMM');
      let formattedString = date.formatDate(timeStamp, 'dddd D MMMM', {
        days: ['Domingo', 'Lunes','Martes','Miercoles','Jueves','Viernes','Sabado','Domingo' /* and all the rest of days - remember starting with Sunday */],
        daysShort: ['Dum', 'Lun', /* and all the rest of days - remember starting with Sunday */],
        months: ['Enero', 'Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre', /* and all the rest of months */],
        monthsShort: ['Ian', 'Feb', /* and all the rest of months */]
      })
      return formattedString
    }
  },
  methods:{
    logout(){
      this.$q.loading.show()
      this.$store.dispatch('login/logout')
        .then(() => {
          this.$q.loading.hide()
          this.$router.push('/login')
        })
    }
  }
}
</script>
<style lang="scss">
.header-image{
  height: 100%;
  z-index: -1;
  opacity: 0.2;
  filter: grayscale(100%);
}
</style>
