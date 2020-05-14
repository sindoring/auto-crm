<template>
  <div>
    <v-card class="mb-12">
      <div v-for="(data, index) in userInfo" :key="index">
        {{ index }}: {{ data }}
      </div>
    </v-card>

    <v-card>
      <div v-for="(data, index) in userInfo.workshop" :key="index">
        {{ index }}: {{ data }}
      </div>
    </v-card>
  </div>
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
};
</script>

<style>

</style>
