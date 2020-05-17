<template>
  <v-row>
    <v-col xs="12" sm="12" md="3">
      <v-card :color="analytics.color">
        <v-card-title>Всего заявок</v-card-title>
        <v-col class="count-color text-center display-2 pa-9">
          {{ bidsData.count }}
        </v-col>
      </v-card>
    </v-col>
  </v-row>
</template>

<script>
export default {
  name: 'BidsAnalize',
  data: ()=>({
    bidsData: {},
    analytics: {},
  }),
  async created() {
    const httpData = await this.$http.get(`${this.$host}/analytics/bids`);
    this.bidsData = httpData.data.bidsCount;
    this.analytics = httpData.data.bidsCount.analytics;
  },
};
</script>

<style lang="scss" scoped>
      .count-color{
            color: #ffffff;
      }
</style>
