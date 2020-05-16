<template>
  <div>
    <v-card class="mb-12">
      <div v-for="(data, index) in userInfo" :key="index">
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
    this.$http.get(`${this.$host}/settings`).then((res)=>{
      this.userInfo = res.data;
    });
  },
};
</script>

<style>

</style>
