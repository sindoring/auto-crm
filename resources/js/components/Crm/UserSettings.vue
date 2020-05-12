<template>
  <v-card>
    {{ userInfo }}
  </v-card>
</template>

<script>
export default {
  name: 'UserSettings',
  data: ()=>({
    userInfo: {},
  }),
  created() {
    this.$http.get(`${this.$host}/user`).then((res)=>{
      this.userInfo = res.data;
    });
  },
  //   methods: {
  //     getUserData() {

//     },
//   },
};
</script>

<style>

</style>
