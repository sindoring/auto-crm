<template>
  <v-card>
    <v-card-title> ООО "СТО" </v-card-title>
    <v-card-subtitle>Ул. Ленина, дом 5</v-card-subtitle>
    <v-card-text>
      <v-card-title>Заявки</v-card-title>
      <v-divider />
      <v-row>
        <bids-analize />
        <bids-in-progress />
        <bids-complete />
        <bids-denied />
      </v-row>
    </v-card-text>
    <v-divider />
    <v-card-text v-if="services">
      <v-card-title>Последние заявки</v-card-title>
      <v-row>
        <v-col v-for="(service, key) in services" :key="key" cols="12">
          <bids-card :bid="service" @update="getBids" />
        </v-col>
      </v-row>
    </v-card-text>
    <v-card-text v-else>
      <v-card-title>Список последних заявок пуст</v-card-title>
    </v-card-text>
  </v-card>
</template>

<script>
import BidsAnalize from './Analytics/BidsAnalize';
import BidsInProgress from './Analytics/BidsInProgress';
import BidsComplete from './Analytics/BidsComplete';
import BidsDenied from './Analytics/BidsDenied';

import BidsCard from './BidsContent/BidsCard';

export default {
  name: 'Dashboard',
  components: { BidsAnalize, BidsInProgress, BidsComplete, BidsDenied, BidsCard },
  data: ()=>({
    userData: {},
    workshopData: {},
    services: [],
  }),
  async created() {
    await this.getBids();
  },
  methods: {
    async getBids() {
      const bidsData = await this.$http.get(`${this.$host}/bids/lastday`);
      this.services = bidsData.data;
    },
  },

};
</script>

<style>

</style>
