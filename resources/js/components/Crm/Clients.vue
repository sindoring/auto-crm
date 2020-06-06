<template>
  <v-card>
    <v-card-title>
      <v-btn @click="addClient = !addClient">
        Добавить клиента
      </v-btn>
    </v-card-title>
    <v-card-text v-if="clients">
      <card-client v-for="(client, key) in clients" :key="key" :client="client" @update="getClients" />
    </v-card-text>
    <v-card-text v-else>
      <v-card-title>Добавьте клиента</v-card-title>
    </v-card-text>
    <bid-add-client v-model="addClient" @update="getClients" />
  </v-card>
</template>

<script>
import BidAddClient from './BidsContent/BidAddClient';
import CardClient from './ClientContent/ClientCard';

export default {
  name: 'Clients',
  components: { CardClient, BidAddClient },
  data: ()=>({
    addClient: false,
    clients: [],
  }),
  async created() {
    await this.getClients();
  },
  methods: {
    async getClients() {
      const httpRequest = await this.$http.get(`${this.$host}/clients`);
      this.clients = httpRequest.data;
    },
  },
};
</script>

<style>

</style>
