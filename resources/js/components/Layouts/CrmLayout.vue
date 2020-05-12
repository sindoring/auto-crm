<template>
  <v-app>
    <v-content>
      <v-app-bar
        dark
      >
        <v-app-bar-nav-icon @click="drawer = true" />

        <v-toolbar-title>{{ title }}</v-toolbar-title>
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
export default {
  name: 'CrmLayout',
  data: ()=>({
    drawer: false,
    routes: [],
    title: 'Дашборд',
  }),
  created() {
    this.$router.options.routes.forEach((route) => {
      this.routes.push({
        name: route.meta.title,
        mdi: route.meta.mdi,
        path: route.path,
      });
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
