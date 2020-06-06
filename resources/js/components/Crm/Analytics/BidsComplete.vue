<template>
  <v-col xs="12" sm="12" md="3">
    <v-card color="success">
      <v-card-title>Готово</v-card-title>
      <v-col class="count-color text-center display-2 pa-9">
        {{ bidsData }}
      </v-col>
    </v-card>
  </v-col>
</template>

<script>
export default {
  name: 'BidsComplete',
  data: ()=>({
    bidsData: {},
    analytics: {},
  }),
  async created() {
    const httpData = await this.$http.get(`${this.$host}/analytics/bids/complete`);
    this.bidsData = httpData.data.count;
  },
};
</script>

<style lang="scss" scoped>
      .count-color{
            color: #ffffff;
      }
</style>
