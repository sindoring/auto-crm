<template>
  <v-app>
    <v-content>
      <v-app-bar
        dark
      >
        <v-app-bar-nav-icon @click="drawer = true" />

        <v-toolbar-title>{{ title }}</v-toolbar-title>
        <v-spacer />
        <form action="/logout" method="POST">
          <crfs-token-input />
          <v-btn type="submit">
            Выход
          </v-btn>
        </form>
      </v-app-bar>

      <v-navigation-drawer
        v-model="drawer"
        absolute
        temporary
      >
        <v-list
          nav
          dense
        >
          <v-list-item-group
            active-class="text--accent-4"
          >
            <v-list-item v-for="(route, index) in routes" :key="index" @click="redirect(route)">
              <v-list-item-icon>
                <v-icon>{{ route.mdi }}</v-icon>
              </v-list-item-icon>
              <v-list-item-title>
                {{ route.name }}
              </v-list-item-title>
            </v-list-item>
          </v-list-item-group>
        </v-list>
      </v-navigation-drawer>
      <v-container>
        <router-view />
      </v-container>
    </v-content>
  </v-app>
</template>

<script>
import CrfsTokenInput from '../Landing/CrfsTokenInput';

export default {
  name: 'CrmLayout',
  components: { CrfsTokenInput },
  data: ()=>({
    drawer: false,
    routes: [],
    title: 'Дашборд',
    userPermission: '',
  }),
  async created() {
    this.userPermission = this.$permission;

    this.$router.options.routes.forEach((route) => {
      if (this.userPermission=='admin') {
        this.routes.push({
          name: route.meta.title,
          mdi: route.meta.mdi,
          path: route.path,
        });
      } else {
        if (route.path == '/crm/bids') {
          this.routes.push({
            name: route.meta.title,
            mdi: route.meta.mdi,
            path: route.path,
          });
        }
      }
    });
  },
  methods: {
    redirect(route) {
      this.$router.push(route.path).catch((err)=>{});
      this.title = route.name;
    },
  },
};
</script>

<style>

</style>
