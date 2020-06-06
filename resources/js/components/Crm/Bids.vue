<template>
  <v-card>
    <v-card-title>
      <v-btn @click="addBid = !addBid">
        Добавить заявку
      </v-btn> <v-spacer /> <v-btn @click="addBidClient = !addBidClient">
        Добавить клиента
      </v-btn>
    </v-card-title>
    <v-row v-if="services">
      <v-col v-for="(service, key) in services" :key="key" cols="12">
        <bids-card :bid="service" @update="getBids" />
      </v-col>
    </v-row>
    <v-row v-else>
      <v-card-title>Список заявок пуст</v-card-title>
    </v-row>
    <bid-add v-model="addBid" @update="getBids" />
    <bid-add-client v-model="addBidClient" @update="getBids" />
  </v-card>
</template>

<script>
import BidsCard from './BidsContent/BidsCard';
import BidAdd from './BidsContent/BidAdd';
import BidAddClient from './BidsContent/BidAddClient';

export default {
  name: 'Bids',
  components: { BidsCard, BidAdd, BidAddClient },
  data: ()=>({
    addBid: false,
    addBidClient: false,
    bidEdit: false,
    services: [],
  }),
  async created() {
    await this.getBids();
  },
  methods: {
    async getBids() {
      const bidsData = await this.$http.get(`${this.$host}/bids/`);
      this.services = bidsData.data;
      console.log(this.services);
    },
  },
};
</script>

<style>

</style>
