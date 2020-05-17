<template>
  <v-card>
    <v-card-title> {{ workshopData.name }}</v-card-title>
    <v-card-subtitle>{{ workshopData.address }}</v-card-subtitle>
    <v-card-text>
      <bids-analize />
    </v-card-text>
  </v-card>
</template>

<script>
import BidsAnalize from './Analytics/BidsAnalize';

export default {
  name: 'Dashboard',
  components: { BidsAnalize },
  data: ()=>({
    userData: {},
    workshopData: {},
  }),
  async beforeCreate() {
    const httpData = await this.$http.get(`${this.$host}/dashboard`);
    this.workshopData = httpData.data.workshop;
  },

};
</script>

<style>

</style>
